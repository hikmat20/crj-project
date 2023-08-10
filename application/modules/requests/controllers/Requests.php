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
	protected $currency;
	protected $unit;
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
		$this->currency = $this->db->get('currency')->result();
		$this->unit = [
			'rp'        => '(Rp)',
			'm'         => 'Meter',
			'percent'   => '%',
			'kg'        => 'Kg',
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
			$print 		= '<a href="' . base_url($this->uri->segment(1) . '/printout/' . $row['id']) . '" class="btn btn-light btn-sm" data-toggle="tooltip" title="Print HS Code" data-id="' . $row['id'] . '" target="_blank"><i class="fa fa-print"></i></a>';
			$cancel 	= '<button type="button" class="btn btn-danger btn-sm cancel" data-toggle="tooltip" title="Cancel" data-id="' . $row['id'] . '"><i class="fa fa-minus-circle"></i></button>';
			$quotation 	= '<button type="button" class="btn btn-pink btn-sm quotation" data-toggle="tooltip" title="Create Quotation" data-id="' . $row['id'] . '"><i class="fas fa-file-invoice"></i></button>';
			$buttons 	= $view . "&nbsp;" . $edit . "&nbsp;" . $cancel;

			if ($row['status'] == 'RVI') {
				$buttons 	=  $view . "&nbsp;" . $edit;
			}
			if ($row['status'] == 'CHK') {
				$buttons 	= $view . "&nbsp;" . $revision . "&nbsp;" . $print . "&nbsp;" . $quotation;
			}
			if ($row['status'] == 'HIS') {
				$buttons 	= $view;
			}

			$nestedData   = array();
			$nestedData[]  = $nomor;
			$nestedData[]  = $row['customer_name'];
			$nestedData[]  = $row['number'];
			$nestedData[]  = $row['project_name'];
			$nestedData[]  = date("d/m/Y", strtotime($row['date']));
			$nestedData[]  = $row['country_code'] . " - " . $row['country_name'];
			$nestedData[]  = $row['employee_name'];
			$nestedData[]  = $row['revision_count'];
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
			'subtitle' 	=> 'Create Request HS Code',
			'customers' => $customers,
			'countries' => $countries,
			'currency' 	=> $this->currency,
		]);

		$this->template->render('form');
	}

	public function edit($id)
	{
		$this->auth->restrict($this->managePermission);
		$request 			= $this->db->get_where('view_check_hscodes', ['id' => $id])->row();
		$dtlRequest 		= $this->db->get_where('check_hscode_detail', ['check_hscode_id' => $id])->result();
		$customers 			= $this->db->get_where('customers', ['status' => '1'])->result();
		$countries 			= $this->db->get_where('countries')->result();
		$symbol 			= [];

		foreach ($this->currency as $cur) {
			$symbol[$cur->code] = $cur->symbol;
		}

		$data = [
			'subtitle' 		=> 'Edit Request HS Code',
			'request' 		=> $request,
			'customers' 	=> $customers,
			'countries' 	=> $countries,
			'dtlRequest' 	=> $dtlRequest,
			'currency' 		=> $this->currency,
			'symbol' 		=> $symbol,
		];

		$this->template->set($data);
		$this->template->render('form');
	}

	public function revision($id)
	{
		$this->auth->restrict($this->managePermission);
		$request 	= $this->db->get_where('view_check_hscodes', ['id' => $id])->row();
		$dtlRequest = $this->db->get_where('check_hscode_detail', ['check_hscode_id' => $id])->result();
		$customers 	= $this->db->get_where('customers', ['status' => '1'])->result();
		$countries 	= $this->db->get_where('countries')->result();
		$flag_revision = true;
		$symbol 			= [];

		foreach ($this->currency as $cur) {
			$symbol[$cur->code] = $cur->symbol;
		}

		$data = [
			'subtitle' 		=> 'Revision Check HS Code',
			'request' 		=> $request,
			'customers' 	=> $customers,
			'countries' 	=> $countries,
			'dtlRequest' 	=> $dtlRequest,
			'flag_revision' => $flag_revision,
			'currency' 		=> $this->currency,
			'symbol' 		=> $symbol,
		];
		$this->template->set($data);
		$this->template->render('form');
	}

	public function view($id)
	{
		$this->auth->restrict($this->viewPermission);
		$request 			= $this->db->get_where('view_check_hscodes', array('id' => $id))->row();
		$dtlRequest 		= $this->db->get_where('check_hscode_detail', ['check_hscode_id' => $id])->result();
		$customers 			= $this->db->get_where('customers')->result_array();
		$countries 			= $this->db->get_where('countries')->result_array();
		$details 			= $this->db->get_where('check_hscode_detail', array('check_hscode_id' => $id))->result();
		$hscodes 			= $this->db->get_where('hscodes', array('status' => '1'))->result();
		$hscodes_doc 		= $this->db->get_where('hscode_requirements')->result();
		$current_ppn 		= $this->db->get_where('configs', ['key' => 'ppn'])->row()->value;
		$employee 			= $this->db->get_where('employees')->result_array();
		$ArrHscode 			= [];
		$ArrDocs 			= [];
		$ArrCurrency 			= [];
		$ArrCountry 		= array_column($countries, 'name', 'id');
		$ArrCountryCode 	= array_column($countries, 'country_code', 'id');
		$ArrCustomer 		= array_column($customers, 'customer_name', 'id_customer');
		$ArrEmpl 			= array_column($employee, 'name', 'id');

		foreach ($hscodes as $hs) {
			$ArrHscode[$hs->origin_code] = $hs;
		}

		foreach ($hscodes_doc as $doc) {
			$ArrDocs[$doc->hscode_id][$doc->type][] = $doc;
		}

		foreach ($this->currency as $cur) {
			$ArrCurrency[$cur->code] = $cur;
		}

		$this->template->set([
			'request' 			=> $request,
			'dtlRequest' 		=> $dtlRequest,
			'ArrEmpl' 			=> $ArrEmpl,
			'details' 			=> $details,
			'ArrHscode' 		=> $ArrHscode,
			'current_ppn' 		=> $current_ppn,
			'ArrDocs' 			=> $ArrDocs,
			'ArrCountry' 		=> $ArrCountry,
			'ArrCountryCode' 	=> $ArrCountryCode,
			'ArrCustomer' 		=> $ArrCustomer,
			'currency' 			=> $ArrCurrency,
		]);
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
		unset($data['deleteItem']);

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
				$root = FCPATH;
				if (count($exist_data) > 0) :
					$this->db->delete('check_hscode_detail', ['check_hscode_id' => $data['id']]);
					foreach ($exist_data as $exdt) {
						if ($exdt->image) {
							if (file_exists($root . 'assets/uploads/' . $data['id'] . "/" . $exdt->image)) {
								unlink($root . 'assets/uploads/' . $data['id'] . "/" . $exdt->image);
							}
						}
					}
				endif;
			}
			$dtlId =  ($this->Requests_model->getDetailId($data['id']));

			foreach ($detail as $dtl) {
				$dtl['check_hscode_id'] 	= $data['id'];
				$dtl['fob_price'] 			= str_replace(",", "", $dtl['fob_price']);
				$dtl['cif_price'] 			= str_replace(",", "", $dtl['cif_price']);
				$dtl['origin_hscode'] 		= trim(str_replace(['-', '.'], "", $dtl['origin_hscode']));

				if (isset($dtl['id']) && $dtl['id']) {
					$dtl['id'] 	= $dtl['id'];
				} else {
					$dtlId++;
					$dtl['id'] 	= $data['id'] . "-" . str_pad($dtlId, 4, "0", STR_PAD_LEFT);
				}

				if (isset($data['old_id']) && $data['old_id']) {
					$dtl['id'] 				= $data['id'] . "-" . sprintf("%04d", $dtlId);
				}

				$check 						= $this->db->get_where('check_hscode_detail', ['id' => $dtl['id']])->num_rows();
				if (isset($dtl['image']) && $dtl['image']) {
					$root = FCPATH;

					if (!is_dir($root . 'assets/uploads/' . $data['id'])) {
						mkdir($root . 'assets/uploads/' . $data['id'], 0755);
						chmod($root . 'assets/uploads/' . $data['id'], 0755);
					}

					$explode 	= explode(".", $dtl['image']);
					$ext 		= $explode['1'];
					$imgName 	= 'img-' . $dtl['id'] . "." . $ext;

					if (file_exists($root . 'assets/temp/' . $dtl['image'])) {
						if (file_exists($root . 'assets/uploads/' . $data['id'] . '/' . $imgName)) {
							unlink($root . 'assets/uploads/' . $data['id'] . '/' . $imgName);
							rename($root . 'assets/temp/' . $dtl['image'], $root . '/assets/uploads/' . $data['id'] . '/' . $imgName);
						} else {
							rename($root . 'assets/temp/' . $dtl['image'], $root . '/assets/uploads/' . $data['id'] . '/' . $imgName);
						}
					} else {
						$ID = $data['id'];
						if (isset($data['old_id']) && $data['old_id']) {
							$ID 				= $data['old_id'];
						}
						if (file_exists($root . 'assets/uploads/' . $ID . '/' . $dtl['image'])) {
							copy($root . 'assets/uploads/' . $ID . '/' . $dtl['image'], $root . '/assets/uploads/' . $data['id'] . '/' . $imgName);
						}
					}
					$dtl['image'] = $imgName;
				}

				if ($check > 0) {
					$this->db->update('check_hscode_detail', $dtl, ['id' => $dtl['id']]);
				} else {
					$dtl['id'] = $data['id'] . "-" . str_pad($dtlId++, 4, "0", STR_PAD_LEFT);
					$this->db->insert('check_hscode_detail', $dtl);
				}
			}
		} else {
			$root = FCPATH;
			$this->db->delete('check_hscode_detail', ['check_hscode_id' => $data['id']]);
			$files = glob($root . 'assets/uploads/' . $data['id'] . "/*"); // get all file names
			foreach ($files as $file) { // iterate files
				if (is_file($file)) {
					unlink($file); // delete file
				}
			}
		}


		if ($post['deleteItem']) {
			$ArrDelete = explode(",", $post['deleteItem']);
			$root = FCPATH;
			if ($ArrDelete) :
				foreach ($ArrDelete as $exdt) {
					$ID = substr($exdt, 0, 10);
					$exData = $this->db->get_where('check_hscode_detail', ['id' => $exdt])->row();
					if ($exData && $exData->image != '') {
						if (file_exists($root . 'assets/uploads/' . $ID . "/" . $exData->image)) {
							unlink($root . 'assets/uploads/' . $ID . "/" . $exData->image);
						}
					}
					$this->db->delete('check_hscode_detail', ['id' => $exdt]);
				}
			endif;
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

	public function change_image()
	{
		$config['upload_path'] 		= './assets/temp/';
		$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
		$config['max_size']     	= '2048';
		$config['max_width'] 		= '2048';
		$config['max_height'] 		= '2048';
		$config['file_name'] 		= 'temp_' . date('YmdHis') . "_" . "0";

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('image')) {
			$error = array('error' => $this->upload->display_errors());
			$return = [
				'status' => 0,
				'msg' => $error,
			];
		} else {
			$data = $this->upload->data();
			$return = [
				'status' => 1,
				'msg' => 'Upload Successfull!',
				'data' => $data['file_name'],
			];
		}

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

					$data[$i] = [
						'product_name' 	=> $dataArray[$i]['1'],
						'specification' => $dataArray[$i]['2'],
						'origin_hscode' => trim(str_replace(['-', '.'], "", $dataArray[$i]['3'])),
						'fob_price' => trim($dataArray[$i]['4']),
						'cif_price' => trim($dataArray[$i]['5']),
					];

					foreach ($objWorksheet->getDrawingCollection() as $n => $drawing) {
						$n++;
						$string 			= $drawing->getCoordinates();
						$coordinate 		= PHPExcel_Cell::coordinateFromString($string)[1] - 1;
						$image 				= $drawing->setCoordinates($string);
						$desc 				= $drawing->getDescription();
						if ($drawing instanceof PHPExcel_Worksheet_Drawing) {
							$filename 		= $drawing->getPath();
							$ext 			= $drawing->getExtension();
							$temp_name 		= 'temp_' . date('YmdHis') . "_" . ($n) . "." . $ext;
							copy($filename, FCPATH . 'assets/temp/' . $temp_name);
						}
						$data[$coordinate]['image'] = ($temp_name) ?: '';
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

	function printout($id)
	{
		$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
		$this->auth->restrict($this->viewPermission);
		$request 		= $this->db->get_where('view_check_hscodes', array('id' => $id))->row();
		$details 		= $this->db->get_where('check_hscode_detail', array('check_hscode_id' => $id))->result();
		$hscodes 		= $this->db->get_where('hscodes', array('status' => '1'))->result();
		$hscodes_doc 	= $this->db->get_where('hscode_requirements')->result();
		$current_ppn 	= $this->db->get_where('configs', ['key' => 'ppn'])->row()->value;
		$hscodes_doc 	= $this->db->get_where('hscode_requirements')->result();
		$ArrHscode 		= [];
		$ArrDocs 		= [];
		$ArrCurrency 	= [];
		foreach ($hscodes as $hs) {
			$ArrHscode[$hs->origin_code] = $hs;
		}

		foreach ($hscodes_doc as $doc) {
			$ArrDocs[$doc->hscode_id][$doc->type][] = $doc;
		}

		foreach ($this->currency as $cur) {
			$ArrCurrency[$cur->code] = $cur;
		}

		$this->template->set([
			'request' 		=> $request,
			'details' 		=> $details,
			'ArrHscode' 	=> $ArrHscode,
			'current_ppn' 	=> $current_ppn,
			'ArrDocs' 		=> $ArrDocs,
			'currency' 		=> $ArrCurrency,
			'unit' 			=> $this->unit,
		]);

		$html = $this->template->load_view('print');
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	public function createQuotation($id)
	{
		$this->auth->restrict($this->addPermission);
		$header 		= $this->db->get_where('view_check_hscodes', ['id' => $id])->row();
		$companies 		= $this->db->get_where('companies', ['status' => '1'])->result();
		$ports 			= $this->db->get_where('harbours', ['status' => '1'])->result();
		$containers 	= $this->db->get_where('containers', ['status' => '1'])->result();
		$cities 		= $this->db->get_where('cities', ['country_id' => '102', 'flag' => '1'])->result();
		$details 		= $this->db->get_where('check_hscode_detail', ['check_hscode_id' => $id])->result();
		$hscodes 		= $this->db->get_where('hscodes', array('status' => '1'))->result();
		$hscodes_doc 	= $this->db->get_where('hscode_requirements')->result();
		$lartas 		= $this->db->get_where('fee_lartas', ['status' => '1'])->result_array();
		$ArrLartas 		= array_column($lartas, 'name', 'id');
		$ArrHscode 		= [];
		$ArrDocs 		= [];
		$ArrPorts 		= [];
		$ArrCurrency 	= [];

		foreach ($hscodes as $hs) {
			$ArrHscode[$hs->origin_code] = $hs;
		}

		foreach ($hscodes_doc as $doc) {
			$ArrDocs[$doc->hscode_id][$doc->type][] = $doc;
		}

		foreach ($ports as $port) {
			$ArrPorts[$port->country_id][] = $port;
		}

		foreach ($this->currency as $cur) {
			$ArrCurrency[$cur->code] = $cur;
		}

		$data = [
			'currency' 		=> $ArrCurrency,
			'header' 		=> $header,
			'companies' 	=> $companies,
			'ports' 		=> $ports,
			'containers' 	=> $containers,
			'cities' 		=> $cities,
			'details' 		=> $details,
			'ArrHscode' 	=> $ArrHscode,
			'ArrDocs' 		=> $ArrDocs,
			'ArrPorts' 		=> $ArrPorts,
			'ArrLartas' 	=> $ArrLartas,
		];
		$this->template->set($data);
		$this->template->render('createQuotation');
	}

	function getArea()
	{
		$city_id 	= $_GET['city_id'];
		$areas 		= [];

		if (isset($city_id) && $city_id) {
			$areas = $this->db->where(['city_id' => $city_id])->get('areas')->result_array();
		}

		echo json_encode($areas);
	}

	function load_price()
	{
		$post 				= $this->input->post();
		$container 			= $post['container'];
		$qty 				= $post['qty'];
		$dest_area 			= $post['dest_area'];
		$src_city 			= $post['src_city'];
		$fee_type 			= $post['fee_type'];
		$customer 			= $post['customer_id'];
		$product_price 		= str_replace(",", "", $post['product_price']);
		$ocean_freight 		= $this->db->get_where('ocean_freights', ['container_id' => $container, 'status' => '1', 'port_id' => $src_city])->row();
		$thc 				= $this->db->get_where('shipping_line_cost', ['container_id' => $container, 'status' => '1'])->row();
		$custom_clearance 	= $this->db->get_where('custom_clearance', ['container_id' => $container, 'status' => '1'])->row();
		$trucking 			= $this->db->get_where('trucking_containers', ['area like' => "%$dest_area%", 'status' => '1'])->row();
		if ($trucking) {
			$trucking_dtl 	= $this->db->get_where('trucking_details', ['trucking_id' => $trucking->id, 'container_id' => $container])->row();
		}
		$surveyor			= $this->db->get_where('surveyors', ['qty_container' => $qty, 'status' => '1'])->row();
		$fee 				= 0;
		$fee_customer_id 	= null;
		$fee_customer_value = 0;
		$err_fee_customer 	= '';

		if (isset($fee_type) && $fee_type == 'V') {
			$fees			= $this->db->get_where('fee_values', ['status' => '1'])->result();
			foreach ($fees as $f) {
				if ($f->max_value >= $product_price) {
					$fee = $f->fee;
					break;
				}
			}
		} else if (isset($fee_type) && $fee_type == 'C') {
			$err_fee_customer 	= 'Fee Customer not available in this Customer.';
			$feeCust 			= $this->db->get_where('fee_customers', ['customer_id' => $customer])->row();
			if ($feeCust) {
				$fee_customer_id 	= $feeCust->id;
				$fee_customer_value = number_format($feeCust->fee_value);
				$err_fee_customer 	= '';
			}
		}

		$data = [
			'ocean_freight' 	 => isset($ocean_freight->cost_value) ? number_format($ocean_freight->cost_value) : 0,
			'thc' 				 => isset($thc->cost_value) ? number_format($thc->cost_value) : 0,
			'custom_clearance' 	 => isset($custom_clearance->cost_value) ? number_format($custom_clearance->cost_value) : 0,
			'trucking' 			 => isset($trucking_dtl) ? number_format($trucking_dtl->cost_value) : 0,
			'trucking_id' 		 => isset($trucking_dtl) ? ($trucking_dtl->trucking_id) : null,
			'surveyor' 			 => isset($surveyor->cost_value) ? number_format($surveyor->cost_value) : 0,
			'fee' 				 => $fee,
			'fee_customer_id' 	 => $fee_customer_id,
			'fee_customer_value' => $fee_customer_value,
			'err_fee_customer' 	 => $err_fee_customer,
		];
		echo json_encode($data);
	}

	function load_storage()
	{
		$post 				= $this->input->post();
		$days 				= ($post['days']) ?: 7;
		$container 			= $post['container'];
		$storage 			= $this->db->get_where('storages', ['day_stacking' => $days, 'status' => '1'])->row();

		$storage_dtl 		= '';
		if ($storage) {
			$storage_dtl 	= $this->db->get_where('storage_details', ['storage_id' => $storage->id, 'container_id' => $container])->row();
		}

		$data = [
			'storage' 	=> $storage_dtl
		];
		echo json_encode($data);
	}

	function saveQuotation()
	{
		$this->auth->restrict($this->managePermission);
		$post = $this->input->post();
		$data = $post;


		$data['id'] 					= $this->Requests_model->generateIdQuotation();
		$data['number'] 				= $this->Requests_model->generateQuotNumber();
		$data['date'] 					= date("Y-m-d");
		$data['ocean_freight'] 			= str_replace(",", "", $post['ocean_freight']);
		$data['shipping'] 				= str_replace(",", "", $post['shipping']);
		$data['storage'] 				= str_replace(",", "", $post['storage']);
		$data['trucking'] 				= str_replace(",", "", $post['trucking']);
		$data['surveyor'] 				= str_replace(",", "", $post['surveyor']);
		$data['total_product'] 			= str_replace(",", "", $post['total_product']);
		$data['total_shipping'] 		= str_replace(",", "", $post['total_shipping']);
		$data['total_custom_clearance'] = str_replace(",", "", $post['total_custom_clearance']);
		$data['total_trucking'] 		= str_replace(",", "", $post['total_trucking']);
		$data['total_fee_lartas'] 		= str_replace(",", "", $post['total_fee_lartas']);
		$data['custom_clearance'] 		= str_replace(",", "", $post['custom_clearance']);
		$data['fee_value'] 				= str_replace(",", "", $post['fee_value']);
		$data['fee_customer'] 			= str_replace(",", "", $post['fee_customer']);
		$data['fee_customer_id'] 		= ($post['fee_customer_id']) ?: null;
		$data['fee_lartas_pi'] 			= str_replace(",", "", $post['fee_lartas_pi']);
		$data['fee_lartas_alkes'] 		= str_replace(",", "", $post['fee_lartas_alkes']);
		$data['fee_lartas_ski'] 		= str_replace(",", "", $post['fee_lartas_ski']);
		$data['created_at']				= $data['modified_at'] = date('Y-m-d H:i:s');
		$data['created_by']				= $data['modified_by'] = $this->auth->user_id();
		$detail 						= $data['detail'];
		unset($data['detail']);
		$this->db->trans_begin();
		$this->db->insert("quotations", $data);

		if ($detail) {
			$dtlId =  ($this->Requests_model->getDetailQuotId($data['id']));
			foreach ($detail as $dtl) {
				$dtlId++;
				$dtl['quotation_id'] 	= $data['id'];
				$dtl['fob_price'] 		= str_replace(",", "", $dtl['fob_price']);
				$dtl['cif_price'] 		= str_replace(",", "", $dtl['cif_price']);
				$dtl['id'] 				= $data['id'] . "-" . sprintf("%04d", $dtlId);
				$dtl['created_at'] 		= $dtl['modified_at'] = date('Y-m-d H:i:s');
				$dtl['created_by'] 		= $dtl['modified_by'] = $this->auth->user_id();
				$this->db->insert('quotation_details', $dtl);
			}
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$return	= array(
				'msg'		=> 'Failed save data Quotation.  Please try again.',
				'status'	=> 0
			);
			$keterangan     = "FAILD save data Quotation" . $data['id'];
			$status         = 1;
			$nm_hak_akses   = $this->addPermission;
			$kode_universal = $data['id'];
			$jumlah         = 1;
			$sql            = $this->db->last_query();
		} else {
			$this->db->trans_commit();
			$return	= array(
				'msg'		=> 'Success Save data Quotation.',
				'status'	=> 1
			);
			$keterangan     = "SUCCESS save data Quotation" . $data['id'];
			$status         = 1;
			$nm_hak_akses   = $this->addPermission;
			$kode_universal = $data['id'];
			$jumlah         = 1;
			$sql            = $this->db->last_query();
			$this->session->set_flashdata('msg', 'Success Save data Quotation.');
		}
		simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
		echo json_encode($return);
	}
}
