<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

/*
 * @author Hikmat Aolia
 * @copyright Copyright (c) 2023, Hikmat Aolia
 *
 * This is controller for Quotations
 */

class Quotations extends Admin_Controller
{
	//Permission
	protected $viewPermission 	= 'Quotations.View';
	protected $addPermission  	= 'Quotations.Add';
	protected $managePermission = 'Quotations.Manage';
	protected $deletePermission = 'Quotations.Delete';
	protected $currency;
	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('upload', 'Image_lib'));
		$this->load->model(array(
			'Quotations/Quotations_model',
			'Requests/Requests_model',
			'Aktifitas/aktifitas_model',
		));
		$this->template->title('Quotations');
		$this->template->page_icon('far fa-list-alt');
		$this->currency = $this->db->get('currency')->result();
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
        FROM view_quotations, (SELECT @row_number:=0) as temp WHERE 1=1 $where  
        AND (`customer_name` LIKE '%$string%'
        OR `project_name` LIKE '%$string%'
        OR `date` LIKE '%$string%'
        OR `employee_name` LIKE '%$string%'
        OR `status` LIKE '%$string%')";

		$totalData = $this->db->query($sql)->num_rows();
		$totalFiltered = $this->db->query($sql)->num_rows();

		$columns_order_by = array(
			0 => 'num',
			1 => 'customer_name',
			2 => 'project_name',
			3 => 'date',
			4 => 'employee_name',
		);

		$sql .= " ORDER BY `modified_at` DESC, " . $columns_order_by[$column] . " " . $dir . " ";
		$sql .= " LIMIT " . $start . " ," . $length . " ";
		$query  = $this->db->query($sql);

		$data  = array();
		$urut1  = 1;
		$urut2  = 0;

		$status = [
			'OPN' => '<span class="bg-info tx-white pd-5 tx-11 tx-bold rounded-5">New</span>',
			'DEAL' => '<span class="bg-success tx-white pd-5 tx-11 tx-bold rounded-5">Deal</span>',
			'LOSE' => '<span class="bg-light tx-white pd-5 tx-11 tx-bold rounded-5">Lose</span>',
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

			$view 		= '<a href="javascript:void(0)" class="nav-link view" data-toggle="tooltip" title="View" data-id="' . $row['id'] . '" data-number="' . $row['number'] . '"><i class="fa fa-eye text-primary"></i> View</a>';
			$edit 		= '<a href="' . base_url($this->uri->segment(1) . '/edit/' . $row['id']) . '" class="nav-link" data-toggle="tooltip" title="Edit" data-id="' . $row['id'] . '"><i class="icon ion-edit text-success"></i> Edit</a>';
			$revision 	= '<a href="' . base_url($this->uri->segment(1) . '/revision/' . $row['id']) . '" class="nav-link" data-toggle="tooltip" title="Revision" data-id="' . $row['id'] . '"><i class="icon ion-edit text-warning"></i> Revison</a>';
			$deal 		= '<a href="javascript:void(0)" class="nav-link" data-toggle="tooltip" title="Create Quotation" data-id="' . $row['id'] . '"><i class="fas fa-handshake text-primary"></i> Deal</a>';
			$printAI 	= '<a href="' . base_url($this->uri->segment(1) . '/print_all_in/' . $row['id']) . '" class="nav-link" data-toggle="tooltip" title="Print All-In" data-id="' . $row['id'] . '" target="_blank"><i class="icon ion-printer text-info"></i> Print All-In</a>';
			$printAPB 	= '<a href="' . base_url($this->uri->segment(1) . '/print_apb/' . $row['id']) . '" class="nav-link" data-toggle="tooltip" title="Print As Per-Bill" data-id="' . $row['id'] . '" target="_blank"><i class="icon ion-printer text-info"></i> <span class="">Print As Per-Bill</span></a>';
			$cancel 	= '<a href="javascript:void(0)" class="nav-link" data-toggle="tooltip" title="Cancel" data-id="' . $row['id'] . '"><i class="icon ion-minus-circled text-danger"></i> Cancel</a>';
			$buttons 	= $view . $edit  . $deal .  $printAI . $printAPB . $cancel;

			if ($row['status'] == 'RVI') {
				$buttons 	=  $view . $revision . $printAPB . $printAI;
			}
			if ($row['status'] == 'DEAL') {
				$buttons 	= $view . $printAPB . $printAI;
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
			$nestedData[]  = $row['employee_name'];
			$nestedData[]  = ($row['revision_count']) ? "Rev-" . $row['revision_count'] : '-';
			$nestedData[]  = $status[$row['status']];
			$nestedData[]  = '<div class="dropdown">
								<a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown">
									<span class="tx- h6">Opsi</span> <i class="fa fa-cog mg-l-5"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right wd-100">
									<nav class="nav nav-style-2 flex-column">
									' . $buttons . '
									</nav>
								</div>
							</div>';
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

	public function edit($id)
	{
		$this->auth->restrict($this->addPermission);
		$configs 		= $this->db->get('configs')->result();
		$header 		= $this->db->get_where('view_quotations', ['id' => $id])->row();
		$companies 		= $this->db->get_where('companies', ['status' => '1'])->result();
		$ports 			= $this->db->get_where('harbours', ['status' => '1'])->result();
		$containers 	= $this->db->get_where('containers', ['status' => '1'])->result();
		$cities 		= $this->db->get_where('cities', ['country_id' => '102', 'flag' => '1'])->result();
		$areas 			= $this->db->get_where('areas', ['city_id' => $header->dest_city])->result();
		$details 		= $this->db->get_where('quotation_details', ['quotation_id' => $id])->result();
		$hscodes 		= $this->db->get_where('hscodes', array('status' => '1'))->result();
		$hscodes_doc 	= $this->db->get_where('hscode_requirements')->result();
		$lartas 		= $this->db->get_where('lartas', ['status' => '1'])->result_array();
		$costing 		= $this->db->get_where('quotation_detail_costing', ['quotation_id' => $id])->result();
		$fee_lartas 	= $this->db->get_where('view_quotation_detail_lartas', ['quotation_id' => $id])->result();
		$otherCost 		= $this->db->get_where('quotation_detail_costing', ['quotation_id' => $id, 'name like' => '%OTH%'])->result();
		$payment_term 	= $this->db->get_where('quotation_payment_term', ['quotation_id' => $id])->result();
		$ArrLartas 		= array_column($lartas, 'name', 'id');
		$ArrHscode 		= [];
		$ArrDocs 		= [];
		$ArrPorts 		= [];
		$ArrCurrency 	= [];

		$unitLartas 	= [
			'TNE' => 'Tonase',
			'SPM' => 'Shipment',
			'CNT' => 'Container',
			'ITM' => 'Item',
		];

		$default = [];
		foreach ($configs as $conf) {
			$default[$conf->key] = $conf;
		}

		foreach ($this->currency as $cur) {
			$ArrCurrency[$cur->code] = $cur;
		}

		$currency = $ArrCurrency[$header->currency]->symbol;
		$currency_code = $ArrCurrency[$header->currency]->code;

		$ArrPayTerm = [];
		foreach ($payment_term as $pt) {
			$ArrPayTerm[$pt->name] = $pt;
		}

		foreach ($hscodes as $hs) {
			$ArrHscode[$hs->origin_code] = $hs;
		}

		foreach ($hscodes_doc as $doc) {
			$ArrDocs[$doc->hscode_id][$doc->type][] = $doc;
		}

		foreach ($ports as $port) {
			$ArrPorts[$port->country_id][] = $port;
		}

		$ArrCosting = [];
		foreach ($costing as $cst) {
			$ArrCosting[$cst->name] = $cst;
		}

		$data = [
			'default' 			=> $default,
			'currency' 			=> $currency,
			'currency_code' 	=> $currency_code,
			'header' 			=> $header,
			'companies' 		=> $companies,
			'costing' 			=> $costing,
			'ports' 			=> $ports,
			'areas' 			=> $areas,
			'containers' 		=> $containers,
			'cities' 			=> $cities,
			'details' 			=> $details,
			'ArrHscode' 		=> $ArrHscode,
			'ArrDocs' 			=> $ArrDocs,
			'ArrPorts' 			=> $ArrPorts,
			'ArrLartas' 		=> $ArrLartas,
			'fee_lartas' 		=> $fee_lartas,
			'ArrCosting' 		=> $ArrCosting,
			'unitLartas' 		=> $unitLartas,
			'otherCost' 		=> $otherCost,
			'ArrPayTerm' 		=> $ArrPayTerm,
		];

		$this->template->set($data);
		$this->template->render('edit');
	}

	public function revision($id)
	{
		$this->auth->restrict($this->managePermission);
		$request 			= $this->db->get_where('view_check_hscodes', ['id' => $id])->row();
		$dtlRequest 		= $this->db->get_where('check_hscode_detail', ['check_hscode_id' => $id])->result();
		$customers 			= $this->db->get_where('customers', ['status' => '1'])->result();
		$countries 			= $this->db->get_where('countries')->result();
		$flag_revision 		= true;
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
		]);
		$this->template->render('view');
	}

	public function save()
	{
		$this->auth->restrict($this->addPermission);
		$post = $this->input->post();
		$data = $post;

		$data['total_product'] 			= str_replace(",", "", $post['total_product']);
		$data['tax'] 					= str_replace(",", "", $post['tax']);
		$data['total_tax'] 				= str_replace(",", "", $post['total_tax']);
		$data['total_bm'] 				= str_replace(",", "", $post['total_bm']);
		$data['total_pph'] 				= str_replace(",", "", $post['total_pph']);
		$data['grand_total'] 			= str_replace(",", "", $post['grand_total']);
		$data['grand_total_exclude_price'] 			= 	str_replace(",", "", $post['grand_total_exclude_price']);

		$data['exchange'] 				= str_replace(",", "", $post['exchange']);
		$data['subtotal'] 				= str_replace(",", "", $post['subtotal']);
		$data['total_costing'] 			= str_replace(",", "", $post['total_costing']);
		$data['total_costing_foreign_currency'] = str_replace(",", "", $post['total_costing_foreign_currency']);
		$data['fee_customer_id'] 		= ($post['fee_customer_id']) ?: null;
		$data['modified_at'] 			= date('Y-m-d H:i:s');
		$data['modified_by'] 			= $this->auth->user_id();

		$detail 						= $data['detail'];
		$detail_lartas 					= isset($data['detail_fee_lartas']) ? $data['detail_fee_lartas'] : '';
		$costing 						= $data['costing'];
		$payment_term 					= $data['payment_term'];

		unset($data['detail']);
		unset($data['detail_fee_lartas']);
		unset($data['costing']);
		unset($data['deleteItem']);
		unset($data['payment_term']);

		$this->db->trans_begin();
		$this->db->update("quotations", $data, ['id' => $post['id']]);

		if ($detail) {
			$n =  ($this->Requests_model->getDetailQuotId($data['id']));
			foreach ($detail as $dtl) {
				$dtlID 					= ($dtl['id']) ?: $data['id'] . "-" . sprintf("%04d", $n++);
				$dtl['id'] 				= $dtlID;
				$dtl['bm_mfn'] 			= str_replace(",", "", $dtl['bm_mfn']);
				$dtl['bm_e'] 			= str_replace(",", "", $dtl['bm_e']);
				$dtl['pph_api'] 		= str_replace(",", "", $dtl['pph_api']);
				$dtl['price'] 			= str_replace(",", "", $dtl['price']);
				$dtl['total_bm'] 		= str_replace(",", "", $dtl['total_bm']);
				$dtl['total_pph'] 		= str_replace(",", "", $dtl['total_pph']);
				$dtl['modified_at'] 	= date('Y-m-d H:i:s');
				$dtl['modified_by'] 	= $this->auth->user_id();
				$this->db->update('quotation_details', $dtl, ['id' => $dtlID]);
			}
		}

		if ($detail_lartas) {
			$dtlId = 0;
			foreach ($detail_lartas as $dtla) {
				$dtlId++;
				$dtla['price'] 					= str_replace(",", "", $dtla['price']);
				$dtla['total'] 					= str_replace(",", "", $dtla['total']);
				$dtla['total_foreign_currency'] = str_replace(",", "", $dtla['total_foreign_currency']);
				$this->db->update('quotation_detail_lartas', $dtla, ['id' => $dtla['id']]);
			}
		}

		if ($costing) {
			$n = 0;
			foreach ($costing as $k => $cost) {
				$n++;
				$cost['id'] 						= isset($cost['id']) && $cost['id'] ? $cost['id'] : $data['id'] . "-C" . sprintf("%03d", $n);
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
				$cost['modified_at'] 				= date('Y-m-d H:i:s');
				$cost['modified_by'] 				= $this->auth->user_id();;
				$this->db->update('quotation_detail_costing', $cost, ['id' => $cost['id']]);
			}
		}

		if ($payment_term) {
			$n = 0;
			foreach ($payment_term as $pt) {
				$n++;
				$pt['id'] 							= isset($pt['id']) && $pt['id'] ? $pt['id'] : $data['id'] . "-P" . sprintf("%02d", $n);
				$pt['quotation_id'] 				= $data['id'];
				$pt['amount'] 						= str_replace(",", "", $pt['amount']);
				$pt['last_update'] 				= date('Y-m-d H:i:s');
				$this->db->update('quotation_payment_term', $pt, ['id' => $pt['id']]);
				// $this->db->insert('quotation_payment_term', $pt);
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
				'msg'		=> 'Success Save data Requests HS Code.',
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
		$config['max_width'] 		= '1024';
		$config['max_height'] 		= '1024';
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

	function saveQuotation()
	{
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
				$totalFee = $fee_value =  ($total_price_non_lartas_convert * $fee) / 100;
			} else if (isset($fee_type) && $fee_type == 'C') {
				$err_fee_customer 		= 'Fee Customer not available in this Customer.';
				$feeCust 				= $this->db->get_where('fee_customers', ['customer_id' => $customer])->row();

				if ($feeCust) {
					$fee_customer_id 	= $feeCust->id;
					$fee_customer_value = ($feeCust->fee_value);
					$err_fee_customer 	= '';
				}
				$totalFee = $fee_customer_value;
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
			'price' 						=> isset($totalFee) ? number_format($totalFee, 2) : 0,
			'total' 						=> isset($totalFee) ? number_format($totalFee * $qty_container, 2) : 0,
			'total_foreign_currency' 		=> isset($totalFee) ? number_format(($totalFee * $qty_container) / $exchange, 2) : 0,
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

	/* PRINT QUOTATION */
	function print_all_in($id)
	{
		$this->auth->restrict($this->viewPermission);
		$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
		$fontDirs = $defaultConfig['fontDir'];

		$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
		$fontData = $defaultFontConfig['fontdata'];

		$mpdf = new \Mpdf\Mpdf([
			'fontDir' => array_merge($fontDirs, [__DIR__]),
			'fontdata' => $fontData +
				[
					'Sun-ExtA' => [
						'R' => 'assets/fonts/Sun-ExtA.ttf',
					],
					'Sun-ExtB' => [
						'R' => 'assets/fonts/Sun-ExtB.ttf',
					],
				],
			'mode' => 'utf-8',
			'format' => 'A4',
			'setAutoTopMargin' => 'pad',
			'autoMarginPadding' => 0
		]);

		// $mpdf = new \Mpdf\Mpdf();
		$header 		= $this->db->get_where('view_quotations', ['id' => $id])->row();
		$companies 		= $this->db->get_where('companies', ['status' => '1'])->result();
		$ports 			= $this->db->get_where('harbours', ['status' => '1'])->result();
		$containers 	= $this->db->get_where('containers', ['status' => '1'])->result();
		$cities 		= $this->db->get_where('cities', ['country_id' => '102', 'flag' => '1'])->result();
		$details 		= $this->db->get_where('quotation_details', ['quotation_id' => $id])->result();
		$hscodes 		= $this->db->get_where('hscodes', array('status' => '1'))->result();
		$hscodes_doc 	= $this->db->get_where('hscode_requirements')->result();
		$lartas 		= $this->db->get_where('lartas', ['status' => '1'])->result_array();
		$feeLartas 		= $this->db->get_where('quotation_detail_lartas', ['quotation_id' => $id])->result_array();
		echo '<pre>';
		print_r($feeLartas);
		echo '</pre>';
		exit;
		$ArrLartas 		= array_column($lartas, 'name', 'id');
		$ArrHscode 		= [];
		$ArrDocs 		= [];
		$ArrPorts 		= [];

		foreach ($hscodes as $hs) {
			$ArrHscode[$hs->origin_code] = $hs;
		}

		foreach ($hscodes_doc as $doc) {
			$ArrDocs[$doc->hscode_id][$doc->type][] = $doc;
		}

		foreach ($ports as $port) {
			$ArrPorts[$port->country_id][] = $port;
		}

		$data = [
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
		$html = $this->template->load_view('print_all_in');
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	function print_apb($id)
	{
		$this->auth->restrict($this->viewPermission);
		$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', 'setAutoTopMargin' => 'pad', 'autoMarginPadding' => 0]);
		$header 		= $this->db->get_where('view_quotations', ['id' => $id])->row();
		$ports 			= $this->db->get_where('harbours', ['status' => '1'])->result();
		$details 		= $this->db->get_where('quotation_details', ['quotation_id' => $id])->result();
		$hscodes 		= $this->db->get_where('hscodes', array('status' => '1'))->result();
		$hscodes_doc 	= $this->db->get_where('hscode_requirements')->result();
		$users 			= $this->db->get_where('users', ['status' => '1'])->result_array();
		$ArrUsers 		= array_column($users, 'full_name', 'id_user');
		$otherCost 		= $this->db->get_where('quotation_detail_costing', ['quotation_id' => $id, 'name like' => '%OTH%'])->result();
		$ArrHscode 		= [];
		$ArrDocs 		= [];
		$ArrPorts 		= [];
		$feeLartas 		= $this->db->get_where('quotation_detail_lartas', ['quotation_id' => $id])->result();

		if ($header->grand_total > 0) {
			$dp1 = ($header->total_product * 30) / 100;
			$dp2 = ($header->total_product - $dp1);
			$dp3 = ($header->total_product * 17) / 100;
			$dp4 = $header->grand_total - ($dp1 + $dp2 + $dp3);
			$DP = [
				'dp1' => number_format($dp1),
				'dp2' => number_format($dp2),
				'dp3' => number_format($dp3),
				'dp4' => number_format($dp4),
			];
		}


		$tonase = 0;
		$totalLartas = 0;
		foreach ($feeLartas as $fla) {
			if ($fla->unit == 'TNE') {
				$tonase += $fla->qty;
			}
			$totalLartas += $fla->total_foreign_currency;
		}

		foreach ($this->currency as $curr) {
			$ArrCurr[$curr->code] = $curr;
		}
		$currSymbol = $ArrCurr[$header->currency]->symbol;
		foreach ($hscodes as $hs) {
			$ArrHscode[$hs->origin_code] = $hs;
		}

		foreach ($hscodes_doc as $doc) {
			$ArrDocs[$doc->hscode_id][$doc->type][] = $doc;
		}

		foreach ($ports as $port) {
			$ArrPorts[$port->country_id][] = $port;
		}

		$costing 		= $this->db->get_where('quotation_detail_costing', ['quotation_id' => $id])->result();
		$ArrCosting = [];
		foreach ($costing as $cst) {
			$ArrCosting[$cst->name] = $cst;
		}

		$data = [
			'header' 		=> $header,
			'details' 		=> $details,
			'totalLartas' 	=> $totalLartas,
			'ArrHscode' 	=> $ArrHscode,
			'tonase' 		=> $tonase,
			'currSymbol' 	=> $currSymbol,
			'ArrUsers' 		=> $ArrUsers,
			'ArrCosting' 	=> $ArrCosting,
			'otherCost' 	=> $otherCost,
			'DP' 			=> $DP,
		];
		$this->template->set($data);
		$mpdf->SetFooter("Page {PAGENO} of {nbpg}");
		$html = $this->template->load_view('print_apb');
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}
}
