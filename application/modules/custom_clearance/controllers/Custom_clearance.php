<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

/*
 * @author Hikmat Aolia
 * @copyright Copyright (c) 2023, Hikmat Aolia
 *
 * This is controller for Master Custom_clearance
 */

class Custom_clearance extends Admin_Controller
{
	//Permission
	protected $viewPermission 	= 'Custom_clearance.View';
	protected $addPermission  	= 'Custom_clearance.Add';
	protected $managePermission = 'Custom_clearance.Manage';
	protected $deletePermission = 'Custom_clearance.Delete';

	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('upload', 'Image_lib'));
		$this->load->model(array(
			'Custom_clearance/Custom_clearance_model',
			'Aktifitas/aktifitas_model',
		));
		$this->template->title('Manage Custom Clearance');
		$this->template->page_icon('fas fa-coins');

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
        FROM view_custom_clearance, (SELECT @row_number:=0) as temp WHERE 1=1 $where  
        AND (`container_size` LIKE '%$string%'
        OR `cost_value` LIKE '%$string%'
        OR `description` LIKE '%$string%'
        OR `status` LIKE '%$string%'
            )";

		$totalData = $this->db->query($sql)->num_rows();
		$totalFiltered = $this->db->query($sql)->num_rows();

		$columns_order_by = array(
			0 => 'num',
			1 => 'container_size',
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
			$nestedData[]  = $row['container_size'];
			$nestedData[]  = "Rp. " . number_format($row['cost_value']);
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

	public function getDataCust()
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
        FROM view_custom_clearance_customers, (SELECT @row_number:=0) as temp WHERE 1=1 $where  
        AND (`customer_name` LIKE '%$string%'
        OR `description` LIKE '%$string%'
        OR `status` LIKE '%$string%'
            )";

		$totalData = $this->db->query($sql)->num_rows();
		$totalFiltered = $this->db->query($sql)->num_rows();

		$columns_order_by = array(
			0 => 'num',
			1 => 'customer_name',
			2 => 'description',
			3 => 'status',
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
		$details = $this->db->get_where('view_custom_clearance_customer_details')->result();

		foreach ($details as $dtl) {
			$ArrDtl[$dtl->cc_id][$dtl->fee_type][] = $dtl;
		}

		/* Button */
		foreach ($query->result_array() as $row) {
			$buttons = '';
			$htmlDDU = '';
			$htmlMSK = '';
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

			if (isset($ArrDtl[$row['id']]['DDU'])) foreach ($ArrDtl[$row['id']]['DDU'] as $rowDtl) {
				$htmlDDU .= "<li>" . $rowDtl->name . " - Rp. " . number_format($rowDtl->cost_value) . "</li>";
			}
			if (isset($ArrDtl[$row['id']]['MSK'])) foreach ($ArrDtl[$row['id']]['MSK'] as $rowDtl) {
				$htmlMSK .= "<li>" . $rowDtl->name . " - Rp. " . number_format($rowDtl->cost_value) . "</li>";
			}

			$view 		= '<button type="button" class="btn btn-primary btn-sm view2" data-toggle="tooltip" title="View" data-id="' . $row['id'] . '"><i class="fa fa-eye"></i></button>';
			$edit 		= '<button type="button" class="btn btn-success btn-sm edit2" data-toggle="tooltip" title="Edit" data-id="' . $row['id'] . '"><i class="fa fa-edit"></i></button>';
			$delete 	= '<button type="button" class="btn btn-danger btn-sm delete2" data-toggle="tooltip" title="Delete" data-id="' . $row['id'] . '"><i class="fa fa-trash"></i></button>';
			$buttons 	= $view . "&nbsp;" . $edit . "&nbsp;" . $delete;

			$nestedData   = array();
			$nestedData[]  = $nomor;
			$nestedData[]  = $row['customer_name'];
			$nestedData[]  = $htmlDDU;
			$nestedData[]  = $htmlMSK;
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
		$containers = $this->db->get_where('containers', ['status' => '1'])->result();
		$this->template->set('containers', $containers);
		$this->template->render('form');
	}

	public function edit($id)
	{
		$this->auth->restrict($this->managePermission);
		$custom = $this->db->get_where('custom_clearance', array('id' => $id))->row();
		$containers = $this->db->get_where('containers', ['status' => '1'])->result();
		$this->template->set([
			'custom'	 	=> $custom,
			'containers' 		=> $containers
		]);
		$this->template->render('form');
	}

	public function view($id)
	{
		$this->auth->restrict($this->viewPermission);
		$custom = $this->db->get_where('custom_clearance', array('id' => $id))->row();
		$containers = $this->db->get_where('containers', ['status' => '1'])->result_array();
		$ArrConte = array_column($containers, 'name', 'id');
		$this->template->set([
			'custom'	 	=> $custom,
			'ArrConte' 		=> $ArrConte
		]);
		$this->template->render('view');
	}

	public function save()
	{
		$this->auth->restrict($this->addPermission);
		$post = $this->input->post();
		$data = $post;

		if (isset($data['type']) && $data['type'] == 'customer') {
			$ddu = $data['dtl']['DDU'];
			$msk = $data['dtl']['MSK'];
			unset($data['type']);
			unset($data['dtl']);
			$data['id'] = isset($post['id']) && $post['id'] ? $post['id'] : $this->Custom_clearance_model->generate_id2();
			$this->db->trans_begin();
			if (isset($post['id']) && $post['id']) {
				$data['modified_at']	= date('Y-m-d H:i:s');
				$data['modified_by']	= $this->auth->user_id();
				$this->db->where('id', $post['id'])->update("custom_clearance_customers", $data);
			} else {
				$data['created_at']		= $data['modified_at'] = date('Y-m-d H:i:s');
				$data['created_by']		= $data['modified_by'] = $this->auth->user_id();
				$this->db->insert("custom_clearance_customers", $data);
			}

			if ($ddu) {
				$n = 0;
				foreach ($ddu as $d) {
					$n++;
					$d['id'] 			= (isset($d['id']) && $d['id']) ? $d['id'] : $data['id'] . "-D" . sprintf("%03d", ($n));
					$d['cost_value'] 	= str_replace(",", "", $d['cost_value']);
					$check_data 		= $this->db->get_where('custom_clearance_customer_details', ['id' => $d['id']])->num_rows();
					if ($check_data > 0) {
						$d['modified_by'] = $this->auth->user_id();
						$d['modified_at'] = date('Y-m-d H:i:s');
						$this->db->update('custom_clearance_customer_details', $d, ['id' => $d['id']]);
					} else {
						$d['cc_id'] 		= $data['id'];
						$d['fee_type'] 		= 'DDU';
						$d['created_by'] 	= $this->auth->user_id();
						$d['created_at'] 	= date('Y-m-d H:i:s');

						$this->db->insert('custom_clearance_customer_details', $d);
					}
				}
			}

			if ($msk) {
				$n = 0;
				foreach ($msk as $d) {
					$n++;
					$d['id'] 			= (isset($d['id']) && $d['id']) ? $d['id'] : $data['id'] . "-M" . sprintf("%03d", ($n));
					$d['cost_value'] 	= str_replace(",", "", $d['cost_value']);
					$check_data 		= $this->db->get_where('custom_clearance_customer_details', ['id' => $d['id']])->num_rows();
					if ($check_data > 0) {
						$d['modified_by'] = $this->auth->user_id();
						$d['modified_at'] = date('Y-m-d H:i:s');
						$this->db->update('custom_clearance_customer_details', $d, ['id' => $d['id']]);
					} else {
						$d['cc_id'] 		= $data['id'];
						$d['fee_type'] 		= 'MSK';
						$d['created_by'] 	= $this->auth->user_id();
						$d['created_at'] 	= date('Y-m-d H:i:s');
						$this->db->insert('custom_clearance_customer_details', $d);
					}
				}
			}
		} else {
			$data['id'] = isset($post['id']) && $post['id'] ? $post['id'] : $this->Custom_clearance_model->generate_id();
			$data['cost_value'] = str_replace(",", "", $post['cost_value']);
			$this->db->trans_begin();
			if (isset($post['id']) && $post['id']) {
				$data['modified_at']	= date('Y-m-d H:i:s');
				$data['modified_by']	= $this->auth->user_id();
				$this->db->where('id', $post['id'])->update("custom_clearance", $data);
			} else {
				$data['created_at']		= $data['modified_at'] = date('Y-m-d H:i:s');
				$data['created_by']		= $data['modified_by'] = $this->auth->user_id();
				$this->db->insert("custom_clearance", $data);
			}
		}
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$return	= array(
				'msg'		=> 'Failed save data Custom Clearance.  Please try again.',
				'status'	=> 0
			);
			$keterangan     = "FAILED save data Custom Clearance " . $data['id'];
			$status         = 1;
			$nm_hak_akses   = $this->addPermission;
			$kode_universal = $data['id'];
			$jumlah         = 1;
			$sql            = $this->db->last_query();
		} else {
			$this->db->trans_commit();
			$return	= array(
				'msg'		=> 'Success Save data Custom Clearance.',
				'status'	=> 1
			);
			$keterangan     = "SUCCESS save data Custom Clearance " . $data['id'];
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
		$custom = $this->db->get_where('custom_clearance')->row_array();
		$data = [
			'status' => '0',
			'deleted_by' => $this->auth->user_id(),
			'deleted_at' => date('Y-m-d H:i:s'),
		];
		$this->db->trans_begin();
		$this->db->update('custom_clearance', $data, ['id' => $id]);
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$return	= array(
				'msg'		=> 'Failed delete data Custom Clearance.  Please try again.',
				'status'	=> 0
			);
			$keterangan     = "FAILD delete data Custom Clearance " . $custom['id'];
			$status         = 1;
			$nm_hak_akses   = $this->deletePermission;
			$kode_universal = $custom['id'];
			$jumlah         = 1;
			$sql            = $this->db->last_query();
		} else {
			$this->db->trans_commit();
			$return	= array(
				'msg'		=> 'Success delete data Custom Clearance.',
				'status'	=> 1
			);
			$keterangan     = "SUCCESS delete data Custom Clearance " . $custom['id'];
			$status         = 1;
			$nm_hak_akses   = $this->deletePermission;
			$kode_universal = $custom['id'];
			$jumlah         = 1;
			$sql            = $this->db->last_query();
		}
		simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
		echo json_encode($return);
	}


	/* Customer */

	public function add2()
	{
		$this->auth->restrict($this->addPermission);
		$idCustomers='';
		$customers 		= $this->db->get_where('customers', ['status' => '1'])->result();
		$exit_customer 	= $this->db->select('customer_id')
		->from('custom_clearance_customers')
		->group_by('customer_id')->get()->result_array();
	
		if($exit_customer){
			$idCustomers  	= array_column($exit_customer, 'customer_id');
			$customers 		= $this->db->where_not_in('id_customer', $idCustomers)->get_where('customers', ['status' => '1'])->result();
		}

		$containers 	= $this->db->get_where('containers', ['status' => '1'])->result();
		$this->template->set([
			'containers' => $containers,
			'customers' => $customers
		]);
		$this->template->render('form2');
	}

	public function edit2($id)
	{
		$this->auth->restrict($this->addPermission);
		$idCustomers='';
		$cc_customer 	= $this->db->get_where('custom_clearance_customers', ['id' => $id])->row();
		$cc_details 	= $this->db->get_where('custom_clearance_customer_details', ['cc_id' => $id])->result();
		$exit_customer 	= $this->db->select('customer_id')->from('custom_clearance_customers')->group_by('customer_id')->where(['customer_id !=' => $cc_customer->customer_id])->get()->result();
		if($exit_customer){
			$idCustomers  	= array_column($exit_customer, 'customer_id');
			$customers 		= $this->db->where_not_in('id_customer', $idCustomers)->get_where('customers', ['status' => '1'])->result();
		}
	
		$customers 		= $this->db->where_not_in('id_customer', $idCustomers)->get_where('customers', ['status' => '1'])->result();
		$containers 	= $this->db->get_where('containers', ['status' => '1'])->result();
		$ArrDTL = [];
		foreach ($cc_details as $dtl) {
			$ArrDTL[$dtl->fee_type][$dtl->container_id] = $dtl;
		}
		
		$ArrDDU = $ArrDTL['DDU'];
		$ArrMSK = $ArrDTL['MSK'];

		$this->template->set([
			'containers' 	=> $containers,
			'customers' 	=> $customers,
			'cc_customer' 	=> $cc_customer,
			'cc_details' 	=> $cc_details,
			'ArrDDU' 		=> $ArrDDU,
			'ArrMSK' 		=> $ArrMSK,
		]);
		$this->template->render('form2');
	}

	public function view2($id)
	{
		$this->auth->restrict($this->viewPermission);
		$idCustomers='';
		$cc_customer 	= $this->db->get_where('view_custom_clearance_customers', ['id' => $id])->row();
		$cc_details 	= $this->db->get_where('custom_clearance_customer_details', ['cc_id' => $id])->result();
		$exit_customer 	= $this->db->select('customer_id')->from('custom_clearance_customers')->group_by('customer_id')->where(['customer_id !=' => $cc_customer->customer_id])->get()->result();
		if($exit_customer){
			$idCustomers  	= array_column($exit_customer, 'customer_id');
			$customers 		= $this->db->where_not_in('id_customer', $idCustomers)->get_where('customers', ['status' => '1'])->result();
		}
		
		$customers 		= $this->db->where_not_in('id_customer', $idCustomers)->get_where('customers', ['status' => '1'])->result();
		$containers 	= $this->db->get_where('containers', ['status' => '1'])->result();
		$ArrDTL = [];
		foreach ($cc_details as $dtl) {
			$ArrDTL[$dtl->fee_type][$dtl->container_id] = $dtl;
		}
		
		$ArrDDU = $ArrDTL['DDU'];
		$ArrMSK = $ArrDTL['MSK'];

		$this->template->set([
			'containers' 	=> $containers,
			'customers' 	=> $customers,
			'cc_customer' 	=> $cc_customer,
			'cc_details' 	=> $cc_details,
			'ArrDDU' 		=> $ArrDDU,
			'ArrMSK' 		=> $ArrMSK,
		]);
		$this->template->render('view2');
	}

		public function delete2()
	{
		$this->auth->restrict($this->deletePermission);
		$id = $this->input->post('id');
		$custom = $this->db->get_where('custom_clearance_customers')->row_array();
		$data = [
			'status' => '0',
			'deleted_by' => $this->auth->user_id(),
			'deleted_at' => date('Y-m-d H:i:s'),
		];
		
		$this->db->trans_begin();
		$this->db->update('custom_clearance_customers', $data, ['id' => $id]);
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$return	= array(
				'msg'		=> 'Failed delete data Custom Clearance.  Please try again.',
				'status'	=> 0
			);
			$keterangan     = "FAILD delete data Custom Clearance " . $custom['id'];
			$status         = 1;
			$nm_hak_akses   = $this->deletePermission;
			$kode_universal = $custom['id'];
			$jumlah         = 1;
			$sql            = $this->db->last_query();
		} else {
			$this->db->trans_commit();
			$return	= array(
				'msg'		=> 'Success delete data Custom Clearance.',
				'status'	=> 1
			);
			$keterangan     = "SUCCESS delete data Custom Clearance " . $custom['id'];
			$status         = 1;
			$nm_hak_akses   = $this->deletePermission;
			$kode_universal = $custom['id'];
			$jumlah         = 1;
			$sql            = $this->db->last_query();
		}
		simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
		echo json_encode($return);
	}
}