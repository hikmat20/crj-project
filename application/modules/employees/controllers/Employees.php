<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

/*
 * @author Ichsan
 * @copyright Copyright (c) 2019, Ichsan
 *
 * This is controller for Master Supplier
 */

class Employees extends Admin_Controller
{
	//Permission
	protected $viewPermission 	= 'Employees.View';
	protected $addPermission  	= 'Employees.Add';
	protected $managePermission = 'Employees.Manage';
	protected $deletePermission = 'Employees.Delete';

	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('upload', 'Image_lib'));
		$this->load->model(array(
			'Employees/Employees_model',
			'Aktifitas/aktifitas_model',
		));
		$this->template->title('Employees Manager');
		$this->template->page_icon('fa fa-building-o');

		date_default_timezone_set('Asia/Bangkok');
	}

	public function getData()
	{
		$requestData    = $_REQUEST;
		$status         = $requestData['status'];
		$search         = $requestData['search']['value'];
		$column         = $requestData['order'][0]['column'];
		$dir            = $requestData['order'][0]['dir'];
		$start          = $requestData['start'];
		$length         = $requestData['length'];

		$where = "";
		$where = " AND `status` = '$status'";

		$string = $this->db->escape_like_str($search);
		$sql = "SELECT *,(@row_number:=@row_number + 1) AS num
        FROM employees, (SELECT @row_number:=0) as temp WHERE 1=1 $where  
        AND (`name` LIKE '%$string%'
        OR phone_number LIKE '%$string%'
        OR email LIKE '%$string%'
        OR `address` LIKE '%$string%'
        OR `status` LIKE '%$string%'
            )";

		$totalData = $this->db->query($sql)->num_rows();
		$totalFiltered = $this->db->query($sql)->num_rows();

		$columns_order_by = array(
			0 => 'num',
			1 => 'name',
			2 => 'phone_number',
			3 => 'email',
			4 => 'address',
			5 => 'status',
			6 => 'status',
			7 => 'status',
			8 => 'status',
			// 6 => '',
		);

		$sql .= " ORDER BY " . $columns_order_by[$column] . " " . $dir . " ";
		$sql .= " LIMIT " . $start . " ," . $length . " ";
		$query  = $this->db->query($sql);


		$data  = array();
		$urut1  = 1;
		$urut2  = 0;

		$status = [
			'0' => '<span class="bg-danger tx-white pd-5 tx-11 tx-bold rounded-5">Inactive</span>',
			'1' => '<span class="bg-info tx-white pd-5 tx-11 tx-bold rounded-5">Active</span>',
		];

		$empType = [
			'Tetap' => '<span class="bg-indigo tx-white pd-5 tx-11 tx-bold rounded-5">Tetap</span>',
			'Kontrak' => '<span class="bg-success tx-white pd-5 tx-11 tx-bold rounded-5">Kontrak</span>',
		];

		$gender = [
			'L' => 'Laki-laki',
			'P' => 'Perempuan',
		];

		/* Button */
		foreach ($query->result_array() as $row) {
			$buttons = '';
			$total_data     = $totalData;
			$start_dari     = $start;
			$asc_desc       = $dir;
			if (
				$asc_desc == 'asc'
			) {
				$nomor = $urut1 + $start_dari;
			}
			if (
				$asc_desc == 'desc'
			) {
				$nomor = ($total_data - $start_dari) - $urut2;
			}

			$view 		= '<button type="button" class="btn btn-primary btn-sm view" data-toggle="tooltip" title="View" data-id="' . $row['id'] . '"><i class="fa fa-eye"></i></button>';
			$edit 		= '<button type="button" class="btn btn-success btn-sm edit" data-toggle="tooltip" title="Edit" data-id="' . $row['id'] . '"><i class="fa fa-edit"></i></button>';
			$delete 	= '<button type="button" class="btn btn-danger btn-sm delete" data-toggle="tooltip" title="Delete" data-id="' . $row['id'] . '"><i class="fa fa-trash"></i></button>';
			$buttons 	= $view . "&nbsp;" . $edit . "&nbsp;" . $delete;

			$nestedData   = array();
			$nestedData[]  = $nomor;
			$nestedData[]  = $row['name'];
			$nestedData[]  = $row['phone_number'];
			$nestedData[]  = $row['email'];
			$nestedData[]  = $row['address'];
			$nestedData[]  = $gender[$row['gender']];
			$nestedData[]  = $empType[$row['employee_type']];
			$nestedData[]  = $status[$row['status']];
			$nestedData[]  = $buttons;
			$data[] = $nestedData;
			$urut1++;
			$urut2++;
		}

		$json_data = array(
			"draw"              => intval($requestData['draw']),
			"recordsTotal"      => intval($totalData),
			"recordsFiltered"   => intval($totalFiltered),
			"data"              => $data
		);

		echo json_encode($json_data);
	}

	public function index()
	{
		$this->auth->restrict($this->viewPermission);
		$this->template->title('Employees');
		$this->template->render('index');
	}
	public function add()
	{
		$this->auth->restrict($this->addPermission);
		$divisions = $this->db->get_where('divisions');
		$religions = $this->db->get_where('religions');

		$data = [
			'divisions' => $divisions,
			'religions' => $religions
		];
		$this->template->set($data);
		$this->template->render('form');
	}

	public function edit($id)
	{
		$this->auth->restrict($this->managePermission);
		$employee = $this->db->get_where('employees', array('id' => $id))->row();
		$divisions = $this->Employees_model->get_data('divisions');
		$religions = $this->Employees_model->get_data('religions');

		$this->template->set([
			'employee' => $employee,
			'divisions' => $divisions,
			'religions' => $religions
		]);
		$this->template->render('form');
	}

	public function delete()
	{
		$this->auth->restrict($this->deletePermission);
		$id = $this->input->post('id');
		$employee = $this->db->get_where('employees')->row_array();
		$data = [
			'status' 		=> 0,
			'deleted_at' 	=> date('Y-m-d H:i:s'),
			'deleted_by' 	=> $this->auth->user_id()
		];

		$this->db->trans_begin();
		$this->db->where('id', $id)->update("employees", $data);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$return	= array(
				'msg'		=> 'Failed delete data Employee.  Please try again.',
				'status'	=> 0
			);
			$keterangan     = "FAILD delete data Employee " . $employee['id'] . ", Employee name : " . $employee['name'];
			$status         = 1;
			$nm_hak_akses   = $this->deletePermission;
			$kode_universal = $employee['id'];
			$jumlah         = 1;
			$sql            = $this->db->last_query();
		} else {
			$this->db->trans_commit();
			$return	= array(
				'msg'		=> 'Success delete data Employee.',
				'status'	=> 1
			);
			$keterangan     = "SUCCESS delete data Employee " . $employee['id'] . ", Employee name : " . $employee['name'];
			$status         = 1;
			$nm_hak_akses   = $this->deletePermission;
			$kode_universal = $employee['id'];
			$jumlah         = 1;
			$sql            = $this->db->last_query();
		}
		simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
		echo json_encode($return);
	}
	public function viewKaryawan($id)
	{
		$this->auth->restrict($this->viewPermission);
		$this->template->page_icon('fa fa-edit');
		$karyawan = $this->db->get_where('employees', array('id_karyawan' => $id))->row();
		$divisi = $this->db->get_where('department_center')->result_array();
		$agama = $this->db->get_where('religion')->result_array();

		$div = array_column($divisi, 'nm_dept', 'id_dept');
		$agm = array_column($divisi, 'nm_dept', 'id_dept');

		$pendidikan = [
			"SD" => "SD",
			"SMP" => "SMP",
			"SMA" => "SMA",
			"DIPLOMA" => "DIPLOMA",
			"SARJANA" => "SARJANA",
			"MASTER" => "MASTER",
			"DOKTORAL" => "DOKTORAL",
			"PROFESOR" => "PROFESOR",
			"LAIN-LAIN" => "LAIN-LAIN",
		];

		$this->template->set([
			'karyawan' => $karyawan,
			'divisi' => $div,
			'agama' => $agm,
			'pendidikan' => $pendidikan,
		]);
		$this->template->title('Karyawan');
		$this->template->render('view_karyawan');
	}


	public function save()
	{
		$this->auth->restrict($this->addPermission);
		$post = $this->input->post();
		$data = $post;
		$data['id'] = isset($post['id']) && $post['id'] ?: $this->Employees_model->generate_id();

		$this->db->trans_begin();
		if (isset($post['id']) && $post['id']) {
			$data['modified_at']	= date('Y-m-d H:i:s');
			$data['modified_by']	= $this->auth->user_id();
			$this->db->where('id', $post['id'])->update("employees", $data);
		} else {
			$data['created_at']		= $data['modified_at'] = date('Y-m-d H:i:s');
			$data['created_by']		= $data['modified_by'] = $this->auth->user_id();
			$this->db->insert("employees", $data);
		}


		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$return	= array(
				'msg'		=> 'Failed save data Employee.  Please try again.',
				'status'	=> 0
			);
			$keterangan     = "FAILD save data Employee " . $data['id'] . ", Employee name : " . $data['name'];
			$status         = 1;
			$nm_hak_akses   = $this->addPermission;
			$kode_universal = $data['id'];
			$jumlah         = 1;
			$sql            = $this->db->last_query();
		} else {
			$this->db->trans_commit();
			$return	= array(
				'msg'		=> 'Success Save data Employee.',
				'status'	=> 1
			);
			$keterangan     = "SUCCESS save data Employee " . $data['id'] . ", Employee name : " . $data['name'];
			$status         = 1;
			$nm_hak_akses   = $this->addPermission;
			$kode_universal = $data['id'];
			$jumlah         = 1;
			$sql            = $this->db->last_query();
		}
		simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
		echo json_encode($return);
	}
}
