<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

/*
 * @author Hikmat Aolia
 * @copyright Copyright (c) 2023, Hikmat Aolia
 *
 * This is controller for Master Fee Lartas Port
 */

class Fee_lartas extends Admin_Controller
{
	//Permission
	protected $viewPermission 	= 'Fee_lartas.View';
	protected $addPermission  	= 'Fee_lartas.Add';
	protected $managePermission = 'Fee_lartas.Manage';
	protected $deletePermission = 'Fee_lartas.Delete';

	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('upload', 'Image_lib'));
		$this->load->model(array(
			'Fee_lartas/Fee_lartas_model',
			'Aktifitas/aktifitas_model',
		));
		$this->template->title('Manage Fee Lartas');
		$this->template->page_icon('fas fa-hand-holding-usd');

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
        FROM fee_lartas, (SELECT @row_number:=0) as temp WHERE 1=1 $where  
        AND (`name` LIKE '%$string%'
        OR `fee_value` LIKE '%$string%'
        OR `description` LIKE '%$string%'
            )";

		$totalData = $this->db->query($sql)->num_rows();
		$totalFiltered = $this->db->query($sql)->num_rows();

		$columns_order_by = array(
			0 => 'num',
			1 => 'name',
			2 => 'type',
			3 => 'fee_value',
			4 => 'description',
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

			$type = ($row['type'] == 'TNE') ? 'Tonase' : (($row['type'] == 'SPM') ? 'Shipment' : '-');

			$view 		= '<button type="button" class="btn btn-primary btn-sm view" data-toggle="tooltip" title="View" data-id="' . $row['id'] . '"><i class="fa fa-eye"></i></button>';
			$edit 		= '<button type="button" class="btn btn-success btn-sm edit" data-toggle="tooltip" title="Edit" data-id="' . $row['id'] . '"><i class="fa fa-edit"></i></button>';
			$delete 	= '<button type="button" class="btn btn-danger btn-sm delete" data-toggle="tooltip" title="Delete" data-id="' . $row['id'] . '"><i class="fa fa-trash"></i></button>';
			$buttons 	= $view . "&nbsp;" . $edit . "&nbsp;" . $delete;



			$nestedData   = array();
			$nestedData[]  = $nomor;
			$nestedData[]  = $row['name'];
			$nestedData[]  = $type;
			$nestedData[]  = "Rp. " . number_format($row['fee_value']);
			$nestedData[]  = $row['description'];
			$nestedData[]  = $buttons;
			$data[] 	   = $nestedData;
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

	public function getData2()
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
        FROM view_fee_lartas_customers, (SELECT @row_number:=0) as temp WHERE 1=1 $where  
        AND (`customer_name` LIKE '%$string%'
        OR `description` LIKE '%$string%'
            )";

		$totalData = $this->db->query($sql)->num_rows();
		$totalFiltered = $this->db->query($sql)->num_rows();

		$columns_order_by = array(
			0 => 'num',
			1 => 'customer_name',
			// 2 => 'type',
			3 => 'description',
			// 4 => 'description',
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
		$ArrDtl = [];
		$details = $this->db->get_where('view_fee_lartas_customer_details')->result();

		foreach ($details as $dtl) {
			$ArrDtl[$dtl->lartas_id][] = $dtl;
		}

		/* Button */
		foreach ($query->result_array() as $row) {
			$buttons = '';
			$html = '';
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

			if (isset($ArrDtl[$row['id']])) foreach ($ArrDtl[$row['id']] as $rowDtl) {
				$html .= "<li>" . $rowDtl->name . " - Rp. " . number_format($rowDtl->cost_value) . "</li>";
			}
			// $type = ($row['type'] == 'TNE') ? 'Tonase' : (($row['type'] == 'SPM') ? 'Shipment' : '-');

			$view 		= '<button type="button" class="btn btn-primary btn-sm view" data-toggle="tooltip" title="View" data-id="' . $row['id'] . '"><i class="fa fa-eye"></i></button>';
			$edit 		= '<button type="button" class="btn btn-success btn-sm edit" data-toggle="tooltip" title="Edit" data-id="' . $row['id'] . '"><i class="fa fa-edit"></i></button>';
			$delete 	= '<button type="button" class="btn btn-danger btn-sm delete" data-toggle="tooltip" title="Delete" data-id="' . $row['id'] . '"><i class="fa fa-trash"></i></button>';
			$buttons 	= $view . "&nbsp;" . $edit . "&nbsp;" . $delete;



			$nestedData   = array();
			$nestedData[]  = $nomor;
			$nestedData[]  = $row['customer_name'];
			$nestedData[]  = '';
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
		$this->template->render('form');
	}

	public function add2()
	{
		$this->auth->restrict($this->addPermission);
		$customers 	= $this->db->get_where('customers', array('status' => '1'))->result();
		$lartas 	= $this->db->get_where('fee_lartas', array('status' => '1'))->result();
		$data 	= [
			'customers' 		=> $customers,
			'lartas' 			=> $lartas,
		];
		$this->template->set($data);
		$this->template->render('form2');
	}

	public function edit($id)
	{
		$this->auth->restrict($this->managePermission);
		$fee 		= $this->db->get_where('fee_lartas', array('id' => $id))->row();
		$customers 	= $this->db->get_where('customers', array('status' => '1'))->result();
		$data 	= [
			'fee' 			=> $fee,
			'customers' 	=> $customers,
		];
		$this->template->set($data);
		$this->template->render('form');
	}

	public function edit2($id)
	{
		$this->auth->restrict($this->managePermission);
		$fee 				= $this->db->get_where('fee_lartas_customers', array('id' => $id))->row();
		$customers 			= $this->db->get_where('customers', array('status' => '1'))->result();
		$fee_details 		= $this->db->get_where('fee_lartas_customer_details', array('storage_id' => $storage->id))->result();

		$ArrDtl = [];
		foreach ($fee_details as $str) {
			$ArrDtl[$str->container_id] = $str;
		}

		$data 	= [
			'fee' 			=> $fee,
			'customers' 	=> $customers,
			'ArrDtl' 		=> $ArrDtl,
		];
		$this->template->set($data);
		$this->template->render('form');
	}

	public function view($id)
	{
		$this->auth->restrict($this->viewPermission);
		$fee 	= $this->db->get_where('fee_lartas', array('id' => $id))->row();
		$data 	= [
			'fee' 		=> $fee,
		];
		$this->template->set($data);
		$this->template->render('view');
	}

	public function view2($id)
	{
		$this->auth->restrict($this->viewPermission);
		$fee 	= $this->db->get_where('fee_lartas', array('id' => $id))->row();
		$data = [
			'fee' 		=> $fee,
		];
		$this->template->set($data);
		$this->template->render('view');
	}

	public function save()
	{
		$this->auth->restrict($this->addPermission);
		$post = $this->input->post();
		$data = $post;


		if (isset($post['_formType']) && $post['_formType'] == 'Customer') {

			$data['id'] = isset($post['id']) && $post['id'] ? $post['id'] : $this->Fee_lartas_model->generate_id2();
			$detail 	= $post['detail'];
			unset($data['_formType']);
			unset($data['detail']);
			$this->db->trans_begin();
			if (isset($post['id']) && $post['id']) {
				$data['modified_at']	= date('Y-m-d H:i:s');
				$data['modified_by']	= $this->auth->user_id();
				$this->db->where('id', $post['id'])->update("fee_lartas_customers", $data);
			} else {
				$data['created_at']		= $data['modified_at'] = date('Y-m-d H:i:s');
				$data['created_by']		= $data['modified_by'] = $this->auth->user_id();
				$this->db->insert("fee_lartas_customers", $data);
			}

			if ($detail) foreach ($detail as $dtl) {
				$dtl['cost_value'] 		= str_replace(",", "", $dtl['value']);
				unset($dtl['value']);
				$dtl['fee_lartas_customer_id'] = $data['id'];
				if (isset($dtl['id']) && $dtl['id']) {
					$this->db->update('fee_lartas_customer_details', $dtl, ['id' => $dtl['id']]);
				} else {
					$this->db->insert('fee_lartas_customer_details', $dtl);
				}
			}
		} else {
			$data['id'] = isset($post['id']) && $post['id'] ? $post['id'] : $this->Fee_lartas_model->generate_id();
			$data['fee_value'] = str_replace(",", "", $post['fee_value']);
			$this->db->trans_begin();
			if (isset($post['id']) && $post['id']) {
				$data['modified_at']	= date('Y-m-d H:i:s');
				$data['modified_by']	= $this->auth->user_id();
				$this->db->where('id', $post['id'])->update("fee_lartas", $data);
			} else {
				$data['created_at']		= $data['modified_at'] = date('Y-m-d H:i:s');
				$data['created_by']		= $data['modified_by'] = $this->auth->user_id();
				$this->db->insert("fee_lartas", $data);
			}
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$return	= array(
				'msg'		=> 'Failed save data Fee Lartas.  Please try again.',
				'status'	=> 0
			);
			$keterangan     = "FAILD save data Fee Lartas " . $data['id'];
			$status         = 1;
			$nm_hak_akses   = $this->addPermission;
			$kode_universal = $data['id'];
			$jumlah         = 1;
			$sql            = $this->db->last_query();
		} else {
			$this->db->trans_commit();
			$return	= array(
				'msg'		=> 'Success Save data Fee Lartas.',
				'status'	=> 1
			);
			$keterangan     = "SUCCESS save data Fee Lartas " . $data['id'];
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
		$fee = $this->db->get_where('fee_lartas')->row_array();
		$data = [
			'status' => '0',
			'deleted_by' => $this->auth->user_id(),
			'deleted_at' => date('Y-m-d H:i:s'),
		];
		$this->db->trans_begin();
		$this->db->update('fee_lartas', $data, ['id' => $id]);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$return	= array(
				'msg'		=> 'Failed delete data Fee Lartas.  Please try again.',
				'status'	=> 0
			);
			$keterangan     = "FAILD delete data Fee Lartas " . $fee['id'];
			$status         = 1;
			$nm_hak_akses   = $this->deletePermission;
			$kode_universal = $fee['id'];
			$jumlah         = 1;
			$sql            = $this->db->last_query();
		} else {
			$this->db->trans_commit();
			$return	= array(
				'msg'		=> 'Success delete data Fee Lartas.',
				'status'	=> 1
			);
			$keterangan     = "SUCCESS delete data Fee Lartas " . $fee['id'];
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