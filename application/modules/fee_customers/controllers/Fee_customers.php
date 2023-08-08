<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

/*
 * @author Hikmat Aolia
 * @copyright Copyright (c) 2023, Hikmat Aolia
 *
 * This is controller for Master Customers 
 */

class Fee_customers extends Admin_Controller
{
	//Permission
	protected $viewPermission 	= 'Fee_customers.View';
	protected $addPermission  	= 'Fee_customers.Add';
	protected $managePermission = 'Fee_customers.Manage';
	protected $deletePermission = 'Fee_customers.Delete';
	protected $type;

	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('upload', 'Image_lib'));
		$this->load->model(array(
			'Fee_customers/Fee_customers_model',
			'Aktifitas/aktifitas_model',
		));
		$this->template->title('Manage Fee Customers');
		$this->template->page_icon('fas fa-hand-holding-usd');
		$this->type = [
			"DDU" => "DDU", "APB" => "As Per Bill", "ALL" => "All In", "ULS" => "Undername Lartas", "UNL" => "Undername non Lartas",
		];

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
		$sql = "SELECT view_fee_customers.*,(@row_number:=@row_number + 1) AS num
        FROM view_fee_customers, (SELECT @row_number:=0) as temp WHERE 1=1 $where  
        AND (`customer_name` LIKE '%$string%'
        OR `employee_name` LIKE '%$string%'
        OR `fee_value` LIKE '%$string%'
        OR `description` LIKE '%$string%'
            )";

		$totalData = $this->db->query($sql)->num_rows();
		$totalFiltered = $this->db->query($sql)->num_rows();

		$columns_order_by = array(
			0 => 'num',
			1 => 'customer_name',
			2 => 'employee_name',
			3 => 'fee_value',
			4 => 'type',
			5 => 'description',
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
			$type 		= isset($row['type']) ? $this->type[$row['type']] : '-';

			$nestedData   = array();
			$nestedData[]  = $nomor;
			$nestedData[]  = $row['customer_name'];
			$nestedData[]  = $row['employee_name'];
			$nestedData[]  = 'Rp. ' . number_format($row['fee_value']);
			$nestedData[]  = $type;
			$nestedData[]  = $row['description'];
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
		$this->template->render('index');
	}

	public function add()
	{
		$this->auth->restrict($this->addPermission);
		$customers = $this->db->get_where('customers', ['status !=' => 'D', 'status !=' => '0'])->result();
		$this->template->set('customers', $customers);
		$this->template->render('form');
	}

	public function edit($id)
	{
		$this->auth->restrict($this->managePermission);
		$fee = $this->db->get_where('fee_customers', array('id' => $id))->row();
		$customers = $this->db->get_where('customers', ['status !=' => 'D', 'status !=' => '0'])->result();
		$data = [
			'fee' 			=> $fee,
			'customers'	 	=> $customers,
		];
		$this->template->set($data);
		$this->template->render('form');
	}

	public function view($id)
	{
		$this->auth->restrict($this->viewPermission);
		$fee = $this->db->get_where('fee_customers', array('id' => $id))->row();
		$customers = $this->db->get_where('customers', ['status !=' => 'D', 'status !=' => '0'])->result_array();
		$ArrCustomers = array_column($customers, 'customer_name', 'id_customer');

		$data = [
			'fee' 				=> $fee,
			'ArrCustomers'	 	=> $ArrCustomers,
			'type'	 			=> $this->type,
		];
		$this->template->set($data);
		$this->template->render('view');
	}

	public function save()
	{
		$this->auth->restrict($this->addPermission);
		$post = $this->input->post();
		$data = $post;
		$data['id'] = isset($post['id']) && $post['id'] ? $post['id'] : $this->Fee_customers_model->generate_id();
		$data['fee_value'] = str_replace(",", "", $post['fee_value']);

		$this->db->trans_begin();
		if (isset($post['id']) && $post['id']) {
			$data['modified_at']	= date('Y-m-d H:i:s');
			$data['modified_by']	= $this->auth->user_id();
			$this->db->where('id', $post['id'])->update("fee_customers", $data);
		} else {
			$data['created_at']		= $data['modified_at'] = date('Y-m-d H:i:s');
			$data['created_by']		= $data['modified_by'] = $this->auth->user_id();
			$this->db->insert("fee_customers", $data);
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$return	= array(
				'msg'		=> 'Failed save data Fee Customer.  Please try again.',
				'status'	=> 0
			);
			$keterangan     = "FAILD save data Fee Customer " . $data['id'];
			$status         = 1;
			$nm_hak_akses   = $this->addPermission;
			$kode_universal = $data['id'];
			$jumlah         = 1;
			$sql            = $this->db->last_query();
		} else {
			$this->db->trans_commit();
			$return	= array(
				'msg'		=> 'Success Save data Fee Customer.',
				'status'	=> 1
			);
			$keterangan     = "SUCCESS save data Fee Customer " . $data['id'];
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
		$fee = $this->db->get_where('fee_customers')->row_array();
		$data = [
			'status' => 0,
			'deleted_by' => $this->auth->user_id(),
			'deleted_at' => date('Y-m-d H:i:s'),
		];
		$this->db->trans_begin();
		$this->db->update('fee_customers', $data, ['id' => $id]);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$return	= array(
				'msg'		=> 'Failed delete data Fee Customer.  Please try again.',
				'status'	=> 0
			);
			$keterangan     = "FAILD delete data Fee Customer " . $fee['id'];
			$status         = 1;
			$nm_hak_akses   = $this->deletePermission;
			$kode_universal = $fee['id'];
			$jumlah         = 1;
			$sql            = $this->db->last_query();
		} else {
			$this->db->trans_commit();
			$return	= array(
				'msg'		=> 'Success delete data Fee Customer.',
				'status'	=> 1
			);
			$keterangan     = "SUCCESS delete data Fee Customer " . $fee['id'] . ", Fee Customer name : " . $fee['city_name'];
			$status         = 1;
			$nm_hak_akses   = $this->deletePermission;
			$kode_universal = $fee['id'];
			$jumlah         = 1;
			$sql            = $this->db->last_query();
		}
		simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
		echo json_encode($return);
	}
}
