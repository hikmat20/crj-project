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

class Spk_produksi extends Admin_Controller
{
    //Permission
    protected $viewPermission 	= 'Spk_produksi.View';
    protected $addPermission  	= 'Spk_produksi.Add';
    protected $managePermission = 'Spk_produksi.Manage';
    protected $deletePermission = 'Spk_produksi.Delete';

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('Mpdf', 'upload', 'Image_lib'));
        $this->load->model(array('Spk_produksi/Inventory_4_model',
                                 'Aktifitas/aktifitas_model',
                                ));
        $this->template->title('Manage Data Supplier');
        $this->template->page_icon('fa fa-building-o');

        date_default_timezone_set('Asia/Bangkok');


    }
    public function index()
    {
       $this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-users');
        $data = $this->Inventory_4_model->CariSPK();
        $this->template->set('results', $data);
        $this->template->title('SPK Produksi');
        $this->template->render('index');
    }

		public function addHeader()
    {
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');
		$aktif = 'active';
		$deleted = '0';
		$penawaran = $this->Inventory_4_model->get_data('tr_penawaran');
		$stock = $this->Inventory_4_model->get_data('stock_material');
		$karyawan = $this->Inventory_4_model->get_data('ms_karyawan','deleted',$deleted);
		$material = $this->Inventory_4_model->get_data_category3();
		$mata_uang = $this->Inventory_4_model->get_data('mata_uang','deleted',$deleted);
		$data = [
			'penawaran' => $penawaran,
			'stock' => $stock,
			'karyawan' => $karyawan,
			'material' => $material,
			'mata_uang' => $mata_uang,
		];
        $this->template->set('results', $data);
        $this->template->title('Add Penawaran');
        $this->template->render('AddHeader');

    }
	public function PrintHeader1($id){
        $this->auth->restrict($this->managePermission);
        $id = $this->uri->segment(3);
		$data['header']  = $this->Inventory_4_model->get_data('tr_spk_produksi','id_spkproduksi',$id);
		$data['detail'] = $this->Inventory_4_model->get_data('dt_spk_produksi','id_spkproduksi',$id);
		$this->load->view('PrintHeader',$data);
	}
	public function PrintHeader(){
		ob_clean();
		ob_start();
        $this->auth->restrict($this->managePermission);
        $id = $this->uri->segment(3);
		$data['header']  = $this->Inventory_4_model->get_data('tr_spk_produksi','id_spkproduksi',$id);
		$data['detail'] = $this->Inventory_4_model->get_data('dt_spk_produksi','id_spkproduksi',$id);
		$this->template->title('Data');
		$this->load->view('PrintHeader1',$data);
		$html = ob_get_contents();
		require_once('./assets/html2pdf/html2pdf/html2pdf.class.php');
		$html2pdf = new HTML2PDF('L','A4','en',true,'UTF-8',array(0, 0, 0, 0));
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($html);
		ob_end_clean();
		$html2pdf->Output('Cetak.pdf', 'I');
	}
	public function PrintHeader2(){
		ob_clean();
		ob_start();
        $this->auth->restrict($this->managePermission);
		$id = $this->uri->segment(3);
		$data['header']  = $this->Inventory_4_model->get_data('tr_spk_produksi','id_spkproduksi',$id);
		$data['detail'] = $this->Inventory_4_model->get_data('dt_spk_produksi','id_spkproduksi',$id);
		$this->template->title('Data');
		$this->load->view('PrintHeader2',$data);
		$html = ob_get_contents();
		require_once('./assets/html2pdf/html2pdf/html2pdf.class.php');
		$html2pdf = new HTML2PDF('P','A4','en',true,'UTF-8',array(0, 0, 0, 0));
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($html);
		ob_end_clean();
		$html2pdf->Output('Cetak.pdf', 'I');
	}
			public function EditHeader()
    {
		$id = $this->uri->segment(3);
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');
		$aktif = 'active';
		$deleted = '0';
		$tr_spk = $this->Inventory_4_model->get_data('tr_spk_produksi','id_spkproduksi',$id);
		$dt_spk = $this->Inventory_4_model->get_data('dt_spk_produksi','id_spkproduksi',$id);
		$penawaran = $this->Inventory_4_model->get_data('tr_penawaran');
		$stock = $this->Inventory_4_model->get_data('stock_material');
		$karyawan = $this->Inventory_4_model->get_data('ms_karyawan','deleted',$deleted);
		$material = $this->Inventory_4_model->get_data_category3();
		$mata_uang = $this->Inventory_4_model->get_data('mata_uang','deleted',$deleted);
		$data = [
			'tr_spk'	=> $tr_spk,
			'dt_spk'	=> $dt_spk,
			'penawaran' => $penawaran,
			'stock' => $stock,
			'karyawan' => $karyawan,
			'material' => $material,
			'mata_uang' => $mata_uang,
		];
        $this->template->set('results', $data);
        $this->template->title('Edit SPK Prouksi');
        $this->template->render('EditHeader');

    }

	    public function detail()
    {
		$id = $this->uri->segment(3);
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-users');
		$deleted = '0';
        $detail = $this->Inventory_4_model->getpenawaran($id);
		$header = $this->Inventory_4_model->getHeaderPenawaran($id);
		$data = [
			'detail' => $detail,
			'header' => $header
		];
        $this->template->set('results', $data);
        $this->template->title('Penawaran');
        $this->template->render('detail');
    }

		public function editPenawaran($id)
    {
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');
		$penawaran = $this->Inventory_4_model->get_data('child_penawaran','id_child_penawaran',$id);
		$inventory_3 = $this->Inventory_4_model->get_data_category();
		$data = [
			'penawaran' => $penawaran,
			'inventory_3' => $inventory_3,
		];
        $this->template->set('results', $data);
        $this->template->title('Edit Penawaran');
        $this->template->render('editPenawaran');

    }



			public function ViewHeader($id)
    {
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');
		$aktif = 'active';
		$deleted = '0';
		$tr_spk = $this->Inventory_4_model->get_data('tr_spk_produksi','id_spkproduksi',$id);
		$dt_spk = $this->Inventory_4_model->get_data('dt_spk_produksi','id_spkproduksi',$id);
		$penawaran = $this->Inventory_4_model->get_data('tr_penawaran');
		$stock = $this->Inventory_4_model->get_data('stock_material');
		$karyawan = $this->Inventory_4_model->get_data('ms_karyawan','deleted',$deleted);
		$material = $this->Inventory_4_model->get_data_category3();
		$mata_uang = $this->Inventory_4_model->get_data('mata_uang','deleted',$deleted);
		$data = [
			'tr_spk'	=> $tr_spk,
			'dt_spk'	=> $dt_spk,
			'penawaran' => $penawaran,
			'stock' => $stock,
			'karyawan' => $karyawan,
			'material' => $material,
			'mata_uang' => $mata_uang,
		];
        $this->template->set('results', $data);
        $this->template->title('Edit SPK Prouksi');
        $this->template->render('ViewHeader');

    }

			public function viewPenawaran($id)
    {
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');
		$penawaran = $this->Inventory_4_model->get_data('child_penawaran','id_child_penawaran',$id);
		$inventory_3 = $this->Inventory_4_model->get_data_category();
		$data = [
			'penawaran' => $penawaran,
			'inventory_3' => $inventory_3,
		];
        $this->template->set('results', $data);
        $this->template->title('Edit Penawaran');
        $this->template->render('viewPenawaran');

    }
	public function copyInventory($id)
    {
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');
		$deleted = '0';
		$inven = $this->Inventory_4_model->getedit($id);
		$komposisiold = $this->Inventory_4_model->get_data('child_inven_compotition','id_category3',$id);
		$komposisi = $this->Inventory_4_model->kompos($id);
		$dimensiold = $this->Inventory_4_model->get_data('child_inven_dimensi','id_category3',$id);
		$dimensi = $this->Inventory_4_model->dimensy($id);
		$supl = $this->Inventory_4_model->supl($id);
		$inventory_1 = $this->Inventory_4_model->get_data('ms_inventory_type','deleted',$deleted);
		$inventory_2 = $this->Inventory_4_model->get_data('ms_inventory_category1','deleted',$deleted);
		$inventory_3 = $this->Inventory_4_model->get_data('ms_inventory_category2','deleted',$deleted);
		$maker = $this->Inventory_4_model->get_data('negara');
		$id_bentuk = $this->Inventory_4_model->get_data('ms_bentuk');
		$id_supplier = $this->Inventory_4_model->get_data('master_supplier');
		$id_surface = $this->Inventory_4_model->get_data('ms_surface');
		$dt_suplier = $this->Inventory_4_model->get_data('child_inven_suplier','id_category3',$id);
		$data = [
			'inventory_1' => $inventory_1,
			'inventory_2' => $inventory_2,
			'inventory_3' => $inventory_3,
			'komposisi' => $komposisi,
			'dimensi' => $dimensi,
			'id_bentuk' => $id_bentuk,
			'inven' => $inven,
			'maker' => $maker,
			'supl' => $supl,
			'id_surface' => $id_surface,
			'id_supplier' => $id_supplier,
			'dt_suplier' => $dt_suplier
		];
        $this->template->set('results', $data);
        $this->template->title('Add Inventory');
        $this->template->render('copy_inventory');

    }
	public function viewInventory($id)
    {
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');
		$deleted = '0';
		$inven = $this->Inventory_4_model->getedit($id);
		$komposisiold = $this->Inventory_4_model->get_data('child_inven_compotition','id_category3',$id);
		$komposisi = $this->Inventory_4_model->kompos($id);
		$dimensiold = $this->Inventory_4_model->get_data('child_inven_dimensi','id_category3',$id);
		$dimensi = $this->Inventory_4_model->dimensy($id);
		$supl = $this->Inventory_4_model->supl($id);
		$inventory_1 = $this->Inventory_4_model->get_data('ms_inventory_type','deleted',$deleted);
		$inventory_2 = $this->Inventory_4_model->get_data('ms_inventory_category1','deleted',$deleted);
		$inventory_3 = $this->Inventory_4_model->get_data('ms_inventory_category2','deleted',$deleted);
		$maker = $this->Inventory_4_model->get_data('negara');
		$id_bentuk = $this->Inventory_4_model->get_data('ms_bentuk');
		$id_supplier = $this->Inventory_4_model->get_data('master_supplier');
		$id_surface = $this->Inventory_4_model->get_data('ms_surface');
		$dt_suplier = $this->Inventory_4_model->get_data('child_inven_suplier','id_category3',$id);
		$data = [
			'inventory_1' => $inventory_1,
			'inventory_2' => $inventory_2,
			'inventory_3' => $inventory_3,
			'komposisi' => $komposisi,
			'dimensi' => $dimensi,
			'id_bentuk' => $id_bentuk,
			'inven' => $inven,
			'maker' => $maker,
			'supl' => $supl,
			'id_surface' => $id_surface,
			'id_supplier' => $id_supplier,
			'dt_suplier' => $dt_suplier
		];
        $this->template->set('results', $data);
        $this->template->title('Add Inventory');
        $this->template->render('view_inventory');

    }
	public function viewBentuk($id){
		$this->auth->restrict($this->viewPermission);
		$id 	= $this->input->post('id');
		$bentuk = $this->db->get_where('ms_bentuk',array('id_bentuk' => $id))->result();
		$dimensi = $this->Bentuk_model->getDimensi($id);
		$data = [
			'bentuk' => $bentuk,
			'dimensi' => $dimensi,
		];
        $this->template->set('results', $data);
		$this->template->render('view_bentuk');
	}


	public function addPenawaran($id)
    {
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');
		$headpenawaran = $this->Inventory_4_model->get_data('tr_penawaran','no_penawaran',$id);
		$inventory_3 = $this->Inventory_4_model->get_data_category();
		$data = [
			'inventory_3' => $inventory_3,
			'headpenawaran' => $headpenawaran
		];
        $this->template->set('results', $data);
        $this->template->title('Add Penawaran');
        $this->template->render('AddPenawaran');

    }


