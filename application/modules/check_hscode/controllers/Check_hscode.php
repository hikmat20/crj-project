<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

/*
 * @author Hikmat Aolia
 * @copyright Copyright (c) 2023, Hikmat Aolia
 *
 * This is controller for Master Trucking Container Port
 */

class Check_hscode extends Admin_Controller
{
	//Permission
	protected $viewPermission 	= 'Check_hscode.View';
	protected $addPermission  	= 'Check_hscode.Add';
	protected $managePermission = 'Check_hscode.Manage';
	protected $deletePermission = 'Check_hscode.Delete';
	protected $currency;
	protected $unit;
	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('upload', 'Image_lib'));
		$this->load->model(array(
			'Check_hscode/Check_hscode_model',
			'Aktifitas/aktifitas_model',
		));
		$this->template->title('Check HS Code');
		$this->template->page_icon('fas fa-check-double');
		date_default_timezone_set('Asia/Bangkok');
		$perm = [
			'ENABLE_ADD'  		=> has_permission('Check_hscode.Add'),
			'ENABLE_MANAGE'  	=> has_permission('Check_hscode.Manage'),
			'ENABLE_VIEW'  		=> has_permission('Check_hscode.View'),
			'ENABLE_DELETE'  	=> has_permission('Check_hscode.Delete'),
		];
		$this->currency = $this->db->get('currency')->result();
		$this->unit = [
			'rp'        => '(Rp)',
			'm'         => 'Meter',
			'percent'   => '%',
			'kg'        => 'Kg',
		];
		$this->template->set($perm);
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
        FROM view_check_hscodes, (SELECT @row_number:=0) as temp WHERE 1=1 $where  
        AND (`customer_name` LIKE '%$string%'
        OR `project_name` LIKE '%$string%'
        OR `number` LIKE '%$string%'
        OR `date` LIKE '%$string%'
        OR `employee_name` LIKE '%$string%'
        OR `revision_count` LIKE '%$string%'
        OR `last_checked_at` LIKE '%$string%'
            )";

		$totalData = $this->db->query($sql)->num_rows();
		$totalFiltered = $this->db->query($sql)->num_rows();

		$columns_order_by = array(
			0 => 'num',
			1 => 'customer_name',
			2 => 'number',
			3 => 'project_name',
			4 => 'date',
			5 => 'qty',
			6 => 'employee_name',
			7 => 'last_checked_at',
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
			'CNL' => '<span class="bg-light tx-white pd-5 tx-11 tx-bold rounded-5">Cancel</span>',
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
			// $edit 		= '<a href="' . base_url($this->uri->segment(1) . '/revision/' . $row['id']) . '" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Revision" data-id="' . $row['id'] . '"><i class="fa fa-edit"></i></a>';
			$print 		= '<a target="_blank" href="' . base_url($this->uri->segment(1) . '/printout/' . $row['id']) . '" class="btn btn-info btn-sm" data-toggle="tooltip" title="Print Check" data-id="' . $row['id'] . '"><i class="fa fa-print"></i></a>';
			$buttons 	= $view . "&nbsp;"  . $print;

			if ($row['status'] == 'QTT') {
				$buttons 	= $view;
			}

			$nestedData   = array();
			$nestedData[]  = $nomor;
			$nestedData[]  = $row['customer_name'];
			$nestedData[]  = $row['number'];
			$nestedData[]  = $row['project_name'];
			$nestedData[]  = date("d/m/Y", strtotime($row['date']));
			$nestedData[]  = $row['qty'];
			$nestedData[]  = $row['employee_name'];
			$nestedData[]  = $row['revision_count'];
			$nestedData[]  = $row['last_checked_at'];
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

	public function getDataRequest()
	{
		$requestData    = $_REQUEST;
		$status         = $requestData['status'];
		$search         = $requestData['search']['value'];
		$column         = $requestData['order'][0]['column'];
		$dir            = $requestData['order'][0]['dir'];
		$start          = $requestData['start'];
		$length         = $requestData['length'];

		$where = "";
		$where = " AND `status` IN('$status','RVI')";

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
			6 => 'status',
		);

		$sql .= " ORDER BY `modified_at` DESC, " . $columns_order_by[$column] . " " . $dir . " ";
		$sql .= " LIMIT " . $start . " ," . $length . " ";
		$query  = $this->db->query($sql);


		$data  = array();
		$urut1  = 1;
		$urut2  = 0;

		$status = [
			'OPN' => '<span class="bg-info tx-white pd-5 tx-11 tx-bold rounded-5">New</span>',
			// 'CHK' => '<span class="bg-success tx-white pd-5 tx-11 tx-bold rounded-5">Checked</span>',
			'RVI' => '<span class="bg-warning tx-white pd-5 tx-11 tx-bold rounded-5">Revision</span>',
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

			$check 		= '<button type="button" data-id="' . $row['id'] . '" class="btn btn-warning btn-sm check" ><i class="fa fa-arrow-circle-right"></i></button>';
			$edit 		= '<a href="' . base_url($this->uri->segment(1) . '/edit/' . $row['id']) . '" class="btn btn-success btn-sm" data-toggle="tooltip" title="Edit" data-id="' . $row['id'] . '"><i class="fa fa-edit"></i></a>';
			$cancel 	= '<button type="button" class="btn btn-danger btn-sm cancel" data-toggle="tooltip" title="Cancel" data-id="' . $row['id'] . '"><i class="fa fa-minus-circle"></i></button>';
			$buttons 	= $check;

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
		// $this->template->render('under-construction');
		$this->template->render('index');
	}

	public function create()
	{
		$this->auth->restrict($this->addPermission);
		$this->template->set(['subtitle' => 'New Check HS Code']);
		$this->template->render('list-request');
	}

	public function loadRequest($id)
	{
		$this->auth->restrict($this->managePermission);
		$request 		= $this->db->get_where('view_check_hscodes', array('id' => $id))->row();
		$details 		= $this->db->get_where('check_hscode_detail', array('check_hscode_id' => $id))->result();
		$hscodes 		= $this->db->get_where('hscodes', array('status' => '1'))->result();
		$hscodes_doc 	= $this->db->get_where('hscode_requirements')->result();
		$current_ppn 	= $this->db->get_where('configs', ['key' => 'ppn'])->row()->value;
		$ArrHscode 		= [];
		$ArrDocs 		= [];
		$ArrCur 		= [];

		foreach ($this->currency as $cur) {
			$ArrCur[$cur->code] = $cur;
		}

		foreach ($hscodes as $hs) {
			$ArrHscode[$hs->origin_code] = $hs;
		}

		foreach ($hscodes_doc as $doc) {
			$ArrDocs[$doc->hscode_id][$doc->type][] = $doc;
		}

		$this->template->set([
			'request' 		=> $request,
			'details' 		=> $details,
			'ArrHscode' 	=> $ArrHscode,
			'current_ppn' 	=> $current_ppn,
			'ArrDocs' 		=> $ArrDocs,
			'currency' 		=> $ArrCur,
			'unit' 		=> $this->unit,

		]);

		$this->template->render('form');
	}

	public function revision($id)
	{
		$this->auth->restrict($this->managePermission);
		$request 		= $this->db->get_where('view_check_hscodes', array('id' => $id))->row();
		$details 		= $this->db->get_where('check_hscode_detail', array('check_hscode_id' => $id))->result();
		$hscodes 		= $this->db->get_where('hscodes', array('status' => '1'))->result();
		$hscodes_doc 	= $this->db->get_where('hscode_requirements')->result();
		$current_ppn 	= $this->db->get_where('configs', ['key' => 'ppn'])->row()->value;
		$ArrHscode 		= [];
		$ArrDocs 		= [];

		foreach ($hscodes as $hs) {
			$ArrHscode[$hs->origin_code] = $hs;
		}
		foreach ($hscodes_doc as $doc) {
			$ArrDocs[$doc->hscode_id][$doc->type][] = $doc;
		}
		// $ArrStates 		= array_column($states, 'name', 'id');
		// $containers 	= $this->db->get_where('containers', ['status' => '1'])->result();
		// $dtlTrucking 	= $this->db->get_where('trucking_details', ['trucking_id' => $trucking->id])->result();
		// $ArrDtl 		= [];
		$this->template->set([
			'request' 		=> $request,
			'details' 		=> $details,
			'ArrHscode' 	=> $ArrHscode,
			'current_ppn' 	=> $current_ppn,
			'ArrDocs' 		=> $ArrDocs,
		]);
		$this->template->render('revision');
	}

	public function view($id)
	{
		$this->auth->restrict($this->viewPermission);
		$request 		= $this->db->get_where('view_check_hscodes', array('id' => $id))->row();
		$customers 		= $this->db->get_where('customers')->result_array();
		$countries 		= $this->db->get_where('countries')->result_array();
		$details 		= $this->db->get_where('check_hscode_detail', array('check_hscode_id' => $id))->result();
		$hscodes 		= $this->db->get_where('hscodes', array('status' => '1'))->result();
		$hscodes_doc 	= $this->db->get_where('hscode_requirements')->result();
		$current_ppn 	= $this->db->get_where('configs', ['key' => 'ppn'])->row()->value;
		$ArrHscode 		= [];
		$ArrDocs 		= [];
		$ArrCountry 	= array_column($countries, 'name', 'id');
		$ArrCountryCode = array_column($countries, 'country_code', 'id');
		$ArrCustomer 	= array_column($customers, 'customer_name', 'id_customer');

		foreach ($hscodes as $hs) {
			$ArrHscode[$hs->origin_code] = $hs;
		}

		foreach ($hscodes_doc as $doc) {
			$ArrDocs[$doc->hscode_id][$doc->type][] = $doc;
		}

		$ArrCurrency 			= [];

		foreach ($this->currency as $cur) {
			$ArrCurrency[$cur->code] = $cur->symbol;
		}

		$this->template->set([
			'request' 			=> $request,
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
		$post 					= $this->input->post();
		$data 					= $post;
		$detail 				= $post['detail'];
		unset($data['detail']);
		unset($data['date_request']);
		$this->db->trans_begin();
		if (isset($post['id']) && $post['id']) {
			$data['last_checked_at']		= date('Y-m-d H:i:s');
			$data['last_checked_by']		= $this->auth->user_id();
			$data['status']					= 'CHK';
			$this->db->where('id', $post['id'])->update("check_hscodes", $data);
		}
		// else {
		// 	$data['created_at']		= $data['last_checked_at'] = date('Y-m-d H:i:s');
		// 	$data['created_by']		= $data['last_checked_by'] = $this->auth->user_id();
		// 	$this->db->insert("check_hscodes", $data);
		// }

		if ($detail) {
			$n = 0;
			foreach ($detail as $dtl) {
				$n++;
				$count 					= sprintf('%04s', $n);
				$dtl['id'] 				= isset($dtl['id']) && $dtl['id'] ? $dtl['id'] : $data['id'] . "-" . $count;
				$dtl['check_hscode_id'] = $data['id'];
				$check = $this->db->get_where('check_hscode_detail', ['id' => $dtl['id']])->num_rows();
				if ($check > 0) {
					$dtl['modified_at'] = date('Y-m-d H:i:s');
					$dtl['modified_by'] = $this->auth->user_id();
					$this->db->update('check_hscode_detail', $dtl, ['id' => $dtl['id']]);
				} else {
					$dtl['created_at'] = date('Y-m-d H:i:s');
					$dtl['created_by'] = $this->auth->user_id();
					$this->db->insert('check_hscode_detail', $dtl);
				}
			}
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$return	= array(
				'msg'		=> 'Failed save data Check HS Code.  Please try again.',
				'status'	=> 0
			);
			$keterangan     = "FAILD save data Check HS Code " . $data['id'];
			$status         = 1;
			$nm_hak_akses   = $this->addPermission;
			$kode_universal = $data['id'];
			$jumlah         = 1;
			$sql            = $this->db->last_query();
		} else {
			$this->db->trans_commit();
			$return	= array(
				'msg'		=> 'Success Save data Check HS Code.',
				'status'	=> 1
			);
			$keterangan     = "SUCCESS save data Check HS Code " . $data['id'];
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

	function printout($id)
	{
		$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
		$this->auth->restrict($this->viewPermission);
		$request 		= $this->db->get_where('view_check_hscodes', array('id' => $id))->row();
		$details 		= $this->db->get_where('check_hscode_detail', array('check_hscode_id' => $id))->result();
		$hscodes 		= $this->db->get_where('hscodes', array('status' => '1'))->result();
		$hscodes_doc 	= $this->db->get_where('hscode_requirements')->result();
		$current_ppn 	= $this->db->get_where('configs', ['key' => 'ppn'])->row()->value;
		$ArrHscode 		= [];
		$ArrDocs 		= [];
		$ArrCurrency 	= [];

		foreach ($this->currency as $cur) {
			$ArrCurrency[$cur->code] = $cur;
		}

		foreach ($hscodes as $hs) {
			$ArrHscode[$hs->origin_code] = $hs;
		}
		foreach ($hscodes_doc as $doc) {
			$ArrDocs[$doc->hscode_id][$doc->type][] = $doc;
		}

		$this->template->set([
			'request' 		=> $request,
			'details' 		=> $details,
			'ArrHscode' 	=> $ArrHscode,
			'current_ppn' 	=> $current_ppn,
			'ArrDocs' 		=> $ArrDocs,
			'currency' 		=> $ArrCurrency,
		]);
		$html = $this->template->load_view('print');
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}
}
