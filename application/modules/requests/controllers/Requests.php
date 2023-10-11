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
			$where = " AND `status` NOT IN('QTT','HIS','CNL')";
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
        OR `description` LIKE '%$string%'
        OR `status` LIKE '%$string%')";

		$totalData = $this->db->query($sql)->num_rows();
		$totalFiltered = $this->db->query($sql)->num_rows();

		$columns_order_by = array(
			0 => 'num',
			1 => 'customer_name',
			2 => 'number',
			3 => 'project_name',
			4 => 'date',
			5 => 'description',
			6 => 'employee_name',
			7 => 'revision_count',
			8 => 'modified_at',
		);

		$sql .= " ORDER BY " . $columns_order_by[$column] . " " . $dir . " ";
		$sql .= " LIMIT " . $start . " ," . $length . " ";
		$query  = $this->db->query($sql);

		$data  = array();
		$urut1  = 1;
		$urut2  = 0;

		$status = [
			'OPN' => '<span class="bg-info tx-white pd-5 tx-11 tx-bold rounded-5">New</span>',
			'CHK' => '<span class="bg-success tx-white pd-5 tx-11 tx-bold rounded-5">Checked</span>',
			'CNL' => '<span class="bg-danger tx-white pd-5 tx-11 tx-bold rounded-5">Cancel</span>',
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
			if ($row['status'] == 'HIS' || $row['status'] == 'CNL') {
				$buttons 	= $view;
			}

			$nestedData   = array();
			$nestedData[]  = $nomor;
			$nestedData[]  = $row['customer_name'];
			$nestedData[]  = $row['number'];
			$nestedData[]  = $row['project_name'];
			$nestedData[]  = date("d/m/Y", strtotime($row['date']));
			$nestedData[]  = $row['description'];
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
			'unit' 				=> $this->unit,
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
				$dtl['price'] 			= str_replace(",", "", $dtl['price']);
				// $dtl['cif_price'] 			= str_replace(",", "", $dtl['cif_price']);
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

	function cancelForm($id)
	{
		$this->auth->restrict($this->deletePermission);
		$this->template->set('id', $id);
		$this->template->render('cancelForm');
	}

	public function cancel()
	{

		$this->auth->restrict($this->deletePermission);
		$post = $this->input->post();
		$reason = [
			'0' => $post['cancel_reason'],
			'1' => "Incorrect data entry",
			'2' => "Cancellation requests from customers",
			'3' => "Data change",
			'4' => "User error",
			'5' => "Dummy data only",
		];

		$data = [
			'status' 		=> 'CNL',
			'canceled_by' 	=> $this->auth->user_id(),
			'canceled_at' 	=> date('Y-m-d H:i:s'),
			'reason_id' 	=> $post['rdio'],
			'cancel_reason' => $reason[$post['rdio']],
		];

		$this->db->trans_begin();
		$this->db->update('check_hscodes', $data, ['id' => $post['id']]);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$return	= array(
				'msg'		=> 'Failed Cancel data Requests.  Please try again.',
				'status'	=> 0
			);
			$keterangan     = "FAILD Cancel data Request ";
			$status         = 1;
			$nm_hak_akses   = $this->deletePermission;
			$kode_universal = $post['id'];
			$jumlah         = 1;
			$sql            = $this->db->last_query();
		} else {
			$this->db->trans_commit();
			$return	= array(
				'msg'		=> 'Success cancel data Requests.',
				'status'	=> 1
			);
			$keterangan     = "SUCCESS cancel data Requests " . $post['id'];
			$status         = 1;
			$nm_hak_akses   = $this->deletePermission;
			$kode_universal = $post['id'];
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
						'price' => trim($dataArray[$i]['4']),
						// 'cif_price' => trim($dataArray[$i]['5']),
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
		$name = $request->customer_name . " " . str_replace("/", "-", $request->number);
		$mpdf->Output($name, 'I');
	}

	public function createQuotation($id)
	{
		$this->auth->restrict($this->addPermission);
		$configs 		= $this->db->get_where('configs')->result_array();
		$default 		= array_column($configs, 'value', 'key');
		$currentTax		= $default['ppn'];
		$header 		= $this->db->get_where('view_check_hscodes', ['id' => $id])->row();
		$companies 		= $this->db->get_where('companies', ['status' => '1'])->result();
		$ports 			= $this->db->get_where('harbours', ['status' => '1'])->result();
		$containers 	= $this->db->get_where('containers', ['status' => '1'])->result();
		$cities 		= $this->db->get_where('cities', ['country_id' => '102', 'flag' => '1'])->result();
		$details 		= $this->db->get_where('view_check_hscode_details', ['check_hscode_id' => $id])->result();
		$hscodes 		= $this->db->get_where('hscodes', array('status' => '1'))->result();
		$hscodes_doc 	= $this->db->get_where('hscode_requirements')->result();
		$lartas 		= $this->db->get_where('lartas', ['status' => '1'])->result_array();
		$ArrLartas 		= array_column($lartas, 'name', 'id');
		$ArrHscode 		= [];
		$ArrDocs 		= [];
		$ArrPorts 		= [];
		$ArrCurrency 	= [];
		$unitLartas 	= [
			'TNE' => 'Tonase',
			'SPM' => 'Shipment',
			'CNT' => 'Container',
		];

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

		$currency = $ArrCurrency[$header->currency]->symbol;
		$currency_code = $ArrCurrency[$header->currency]->code;

		$lartasItems = [];

		foreach ($details as $dtl) {
			if ($dtl->lartas) {
				$lartasItems[] = $dtl->lartas;
			}
		}

		$itemLartas = array_unique($lartasItems);

		$default = [];
		foreach ($configs as $conf) {
			$default[$conf['key']] = $conf;
		}

		$data = [
			'currency' 		=> $currency,
			'currency_code' => $currency_code,
			'header' 		=> $header,
			'default' 		=> $default,
			'companies' 	=> $companies,
			'ports' 		=> $ports,
			'containers' 	=> $containers,
			'cities' 		=> $cities,
			'details' 		=> $details,
			'ArrHscode' 	=> $ArrHscode,
			'ArrDocs' 		=> $ArrDocs,
			'ArrPorts' 		=> $ArrPorts,
			'ArrLartas' 	=> $ArrLartas,
			'itemLartas' 	=> $itemLartas,
			'currentTax' 	=> $currentTax,
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
		$post 					= $this->input->post();

		$container 				= $post['container'];
		$dest_area 				= $post['dest_area'];
		$src_city 				= $post['src_city'];
		$fee_type 				= $post['fee_type'];
		$service_type 			= $post['service_type'];
		$customer 				= $post['customer_id'];
		$qty_container 			= $post['qty'];
		$qty_ls_container 		= $post['qty_ls_container'];
		$days 					= ($post['stacking_days']) ?: 7;
		$exchange 				= str_replace(",", "", $post['exchange']);
		$total_price 			= str_replace(",", "", $post['total_price']);
		$total_price_non_lartas = str_replace(",", "", $post['total_price_non_lartas']);
		$ocean_freight 			= $this->db->get_where('ocean_freights', ['container_id' => $container, 'status' => '1', 'port_id' => $src_city])->row();
		$shipping 				= $this->db->get_where('shipping_line_cost', ['container_id' => $container, 'status' => '1'])->row();
		$custom_clearance 		= $this->db->get_where('custom_clearance', ['container_id' => $container, 'status' => '1'])->row();
		$trucking 				= $this->db->get_where('trucking_containers', ['area like' => "%$dest_area%", 'status' => '1'])->row();

		$storage 				= $this->db->get_where('storages', ['day_stacking' => $days, 'status' => '1'])->row();
		$storage_dtl 			= '';
		if ($storage) {
			$storage_dtl 		= $this->db->get_where('storage_details', ['storage_id' => $storage->id, 'container_id' => $container])->row();
		}

		if ($trucking) {
			$trucking_dtl 	= $this->db->get_where('trucking_details', ['trucking_id' => $trucking->id, 'container_id' => $container])->row();
		}

		if ($qty_ls_container || $qty_ls_container > 0) {
			$surveyor		= $this->db->get_where('surveyors', ['qty_container' => $qty_ls_container, 'status' => '1'])->row();
		}

		$fee 				= 0;
		$fee_value			= 0;
		$totalFee			= 0;
		$fee_customer_id 	= null;
		$fee_customer_value = 0;
		$err_fee_customer 	= '';

		$convertRate 		= $total_price * $exchange;
		$total_price_non_lartas_convert = $total_price_non_lartas * $exchange;

		if ($total_price_non_lartas > 0) {
			if ((isset($fee_type) && $fee_type == 'V')) {
				$fees			= $this->db->get_where('fee_values', ['status' => '1'])->result();
				foreach ($fees as $f) {
					if ($f->max_value >= $total_price_non_lartas_convert) {
						$fee 	= $f->fee;
						break;
					}
				}
				$totalFee 	= $fee_value =  ($total_price_non_lartas_convert * $fee) / 100;
				$feePrice 	= $totalFee;
				$feeTotal	= $totalFee;
				$feeTotal_foreign_currency = $totalFee / $exchange;
			} else if (isset($fee_type) && $fee_type == 'C') {
				$err_fee_customer 		= 'Fee Customer not available in this Customer.';
				$feeCust 				= $this->db->get_where('fee_customers', ['customer_id' => $customer, 'status' => '1'])->row();

				if ($feeCust) {
					if ($container) {
						$feeDetail 			= $this->db->get_where('fee_customer_details', ['fee_customer_id' => $feeCust->id, 'fee_type' => $service_type, 'container_id' => $container])->row();
						if ($feeDetail) {
							$fee_customer_id 	= $feeCust->id;
							$fee_customer_value = $feeDetail->cost_value;
							$err_fee_customer 	= '';
						}
					} else {
						$err_fee_customer 	= 'Container type has not been selected.';
					}
				}

				$totalFee = $fee_customer_value;
				$feePrice 	= $totalFee;
				$feeTotal	= $totalFee * $qty_container;
				$feeTotal_foreign_currency = $totalFee / $exchange;
			}
		}

		$freight = [
			'price' 					=> isset($ocean_freight->cost_value) ? number_format($ocean_freight->cost_value, 2) : 0,
			'total' 					=> isset($ocean_freight->cost_value) ? number_format($ocean_freight->cost_value * $qty_container, 2) : 0,
			'total_foreign_currency' 	=> isset($ocean_freight->cost_value) ? number_format(($ocean_freight->cost_value * $qty_container) / $exchange, 2) : 0,
		];

		$shippingCost = [
			'price' 					=> isset($shipping->cost_value) ? number_format($shipping->cost_value, 2) : 0,
			'total' 					=> isset($shipping->cost_value) ? number_format($shipping->cost_value * $qty_container, 2) : 0,
			'total_foreign_currency' 	=> isset($shipping->cost_value) ? number_format(($shipping->cost_value * $qty_container) / $exchange, 2) : 0,
		];

		$cc = [
			'price' 					=> isset($custom_clearance->cost_value) ? number_format($custom_clearance->cost_value, 2) : 0,
			'total' 					=> isset($custom_clearance->cost_value) ? number_format($custom_clearance->cost_value * $qty_container, 2) : 0,
			'total_foreign_currency' 	=> isset($custom_clearance->cost_value) ? number_format(($custom_clearance->cost_value * $qty_container) / $exchange, 2) : 0,
		];

		$truck = [
			'price' 					=> isset($trucking_dtl->cost_value) ? number_format($trucking_dtl->cost_value, 2) : 0,
			'total' 					=> isset($trucking_dtl->cost_value) ? number_format($trucking_dtl->cost_value * $qty_container, 2) : 0,
			'total_foreign_currency' 	=> isset($trucking_dtl->cost_value) ? number_format(($trucking_dtl->cost_value * $qty_container) / $exchange, 2) : 0,
			'trucking_id' 				=> isset($trucking_dtl) ? ($trucking_dtl->trucking_id) : null,
		];

		$surv = [
			'price' 					=> isset($surveyor->cost_value) ? number_format($surveyor->cost_value, 2) : 0,
			'total' 					=> isset($surveyor->cost_value) ? number_format($surveyor->cost_value, 2) : 0,
			'total_foreign_currency' 	=> isset($surveyor->cost_value) ? number_format(($surveyor->cost_value) / $exchange, 2) : 0,
		];

		$stor = [
			'price' 					=> isset($storage_dtl->cost_value) ? number_format($storage_dtl->cost_value, 2) : 0,
			'total' 					=> isset($storage_dtl->cost_value) ? number_format($storage_dtl->cost_value * $qty_container, 2) : 0,
			'total_foreign_currency' 	=> isset($storage_dtl->cost_value) ? number_format(($storage_dtl->cost_value * $qty_container) / $exchange, 2) : 0,
		];

		$totalFeeCSJ = [
			'price' 						=> isset($feePrice) ? number_format($feePrice, 2) : 0,
			'total' 						=> isset($feeTotal) ? number_format($feeTotal, 2) : 0,
			'total_foreign_currency' 		=> isset($feeTotal_foreign_currency) ? number_format($feeTotal_foreign_currency, 2) : 0,
			'fee' 							=> $fee,
			'fee_value' 					=> isset($fee_value) ? number_format($fee_value, 2) : 0,
			'fee_customer' 					=> isset($fee_customer_value) ? number_format($fee_customer_value, 2) : 0,
			'fee_customer_id' 				=> $fee_customer_id,
		];

		$data = [
			'ocean_freight' 	 			=> $freight,
			'shipping' 		 	 			=> $shippingCost,
			'custom_clearance' 	 			=> $cc,
			'trucking' 			 			=> $truck,
			'surveyor' 			 			=> $surv,
			'storage' 			 			=> $stor,
			'totalFeeCSJ' 	 	 			=> $totalFeeCSJ,
			'err_fee_customer' 	 			=> $err_fee_customer,
			// 'total_price'		 => number_format($convertRate),
			// 'fee_csj_value' 	 => number_format($fee_csj_value),
			// 'fee_customer_value' => number_format($fee_customer_value),
		];

		echo json_encode($data);
	}

	function getPriceLartas()
	{
		$post 				= $this->input->post();

		$id 				= $post['id'];
		$fee_lartas_type 	= $post['fee_lartas_type'];
		$customer_id 		= $post['customer_id'];
		$lartas 			= [];

		$details 			= $this->db->get_where('view_check_hscode_details', ['check_hscode_id' => $id])->result();
		$lartasItems 		= [];
		foreach ($details as $dtl) {
			$lartasItems[] = $dtl->lartas;
		}

		$itemLartas = array_unique($lartasItems);

		if ($fee_lartas_type == 'STD') {
			$lartas = $this->db->where_in('lartas_id', $itemLartas)->get_where('view_fee_lartas', ['status' => '1'])->result();
		} else if ($fee_lartas_type == 'CORP') {
			$header = $this->db->get_where('fee_lartas_customers', ['customer_id' => $customer_id, 'status' => '1'])->row();
			if ($header) {
				$lartas = $this->db->where_in('lartas_id', $itemLartas)->get_where('view_fee_lartas_customer_details', ['fee_lartas_customer_id' => $header->id])->result();
			}
		}

		$unitType 	= [
			'TNE' => 'Tonase',
			'SPM' => 'Shipment',
			'CNT' => 'Container',
		];

		$data = [
			'lartas' 		=> $lartas,
			'unitType' 	=> $unitType,
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

		// echo '<pre>';
		// print_r($data);
		// echo '</pre>';
		// exit;

		$data['id'] 					= $this->Requests_model->generateIdQuotation();
		$data['number'] 				= $this->Requests_model->generateQuotNumber();
		$data['date'] 					= date("Y-m-d");

		$data['total_product'] 			= str_replace(",", "", $post['total_product']);
		$data['tax'] 					= str_replace(",", "", $post['tax']);
		$data['total_tax'] 				= str_replace(",", "", $post['total_tax']);
		$data['total_bm'] 				= str_replace(",", "", $post['total_bm']);
		$data['total_pph'] 				= str_replace(",", "", $post['total_pph']);
		$data['grand_total'] 			= str_replace(",", "", $post['grand_total']);
		$data['grand_total_exclude_price'] = str_replace(",", "", $post['grand_total_exclude_price']);

		$data['exchange'] 				= str_replace(",", "", $post['exchange']);
		$data['subtotal'] 				= str_replace(",", "", $post['subtotal']);
		$data['total_costing'] 			= str_replace(",", "", $post['total_costing']);
		$data['total_costing_foreign_currency'] = str_replace(",", "", $post['total_costing_foreign_currency']);
		$data['fee_customer_id'] 		= ($post['fee_customer_id']) ?: null;
		// $data['fee_value'] 				= str_replace(",", "", $post['fee_value']) ?: null;
		$data['fee_customer'] 			= str_replace(",", "", $post['fee_customer']) ?: null;
		$data['created_at']				= $data['modified_at'] = date('Y-m-d H:i:s');
		$data['created_by']				= $data['modified_by'] = $this->auth->user_id();

		$detail 						= $data['detail'];
		$detail_lartas 					= isset($data['detail_fee_lartas']) ? $data['detail_fee_lartas'] : "";
		$costing 						= $data['costing'];
		$payment_term 					= $data['payment_term'];
		$checked_item 					= $data['checked_item'];

		unset($data['detail']);
		unset($data['detail_fee_lartas']);
		unset($data['costing']);
		unset($data['deleteItem']);
		unset($data['payment_term']);
		unset($data['checked_item']);

		$this->db->trans_begin();
		if ($detail) {
			$dtlId =  ($this->Requests_model->getDetailQuotId($data['id']));
			$ArrDetail = [];
			// $ArrDetailNotChecked = [];
			foreach ($detail as $k => $dtl) {
				if (in_array($k, $checked_item)) {
					$dtlId++;
					$ArrDetail[$k] = $dtl;
					$ArrDetail[$k]['id'] 				= $data['id'] . "-" . sprintf("%04d", $dtlId);
					$ArrDetail[$k]['quotation_id'] 		= $data['id'];
					$ArrDetail[$k]['price'] 			= str_replace(",", "", $dtl['price']);
					$ArrDetail[$k]['unit_price'] 		= str_replace(",", "", $dtl['unit_price']);
					$ArrDetail[$k]['bm_type'] 			= explode("-", $dtl['bm_type'])[0];
					$ArrDetail[$k]['bm_value'] 			= explode("-", $dtl['bm_type'])[1];
					$ArrDetail[$k]['created_at'] 		= $dtl['modified_at'] = date('Y-m-d H:i:s');
					$ArrDetail[$k]['created_by'] 		= $dtl['modified_by'] = $this->auth->user_id();
				}
			}
		}

		$ArrDtlLartas = [];
		if ($detail_lartas) {
			$dtlId = 0;
			foreach ($detail_lartas as $k => $dtla) {
				$dtlId++;
				$ArrDtlLartas[$k] = $dtla;
				$ArrDtlLartas[$k]['id'] 						= $data['id'] . "-L" . sprintf("%03d", $dtlId);
				$ArrDtlLartas[$k]['quotation_id'] 				= $data['id'];
				$ArrDtlLartas[$k]['price'] 						= str_replace(",", "", $dtla['price']);
				$ArrDtlLartas[$k]['total'] 						= str_replace(",", "", $dtla['total']);
				$ArrDtlLartas[$k]['total_foreign_currency'] 	= str_replace(",", "", $dtla['total_foreign_currency']);
				$ArrDtlLartas[$k]['created_at'] 				= date('Y-m-d H:i:s');
				$ArrDtlLartas[$k]['created_by'] 				= $this->auth->user_id();;
			}
		}

		$this->db->insert("quotations", $data);
		$this->db->insert_batch('quotation_details', $ArrDetail);
		if ($ArrDtlLartas) {
			$this->db->insert_batch('quotation_detail_lartas', $ArrDtlLartas);
		}

		if ($costing) {
			$n = 0;
			foreach ($costing as $k => $cost) {
				$n++;
				$cost['id'] 						= $data['id'] . "-C" . sprintf("%03d", $n);
				$cost['name'] 						= $cost['name'];
				if ($k == '1' || $k == '2' || $k == '3') {
					$cost['name'] 					= "OTH-" . $cost['name'];
				}
				$cost['quotation_id'] 				= $data['id'];
				$cost['price'] 						= str_replace(",", "", $cost['price']);
				$cost['total'] 						= str_replace(",", "", $cost['total']);
				$cost['currency'] 					= $data['currency'];
				$cost['exchange'] 					= str_replace(",", "", $data['exchange']);
				$cost['total_foreign_currency'] 	= str_replace(",", "", $cost['total_foreign_currency']);
				$cost['created_at'] 				= date('Y-m-d H:i:s');
				$cost['created_by'] 				= $this->auth->user_id();;
				$this->db->insert('quotation_detail_costing', $cost);
			}
		}

		if ($payment_term) {
			$n = 0;
			foreach ($payment_term as $pt) {
				$n++;
				$pt['id'] 							= $data['id'] . "-P" . sprintf("%02d", $n);
				$pt['quotation_id'] 				= $data['id'];
				$pt['amount'] 						= str_replace(",", "", $pt['amount']);
				$pt['last_update'] 					= date('Y-m-d H:i:s');
				$this->db->insert('quotation_payment_term', $pt);
			}
		}

		$this->db->update("check_hscodes", ['status' => 'QTT'], ['id' => $data['check_id']]);

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

	function getItemLartas()
	{
		$check_id 		= $this->input->post('check_id');
		$data 			= $this->input->post('data');
		$lartas_type 	= $this->input->post('lartas_type');
		$customer_id 	= $this->input->post('customer_id');

		if ($check_id) {
			$header 		= $this->db->get_where('check_hscodes', ['id' => $check_id])->row();
		}
		$details 		= $this->db->where_in('id', $data)->get_where('view_check_hscode_details', ['check_hscode_id' => $check_id])->result();
		$lartas 		= $this->db->get_where('lartas', ['status' => '1'])->result_array();
		$ArrLartas 		= array_column($lartas, 'name', 'id');
		$lartasItems 	= [];

		foreach ($details as $dtl) {
			if ($dtl->lartas) {
				$lartasItems[] = $dtl->lartas;
			}
		}

		foreach ($this->currency as $cur) {
			$ArrCurrency[$cur->code] = $cur;
		}

		if ($lartas_type == 'STD') {
			$lartas = $this->db->where_in('lartas_id', $lartasItems)->get_where('view_fee_lartas', ['status' => '1'])->result();
		} else if ($lartas_type == 'CORP') {
			$feeLartas = $this->db->get_where('fee_lartas_customers', ['customer_id' => $customer_id, 'status' => '1'])->row();
			if ($feeLartas) {
				$lartas = $this->db->where_in('lartas_id', $lartasItems)->get_where('view_fee_lartas_customer_details', ['fee_lartas_customer_id' => $feeLartas->id])->result();
			}
		}

		$unitType 	= [
			'TNE' => 'Tonase',
			'SPM' => 'Shipment',
			'CNT' => 'Container',
		];

		$Data = [
			'itemLartas' 	=> array_unique($lartasItems),
			'ArrLartas' 	=> $ArrLartas,
			'currency' 		=> isset($header) ? $ArrCurrency[$header->currency]->symbol : '',
			// 'unitType' 		=> $unitType,
			// 'lartas' 		=> $lartas,
		];

		echo json_encode($Data);
	}
}