function cari_pricelist()
    {
        $id_category3=$_GET['id_category3'];
		$mata_uang=$_GET['mata_uang'];
		$kurs	= $this->db->query("SELECT * FROM mata_uang WHERE kode = '$mata_uang' ")->result();
		$mu = $kurs[0]->kurs;
		$kategory3	= $this->db->query("SELECT * FROM ms_inventory_category3 WHERE id_category3 = '$id_category3' ")->result();
		$inven1 = $kategory3[0]->id_category1;
		if($inven1 == "I2000001"){
			$plquery	= $this->db->query("SELECT * FROM ms_pricelistfr WHERE id_category3 = '$id_category3' ")->result();
			if(empty($plquery)){
				echo "<div class='col-sm-12' align='center'>
					<label  for='forecast'>PRICELIST</label>
					</div>
					<div class='col-sm-12' align='center'>
					<div class='form-group row'>
					<table class='col-sm-12'>
					<tr>
						<th><center>Book Price<c/enter></th>
					</tr>
					<tr>
						<td><center>
						Price List Untuk Material Ini Belum Terinput
						</center></td>
					</tr>
					</table>
					</div>
					</div>";
			}else{
		$bottom_price = $plquery[0]->bottom_price;
			echo "	<div class='col-sm-12' align='center'>
					<label  for='forecast'>PRICELIST</label>
					</div>
					<div class='col-sm-12' align='center'>
					<div class='form-group row'>
					<table class='col-sm-12'>
					<tr>
						<th><center>Book Price<c/enter></th>
					</tr>
					<tr>
						<td><center>Rp. $bottom_price  ,-</center></td>
					</tr>
					</table>
					</div>
					</div>
					";};
		} elseif ($inven1 == "I2000002") {

			$plquery	= $this->db->query("SELECT * FROM ms_pricelistnfr WHERE id_category3 = '$id_category3' ")->result();
			if(empty($plquery)){
				echo "<div class='col-sm-12' align='center'>
					<label  for='forecast'>PRICELIST</label>
					</div>
					<div class='col-sm-12' align='center'>
					<div class='form-group row'>
					<table class='col-sm-12'>
					<tr>
						<th><center>Book Price<c/enter></th>
						<th><center>LME 10 Hari</center></th>
						<th><center>LME 30 Hari</center></th>
						<th><center>LME SPOT</center></th>
					</tr>
					<tr>
						<td colspan='4'><center>
						Price List Untuk Material Ini Belum Terinput
						</center></td>
					</tr>
					</table>
					</div>
					</div>";
			}else{
		$bottom_price = number_format($plquery[0]->bottom_price*$mu,2);
		$bottom_price10 = number_format($plquery[0]->bottom_price10*$mu,2);
		$bottom_price30 = number_format($plquery[0]->bottom_price30*$mu,2);
		$bottom_pricespot = number_format($plquery[0]->bottom_pricespot*$mu,2);
			echo "	<div class='col-sm-12' align='center'>
					<label  for='forecast'>PRICELIST</label>
					</div>
					<div class='col-sm-12' align='center'>
					<div class='form-group row'>
					<table class='col-sm-12'>
					<tr>
						<th><center>Book Price<c/enter></th>
						<th><center>LME 10 Hari</center></th>
						<th><center>LME 30 Hari</center></th>
						<th><center>LME SPOT</center></th>
					</tr>
					<tr>
						<td><center>Rp. $bottom_price  ,-</center></td>
						<td><center>Rp. $bottom_price10  ,-</center></td>
						<td><center>Rp. $bottom_price30  ,-</center></td>
						<td><center>Rp. $bottom_pricespot  ,-</center></td>
					</tr>
					</table>
					</div>
					</div>
					";};
		};

	}
function cari_bentuk()
    {
        $id_category3=$_GET['id_category3'];
		$kategory3	= $this->db->query("SELECT * FROM ms_inventory_category3 WHERE id_category3 = '$id_category3' ")->result();
		$id_bentuk = $kategory3[0]->id_bentuk;
		$bentukquery	= $this->db->query("SELECT * FROM ms_bentuk WHERE id_bentuk = '$id_bentuk' ")->result();
		$bentuk_material = $bentukquery[0]->nm_bentuk;
		echo "<div class='col-md-4'>
				<label for='customer'>Bentuk</label>
			  </div>
			  <div class='col-md-8'>
				<input type='text' class='form-control' readonly value='$bentuk_material' id='bentuk_material'  required name='bentuk_material' placeholder='Bentuk Material'>
			  </div>
			  <div class='col-md-8' hidden>
				<input type='text' class='form-control' readonly value='$id_bentuk' id='id_bentuk'  required name='id_bentuk' placeholder='Bentuk Material'>
			  </div>";
	}
function GetProduk()
    {
        $id_customer=$_GET['id_customer'];
		$dt1	= $this->db->query("SELECT * FROM tr_inquiry WHERE id_customer = '$id_customer' ")->result();
		$id_crcl = $dt1[0]->no_inquiry;
		$link = base_url('/transaksi_inquiry/');
		if(!empty($dt1)){
		$material = $this->Inventory_4_model->CariMaterial($id_crcl);
		echo "<select id='id_produk' name='id_produk' class='form-control select' onchange='get_properties()'  required>
						<option value=''>--Pilih Material--</option>";
				foreach($material as $material){
					echo"<option value='$material->id_dt_inquery'>$material->nama2-$material->nama3-$material->hardness</option>";
				}
		echo "</select>";}else{
			echo"<a class='btn btn-danger btn-sm' href='$link' title='CRCL'></i>CRCL Cusromer Ini Belum Dibuat Klik DIsini Untuk Membuat CRCL</i></a>";
		};
	}
	
function FindingStock()
    {
        $id_material=$_GET['id_material'];
		$stok	= $this->db->query("SELECT * FROM stock_material WHERE id_category3 = '$id_material' AND id_gudang='1' ")->result();
		echo "<select id='id_stock' name='id_stock' class='form-control input-md chosen-select' onchange='get_produk()' required>
						<option value=''>--Pilih--</option>";
				foreach($stok as $stok){
					echo"<option value='$stok->id_stock'>$stok->lotno</option>";
				}
					echo"</select>";
	}

function GetMaterial()
    {
        $id_produk=$_GET['id_produk'];
		$dt1	= $this->db->query("SELECT * FROM dt_inquery_transaksi WHERE id_dt_inquery = '$id_produk' ")->result();
		$id_crcl = $dt1[0]->id_category3;
		$nm	= $this->db->query("SELECT * FROM ms_inventory_category3 WHERE id_category3 = '$id_crcl' ")->result();
		$nama = $nm[0]->nama;
		echo "<input type='text' class='form-control' value='$nama' readonly id='material' required name='material'>";
	}
function GetCustomer()
    {
        $no_penawaran=$_GET['no_penawaran'];
		$dt1	= $this->db->query("SELECT * FROM tr_penawaran WHERE no_penawaran = '$no_penawaran' ")->result();
		$id_customer = $dt1[0]->id_customer;
		$nm	= $this->db->query("SELECT * FROM master_customers WHERE id_customer = '$id_customer' ")->result();
		$nama = $nm[0]->name_customer;
		echo "<div class='col-md-4'><label for='customer'>Customer</label></div>
			<div class='col-md-8'><input type='text' value='$nama' class='form-control' id='nama_customer' required name='nama_customer' readonly ></div>
			<div class='col-md-8' hidden><input type='text' value='$id_customer' class='form-control' id='id_customer' required name='id_customer' readonly ></div>";
	}
function GetPenawaran()
    {
        $no_penawaran=$_GET['no_penawaran'];
		$dt1	= $this->db->query("SELECT * FROM tr_penawaran WHERE no_penawaran = '$no_penawaran' ")->result();
		$id_customer = $dt1[0]->id_customer;
		$nm	= $this->db->query("SELECT * FROM master_customers WHERE id_customer = '$id_customer' ")->result();
		$nama = $nm[0]->name_customer;
		$dt	= $this->db->query("SELECT a.*, b.nama as nama3, b.hardness as hard FROM child_penawaran as a inner join ms_inventory_category3 as b on a.id_category3 = b.id_category3 WHERE no_penawaran = '$no_penawaran'  ")->result();
		$cr	= $this->db->query("SELECT * FROM tr_inquiry WHERE id_customer = '$id_customer' ")->result();
		$idcr = $cr[0]->no_inquiry;
		$loop=0; foreach($dt AS $dt){
		$loop++;
		$id_category3=$dt->id_category3;
		$crcl	= $this->db->query("SELECT * FROM dt_inquery_transaksi WHERE no_inquery = '$idcr' AND id_category3='$id_category3' ")->result();	
		echo "
		<tr id='tabel_penawaran_$loop'>
			<th hidden><input type='text' class='form-control' value='$dt->id_child_penawaran' readonly id='dp_id_child_penawaran_$loop' required name='dp[$loop][id_child_penawaran]'></th>
			<th hidden><input type='text' class='form-control' value='$dt->id_category3' readonly id='dp_idmaterial_$loop' required name='dp[$loop][idmaterial]'></th>
			<th><input type='text' class='form-control' value='$dt->nama3-$dt->hard' readonly id='dp_noalloy_$loop' required name='dp[$loop][noalloy]'></th>
			<th><input type='text' class='form-control' value='$dt->thickness' readonly id='dp_thickness_$loop' required name='dp[$loop][thickness]'></th>
			<th><input type='text' class='form-control' value='$dt->width' readonly id='dp_width_$loop' required name='dp[$loop][width]'></th>
			<th><input type='text' class='form-control' value='$dt->harga_penawaran' readonly id='dp_hgpenwaran_$loop' required name='dp[$loop][hgpenaaran]'></th>
			<th><input type='text' class='form-control' onkeyup='return AksiDetail($loop);' id='dp_hgdeal_$loop' required name='dp[$loop][hgdeal]'></th>
			<th><input type='text' class='form-control' onkeyup='return AksiDetail($loop);' id='dp_qty_$loop' required name='dp[$loop][qty]'></th>
			<th><input type='text' class='form-control' onkeyup='return AksiDetail($loop);'id='dp_weight_$loop' required name='dp[$loop][weight]'></th>
			<th id='total_weight_$loop'><input type='text' class='form-control' value='$jcc' readonly id='dp_twight_$loop' required name='dp[$loop][twight]'></th>
			<th id='total_harga_$loop'><input type='text' class='form-control' value='$sp' readonly id='dp_tharga_$loop' required name='dp[$loop][tharga]'></th>
			<th><input type='date' class='form-control'   id='dp_ddate_$loop' data-role='qtip' required name='dp[$loop][ddate]'></th>
			<th><select id='dp_crcl_$loop' name='dp[$loop][crcl]' class='form-control select' required>
						<option value=''>--Pilih--</option>";
						foreach($crcl AS $crcl){
						echo"<option value='$crcl->id_dt_inquery'>$crcl->id_dt_inquery</option>";
						}
		echo"</select></th>
			<th><input type='checkbox' value='1' id='dp_deal_$loop' required name='dp[$loop][deal]'></th>
		</tr>
		";
		};
	}
function GetThickness()
    {
        $id_produk=$_GET['id_produk'];
		$dt1	= $this->db->query("SELECT * FROM dt_inquery_transaksi WHERE id_dt_inquery = '$id_produk' ")->result();
		$id_crcl = $dt1[0]->thickness;
		echo "<input type='text' class='form-control' value='$id_crcl' readonly id='thickness' required name='thickness'>";
	}
function GetDensity()
    {
        $id_produk=$_GET['id_produk'];
		$dt1	= $this->db->query("SELECT * FROM dt_inquery_transaksi WHERE id_dt_inquery = '$id_produk' ")->result();
		$density = $dt1[0]->density;
		echo "<input type='text' class='form-control' value='$density' readonly id='density' required name='density'>";
	}
function GetSurface()
    {
        $id_produk=$_GET['id_produk'];
		$dt1	= $this->db->query("SELECT * FROM dt_inquery_transaksi WHERE id_dt_inquery = '$id_produk' ")->result();
		$id_crcl = $dt1[0]->id_category3;
		$nm	= $this->db->query("SELECT * FROM ms_inventory_category3 WHERE id_category3 = '$id_crcl' ")->result();
		$nama = $nm[0]->id_surface;
		$id_surface	= $this->db->query("SELECT * FROM ms_surface WHERE id_surface = '$nama' ")->result();
		$isi_surface = $id_surface[0]->nm_surface;
		echo "<input type='text' class='form-control' value='$isi_surface' readonly id='surface' required name='surface'>";
	}
function totalw()
    {
        $hgdeal=$_GET['hgdeal'];
		$weight=$_GET['weight'];
		$qty=$_GET['qty'];
		$id=$_GET['id'];
		$twight = $weight*$qty;
		echo "<input type='text' class='form-control' value='$twight' readonly id='dp_twight_$id' required name='dp[$id][twight]'>";
	}
function totalhg()
    {
		$hgdeal=$_GET['hgdeal'];
		$weight=$_GET['weight'];
        $qty=$_GET['qty'];
		$id=$_GET['id'];
		$twight = $weight*$qty;
		$thg = $twight * $hgdeal;
		echo "<input type='text' class='form-control' value='$thg' readonly id='dp_tharga_$id' required name='dp[$id][tharga]'>";
	}
function HitungPisau()
    {
        $qty=$_GET['qty'];
		$id=$_GET['id'];
		$quantity = $qty+1;
		$pisau=$quantity*2;
		echo "<input type='text' class='form-control' readonly value='$pisau' id='stok_jmlpisau_$id' required name='stok[$id][jmlpisau]'>";
	}
function GetPotongan()
    {
        $id_produk=$_GET['id_produk'];
		$dt1	= $this->db->query("SELECT * FROM dt_inquery_transaksi WHERE id_dt_inquery = '$id_produk' ")->result();
		$id_crcl = $dt1[0]->thickness;
		if($id_crcl > 0.2){
			$potongan='1';
		}else{
			$potongan='2';
		};
		echo "<input type='text' class='form-control' value='$potongan' readonly id='potongan_pinggir' required name='potongan_pinggir'>";
	}
function HitungTPanjang()
    {
        $hasilpanjang=$_GET['hasilpanjang'];
		$total_panjang=$_GET['total_panjang'];
		$hasil = $total_panjang+$hasilpanjang;
		echo "<input type='number' class='form-control' value='$hasil' id='total_panjang' readonly required name='total_panjang' >";
	}
function HitungJPisau()
    {
        $jml_pisau=$_GET['jml_pisau'];
		$jumlahpisau=$_GET['jumlahpisau'];
		$hasil = $jml_pisau+$jumlahpisau;
		echo "<input type='number' class='form-control' value='$hasil' id='jml_pisau' readonly required name='jml_pisau' >";
	}
function HitungJMother()
    {
        $jml_mother=$_GET['jml_mother'];
		$hasil = $jml_mother+1;
		echo "<input type='number' class='form-control' value='$hasil' id='jml_mother' readonly required name='jml_mother' >";
	}
function HitungTBerat()
    {
         $hasilpanjang=$_GET['hasilpanjang'];
		$total_panjang=$_GET['total_panjang'];
		$thickness=$_GET['thickness'];
		$lebarcc=$_GET['lebarcc'];
		$density=$_GET['density'];
		$hpanjang = $total_panjang+$hasilpanjang;
		$hasil= $hpanjang*$density*$lebarcc*$thickness;
		echo "<input type='number' value='$hasil' class='form-control' id='total_berat' readonly required name='total_berat' >";
	}
function GetSpk()
    {
		$loop=$_GET['jumlah']+1;
		$thickness = $_GET['thickness'];
		$nama_material = $_GET['nama_material'];
		$deleted='0';
		$approve='1';
		$id_material=$_GET['id_material'];
		$customers = $this->Inventory_4_model->get_data('master_customers','deleted',$deleted);
		$nosurat = $this->db->query("SELECT a.*, b.no_surat as no_surat FROM dt_spkmarketing as a INNER JOIN tr_spk_marketing as b ON a.id_spkmarketing = b.id_spkmarketing WHERE a.id_material='$id_material' AND a.deal='1' AND b.status_approve = '1' ")->result();
		
		echo "
		<tr id='tr_$loop'>
			<th>$loop</th>
			<th><select id='used_no_surat_$loop' name='dt[$loop][no_surat]' onchange='CariDetail($loop)' class='form-control' required>
			<option value=''>-Pilih-<option>
			<option value='nonspk'>-Non SPK-<option>";
			foreach($nosurat as $nosurat){
			echo"<option value='$nosurat->id_dt_spkmarketing'>$nosurat->no_surat</option>";
			}
		echo"</select></th>
			<th id='idcust_$loop' hidden><input type='text' class='form-control' readonly id='used_idcustomer_$loop' required name='dt[$loop][idcustomer]'></th>
			<th id='nmcust_$loop'><input type='text' class='form-control' readonly id='used_namacustomer_$loop' required name='dt[$loop][namacustomer]'></th>
			<th><input type='text' class='form-control' value='$nama_material'  readonly id='used_nmmaterial_$loop' required name='dt[$loop][nmmaterial]'></th>
			<th><input type='text' class='form-control' value='$thickness' readonly id='used_thickness_$loop' required name='dt[$loop][thickness]'></th>
			<th id='weight_$loop'><input type='text' class='form-control'   	id='used_weight_$loop' required name='dt[$loop][weight]'></th>
			<th id='qtyproduk_$loop'><input type='text' class='form-control'  	id='used_qtycoil_$loop' onkeyup='HitungTotalCoil($loop)' required name='dt[$loop][qtycoil]'></th>
			<th id='width_$loop'><input type='text' class='form-control'   	id='used_width_$loop' onkeyup='HitungTotalCoil($loop)' required name='dt[$loop][width]'></th>
			<th id='twidth_$loop'><input type='text' class='form-control'  id='used_totalwidth_$loop' required name='dt[$loop][totalwidth]'></th>
			<th id='delivery_$loop'><input type='date' class='form-control'   id='used_delivery_$loop' required name='dt[$loop][delivery]'></th>
			<th><button type='button' class='btn btn-sm btn-success' title='Ambil' id='tambah_$loop' data-role='qtip' onClick='return TambahItem($loop);'><i class='fa fa-check'></i></button>
			<button type='button' class='btn btn-sm btn-danger' title='Hapus Data' data-role='qtip' onClick='return HapusItem($loop);'><i class='fa fa-close'></i></button></th>
			
		</tr>
		";
	}
function LockSpk()
    {
		$loop=$_GET['id'];
		$idcustomer=$_GET['idcustomer'];
		$dtno_surat=$_GET['dtno_surat'];
		$nmmaterial=$_GET['nmmaterial'];
		$namacustomer=$_GET['namacustomer'];
		$thickness=$_GET['thickness'];
		$weight=$_GET['weight'];
		$width=$_GET['width'];
		$id_material=$_GET['id_material'];
		$qtycoil=$_GET['qtycoil'];
		$totalwidth=$_GET['totalwidth'];
		$delivery=$_GET['delivery'];
		$nosurat = $this->db->query("SELECT a.*, b.no_surat as no_surat FROM dt_spkmarketing as a INNER JOIN tr_spk_marketing as b ON a.id_spkmarketing = b.id_spkmarketing WHERE a.id_material='$id_material' ")->result();
		echo "
			<th>$loop</th>
			<th><select id='used_no_surat_$loop' name='dt[$loop][no_surat]' readonly onchange='CariDetail($loop)' class='form-control' required>
			<option valu=''>-Pilih-<option>";
			foreach($nosurat as $nosurat){
				$select = $dtno_surat == $nosurat->id_dt_spkmarketing ? 'selected' : '';
			echo"<option value='$nosurat->id_dt_spkmarketing' $select>$nosurat->no_surat</option>";
			}
		echo"</select></th>
			<th hidden><input type='text' class='form-control' 	value='$idcustomer' 	readonly id='used_idcustomer_$loop' required name='dt[$loop][idcustomer]'></th>
			<th><input type='text' class='form-control'  	   	value='$namacustomer' 	readonly id='used_namacustomer_$loop' required name='dt[$loop][namacustomer]'></th>
			<th><input type='text' class='form-control' 		value='$nmmaterial'  	readonly id='used_nmmaterial_$loop' required name='dt[$loop][nmmaterial]'></th>
			<th><input type='text' class='form-control' 		value='$thickness' 		readonly id='used_thickness_$loop' required name='dt[$loop][thickness]'></th>
			<th><input type='text' class='form-control'   		value='$weight' 		readonly id='used_weight_$loop' required name='dt[$loop][weight]'></th>
			<th><input type='text' class='form-control'  		value='$qtycoil' 		readonly id='used_qtycoil_$loop' onkeyup='HitungTotalCoil($loop)' required name='dt[$loop][qtycoil]'></th>
			<th><input type='text' class='form-control'   		value='$width' 			readonly id='used_width_$loop' onkeyup='HitungTotalCoil($loop)' required name='dt[$loop][width]'></th>
			<th><input type='text' class='form-control'  		value='$totalwidth' 	readonly id='used_totalwidth_$loop' required name='dt[$loop][totalwidth]'></th>
			<th><input type='date' class='form-control'   		value='$delivery' 		readonly id='used_delivery_$loop' required name='dt[$loop][delivery]'></th>
			<th><button type='button' class='btn btn-sm btn-danger' title='Hapus Data' data-role='qtip' onClick='return CancelItem($loop);'><i class='fa fa-close'></i></button></th>
		";
	}
function HitungTotalWidth()
    {
        $qtycoil=$_GET['qtycoil'];
		$width=$_GET['width'];
		$loop=$_GET['id'];
		$totalwidth=$qtycoil*$width;
		echo "<input type='text' class='form-control' value='$totalwidth' id='used_totalwidth_$loop' required name='dt[$loop][totalwidth]'>";
	}
function GetMaterialName()
    {
        $id_stock=$_GET['id_stock'];
		$dbstock	= $this->db->query("SELECT * FROM stock_material WHERE id_stock = '$id_stock' ")->result();
		$nama_material = $dbstock[0]->nama_material;
		$lotno = $dbstock[0]->lotno;
		echo "<div class='col-md-4'>
				<label for='customer'>Nama Material</label>
			</div>
			<div class='col-md-8'>
				<input type='text' class='form-control' value='$nama_material' id='nama_material'  required name='nama_material' readonly >
			</div>
			<div class='col-md-8' hidden>
				<input type='text' class='form-control' value='$lotno' id='lotno'  required name='lotno' readonly >
			</div>";
	}
function GetMaterialThickness()
    {
        $id_stock=$_GET['id_stock'];
		$dbstock	= $this->db->query("SELECT * FROM stock_material WHERE id_stock = '$id_stock' ")->result();
		$thickness = $dbstock[0]->thickness;
		echo "<input type='number' value='$thickness' class='form-control' id='thickness'  required name='thickness' readonly >";
	}
function CariIdCustomer()
    {
        $loop=$_GET['id'];
		$id_marketing=$_GET['id_marketing'];
		$dbstocking	= $this->db->query("SELECT * FROM dt_spkmarketing WHERE id_dt_spkmarketing = '$id_marketing' ")->result();
		$id_tr= $dbstocking[0]->id_spkmarketing;
		$dbstock	= $this->db->query("SELECT * FROM tr_spk_marketing WHERE id_spkmarketing = '$id_tr' ")->result();
		$id_customerr = $dbstock[0]->id_customer;
		echo "<input type='text' class='form-control' value='$id_customerr'  readonly id='used_idcustomer_$loop' required name='dt[$loop][idcustomer]'>";
	}
function CariW1material()
    {
        $loop=$_GET['id'];
		$id_marketing=$_GET['id_marketing'];
		$dbstocking	= $this->db->query("SELECT * FROM dt_spkmarketing WHERE id_dt_spkmarketing = '$id_marketing' ")->result();
		$id_customerr = $dbstocking[0]->width;
		echo "<input type='text' class='form-control'  value='$id_customerr'  readonly	id='used_weight_$loop' required name='dt[$loop][weight]'>";
	}
function CariW2material()
    {
        $loop=$_GET['id'];
		$id_marketing=$_GET['id_marketing'];
		$dbstocking	= $this->db->query("SELECT * FROM dt_spkmarketing WHERE id_dt_spkmarketing = '$id_marketing' ")->result();
		$id_customerr = $dbstocking[0]->weight;
		echo "<input type='text' class='form-control'  value='$id_customerr'  readonly	id='used_width_$loop' required name='dt[$loop][width]'>";
	}
function CariTW2material()
    {
        $loop=$_GET['id'];
		$id_marketing=$_GET['id_marketing'];
		$dbstocking	= $this->db->query("SELECT * FROM dt_spkmarketing WHERE id_dt_spkmarketing = '$id_marketing' ")->result();
		$id_customerr = $dbstocking[0]->total_weight;
		echo "<input type='text' class='form-control'  value='$id_customerr'  id='used_totalwidth_$loop' required name='dt[$loop][totalwidth]'>";
	}
function CariDelivermaterial()
    {
        $loop=$_GET['id'];
		$id_marketing=$_GET['id_marketing'];
		$dbstocking	= $this->db->query("SELECT * FROM dt_spkmarketing WHERE id_dt_spkmarketing = '$id_marketing' ")->result();
		$id_customerr = $dbstocking[0]->delivery;
		echo "<input type='date' class='form-control' value='$id_customerr'   id='used_delivery_$loop' required name='dt[$loop][delivery]'>";
	}
function CariQrollmaterial()
    {
        $loop=$_GET['id'];
		$id_marketing=$_GET['id_marketing'];
		$dbstocking	= $this->db->query("SELECT * FROM dt_spkmarketing WHERE id_dt_spkmarketing = '$id_marketing' ")->result();
		$id_customerr = $dbstocking[0]->qty_produk;
		echo "<input type='text' class='form-control'  value='$id_customerr' 	id='used_qtycoil_$loop' onkeyup='HitungTotalCoil($loop)' required name='dt[$loop][qtycoil]'>";
	}
function CariNamaCustomer()
    {
        $loop=$_GET['id'];
		$id_marketing=$_GET['id_marketing'];
		$dbstocking	= $this->db->query("SELECT * FROM dt_spkmarketing WHERE id_dt_spkmarketing = '$id_marketing' ")->result();
		$id_tr= $dbstocking[0]->id_spkmarketing;
		$dbstock	= $this->db->query("SELECT * FROM tr_spk_marketing WHERE id_spkmarketing = '$id_tr' ")->result();
		$id_customerr = $dbstock[0]->id_customer;
		$dbcustomer	= $this->db->query("SELECT * FROM master_customers WHERE id_customer = '$id_customerr' ")->result();
		$nama = $dbcustomer[0]->name_customer;
		echo "<input type='text' class='form-control' value='$nama'  readonly id='used_namacustomer_$loop' required name='dt[$loop][namacustomer]'>";
	}
function GetPegangan()
    {
        $id_stock=$_GET['id_stock'];
		$dbstock	= $this->db->query("SELECT * FROM stock_material WHERE id_stock = '$id_stock' ")->result();
		$thickness = $dbstock[0]->thickness;
		if($thickness < 0.25){
			$lpegangan ='4';
		}else{
			$lpegangan ='2';
		}
		echo "<input type='number' value='$lpegangan' class='form-control' id='lpegangan' onkeyup required name='lpegangan' readonly >";
	}
function CariQtyCoil()
    {
        $qtycoil=$_GET['qtycoil'];
		$qcoil=$_GET['qcoil'];
		$qcoilnew = $qtycoil+$qcoil;
		echo "<input type='number' value='$qcoilnew' class='form-control' id='qcoil' onkeyup required name='qcoil' readonly >";
	}
function MinusQtyCoil()
    {
        $qtycoil=$_GET['qtycoil'];
		$qcoil=$_GET['qcoil'];
		$qcoilnew = $qcoil-$qtycoil;
		echo "<input type='number' value='$qcoilnew' class='form-control' id='qcoil' onkeyup required name='qcoil' readonly >";
	}
function CarijPisau()
    {
        $qtycoil=$_GET['qtycoil'];
		$qcoil=$_GET['qcoil'];
		$qcoilnew = $qtycoil+$qcoil;
		$kalidua = $qcoilnew*2;
		$jpisau = $kalidua+2;
		echo "<input type='number' value='$jpisau' class='form-control' id='jpisau' onkeyup required name='jpisau' readonly >";
	}
function MinusJPisau()
    {
        $qtycoil=$_GET['qtycoil'];
		$qcoil=$_GET['qcoil'];
		$qcoilnew = $qcoil-$qtycoil;
		$kalidua = $qcoilnew*2;
		if($qcoilnew=='0'){
		$jpisau='0';
		}else{
		$jpisau = $kalidua+2;
		}
		
		echo "<input type='number' value='$jpisau' class='form-control' id='jpisau' onkeyup required name='jpisau' readonly >";
	}
function CariSisa()
    {
        $widthmother=$_GET['widthmother'];
		$lpegangan=$_GET['lpegangan'];
		$qtycoil=$_GET['qtycoil'];
		$weight=$_GET['weight'];
		$sisa=$_GET['sisa'];
		$used=$_GET['used'];
		$jumlahwidth=$qtycoil*$weight;
		$totalused= $used+$jumlahwidth;
		$totalsisa= $widthmother-$totalused-$lpegangan;
		echo "<div hidden><input type='number' value='$totalused' class='form-control' id='used' onkeyup required name='used' readonly ></div>
		<input type='number' value='$totalsisa' class='form-control' id='sisa' onkeyup required name='sisa' readonly >";
	}
function MinusSisa()
    {
        $widthmother=$_GET['widthmother'];
		$lpegangan=$_GET['lpegangan'];
		$qtycoil=$_GET['qtycoil'];
		$weight=$_GET['weight'];
		$sisa=$_GET['sisa'];
		$used=$_GET['used'];
		$jumlahwidth=$qtycoil*$weight;
		$totalused= $used-$jumlahwidth;
		if($totalused=='0'){
			$totalsisa=$widthmother;
		}else{
		$totalsisa= $widthmother-$totalused-$lpegangan;
		}
		echo "<div hidden><input type='number' value='$totalused' class='form-control' id='used' onkeyup required name='used' readonly ></div>
		<input type='number' value='$totalsisa' class='form-control' id='sisa' onkeyup required name='sisa' readonly >";
	}
function GetMaterialDensity()
    {
        $id_stock=$_GET['id_stock'];
		$dbstock	= $this->db->query("SELECT * FROM stock_material WHERE id_stock = '$id_stock' ")->result();
		$id_category3 = $dbstock[0]->id_category3; 
		$ms_inventory	= $this->db->query("SELECT * FROM ms_inventory_category3 WHERE id_category3 = '$id_category3' ")->result();
		$density = $ms_inventory[0]->density; 
		echo "<input type='number' value='$density' class='form-control' id='density'  required name='density' readonly >";
	}
function GetMaterialWeight()
    {
        $id_stock=$_GET['id_stock'];
		$dbstock	= $this->db->query("SELECT * FROM stock_material WHERE id_stock = '$id_stock' ")->result();
		$weight = $dbstock[0]->weight; 
		echo "<input type='number' value='$weight' class='form-control' id='weight'  required name='weight' readonly >";
	}
function GetMaterialPanjang()
    {
        $id_stock=$_GET['id_stock'];
		$dbstock	= $this->db->query("SELECT * FROM stock_material WHERE id_stock = '$id_stock' ")->result();
		$length = $dbstock[0]->length; 
		echo "<input type='number' value='$length' class='form-control' id='panjang'  required name='panjang' readonly >";
	}
function GetMaterialWidth()
    {
        $id_stock=$_GET['id_stock'];
		$dbstock	= $this->db->query("SELECT * FROM stock_material WHERE id_stock = '$id_stock' ")->result();
		$width = $dbstock[0]->width; 
		echo "<input type='number' value='$width' class='form-control' id='width'  required name='width' readonly >";
	}
function GetSisaMaterial()
    {
        $id_stock=$_GET['id_stock'];
		$dbstock	= $this->db->query("SELECT * FROM stock_material WHERE id_stock = '$id_stock' ")->result();
		$totalsisa = $dbstock[0]->width; 
		echo "<div hidden><input type='number' value='0' class='form-control' id='used' onkeyup required name='used' readonly ></div>
		<input type='number' value='$totalsisa' class='form-control' id='sisa' onkeyup required name='sisa' readonly >";
	}
function GetMaterialHiden()
    {
        $id_stock=$_GET['id_stock'];
		$dbstock	= $this->db->query("SELECT * FROM stock_material WHERE id_stock = '$id_stock' ")->result();
		$lotno = $dbstock[0]->lotno; 
		$nama_material = $dbstock[0]->nama_material; 
		echo "<input type='text' value='$lotno' class='form-control' id='lotno' onkeyup required name='lotno' readonly >
				<input type='text' value='$nama_material' class='form-control' id='nama_material' onkeyup required name='nama_material' readonly >";
	}

function cari_thickness()
    {
        $id_category3=$_GET['id_category3'];
		$kategory3	= $this->db->query("SELECT * FROM child_inven_dimensi WHERE id_category3 = '$id_category3' ")->result();
		$thickness = $kategory3[0]->nilai_dimensi;
		echo "<input type='text' class='form-control' readonly id='thickness' value='$thickness' required name='thickness' placeholder='Bentuk Material'>";
	}
function cari_density()
    {
        $id_category3=$_GET['id_category3'];
		$kategory3	= $this->db->query("SELECT * FROM ms_inventory_category3 WHERE id_category3 = '$id_category3' ")->result();
		$density = $kategory3[0]->density;
		echo "<input type='text' class='form-control' readonly id='density' value='$density' required name='density' placeholder='Bentuk Material'>";
	}
function hitung_komisi()
    {
        $bottom=$_GET['bottom'];
		$komisi=$_GET['bottom']*$_GET['komisi']/100;
		$hasil=$bottom+$komisi;
		echo "<input type='text' class='form-control' value='$hasil' id='harga_penawaran'  required name='harga_penawaran' placeholder='Bentuk Material'>";
	}
function cari_inven1()
    {
        $id_category3=$_GET['id_category3'];
		$kategory3	= $this->db->query("SELECT * FROM ms_inventory_category3 WHERE id_category3 = '$id_category3' ")->result();
		$inven1 = $kategory3[0]->id_category1;
		echo "<input type='text' class='form-control' id='inven1' value='$inven1'  required name='inven1' placeholder='Bentuk Material'>";
	}
	public function delDetail(){
		$this->auth->restrict($this->deletePermission);
		$id = $this->input->post('id');
		// print_r($id);
		// exit();
		$data = [
			'deleted' 		=> '1',
			'deleted_by' 	=> $this->auth->user_id()
		];

		$this->db->trans_begin();
		$this->db->where('id_dimensi',$id)->update("ms_dimensi",$data);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$status	= array(
			  'pesan'		=>'Gagal Save Item. Thanks ...',
			  'status'	=> 0
			);
		} else {
			$this->db->trans_commit();
			$status	= array(
			  'pesan'		=>'Success Save Item. Thanks ...',
			  'status'	=> 1
			);
		}

  		echo json_encode($status);
	}

	public function Approve(){
		$this->auth->restrict($this->deletePermission);
		$id = $this->input->post('id');
		$data = [
			'status_approve' 		=> '1'
		];

		$this->db->trans_begin();
		$this->db->where('id_spkproduksi',$id)->update("tr_spk_produksi",$data);
		$gudang = $this->db->query("SELECT * FROM tr_spk_produksi WHERE id_spkproduksi ='$id' ")->result();
			$id_stock=$gudang[0]->id_stock;
		$data2 = [
			'id_gudang' 		=> '2'
		];

		$this->db->trans_begin();
		$this->db->where('id_stock',$id_stock)->update("stock_material",$data2);
		

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$status	= array(
			  'pesan'		=>'Gagal Save Item. Thanks ...',
			  'status'	=> 0
			);
		} else {
			$this->db->trans_commit();
			$status	= array(
			  'pesan'		=>'Success Save Item. Thanks ...',
			  'status'	=> 1
			);
		}

  		echo json_encode($status);
	}
		function get_inven2()
    {
        $inventory_1=$_GET['inventory_1'];
        $data=$this->Inventory_4_model->level_2($inventory_1);
        echo "<select id='inventory_2' name='hd1[1][inventory_2]' class='form-control onchange='get_inv3()'  input-sm select2'>";
        echo "<option value=''>--Pilih--</option>";
                foreach ($data as $key => $st) :
				      echo "<option value='$st->id_category1' set_select('inventory_2', $st->id_category1, isset($data->id_category1) && $data->id_category1 == $st->id_category1)>$st->nama
                    </option>";
                endforeach;
        echo "</select>";
    }
		function get_inven3()
    {
        $inventory_2=$_GET['inventory_2'];
        $data=$this->Inventory_4_model->level_3($inventory_2);

        // print_r($data);
        // exit();
        echo "<select id='inventory_3' name='hd1[1][inventory_3]' class='form-control input-sm select2'>";
        echo "<option value=''>--Pilih--</option>";
                foreach ($data as $key => $st) :
				      echo "<option value='$st->id_category2' set_select('inventory_3', $st->id_category2, isset($data->id_category2) && $data->id_category2 == $st->id_category2)>$st->nama
                    </option>";
                endforeach;
        echo "</select>";
    }
		public function saveNewPenawaran()
    {
        $this->auth->restrict($this->addPermission);
		$post = $this->input->post();
		$this->db->trans_begin();
		$code = $post['no_penawaran'];
		$data = [
							'id_child_penawaran'	=> $code,
							'id_category3'			=> $post['id_category3'],
							'no_penawaran'			=> $post['no_penawaran'],
							'bentuk_material'		=> $post['bentuk_material'],
							'id_bentuk'				=> $post['id_bentuk'],
							'thickness'				=> $post['thickness'],
							'density'				=> $post['density'],
							'lotno'					=> $post['lotno'],
							'width'					=> $post['width'],
							'forecast'				=> $post['forecast'],
							'inven1'				=> $post['inven1'],
							'bottom'				=> $post['bottom'],
							'dasar_harga'			=> $post['dasar_harga'],
							'komisi'				=> $post['komisi'],
							'keterangan'			=> $post['keterangan'],
							'harga_penawaran'		=> $post['harga_penawaran'],
							'status_approve'			=> '0',
							'created_on'			=> date('Y-m-d H:i:s'),
							'created_by'			=> $this->auth->user_id()
                            ];
            //Add Data
               $this->db->insert('child_penawaran',$data);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$status	= array(
			  'pesan'		=>'Gagal Save Item. Thanks ...',
			  'code' => $code,
			  'status'	=> 0
			);
		} else {
			$this->db->trans_commit();
			$status	= array(
			  'pesan'		=>'Success Save Item. invenThanks ...',
			  'code' => $code,
			  'status'	=> 1
			);
		}

  		echo json_encode($status);

    }


	public function SaveNewHeader()
    {
        $this->auth->restrict($this->addPermission);
		$post = $this->input->post();
		$code = $this->Inventory_4_model->generate_code();
		$no_surat = $this->Inventory_4_model->BuatNomor();
		$this->db->trans_begin();
		$data = [
							'id_spkproduksi'		=> $code,
							'no_surat'				=> $no_surat,
							'tgl_spk_produksi'		=> date('Y-m-d'),
							'id_stock'				=> $post['id_stock'],
							'id_material'			=> $post['id_material'],
							'nama_material'			=> $post['nama_material'],
							'lotno'					=> $post['lotno'],
							'weight'				=> $post['weight'],
							'density'				=> $post['density'],
							'thickness'				=> $post['thickness'],
							'panjang'				=> $post['panjang'],
							'width'					=> $post['width'],
							'lpegangan'				=> $post['lpegangan'],
							'qcoil'					=> $post['qcoil'],
							'jpisau'				=> $post['jpisau'],
							'used'					=> $post['used'],
							'sisa'					=> $post['sisa'],
							'status_approve'		=> '0',
							'created_on'			=> date('Y-m-d H:i:s'),
							'created_by'			=> $this->auth->user_id()
                            ];
            //Add Data
               $this->db->insert('tr_spk_produksi',$data);
		$numb1 =0;
		foreach($_POST['dt'] as $used){
		$numb1++;        
                $dt =  array(
							'id_spkproduksi'		=> $code,
							'no_surat'				=> $used[no_surat],
							'id_dt_spkproduksi'		=> $code.'-'.$numb1,
							'idcustomer'			=> $used[idcustomer],
							'nmmaterial'		    => $used[nmmaterial],
							'thickness'		    	=> $used[thickness],
							'weight'		        => $used[weight],
							'qtycoil'		        => $used[qtycoil],
							'width'					=> $used[width],
							'totalwidth'		    => $used[totalwidth],
							'delivery'				=> $used[delivery],
                            );
                    $this->db->insert('dt_spk_produksi',$dt);
			
		    }
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$status	= array(
			  'pesan'		=>'Gagal Save Item. Thanks ...',
			  'code' => $code,
			  'status'	=> 0
			);
		} else {
			$this->db->trans_commit();
			$status	= array(
			  'pesan'		=>'Success Save Item. invenThanks ...',
			  'code' => $code,
			  'status'	=> 1
			);
		}

  		echo json_encode($status);

    }
	public function SaveEditHeader()
    {
        $this->auth->restrict($this->addPermission);
		$post = $this->input->post();
		$code = $post['id_spkmarketing'];
		$no_surat = $post['no_surat'];
		$this->db->trans_begin();
		$data = [
							'id_spkproduksi'		=> $code,
							'no_surat'				=> $no_surat,
							'tgl_spk_produksi'		=> date('Y-m-d'),
							'id_stock'				=> $post['id_stock'],
							'id_material'			=> $post['id_material'],
							'nama_material'			=> $post['nama_material'],
							'lotno'					=> $post['lotno'],
							'weight'				=> $post['weight'],
							'density'				=> $post['density'],
							'thickness'				=> $post['thickness'],
							'panjang'				=> $post['panjang'],
							'width'					=> $post['width'],
							'lpegangan'				=> $post['lpegangan'],
							'qcoil'					=> $post['qcoil'],
							'jpisau'				=> $post['jpisau'],
							'used'					=> $post['used'],
							'sisa'					=> $post['sisa'],
							'status_approve'		=> '0',
							'created_on'			=> date('Y-m-d H:i:s'),
							'created_by'			=> $this->auth->user_id()
                            ];
            //Add Data
			$this->db->where('id_spkproduksi',$code)->update("tr_spk_produksi",$data);
			$this->db->delete('dt_spk_produksi', array('id_spkproduksi' => $code));
			
		$numb1 =0;
		foreach($_POST['dt'] as $used){
		$numb1++;        
                $dt =  array(
							'id_spkproduksi'		=> $code,
							'no_surat'				=> $used[no_surat],
							'id_dt_spkproduksi'		=> $code.'-'.$numb1,
							'idcustomer'			=> $used[idcustomer],
							'nmmaterial'		    => $used[nmmaterial],
							'thickness'		    	=> $used[thickness],
							'weight'		        => $used[weight],
							'qtycoil'		        => $used[qtycoil],
							'width'					=> $used[width],
							'totalwidth'		    => $used[totalwidth],
							'delivery'				=> $used[delivery],
                            );
                    $this->db->insert('dt_spk_produksi',$dt);
			
		    }
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$status	= array(
			  'pesan'		=>'Gagal Save Item. Thanks ...',
			  'code' => $code,
			  'status'	=> 0
			);
		} else {
			$this->db->trans_commit();
			$status	= array(
			  'pesan'		=>'Success Save Item. invenThanks ...',
			  'code' => $code,
			  'status'	=> 1
			);
		}

  		echo json_encode($status);

    }
		public function SaveEditHeadercontoh()
    {
  $this->auth->restrict($this->addPermission);
		$post = $this->input->post();
		$code = $post['id_shearing'];
		$this->db->trans_begin();
		$data = [
							'tgl_penawaran'			=> date('Y-m-d'),
							'id_customer'			=> $post['id_customer'],
							'id_produk'				=> $post['id_produk'],
							'material'				=> $post['material'],
							'thickness'				=> $post['thickness'],
							'density'				=> $post['density'],
							'surface'				=> $post['surface'],
							'lebar_coil'			=> $post['lebar_coil'],
							'qty'					=> $post['qty'],
							'mata_uang'				=> $post['mata_uang'],
							'potongan_pinggir'		=> $post['potongan_pinggir'],
							'total_panjang'			=> $post['total_panjang'],
							'jml_pisau'				=> $post['jml_pisau'],
							'jml_mother'			=> $post['jml_mother'],
							'total_berat'			=> $post['total_berat'],
							
							'created_on'			=> date('Y-m-d H:i:s'),
							'created_by'			=> $this->auth->user_id()
                            ];
            //Add Data
			$this->db->where('id_shearing',$code)->update("tr_penawaran_shearing",$data);
			$this->db->delete('dt_penawaran_shearing_used', array('id_shearing' => $code));
			
		$numb1 =0;
		foreach($_POST['used'] as $use){
		$numb1++;        
                $stokpakai =  array(
							'id_shearing'		    	=> $code,
							'id_used_syock_penawaran'	=> $code.'-'.$numb1,
							'idstk'		    			=> $use[idstk],
							'lotno'		        		=> $use[lotno],
							'namamaterial'		        => $use[namamaterial],
							'weight'		        	=> $use[weight],
							'density'		        	=> $use[density],
							'hasilpanjang'		        => $use[hasilpanjang],
							'width'		    			=> $use[width],
							'lebarcc'					=> $use[lebarcc],
							'jumlahcc'		    		=> $use[jumlahcc],
							'sisapotongan'		    	=> $use[sisapotongan],
							'qty'		    			=> $use[qty],
							'jmlpisau'		    		=> $use[jmlpisau]
                            );
                    $this->db->insert('dt_penawaran_shearing_used',$stokpakai);
			
		    }
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$status	= array(
			  'pesan'		=>'Gagal Save Item. Thanks ...',
			  'code' => $code,
			  'status'	=> 0
			);
		} else {
			$this->db->trans_commit();
			$status	= array(
			  'pesan'		=>'Success Save Item. invenThanks ...',
			  'code' => $code,
			  'status'	=> 1
			);
		}

  		echo json_encode($status);


    }
	public function saveEditPenawaran()
    {
        $this->auth->restrict($this->addPermission);
		$post = $this->input->post();
		$code = $this->Inventory_4_model->generate_code();
		$this->db->trans_begin();
		$id = $post['id_child_penawaran'];
		$data = [
							'id_category3'			=> $post['id_category3'],
							'bentuk_material'		=> $post['bentuk_material'],
							'id_bentuk'				=> $post['id_bentuk'],
							'thickness'				=> $post['thickness'],
							'density'				=> $post['density'],
							'forecast'				=> $post['forecast'],
							'inven1'				=> $post['inven1'],
							'bottom'				=> $post['bottom'],
							'dasar_harga'			=> $post['dasar_harga'],
							'komisi'				=> $post['komisi'],
							'keterangan'			=> $post['keterangan'],
							'harga_penawaran'		=> $post['harga_penawaran'],
							'created_on'			=> date('Y-m-d H:i:s'),
							'created_by'			=> $this->auth->user_id()
                            ];
            //Add Data
               $this->db->where('id_child_penawaran',$id)->update("child_penawaran",$data);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$status	= array(
			  'pesan'		=>'Gagal Save Item. Thanks ...',
			  'code' => $id_bentuk,
			  'status'	=> 0
			);
		} else {
			$this->db->trans_commit();
			$status	= array(
			  'pesan'		=>'Success Save Item. invenThanks ...',
			  'code' => $id_bentuk,
			  'status'	=> 1
			);
		}

  		echo json_encode($status);

    }
