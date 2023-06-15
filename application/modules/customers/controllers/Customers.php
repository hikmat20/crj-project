<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

/*
 * @author Ichsan
 * @copyright Copyright (c) 2019, Ichsan
 *
 * This is controller for Master Supplier
 */

class Customers extends Admin_Controller
{
	//Permission
	protected $viewPermission 	= 'Customers.View';
	protected $addPermission  	= 'Customers.Add';
	protected $managePermission = 'Customers.Manage';
	protected $deletePermission = 'Customers.Delete';

	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('mpdf', 'upload', 'Image_lib'));
		$this->load->model(array(
			'Customers/Customer_model',
			'Aktifitas/aktifitas_model',
		));
		$this->template->title('Manage Customers');
		$this->template->page_icon('fa fa-building');

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
        FROM customers, (SELECT @row_number:=0) as temp WHERE 1=1 $where  
        AND (customer_name LIKE '%$string%'
        OR telephone LIKE '%$string%'
        OR email LIKE '%$string%'
        OR `address` LIKE '%$string%'
        OR `status` LIKE '%$string%'
            )";

		$totalData = $this->db->query($sql)->num_rows();
		$totalFiltered = $this->db->query($sql)->num_rows();

		$columns_order_by = array(
			0 => 'num',
			1 => 'customer_name',
			2 => 'telephone',
			3 => 'email',
			4 => 'address',
			5 => 'status',
			// 6 => '',
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

			$view 		= '<button type="button" class="btn btn-primary btn-sm view" data-toggle="tooltip" title="View" data-id="' . $row['id_customer'] . '"><i class="fa fa-eye"></i></button>';
			$edit 		= '<button type="button" class="btn btn-success btn-sm edit" data-toggle="tooltip" title="Edit" data-id="' . $row['id_customer'] . '"><i class="fa fa-edit"></i></button>';
			$delete 	= '<button type="button" class="btn btn-danger btn-sm delete" data-toggle="tooltip" title="Delete" data-id="' . $row['id_customer'] . '"><i class="fa fa-trash"></i></button>';
			$buttons 	= $view . "&nbsp;" . $edit . "&nbsp;" . $delete;

			$nestedData   = array();
			$nestedData[]  = "<div class='text-center'>" . $nomor . "</div>";
			$nestedData[]  = "<div class='tx-bold text-dark'>" . $row['customer_name'] . "</div>";
			$nestedData[]  = "<div class=''>" . $row['telephone'] . "</div>";
			$nestedData[]  = "<div class=''>" . $row['email'] . "</div>";
			$nestedData[]  = "<div class=''>" . ($row['address']) . "</div>";
			$nestedData[]  = "<div class=''>" . $status[$row['status']] . "</div>";
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

	public function addCustomer()
	{
		$this->auth->restrict($this->viewPermission);
		$prof = $this->Customer_model->get_data('provinsi');
		$karyawan = $this->db->get_where('ms_karyawan', array('divisi' => 2, 'deleted' => 0))->result();
		$data = [
			'prof' => $prof,
			'karyawan' => $karyawan
		];
		$this->template->set($data);
		$this->template->title('Add Customer');
		$this->template->render('add_customer');
	}

	public function editCustomer($id)
	{
		$this->auth->restrict($this->viewPermission);
		$customer = $this->db->get_where('customers', array('id_customer' => $id))->row();
		$pic = $this->db->get_where('customer_pic', array('id_customer' => $id))->result();
		// $prof = $this->Customer_model->get_data('provinsi');
		// $kota = $this->Customer_model->get_data('kota');
		$karyawan = $this->db->get_where('ms_karyawan', array('deleted' => 0, '', 'divisi' => 2))->result();

		$data = [
			'customer'	=> $customer,
			// 'kota' => $kota,
			// 'prof' => $prof,
			'PIC' => $pic,
			'karyawan' => $karyawan
		];
		$this->template->set($data);
		$this->template->render('add_customer');
	}

	public function saveCustomer()
	{
		$this->auth->restrict($this->addPermission);
		$post = $this->input->post();

		$data = $post;
		$data['id_customer'] 			= $post['id_cust'] ?: $this->Customer_model->generate_id();
		$data['receive_invoice_day'] 	= json_encode($post['receive_invoice_day']) ?: null;
		$data['invoicing_requirement'] 	= json_encode($post['invoicing_requirement']) ?: null;
		$data['down_payment_value'] 	= str_replace(",", "", $post['down_payment_value']);
		$data['remain_payment'] 		= str_replace(",", "", $post['remain_payment']);

		$dataPIC = $post['PIC'];
		unset($data['PIC']);
		unset($data['nominal_dp']);
		unset($data['sisa_pembayaran']);

		$this->db->trans_begin();
		if (isset($post['id_customer']) && $post['id_customer'] == '') {
			$data['created_at'] 			= date('Y-m-d H:i:s');
			$data['created_by'] 			= $this->auth->user_id();
			$this->db->insert('customers', $data);
		} else {
			$data['modified_at'] 			= date('Y-m-d H:i:s');
			$data['modified_by'] 			= $this->auth->user_id();
			$this->db->update('customers', $data, $data['id_customer']);
		}

		$n = 0;
		if ($dataPIC) {
			foreach ($dataPIC as $pic) {
				$n++;
				$dataPic =  array(
					'id_customer'	=> $data['id_customer'],
					'name'			=> $pic['name'],
					'phone_number'	=> $pic['phone_number'],
					'email'			=> $pic['email'],
					'position'		=> $pic['position']
				);

				if (isset($pic['id']) && $pic['id']) {
					$check = $this->db->get_where('customer_pic', ['id' => $pic['id']])->num_rows();
					if ($check > 0) {
						$this->db->update('customer_pic', $pic, ['id' => $pic['id']]);
					}
				} else {
					$this->db->insert('customer_pic', $dataPic);
				}
			}
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$return	= array(
				'msg'		=> 'Failed save data Customer.  Please try again.',
				'status'	=> 0
			);
			$keterangan     = "SUCCESS save data Customer " . $data['id_customer'] . ", Customer name : " . $data['customer_name'];
			$status         = 1;
			$nm_hak_akses   = $this->addPermission;
			$kode_universal = $data['id_customer'];
			$jumlah         = 1;
			$sql            = $this->db->last_query();
		} else {
			$this->db->trans_commit();
			$return	= array(
				'msg'		=> 'Success Save data Customer.',
				'status'	=> 1
			);
			$keterangan     = "SUCCESS save data Customer " . $data['id_customer'] . ", Customer name : " . $data['customer_name'];
			$status         = 1;
			$nm_hak_akses   = $this->addPermission;
			$kode_universal = $data['id_customer'];
			$jumlah         = 1;
			$sql            = $this->db->last_query();
		}
		simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
		echo json_encode($return);
	}

	function deleteCustomer()
	{
		$id = $this->input->post('id');
		$data = $this->db->get_where('customers', ['id_customer' => $id])->row_array();

		$this->db->trans_begin();
		$sql = $this->db->update('customers', ['sstatus' => 'X', 'deleted_at' => date('Y-m-d H:i:s'), 'deleted_by' => $this->auth->user_id()], ['id_customer' => $id]);
		$errMsg = $this->db->error()['message'];
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$keterangan     = "FAILD " . $errMsg;
			$status         = 0;
			$nm_hak_akses   = $this->addPermission;
			$kode_universal = $data['id_customer'];
			$jumlah         = 1;
			$sql            = $this->db->last_query();
			$return	= array(
				'msg'		=> "Failed delete data Customer. Please try again. " . $errMsg,
				'status'	=> 0
			);
		} else {
			$this->db->trans_commit();
			$return	= array(
				'msg'		=> 'Success Save data Customer.',
				'status'	=> 1
			);
			$keterangan     = "SUCCESS save data Customer " . $data['id_customer'] . ", Customer name : " . $data['customer_name'];
			$status         = 1;
			$nm_hak_akses   = $this->addPermission;
			$kode_universal = $data['id_customer'];
			$jumlah         = 1;
			$sql            = $this->db->last_query();
		}
		simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
		echo json_encode($return);
	}


	function getkota()
	{
		$id_prov = $_GET['id_prov'];
		$data = $this->Customer_model->carikota($id_prov);
		echo "<select id='id_kota' name='id_kota' class='form-control input-sm select2'>";
		echo "<option value=''>--Pilih--</option>";
		foreach ($data as $key => $st) :
			echo "<option value='$st->id_prov' set_select('id_kota', $st->id_prov, isset($data->id_prov) && $data->id_prov == $st->id_prov)>$st->nama_kota
                    </option>";
		endforeach;
		echo "</select>";
	}

	public function viewCustomer($id)
	{
		$this->auth->restrict($this->viewPermission);
		$session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-edit');
		$aktif = 'active';
		$cus = $this->db->get_where('master_customers', array('id_customer' => $id))->result();
		$pic = $this->db->get_where('child_customer_pic', array('id_customer' => $id))->result();
		$cate = $this->db->get_where('child_category_customer', array('id_customer' => $id))->result();
		$category = $this->Customer_model->get_data('child_customer_category', 'activation', $aktif);
		$prof = $this->Customer_model->get_data('provinsi');
		$kota = $this->Customer_model->get_data('kota');
		$karyawan = $this->db->get_where('ms_karyawan', array('deleted' => 0, '', 'divisi' => 2))->result();

		$data = [
			'cus'	=> $cus,
			'category' => $category,
			'cate' => $cate,
			'kota' => $kota,
			'prof' => $prof,
			'pic' => $pic,
			'karyawan' => $karyawan
		];
		$this->template->set('results', $data);
		$this->template->title('View Customer');
		$this->template->render('view_customer');
	}
}
