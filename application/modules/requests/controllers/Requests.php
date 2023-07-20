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
		if ($status) {
			$where = " AND `status` IN($status)";
		} else {
			$where = " AND `status` NOT IN('QTT','HIS')";
		}

		$string = $this->db->escape_like_str($search);
		$sql = "SELECT *,(@row_number:=@row_number + 1) AS num
        FROM view_check_hscodes, (SELECT @row_number:=0) as temp WHERE 1=1 $where  
        AND (`customer_name` LIKE '%$string%'
        OR `project_name` LIKE '%$string%'
        OR `date` LIKE '%$string%'
        OR `country_name` LIKE '%$string%'
        OR `country_code` LIKE '%$string%'
        OR `employee_name` LIKE '%$string%'
        OR `status` LIKE '%$string%')";

		$totalData = $this->db->query($sql)->num_rows();
		$totalFiltered = $this->db->query($sql)->num_rows();

		$columns_order_by = array(
			0 => 'num',
			1 => 'customer_name',
			2 => 'project_name',
			3 => 'date',
			4 => 'country_name',
			5 => 'employee_name',
		);

		$sql .= " ORDER BY `modified_at` DESC, " . $columns_order_by[$column] . " " . $dir . " ";
		$sql .= " LIMIT " . $start . " ," . $length . " ";
		$query  = $this->db->query($sql);

		$data  = array();
		$urut1  = 1;
		$urut2  = 0;

		$status = [
			'OPN' => '<span class="bg-info tx-white pd-5 tx-11 tx-bold rounded-5">New</span>',
			'CHK' => '<span class="bg-success tx-white pd-5 tx-11 tx-bold rounded-5">Checked</span>',
			'CNL' => '<span class="bg-light tx-white pd-5 tx-11 tx-bold rounded-5">Cancel</span>',
			'RVI' => '<span class="bg-warning tx-white pd-5 tx-11 tx-bold rounded-5">Revision</span>',
			'HIS' => '<span class="bg-secondary tx-white pd-5 tx-11 tx-bold rounded-5">History</span>',
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
			$edit 		= '<a href="' . base_url($this->uri->segment(1) . '/edit/' . $row['id']) . '" class="btn btn-success btn-sm" data-toggle="tooltip" title="Edit" data-id="' . $row['id'] . '"><i class="fa fa-edit"></i></a>';
			$revision 	= '<a href="' . base_url($this->uri->segment(1) . '/revision/' . $row['id']) . '" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Revision" data-id="' . $row['id'] . '"><i class="fa fa-pen"></i></a>';
			$cancel 	= '<button type="button" class="btn btn-danger btn-sm cancel" data-toggle="tooltip" title="Cancel" data-id="' . $row['id'] . '"><i class="fa fa-minus-circle"></i></button>';
			$buttons 	= $view . "&nbsp;" . $edit . "&nbsp;" . $cancel;

			if ($row['status'] == 'CHK') {
				$buttons 	= $view . "&nbsp;" . $revision;
			}
			if ($row['status'] == 'HIS') {
				$buttons 	= $view;
			}

			$nestedData   = array();
			$nestedData[]  = $nomor;
			$nestedData[]  = $row['customer_name'];
			$nestedData[]  = $row['project_name'];
			$nestedData[]  = date("d/m/Y", strtotime($row['date']));
			$nestedData[]  = $row['country_code'] . " - " . $row['country_name'];
			$nestedData[]  = $row['employee_name'];
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
		$this->auth->restrict($this->addPermission);
		$customers = $this->db->get_where('customers', ['status' => '1'])->result();
		$countries = $this->db->get_where('countries')->result();
		$this->template->set([
			'subtitle' => 'Create Request HS Code',
			'customers' => $customers,
			'countries' => $countries,
		]);
		$this->template->render('form');
	}

	public function edit($id)
	{
		$this->auth->restrict($this->managePermission);
		$request 	= $this->db->get_where('check_hscodes', ['id' => $id])->row();
		$dtlRequest = $this->db->get_where('check_hscode_detail', ['check_hscode_id' => $id])->result();
		$customers 	= $this->db->get_where('customers', ['status' => '1'])->result();
		$countries 	= $this->db->get_where('countries')->result();
		$data = [
			'subtitle' 	=> 'Edit Request HS Code',
			'request' 	=> $request,
			'customers' => $customers,
			'countries' => $countries,
			'dtlRequest' => $dtlRequest,
		];
		$this->template->set($data);
		$this->template->render('form');
	}

	public function revision($id)
	{
		$this->auth->restrict($this->managePermission);
		$request 	= $this->db->get_where('check_hscodes', ['id' => $id])->row();
		$dtlRequest = $this->db->get_where('check_hscode_detail', ['check_hscode_id' => $id])->result();
		$customers 	= $this->db->get_where('customers', ['status' => '1'])->result();
		$countries 	= $this->db->get_where('countries')->result();
		$flag_revision = true;
		$data = [
			'subtitle' 		=> 'Revision Check HS Code',
			'request' 		=> $request,
			'customers' 	=> $customers,
			'countries' 	=> $countries,
			'dtlRequest' 	=> $dtlRequest,
			'flag_revision' => $flag_revision,
		];
		$this->template->set($data);
		$this->template->render('form');
	}

	public function view($id)
	{
		$this->auth->restrict($this->viewPermission);
		$request 		= $this->db->get_where('check_hscodes', ['id' => $id])->row();
		$dtlRequest 	= $this->db->get_where('check_hscode_detail', ['check_hscode_id' => $id])->result();
		$customers 		= $this->db->get_where('customers', ['status' => '1'])->result_array();
		$countries 		= $this->db->get_where('countries')->result_array();
		$employee 		= $this->db->get_where('employees')->result_array();
		$ArrCustomer 	= array_column($customers, 'customer_name', 'id_customer');
		$ArrCountry 	= array_column($countries, 'name', 'id');
		$ArrCountryCode = array_column($countries, 'country_code', 'id');
		$ArrEmpl 		= array_column($employee, 'name', 'id');

		$data = [
			'subtitle' 			=> 'Edit Request HS Code',
			'request' 			=> $request,
			'ArrCustomer' 		=> $ArrCustomer,
			'ArrCountry' 		=> $ArrCountry,
			'ArrCountryCode' 	=> $ArrCountryCode,
			'ArrEmpl' 			=> $ArrEmpl,
			'dtlRequest' 		=> $dtlRequest,
		];
		$this->template->set($data);
		$this->template->render('view');
	}

	public function save()
	{
		$this->auth->restrict($this->addPermission);
		$post 			= $this->input->post();
		$data 			= $post;
		$data['id'] 	= isset($post['id']) && $post['id'] ? $post['id'] : $this->Requests_model->generate_id();
		$data['number'] = isset($post['number']) && $post['number'] ? $post['number'] : $this->Requests_model->generate_number();
		$data['date'] 	= date("Y-m-d", strtotime(str_replace("/", "-", $post['date'])));
		$detail 		= isset($post['detail']) ? $post['detail'] : '';
		$replace 		= ($post['replace']);
		unset($data['detail']);
		unset($data['replace']);

		$this->db->trans_begin();
		if (isset($post['id']) && $post['id']) {
			$data['modified_at']	= date('Y-m-d H:i:s');
			$data['modified_by']	= $this->auth->user_id();
			$this->db->where('id', $post['id'])->update("check_hscodes", $data);
		} else {
			if (isset($data['old_id']) && $data['old_id']) {
				$oldData 				= $this->db->get_where('check_hscodes', ['id' => $data['old_id']])->row();
				$data['revision_count'] = $oldData->revision_count + 1;
				$data['status'] = 'RVI';
				$this->db->update('check_hscodes', ['status' => 'HIS'], ['id' => $data['old_id']]);
			}
			$data['created_at']		= $data['modified_at'] = date('Y-m-d H:i:s');
			$data['created_by']		= $data['modified_by'] = $this->auth->user_id();
			$this->db->insert("check_hscodes", $data);
		}

		if ($detail) {
			if ($replace == '1') {
				$exist_data = $this->db->get_where('check_hscode_detail', ['check_hscode_id' => $data['id']])->result();
				$root = $_SERVER['DOCUMENT_ROOT'];
				if (count($exist_data) > 0) :
					$this->db->delete('check_hscode_detail', ['check_hscode_id' => $data['id']]);
					foreach ($exist_data as $exdt) {
						if ($exdt->image) {
							if (file_exists($root . '/assets/uploads/' . $data['id'] . "/" . $exdt->image)) {
								unlink($root . '/assets/uploads/' . $data['id'] . "/" . $exdt->image);
							}
						}
					}
				endif;
			}
			$dtlId =  ($this->Requests_model->getDetailId($data['id']));
			foreach ($detail as $dtl) {
				$dtlId++;
				$dtl['check_hscode_id'] 	= $data['id'];
				$dtl['id'] 					= isset($dtl['id']) && $dtl['id'] ? $dtl['id'] : $data['id'] . "-" . str_pad($dtlId, 4, "0", STR_PAD_LEFT);
				if (isset($data['old_id']) && $data['old_id']) {
					$dtl['id'] 					= $data['id'] . "-" . sprintf("%04d", $dtlId);
				}
				$check 						= $this->db->get_where('check_hscode_detail', ['id' => $dtl['id']])->num_rows();

				if (isset($dtl['image']) && $dtl['image']) {
					$root = $_SERVER['DOCUMENT_ROOT'];
					if (!is_dir($root . '/assets/uploads/' . $data['id'])) {
						mkdir($root . '/assets/uploads/' . $data['id'], 0755);
						chmod($root . '/assets/uploads/' . $data['id'], 0755);
					}
					$explode 	= explode(".", $dtl['image']);
					$ext 		= $explode['1'];
					$imgName 	= 'img-' . $dtl['id'] . "." . $ext;
					if (file_exists($root . '/assets/temp/' . $dtl['image'])) {
						rename($root . '/assets/temp/' . $dtl['image'], $root . '/assets/uploads/' . $data['id'] . '/' . $imgName);
					}
					$dtl['image'] = $imgName;
				}

				if ($check > 0) {
					$this->db->update('check_hscode_detail', $dtl, ['id' => $dtl['id']]);
				} else {
					$this->db->insert('check_hscode_detail', $dtl);
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
				'start' 		=> "Start Import",
			];

			/* Import with Image */
			$obj 				= new PHPExcel_Reader_Excel2007;
			$objReader 			= $obj->load($file_tmp);
			$objWorksheet 		= $objReader->getActiveSheet();
			$objGetWorksheet 	= $objReader->getSheetByName('imp_hscode');
			if (!$objGetWorksheet) {
				$log_import['status'] 	= "Error!";
				$log_import['msg'] 		= "Worksheet name not valid!";
			} else {
				$dataArray = $objWorksheet->toArray();
				for ($i = 1; $i < count($dataArray); $i++) {
					$data[] = [
						'product_name' => $dataArray[$i]['1'],
						'specification' => $dataArray[$i]['2'],
						'origin_hscode' => $dataArray[$i]['3'],
					];
					foreach ($objWorksheet->getDrawingCollection() as $k => $drawing) {
						// $string = $drawing->getCoordinates();
						// $coordinate = PHPExcel_Cell::coordinateFromString($string);
						if ($drawing instanceof PHPExcel_Worksheet_Drawing) {
							$filename = $drawing->getPath();
							// $img = $drawing->getFilename();
							$ext = $drawing->getExtension();
							$temp_name = 'temp_' . date('YmdHis') . "." . $ext;
							copy($filename, $_SERVER['DOCUMENT_ROOT'] . '/assets/temp/' . $temp_name);
						}
						$data[$k]['image'] = ($temp_name) ?: '';
						// $data[$k]['image'] = '';
					}
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