public function deletePenawaran(){
		$this->auth->restrict($this->deletePermission);
		$id = $this->input->post('id');
		$this->db->trans_begin();
		$this->db->delete('child_penawaran', array('id_child_penawaran' => $id));

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$status	= array(
			  'pesan'		=>'Gagal Save Item. Thanks ...',
			  'status'	=> 0
			);
		} else {
			$this->db->trans_commit();
			$status	= array(
			  'pesan'		=>'Success Save Item. Thanks ...',
			  'status'	=> 1
			);
		}

  		echo json_encode($status);
	}

	public function saveEditInventory()
    {
        $this->auth->restrict($this->addPermission);
		$session = $this->session->userdata('app_session');
		$code = $this->Inventory_4_model->generate_id();
		$this->db->trans_begin();
		$id = $_POST['hd1']['1']['id_category3'];
		$id_bentuk = $_POST['hd1']['1']['id_bentuk'];
		$numb1 =0;
		foreach($_POST['hd1'] as $h1){
		$numb1++;
                $header1 =  array(
							'id_type'		        => $h1[inventory_1],
							'id_category1'		    => $h1[inventory_2],
							'id_category2'		    => $h1[inventory_3],
							'nama'		        	=> $h1[nm_inventory],
							'maker'		        	=> $h1[maker],
							'density'		        => $h1[density],
							'hardness'		        => $h1[hardness],
							'id_bentuk'		        => $h1[id_bentuk],
							'id_surface'		    => $h1[id_surface],
							'mountly_forecast'		=> $h1[mountly_forecast],
							'safety_stock'		    => $h1[safety_stock],
							'order_point'		    => $h1[order_point],
							'maksimum'		    	=> $h1[maksimum],
							'aktif'					=> 'aktif',
							'created_on'		=> date('Y-m-d H:i:s'),
							'created_by'		=> $this->auth->user_id(),
							'deleted'			=> '0'
                            );
                     $this->db->where('id_category3',$id)->update("ms_inventory_category3",$header1);

		    }

		if(empty($_POST['data1'])){
		}else{
		$this->db->delete('child_inven_suplier', array('id_category3' => $id));
		$numb2 =0;

		foreach($_POST['data1'] as $d1){
		$numb2++;
              $data1 =  array(
			                    'id_category3'=>$id,
								'id_suplier'=>$d1[id_supplier],
								'lead'=>$d1[lead],
								'minimum'=>$d1[minimum],
								'deleted' =>'0',
							    'created_on' => date('Y-m-d H:i:s'),
								'created_by' => $this->auth->user_id(),
                            );
            //Add Data
              $this->db->insert('child_inven_suplier',$data1);

		    }
		}

		if(empty($_POST['compo'])){
		}else{
		$this->db->delete('child_inven_compotition', array('id_category3' => $id));
		$numb3 =0;
		foreach($_POST['compo'] as $c1){
		$numb3++;
              $comp =  array(
			                    'id_category3'=>$id,
								'id_compotition'=>$c1[id_compotition],
								'nilai_compotition'=>$c1[jumlah_kandungan],
								'deleted' =>'0',
							    'created_on' => date('Y-m-d H:i:s'),
								'created_by' => $this->auth->user_id(),
                            );
            //Add Data
              $this->db->insert('child_inven_compotition',$comp);

		    }
		}

		if(empty($_POST['dimens'])){
		}else{
		$this->db->delete('child_inven_dimensi', array('id_category3' => $id));
		$numb4 =0;
		foreach($_POST['dimens'] as $dm){
		$numb4++;
              $dms =  array(
			                    'id_category3'=>$id,
								'id_dimensi'=>$dm[id_dimensi],
								'nilai_dimensi'=>$dm[nilai_dimensi],
								'deleted' =>'0',
							    'created_on' => date('Y-m-d H:i:s'),
								'created_by' => $this->auth->user_id(),
                            );
            //Add Data
              $this->db->insert('child_inven_dimensi',$dms);

		    }
		}
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$status	= array(
			  'pesan'		=>'Gagal Save Item. Thanks ...',
			  'code' => $id_bentuk,
			  'status'	=> 0
			);
		} else {
			$this->db->trans_commit();
			$status	= array(
			  'pesan'		=>'Success Save Item. invenThanks ...',
			  'code' => $id_bentuk,
			  'status'	=> 1
			);
		}

  		echo json_encode($status);

    }
		function get_compotition_new()
    {
        $inventory_2=$_GET['inventory_2'];
        $comp=$this->Inventory_4_model->compotition($inventory_2);
		$numb = 0;
        // print_r($data);
        // exit();
                foreach ($comp as $key => $cmp): $numb++;
				      echo "<tr>
					  <td hidden align='left'>
					  <input type='text' name='compo[$numb][id_compotition]' readonly class='form-control'  value='$cmp->id_compotition'>
					  </td>
					  <td align='left'>
					  $cmp->name_compotition
					  </td>
					  <td align='left'>
					  <input type='text' name='compo[$numb][jumlah_kandungan]' class='form-control'>
					  </td>
					  <td align='left'>%</td>
                    </tr>";
                endforeach;
        echo "</select>";
    }
	function get_dimensi()
    {
        $id_bentuk=$_GET['id_bentuk'];
        $dim=$this->Inventory_4_model->bentuk($id_bentuk);
		$numb = 0;
        // print_r($data);
        // exit();
                foreach ($dim as $key => $ensi): $numb++;
				      echo "<tr>
					  <td align='left' hidden>
					  <input type='text' name='dimens[$numb][id_dimensi]' readonly class='form-control'  value='$ensi->id_dimensi'>
					  </td>
					  <td align='left'>
					  $ensi->nm_dimensi
					  </td>
					  <td align='left'>
					  <input type='text' name='dimens[$numb][nilai_dimensi]' class='form-control'>
					  </td>
                    </tr>";
                endforeach;
        echo "</select>";
    }
	function get_compotition_old()
    {
        $inventory_2=$_GET['inventory_2'];
        $comp=$this->Inventory_4_model->compotition_edit($inventory_2);
		$numb = 0;
        // print_r($data);
        // exit();
                foreach ($comp as $key => $cmp): $numb++;
				      echo "<tr>
					  <td hidden align='left'>
					  <input type='text' name='compo[$numb][id_compotition]' readonly class='form-control'  value='$cmp->id_compotition'>
					  </td>
					  <td align='left'>
					  $cmp->name_compotition
					  </td>
					  <td align='left'>
					  <input type='text' name='compo[$numb][jumlah_kandungan]' class='form-control'>
					  </td>
					  <td align='left'>%</td>
                    </tr>";
                endforeach;
        echo "</select>";
    }
	function get_dimensi_old()
    {
        $id_bentuk=$_GET['id_bentuk'];
        $dim=$this->Inventory_4_model->bentuk_edit($id_bentuk);
		$numb = 0;
        // print_r($data);
        // exit();
                foreach ($dim as $key => $ensi): $numb++;
				      echo "<tr>
					  <td hidden align='left'>
					  <input type='text' name='dimens[$numb][id_dimensi]' readonly class='form-control'  value='$cmp->id_dimensi'>
					  </td>
					  <td align='left'>
					  $ensi->nm_dimensi
					  </td>
					  <td align='left'>
					  <input type='text' name='dimens[$numb][nilai_dimensi]' class='form-control'>
					  </td>
                    </tr>";
                endforeach;
        echo "</select>";
    }
	public function saveEditInventorylama()
    {
        $this->auth->restrict($this->addPermission);
		$session = $this->session->userdata('app_session');
		$code = $this->Inventory_4_model->generate_id();
		$this->db->trans_begin();
		$id =$_POST['hd1']['1']['id_category3'];
		$numb1 =0;
		//$head = $_POST['hd1'];
		foreach($_POST['hd1'] as $h1){
		$numb1++;

                $header1 =  array(
							'id_type'		        => $h1[inventory_1],
							'id_category1'		    => $h1[inventory_2],
							'id_category2'		    => $h1[inventory_3],
							'nama'		        	=> $h1[nm_inventory],
							'maker'		        	=> $h1[maker],
							'density'		        => $h1[density],
							'hardness'		        => $h1[hardness],
							'id_bentuk'		        => $h1[id_bentuk],
							'id_surface'		    => $h1[id_surface],
							'mountly_forecast'		=> $h1[mountly_forecast],
							'safety_stock'		    => $h1[safety_stock],
							'order_point'		    => $h1[order_point],
							'maksimum'		    	=> $h1[maksimum],
							'aktif'					=> 'aktif',
							'created_on'		=> date('Y-m-d H:i:s'),
							'created_by'		=> $this->auth->user_id(),
							'deleted'			=> '0'
                            );
            //Add Data
              $this->db->where('id_category3',$id)->update("ms_inventory_category3",$data);

		    }
		$this->db->delete('child_inven_suplier', array('id_category3' => $id));
		if(empty($_POST['data1'])){
		}else{
		$numb2 =0;
		foreach($_POST['data1'] as $d1){
		$numb2++;
              $data1 =  array(
			                    'id_category3'=>$code,
								'id_suplier'=>$d1[id_supplier],
								'lead'=>$d1[lead],
								'minimum'=>$d1[minimum],
								'deleted' =>'0',
							    'created_on' => date('Y-m-d H:i:s'),
								'created_by' => $this->auth->user_id(),
                            );
            //Add Data
              $this->db->insert('child_inven_suplier',$data1);

		    }
		}
		if(empty($_POST['compo'])){
		}else{
		$numb3 =0;
		foreach($_POST['compo'] as $c1){
		$numb3++;
              $comp =  array(
			                    'id_category3'=>$code,
								'id_compotition'=>$c1[id_compotition],
								'nilai_compotition'=>$c1[jumlah_kandungan],
								'deleted' =>'0',
							    'created_on' => date('Y-m-d H:i:s'),
								'created_by' => $this->auth->user_id(),
                            );
            //Add Data
              $this->db->insert('child_inven_compotition',$comp);

		    }
		}
		if(empty($_POST['dimens'])){
		}else{
		$numb4 =0;
		foreach($_POST['dimens'] as $dm){
		$numb4++;
              $dms =  array(
			                    'id_category3'=>$code,
								'id_dimensi'=>$dm[id_dimensi],
								'nilai_dimensi'=>$dm[nilai_dimensi],
								'deleted' =>'0',
							    'created_on' => date('Y-m-d H:i:s'),
								'created_by' => $this->auth->user_id(),
                            );
            //Add Data
              $this->db->insert('child_inven_dimensi',$dms);

		    }
		}
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$status	= array(
			  'pesan'		=>'Gagal Save Item. Thanks ...',
			  'status'	=> 0
			);
		} else {
			$this->db->trans_commit();
			$status	= array(
			  'pesan'		=>'Success Save Item. invenThanks ...',
			  'status'	=> 1
			);
		}

  		echo json_encode($status);

    }
	public function saveEditInventoryOld()
    {
        $this->auth->restrict($this->addPermission);
		$session = $this->session->userdata('app_session');
		$code = $this->Inventory_4_model->generate_id();
		$this->db->trans_begin();
		$id =$_POST['hd1']['1']['id_category3'];
		$numb1 =0;
		//$head = $_POST['hd1'];
		foreach($_POST['hd1'] as $h1){
		$numb1++;

                $header1 =  array(
							'id_type'		        => $h1[inventory_1],
							'id_category1'		    => $h1[inventory_2],
							'id_category2'		    => $h1[inventory_3],
							'nama'		        	=> $h1[nm_inventory],
							'maker'		        	=> $h1[maker],
							'density'		        => $h1[density],
							'hardness'		        => $h1[hardness],
							'id_bentuk'		        => $h1[id_bentuk],
							'id_surface'		    => $h1[id_surface],
							'mountly_forecast'		=> $h1[mountly_forecast],
							'safety_stock'		    => $h1[safety_stock],
							'order_point'		    => $h1[order_point],
							'maksimum'		    	=> $h1[maksimum],
							'aktif'					=> 'aktif',
							'created_on'		=> date('Y-m-d H:i:s'),
							'created_by'		=> $this->auth->user_id(),
							'deleted'			=> '0'
                            );
            //Add Data
              $this->db->where('id_category3',$id)->update("ms_inventory_category3",$data);

		    }
		if(empty($_POST['data1'])){
		}else{
		$numb2 =0;
		foreach($_POST['data1'] as $d1){
		$numb2++;
              $data1 =  array(
			                    'id_category3'=>$id,
								'id_suplier'=>$d1[id_supplier],
								'lead'=>$d1[lead],
								'minimum'=>$d1[minimum],
								'deleted' =>'0',
							    'created_on' => date('Y-m-d H:i:s'),
								'created_by' => $this->auth->user_id(),
                            );
            //Add Data
              $this->db->insert('child_inven_suplier',$data1);

		    }
		}
		if(empty($_POST['compo'])){
		}else{
		$numb3 =0;
		foreach($_POST['compo'] as $c1){
		$numb3++;
              $comp =  array(
			                    'id_category3'=>$id,
								'id_compotition'=>$c1[id_compotition],
								'nilai_compotition'=>$c1[jumlah_kandungan],
								'deleted' =>'0',
							    'created_on' => date('Y-m-d H:i:s'),
								'created_by' => $this->auth->user_id(),
                            );
            //Add Data
              $this->db->insert('child_inven_compotition',$comp);

		    }
		}
		if(empty($_POST['dimens'])){
		}else{
		$numb4 =0;
		foreach($_POST['dimens'] as $dm){
		$numb4++;
              $dms =  array(
			                    'id_category3'=>$id,
								'id_dimensi'=>$dm[id_dimensi],
								'nilai_dimensi'=>$dm[nilai_dimensi],
								'deleted' =>'0',
							    'created_on' => date('Y-m-d H:i:s'),
								'created_by' => $this->auth->user_id(),
                            );
            //Add Data
              $this->db->insert('child_inven_dimensi',$dms);

		    }
		}
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$status	= array(
			  'pesan'		=>'Gagal Save Item. Thanks ...',
			  'status'	=> 0
			);
		} else {
			$this->db->trans_commit();
			$status	= array(
			  'pesan'		=>'Success Save Item. invenThanks ...',
			  'status'	=> 1
			);
		}

  		echo json_encode($status);

    }

		function get_compotition()
    {
        $inventory_2=$_GET['inventory_2'];
        $comp=$this->Inventory_4_model->compotition($inventory_2);
		$numb = 0;
        // print_r($data);
        // exit();
                foreach ($comp as $key => $cmp): $numb++;
				      echo "<tr>
					  <td hidden align='left'>
					  <input type='text' name='compo[$numb][id_compotition]' readonly class='form-control'  value='$cmp->id_compotition'>
					  </td>
					  <td align='left'>
					  $cmp->name_compotition
					  </td>
					  <td align='left'>
					  <input type='text' name='compo[$numb][jumlah_kandungan]' class='form-control'>
					  </td>
					  <td align='left'>%</td>
                    </tr>";
                endforeach;
        echo "</select>";
    }

}
