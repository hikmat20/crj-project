<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

/*
 * @author Hikmat Aolia
 * @copyright Copyright (c) 2023, Hikmat Aolia
 *
 * This is controller for Requests HS Code
 */

class Requests extends Admin_Controller
{
	//Permission
	protected $viewPermission 	= 'Requests.View';
	protected $addPermission  	= 'Requests.Add';
	protected $managePermission = 'Requests.Manage';
	protected $deletePermission = 'Requests.Delete';

	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('upload', 'Image_lib'));
		$this->load->model(array(
			'Requests/Requests_model',
			'Aktifitas/aktifitas_model',
		));
		$this->template->title('Requests HS Code');
		$this->template->page_icon('far fa-list-alt');

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
        FROM requests, (SELECT @row_number:=0) as temp WHERE 1=1 $where  
        AND (`qty_container` LIKE '%$string%'
        OR `cost_value` LIKE '%$string%'
        OR `description` LIKE '%$string%'
        OR `status` LIKE '%$string%'
            )";

		$totalData = $this->db->query($sql)->num_rows();
		$totalFiltered = $this->db->query($sql)->num_rows();

		$columns_order_by = array(
			0 => 'num',
			1 => 'qty_container',
			2 => 'cost_value',
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
			$nestedData[]  = $row['qty_container'];
			$nestedData[]  = 'Rp. ' . number_format($row['cost_value']);
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
		$this->template->render('index');
	}

	public function add()
	{
		$this->template->title('Requests HS Code | Create Request');
		$this->auth->restrict($this->addPermission);
		$customers = $this->db->get_where('customers', ['status' => '1'])->result();
		$countries = $this->db->get_where('countries')->result();
		$this->template->set([
			'customers' => $customers,
			'countries' => $countries,
		]);
		$this->template->render('form');
	}

	public function edit($id)
	{
		$this->auth->restrict($this->managePermission);
		$surveyor = $this->db->get_where('Requests', array('id' => $id))->row();
		$containers = $this->db->get_where('containers', ['status' => '1'])->result();
		$data = [
			'surveyor' 		=> $surveyor,
			'containers'	=> $containers,
		];
		$this->template->set($data);
		$this->template->render('form');
	}

	public function view($id)
	{
		$this->auth->restrict($this->viewPermission);
		$surveyor = $this->db->get_where('Requests', array('id' => $id))->row();
		$this->template->set([
			'surveyor' => $surveyor,
		]);
		$this->template->render('view');
	}

	public function save()
	{
		$this->auth->restrict($this->addPermission);
		$post 			= $this->input->post();
		$data 			= $post;
		$data['id'] 	= isset($post['id']) && $post['id'] ? $post['id'] : $this->Requests_model->generate_id();
		$data['date'] 	= date("Y-m-d", strtotime($post['date']));
		$detail 		= $post['detail'];
		unset($data['detail']);
		$this->db->trans_begin();
		if (isset($post['id']) && $post['id']) {
			$data['modified_at']	= date('Y-m-d H:i:s');
			$data['modified_by']	= $this->auth->user_id();
			$this->db->where('id', $post['id'])->update("requests", $data);
		} else {
			$data['created_at']		= $data['modified_at'] = date('Y-m-d H:i:s');
			$data['created_by']		= $data['modified_by'] = $this->auth->user_id();
			$this->db->insert("requests", $data);
		}

		if ($detail) {
			$dtlId =  ($this->Requests_model->getDetailId($data['id']));
			foreach ($detail as $dtl) {
				$dtlId++;
				$dtl['request_id'] = $data['id'];
				$dtl['id'] = isset($dtl['id']) && $dtl['id'] ? $data['id'] : $data['id'] . "-" . str_pad($dtlId, 4, "0", STR_PAD_LEFT);
				$check = $this->db->get_where('request_detail', ['id' => $dtl['id']])->num_rows();
				if ($check > 0) {
					$this->db->update('request_detail', $dtl, ['id' => $dtl['id']]);
				} else {
					$this->db->insert('request_detail', $dtl);
				}
			}
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$return	= array(
				'msg'		=> 'Failed save data Requests HS Code.  Please try again.',
				'status'	=> 0
			);
			$keterangan     = "FAILD save data Requests HS Code" . $data['id'];
			$status         = 1;
			$nm_hak_akses   = $this->addPermission;
			$kode_universal = $data['id'];
			$jumlah         = 1;
			$sql            = $this->db->last_query();
		} else {
			$this->db->trans_commit();
			$return	= array(
				'msg'		=> 'Success Save data Requests HS Code.',
				'status'	=> 1
			);
			$keterangan     = "SUCCESS save data Requests HS Code" . $data['id'];
			$status         = 1;
			$nm_hak_akses   = $this->addPermission;
			$kode_universal = $data['id'];
			$jumlah         = 1;
			$sql            = $this->db->last_query();
			$this->session->set_flashdata('msg', 'Success Save data Requests HS Code.');
		}
		simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
		echo json_encode($return);
	}

	public function delete()
	{
		$this->auth->restrict($this->deletePermission);
		$id = $this->input->post('id');
		$dt = $this->db->get_where('Requests')->row_array();
		$data = [
			'status' => '0',
			'deleted_by' => $this->auth->user_id(),
			'deleted_at' => date('Y-m-d H:i:s'),
		];
		$this->db->trans_begin();
		$this->db->update('Requests', $data, ['id' => $id]);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$return	= array(
				'msg'		=> 'Failed delete data Requests.  Please try again.',
				'status'	=> 0
			);
			$keterangan     = "FAILD delete data Requests " . $dt['id'];
			$status         = 1;
			$nm_hak_akses   = $this->deletePermission;
			$kode_universal = $dt['id'];
			$jumlah         = 1;
			$sql            = $this->db->last_query();
		} else {
			$this->db->trans_commit();
			$return	= array(
				'msg'		=> 'Success delete data Requests.',
				'status'	=> 1
			);
			$keterangan     = "SUCCESS delete data Requests " . $dt['id'];
			$status         = 1;
			$nm_hak_akses   = $this->deletePermission;
			$kode_universal = $dt['id'];
			$jumlah         = 1;
			$sql            = $this->db->last_query();
		}
		simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
		echo json_encode($return);
	}

	/* LOAD DATA */
	public function load_marketing()
	{
		$customer_id = $this->input->post('customer_id');
		$get_cust = $this->db->get_where('customers', ['id_customer' => $customer_id])->row();
		$get_sales = $this->db->get_where('employees', ['id' => $get_cust->sales_id])->row();
		echo json_encode($get_sales);
	}

	public function importdata()
	{
		$this->load->library('excel');
		$log_import = [];
		$data = [];
		if (isset($_FILES['file']['name'])) {
			$file_tmp = $_FILES['file']['tmp_name'];
			$file_name = $_FILES['file']['name'];
			$file_type = $_FILES['file']['type'];
			$config['allowed_types']        = 'xlsx';
			$log_import = [
				'file_name' 	=> "File name " . $file_name,
				// 'file_type' => "File type " . $file_type,
				'start' 		=> "Start Import",
			];

			// $oobj = new  PHPExcel_Reader_Excel2007;
			$obj 				= new PHPExcel_Reader_Excel2007;
			$objReader 			= $obj->load($file_tmp);
			$objWorksheet 		= $objReader->getActiveSheet();
			$objGetWorksheet 	= $objReader->getSheetByName('imp_hscode');
			// $objImg = new PHPExcel_Worksheet_Drawing;
			if (!$objGetWorksheet) {
				$log_import['status'] 	= "Error!";
				$log_import['msg'] 		= "Worksheet name not valid!";
			} else {
				$dataArray = $objWorksheet->toArray();
				for ($i = 2; $i < count($dataArray); $i++) {
					$data[] = [
						'product_name' => $dataArray[$i]['1'],
						'specification' => $dataArray[$i]['2'],
						'origin_hscode' => $dataArray[$i]['3'],
					];
				}
				$log_import['msg'] = "Data has been imported.";
				$log_import['count_data'] = "Total Data " . count($data);
				$log_import['status'] = "Successfull!";
			}

			echo json_encode([
				'log_import' => $log_import,
				'data' => $data
			]);
		}
	}
}
