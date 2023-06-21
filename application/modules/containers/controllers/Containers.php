<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

/*
 * @author Hikmat Aolia
 * @copyright Copyright (c) 2023, Hikmat Aolia
 *
 * This is controller for Master Container
 */

class Containers extends Admin_Controller
{
	//Permission
	protected $viewPermission 	= 'Containers.View';
	protected $addPermission  	= 'Containers.Add';
	protected $managePermission = 'Containers.Manage';
	protected $deletePermission = 'Containers.Delete';

	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('upload', 'Image_lib'));
		$this->load->model(array(
			'Containers/Containers_model',
			'Aktifitas/aktifitas_model',
		));
		$this->template->title('Manage Containers');
		$this->template->page_icon('tx-primary fa-4x fas fa-truck-moving');

		date_default_timezone_set('Asia/Bangkok');
	}

	public function index()
	{
		$this->auth->restrict($this->viewPermission);
		$this->template->render('index');
	}
	public function edit($id)
	{
		$this->auth->restrict($this->viewPermission);
		$session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-edit');
		$inven = $this->db->get_where('department', array('id' => $id))->result();
		$data = [
			'inven' => $inven
		];
		$this->template->set('results', $data);
		$this->template->title('Departement');
		$this->template->render('edit');
	}
	public function view()
	{
		$this->auth->restrict($this->viewPermission);
		$id 	= $this->input->post('id');
		$cust 	= $this->Inventory_1_model->getById($id);
		$this->template->set('result', $cust);
		$this->template->render('view');
	}
	public function saveEditDepartment()
	{
		$this->auth->restrict($this->editPermission);
		$post = $this->input->post();
		$this->db->trans_begin();


		$data = [
			'nm_dept'		        => $post['nm_dept'],
		];

		$this->db->where('id', $post['id'])->update("department", $data);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$status	= array(
				'pesan'		=> 'Gagal Save Item. Thanks ...',
				'status'	=> 0
			);
		} else {
			$this->db->trans_commit();
			$status	= array(
				'pesan'		=> 'Success Save Item. Thanks ...',
				'status'	=> 1
			);
		}

		echo json_encode($status);
	}
	public function add()
	{
		$this->template->render('add');
	}
	public function delet()
	{
		$this->auth->restrict($this->deletePermission);
		$id = $this->input->post('id');
		$this->db->trans_begin();
		$this->db->delete('department', array('id' => $id));

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$status	= array(
				'pesan'		=> 'Gagal Save Item. Thanks ...',
				'status'	=> 0
			);
		} else {
			$this->db->trans_commit();
			$status	= array(
				'pesan'		=> 'Success Save Item. Thanks ...',
				'status'	=> 1
			);
		}

		echo json_encode($status);
	}
	public function save()
	{
		$this->auth->restrict($this->addPermission);
		$post = $this->input->post();
		$this->db->trans_begin();
		$data = [
			'nm_dept'		=> $post['nm_dept'],
		];

		$insert = $this->db->insert("department", $data);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$status	= array(
				'pesan'		=> 'Gagal Save Item. Thanks ...',
				'status'	=> 0
			);
		} else {
			$this->db->trans_commit();
			$status	= array(
				'pesan'		=> 'Success Save Item. Thanks ...',
				'status'	=> 1
			);
		}

		echo json_encode($status);
	}
}
