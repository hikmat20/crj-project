<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

/*
 * @author Hikmat Aolia
 * @copyright Copyright (c) 2023, Hikmat Aolia
 *
 * This is controller for Master Harbour Port
 */

class Trucking_containers extends Admin_Controller
{
	//Permission
	protected $viewPermission 	= 'Trucking_containers.View';
	protected $addPermission  	= 'Trucking_containers.Add';
	protected $managePermission = 'Trucking_containers.Manage';
	protected $deletePermission = 'Trucking_containers.Delete';

	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('upload', 'Image_lib'));
		$this->load->model(array(
			'Trucking_containers/Trucking_containers_model',
			'Aktifitas/aktifitas_model',
		));
		$this->template->title('Manage Trucking Containers');
		$this->template->page_icon('fas fa-truck-moving');
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
        FROM view_harbours, (SELECT @row_number:=0) as temp WHERE 1=1 $where  
        AND (`country_name` LIKE '%$string%'
        OR `country_code` LIKE '%$string%'
        OR `city_name` LIKE '%$string%'
        OR `description` LIKE '%$string%'
        OR `status` LIKE '%$string%')";

		$totalData = $this->db->query($sql)->num_rows();
		$totalFiltered = $this->db->query($sql)->num_rows();

		$columns_order_by = array(
			0 => 'num',
			1 => 'country_code',
			2 => 'city_name',
			3 => 'description',
			4 => 'status',
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
			$nestedData[]  = $row['country_code'];
			$nestedData[]  = $row['city_name'];
			$nestedData[]  = $row['description'];
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
		$this->template->render('under-construction');
		// $this->template->render('index');
	}

	public function add()
	{
		$this->auth->restrict($this->addPermission);
		$states = $this->db->order_by('name', 'ASC')->get_where('states', ['country_id' => '102'])->result_array();
		$cities = $this->db->order_by('name', 'ASC')->get_where('cities', ['country_id' => '102'])->result_array();
		$ArrStates = array_column($states, 'name', 'id');
		$ArrCities = [];
		foreach ($cities as $city) {
			$ArrCities[$city['state_id']][] = $city;
		}

		$this->template->set([
			'ArrStates' => $ArrStates,
			'ArrCities' => $ArrCities,
		]);
		$this->template->render('form');
	}

	public function edit($id)
	{
		$this->auth->restrict($this->viewPermission);
		$port = $this->db->get_where('harbours', array('id' => $id))->row();
		$countries = $this->db->get('countries')->result();
		$data = [
			'port' 		=> $port,
			'countries'	 	=> $countries,
		];
		$this->template->set($data);
		$this->template->render('form');
	}

	public function view()
	{
		$this->auth->restrict($this->viewPermission);
		$id 	= $this->input->post('id');
		$cust 	= $this->Inventory_1_model->getById($id);
		$this->template->set('result', $cust);
		$this->template->render('view');
	}

	public function save()
	{
		$this->auth->restrict($this->addPermission);
		$post = $this->input->post();
		$data = $post;
		$data['id'] = isset($post['id']) && $post['id'] ? $post['id'] : $this->Trucking_containers_model->generate_id();

		$this->db->trans_begin();
		if (isset($post['id']) && $post['id']) {
			$data['modified_at']	= date('Y-m-d H:i:s');
			$data['modified_by']	= $this->auth->user_id();
			$this->db->where('id', $post['id'])->update("harbours", $data);
		} else {
			$data['created_at']		= $data['modified_at'] = date('Y-m-d H:i:s');
			$data['created_by']		= $data['modified_by'] = $this->auth->user_id();
			$this->db->insert("harbours", $data);
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$return	= array(
				'msg'		=> 'Failed save data Harbour.  Please try again.',
				'status'	=> 0
			);
			$keterangan     = "FAILD save data Harbour " . $data['id'] . ", Harbour name : " . $data['city_name'];
			$status         = 1;
			$nm_hak_akses   = $this->addPermission;
			$kode_universal = $data['id'];
			$jumlah         = 1;
			$sql            = $this->db->last_query();
		} else {
			$this->db->trans_commit();
			$return	= array(
				'msg'		=> 'Success Save data Harbour.',
				'status'	=> 1
			);
			$keterangan     = "SUCCESS save data Harbour " . $data['id'] . ", Harbour name : " . $data['city_name'];
			$status         = 1;
			$nm_hak_akses   = $this->addPermission;
			$kode_universal = $data['id'];
			$jumlah         = 1;
			$sql            = $this->db->last_query();
		}
		simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
		echo json_encode($return);
	}

	public function delete()
	{
		$this->auth->restrict($this->deletePermission);
		$id = $this->input->post('id');
		$container = $this->db->get_where('harbours')->row_array();
		$data = [
			'status' => 0,
			'deleted_by' => $this->auth->user_id(),
			'deleted_at' => date('Y-m-d H:i:s'),
		];
		$this->db->trans_begin();
		$this->db->update('harbours', $data, ['id' => $id]);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$return	= array(
				'msg'		=> 'Failed delete data Harbour.  Please try again.',
				'status'	=> 0
			);
			$keterangan     = "FAILD delete data Harbour " . $container['id'] . ", Harbour name : " . $container['city_name'];
			$status         = 1;
			$nm_hak_akses   = $this->deletePermission;
			$kode_universal = $container['id'];
			$jumlah         = 1;
			$sql            = $this->db->last_query();
		} else {
			$this->db->trans_commit();
			$return	= array(
				'msg'		=> 'Success delete data Harbour.',
				'status'	=> 1
			);
			$keterangan     = "SUCCESS delete data Harbour " . $container['id'] . ", Harbour name : " . $container['city_name'];
			$status         = 1;
			$nm_hak_akses   = $this->deletePermission;
			$kode_universal = $container['id'];
			$jumlah         = 1;
			$sql            = $this->db->last_query();
		}
		simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
		echo json_encode($return);
	}
}
