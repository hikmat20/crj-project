<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Incoming extends Admin_Controller
{
    //Permission
    protected $viewPermission 	= 'Incoming.View';
    protected $addPermission  	= 'Incoming.Add';
    protected $managePermission = 'Incoming.Manage';
    protected $deletePermission = 'Incoming.Delete';

   public function __construct()
    {
        parent::__construct();

        $this->load->library(array('Mpdf', 'upload', 'Image_lib'));
        $this->load->model(array('Incoming/Slitting_model',
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
        $data = $this->db->query("SELECT a.*, b.name_suplier as name_suplier FROM tr_incoming as a INNER JOIN master_supplier as b on a.id_suplier=b.id_suplier ORDER BY a.id_incoming DESC")->result();
        $this->template->set('results', $data);
        $this->template->title('Incoming');
        $this->template->render('index');
    }

		public function add()
    {
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');
		$aktif = 'active';
		$deleted = '0';
		$po = $data = $this->db->query("SELECT * FROM tr_purchase_order WHERE status='2' ")->result();
		$suplier = $data = $this->db->query("SELECT * FROM master_supplier WHERE deleted='0' ")->result();
		$gudang	= $this->db->query("select * FROM ms_gudang ")->result();
		$data = [
			'po' => $po,
			'gudang' => $gudang,
			'suplier' => $suplier,
		];
        $this->template->set('results', $data);
        $this->template->title('INCOMING');
        $this->template->render('Add');

    }

    public function edit(){
		$id = $this->uri->segment(3);
    	$session = $this->session->userdata('app_session');
		$aktif = 'active';
		$deleted = '0';
		$customers = $this->Slitting_model->get_data('master_customers','deleted',$deleted);
		$head = $this->Slitting_model->get_data('tr_penawaran_slitting','id_slitting',$id);
		$detail = $this->Slitting_model->get_data('dt_penawaran_slitting','id_slitting',$id);
		$karyawan = $this->Slitting_model->get_data('ms_karyawan','deleted',$deleted);
		$mata_uang = $this->Slitting_model->get_data('mata_uang','deleted',$deleted);
		$data = [
			'customers' => $customers,
			'karyawan' => $karyawan,
			'mata_uang' => $mata_uang,
			'head' => $head,
			'detail' => $detail,
		];
			$this->template->set('results', $data);
      $this->template->page_icon('fa fa-edit');
      $this->template->title('Penawaran Slitting');
      $this->template->render('edit');
    }


	public function view(){
		$this->auth->restrict($this->viewPermission);
		$id 	= $this->input->post('id');
		$header = $this->db->get_where('cycletime_header',array('id_time' => $id))->result();
    // print_r($header);
		$data = [
			'header' => $header
			];
    $this->template->set('results', $data);
		$this->template->render('view', $data);
	}
	function CariPic()
    {
        $id_customer=$_GET['id_customer'];
		$pic = $this->Slitting_model->get_data('child_customer_pic','id_customer',$id_customer);
		echo "<select id='pic_cutomer' name='pic_cutomer' class='form-control' required>
						<option value=''>--Pilih--</option>";
			foreach ($pic as $pic){
				echo "<option value='$pic->name_pic'>$pic->name_pic</option>";
			}
		echo "</select>";
	}
	function CariDensity()
    {
		$id_material=$_GET['id_material'];
		$id=$_GET['id'];
		$material = $this->db->query("SELECT * FROM ms_inventory_category3 WHERE id_category3 = '$id_material' ")->result();
		$density = $material[0]->density;
		echo "<input type='text' value='".$density."' placeholder='Thickness' readonly class='form-control input-md ' id='dt_density_".$id."' required name='dt[".$id."][density]' >";
	}
function LockDetail()
    {
		$id_customer	=$_GET['id_customer'];
		$lotno			=$_GET['lotno'];
		$idmaterial		=$_GET['idmaterial'];
		$berat			=$_GET['berat'];
		$density		=$_GET['density'];
		$thicknessform	=$_GET['thickness'];
		$nama_material	=$_GET['nama_material'];
		$lebar			=$_GET['lebar'];
		$panjang		=$_GET['panjang'];
		$lebarnew		=$_GET['lebarnew'];
		$qty			=$_GET['qty'];
		$pegangan		=$_GET['pegangan'];
		$sisa			=$_GET['sisa'];
		$used			=$_GET['used'];
		$sisakg			=$_GET['sisakg'];
		$jmlpisau		=$_GET['jmlpisau'];
		$harga			=$_GET['harga'];
		$waktu			=$_GET['waktu'];
		$profit			=$_GET['profit'];
		$totalpenawaran	=$_GET['totalpenawaran'];
		$hargadeal		=$_GET['hargadeal'];
		$loop			=$_GET['id'];
		$material 		= $this->db->query("SELECT a.*, b.nama as alloy, c.nm_bentuk as bentuk FROM ms_inventory_category3 as a INNER JOIN ms_inventory_category2 as b ON a.id_category2 = b.id_category2 INNER JOIN ms_bentuk as c ON a.id_bentuk = c.id_bentuk WHERE a.deleted = '0' AND a.id_category3 = '$idmaterial' ")->result();echo "
		<th hidden><input type='text' 	 class='form-control' value='$lotno' id='dt_lotno_$loop' required name='dt[$loop][lotno]'></th>
		<th hidden><input type='text' 	 class='form-control' value='$idmaterial' id='dt_idmaterial_$loop' required name='dt[$loop][idmaterial]'></th>";
		foreach ($material as $material){
		if($material->id_bentuk == 'B2000001' ){
		$dimensi = $this->db->query("SELECT * FROM child_inven_dimensi WHERE id_category3 = '$material->id_category3' AND id_dimensi = '22'")->result();
		$thickness = $dimensi[0]->nilai_dimensi;
		echo"<th><input readonly type='text' class='form-control' id='dt_nama_material_$loop' required name='dt[$loop][nama_material]' value='$material->bentuk $material->alloy $material->nama $material->hardness $thickness' ></th>";
		}elseif($material->id_bentuk == 'B2000002' ){
		$dimensi = $this->db->query("SELECT * FROM child_inven_dimensi WHERE id_category3 = '$material->id_category3' AND id_dimensi = '25' ")->result();
		$thickness = $dimensi[0]->nilai_dimensi;
		echo"<th><input readonly type='text' class='form-control' id='dt_nama_material_$loop' required name='dt[$loop][nama_material]' value='$material->bentuk $material->alloy $material->nama $material->hardness $thickness' ></th>";
		}elseif($material->id_bentuk == 'B2000003' ){
		$dimensi = $this->db->query("SELECT * FROM child_inven_dimensi WHERE id_category3 = '$material->id_category3' AND id_dimensi = '30' ")->result();
		$thickness = $dimensi[0]->nilai_dimensi;
		echo"<th><input readonly type='text' class='form-control' id='dt_nama_material_$loop' required name='dt[$loop][nama_material]' value='$material->bentuk $material->alloy $material->nama $material->hardness $thickness' ></th>";
		}elseif($material->id_bentuk == 'B2000004' ){
		$dimensi = $this->db->query("SELECT * FROM child_inven_dimensi WHERE id_category3 = '$material->id_category3' AND id_dimensi = '8' ")->result();
		$thickness = $dimensi[0]->nilai_dimensi;
		$dimensi2 = $this->db->query("SELECT * FROM child_inven_dimensi WHERE id_category3 = '$material->id_category3' AND id_dimensi = '9' ")->result();
		$thickness2 = $dimensi[0]->nilai_dimensi;
		echo"<th><input readonly type='text' class='form-control' id='dt_nama_material_$loop' required name='dt[$loop][nama_material]' value='$material->bentuk $material->alloy $material->nama $material->hardness $thickness x $thickness2' ></th>";
		}elseif($material->id_bentuk == 'B2000005' ){
		$dimensi = $this->db->query("SELECT * FROM child_inven_dimensi WHERE id_category3 = '$material->id_category3' AND id_dimensi = '11' ")->result();
		$thickness = $dimensi[0]->nilai_dimensi;
		echo"<th><input readonly type='text' class='form-control' id='dt_nama_material_$loop' required name='dt[$loop][nama_material]' value='$material->bentuk $material->alloy $material->nama $material->hardness $thickness' ></th>";
		}elseif($material->id_bentuk == 'B2000006' ){
		$dimensi = $this->db->query("SELECT * FROM child_inven_dimensi WHERE id_category3 = '$material->id_category3' AND id_dimensi = '13' ")->result();
		$thickness = $dimensi[0]->nilai_dimensi;
		echo"<th><input readonly type='text' class='form-control' id='dt_nama_material_$loop' required name='dt[$loop][nama_material]' value='$material->bentuk $material->alloy $material->nama $material->hardness $thickness' ></th>";
		}elseif($material->id_bentuk == 'B2000007' ){
		$dimensi = $this->db->query("SELECT * FROM child_inven_dimensi WHERE id_category3 = '$material->id_category3' AND id_dimensi = '15' ")->result();
		$thickness = $dimensi[0]->nilai_dimensi;
		$dimensi2 = $this->db->query("SELECT * FROM child_inven_dimensi WHERE id_category3 = '$material->id_category3' AND id_dimensi = '16' ")->result();
		$thickness2 = $dimensi[0]->nilai_dimensi;
		echo"<th><input readonly type='text' class='form-control' id='dt_nama_material_$loop' required name='dt[$loop][nama_material]' value='$material->bentuk $material->alloy $material->nama $material->hardness $thickness x $thickness2' ></th>";
		}elseif($material->id_bentuk == 'B2000009' ){
		$dimensi = $this->db->query("SELECT * FROM child_inven_dimensi WHERE id_category3 = '$material->id_category3' AND id_dimensi = '19' ")->result();
		$thickness = $dimensi[0]->nilai_dimensi;
		echo"<th><input readonly type='text' class='form-control' id='dt_nama_material_$loop' required name='dt[$loop][nama_material]' value='$material->bentuk $material->alloy $material->nama $material->hardness $thickness ' ></th>";
		};};
		echo"
		<th><input type='number' 		class='form-control' value='$berat'  		 id='dt_berat_$loop' 			required name='dt[$loop][berat]' 			readonly onkeyup='HitungPanjang($loop)'></th>
		<th><input type='number' 		class='form-control' value='$density' 		 id='dt_density_$loop' 			required name='dt[$loop][density]' 			readonly onkeyup='HitungPanjang($loop)'></th>
		<th><input type='number' 		class='form-control' value='$thicknessform'  id='dt_thickness_$loop' 		required name='dt[$loop][thickness]' 		readonly onkeyup='HitungPanjang($loop)'></th>
		<th><input type='number' 		class='form-control' value='$lebar' 		 id='dt_lebar_$loop' 	placeholder='dt_lebar_$loop' 			required name='dt[$loop][lebar]' 			readonly onkeyup='HitungPanjang($loop)'></th>
		<th><input type='number'	 	class='form-control' value='$panjang' 		 id='dt_panjang_$loop'  placeholder='dt_panjang_$loop'		required name='dt[$loop][panjang]' 			readonly>		</th>
		<th hidden><input type='number'	class='form-control' value='$lebarnew' 		 id='dt_lebarnew_$loop' placeholder='dt_lebarnew_$loop'		required name='dt[$loop][lebarnew]' 		readonly onkeyup='HitungPanjang($loop)'></th>
		<th hidden><input type='number'	class='form-control' value='$qty' 			 id='dt_qty_$loop'		placeholder='dt_qty_$loop'		required name='dt[$loop][qty]'      		readonly onkeyup='HitungPanjang($loop)'></th>
		<th hidden><input type='number'	class='form-control' value='$pegangan' 		 id='dt_pegangan_$loop' placeholder='dt_pegangan_$loop'		required name='dt[$loop][pegangan]'			readonly></th>
		<th><input type='number'	 		class='form-control' value='$sisa' 		 id='dt_sisa_$loop' 	placeholder='dt_sisa_$loop' 			required name='dt[$loop][sisa]' 			readonly></th>
		<th hidden><input type='number'	 		class='form-control' value='$used' 		 id='dt_used_$loop' 	placeholder='dt_used_$loop' 			required name='dt[$loop][used]' 			readonly></th>
		<th><input type='number'	 		class='form-control' value='$sisakg' 		 id='dt_sisakg_$loop' 	placeholder='dt_sisakg_$loop' 			required name='dt[$loop][sisakg]' 			readonly></th>
		<th hidden><input type='number'	class='form-control' value='$jmlpisau' 		 id='dt_jmlpisau_$loop' 		required name='dt[$loop][jmlpisau]' 		readonly></th>
		<th hidden><input type='number' 	class='form-control' value='$waktu' 		 id='dt_waktu_$loop' 			required name='dt[$loop][waktu]' 			readonly></th>
		<th><input type='number'	 		class='form-control' value='$harga' 		 id='dt_harga_$loop' 			required name='dt[$loop][harga]' 			readonly></th>
		<th><input type='number'			class='form-control' value='$profit' 		 id='dt_profit_$loop' 			required name='dt[$loop][profit]' 			readonly onkeyup='HitungPanjang($loop)'></th>
		<th><input type='number'	 		class='form-control' value='$totalpenawaran' id='dt_totalpenawaran_$loop' 	required name='dt[$loop][totalpenawaran]' 	readonly></th>
		<th><input type='number'	 		class='form-control' value='$hargadeal' 	 id='dt_hargadeal_$loop' 		required name='dt[$loop][hargadeal]'		></th>
		<th><button type='button' class='btn btn-sm btn-danger hapusPart' title='Hapus Part'><i class='fa fa-close'></i></button></th>
		";
	}
	function SumHarga()
    {
		$hargadeal=$_GET['hargadeal'];
		$total_harga_penawaran=$_GET['total_harga_penawaran'];
		$rumusvix = $hargadeal+$total_harga_penawaran;
		echo "<input type='number' class='form-control' value='$rumusvix' id='total_harga_penawaran' readonly required name='total_harga_penawaran' >";
	}
	function CariTPanjang()
    {
		$id_customer=$_GET['id_customer'];
		$lotno=$_GET['lotno'];
		$idmaterial=$_GET['idmaterial'];
		$berat=$_GET['berat'];
		$density=$_GET['density'];
		$thickness=$_GET['thickness'];
		$lebar=$_GET['lebar'];
		$panjang=$_GET['panjang'];
		$lebarnew=$_GET['lebarnew'];
		$qty=$_GET['qty'];
		$pegangan=$_GET['pegangan'];
		$sisa=$_GET['sisa'];
		$jmlpisau=$_GET['jmlpisau'];
		$harga=$_GET['harga'];
		$total_panjang=$_GET['total_panjang'];
		$jml_pisau=$_GET['jml_pisau'];
		$jml_mother=$_GET['jml_mother'];
		$total_berat=$_GET['total_berat'];
		$loop=$_GET['id'];
		$rumus1=$panjang*$qty;
		$rumusvix = $rumus1+$total_panjang;
		echo "<input type='number' value='$rumusvix' class='form-control' id='total_panjang' readonly required name='total_panjang' >";
	}
function MinPanjang()
    {

		$panjang=$_GET['panjang'];
		$qty=$_GET['qty'];
		$total_panjang=$_GET['total_panjang'];
		$rumus1=$panjang*$qty;
		$rumusvix = $total_panjang-$rumus1;
		echo "<input type='number' value='$rumusvix' class='form-control' id='total_panjang' readonly required name='total_panjang' >";
	}
function CariMCoils()
    {
		$id_customer=$_GET['id_customer'];
		$lotno=$_GET['lotno'];
		$idmaterial=$_GET['idmaterial'];
		$berat=$_GET['berat'];
		$density=$_GET['density'];
		$thickness=$_GET['thickness'];
		$lebar=$_GET['lebar'];
		$panjang=$_GET['panjang'];
		$lebarnew=$_GET['lebarnew'];
		$qty=$_GET['qty'];
		$pegangan=$_GET['pegangan'];
		$sisa=$_GET['sisa'];
		$jmlpisau=$_GET['jmlpisau'];
		$harga=$_GET['harga'];
		$total_panjang=$_GET['total_panjang'];
		$jml_pisau=$_GET['jml_pisau'];
		$jml_mother=$_GET['jml_mother'];
		$total_berat=$_GET['total_berat'];
		$loop=$_GET['id'];
		$rumusvix = $jml_mother+1;
		echo "<input type='number' value='$rumusvix' class='form-control' id='jml_mother' readonly required name='jml_mother' >";
	}
function MinMother()
    {
		$qty=$_GET['qty'];
		$jml_mother=$_GET['jml_mother'];
		$rumusvix = $jml_mother-1;
		echo "<input type='number' value='$rumusvix' class='form-control' id='jml_mother' readonly required name='jml_mother' >";
	}
function MinHarga()
    {
		$hargadeal=$_GET['hargadeal'];
		$total_harga_penawaran=$_GET['total_harga_penawaran'];
		$rumusvix = $total_harga_penawaran-$hargadeal;
		echo "<input type='number' class='form-control' value='$rumusvix' id='total_harga_penawaran' readonly required name='total_harga_penawaran' >";
	}
function CariJPisau()
    {
		$id_customer=$_GET['id_customer'];
		$lotno=$_GET['lotno'];
		$idmaterial=$_GET['idmaterial'];
		$berat=$_GET['berat'];
		$density=$_GET['density'];
		$thickness=$_GET['thickness'];
		$lebar=$_GET['lebar'];
		$panjang=$_GET['panjang'];
		$lebarnew=$_GET['lebarnew'];
		$qty=$_GET['qty'];
		$pegangan=$_GET['pegangan'];
		$sisa=$_GET['sisa'];
		$jmlpisau=$_GET['jmlpisau'];
		$harga=$_GET['harga'];
		$total_panjang=$_GET['total_panjang'];
		$jml_pisau=$_GET['jml_pisau'];
		$jml_mother=$_GET['jml_mother'];
		$total_berat=$_GET['total_berat'];
		$loop=$_GET['id'];
		$rumusvix = $jml_pisau+$jmlpisau;
		echo "<input type='number' value='$rumusvix' class='form-control' id='jml_pisau' readonly required name='jml_pisau' >";
	}
function MinPisau()
    {
		$jmlpisaudt=$_GET['jmlpisaudt'];
		$jml_pisau=$_GET['jml_pisau'];
		$rumusvix = $jml_pisau-$jmlpisaudt;
		echo "<input type='number' value='$rumusvix' class='form-control' id='jml_pisau' readonly required name='jml_pisau' >";
	}
function CariTBProduk()
    {
		$id_customer=$_GET['id_customer'];
		$lotno=$_GET['lotno'];
		$idmaterial=$_GET['idmaterial'];
		$berat=$_GET['berat'];
		$density=$_GET['density'];
		$thickness=$_GET['thickness'];
		$lebar=$_GET['lebar'];
		$panjang=$_GET['panjang'];
		$lebarnew=$_GET['lebarnew'];
		$qty=$_GET['qty'];
		$pegangan=$_GET['pegangan'];
		$sisa=$_GET['sisa'];
		$jmlpisau=$_GET['jmlpisau'];
		$harga=$_GET['harga'];
		$total_panjang=$_GET['total_panjang'];
		$jml_pisau=$_GET['jml_pisau'];
		$jml_mother=$_GET['jml_mother'];
		$total_berat=$_GET['total_berat'];
		$loop=$_GET['id'];
		$rumus1= $berat;
		$rumusvix = $rumus1+$total_berat;
		echo "<input type='number' value='$rumusvix' class='form-control' id='total_berat' readonly required name='total_berat' >";
	}
function MinBerat()
    {

		$berat=$_GET['berat'];
		$total_berat=$_GET['total_berat'];
		$rumus1= $berat;
		$rumusvix = $total_berat-$rumus1;
		echo "<input type='number' value='$rumusvix' class='form-control' id='total_berat' readonly required name='total_berat' >";
	}
function HitungTWaktu()
    {

		$total_waktu=$_GET['total_waktu'];
		$waktu=$_GET['waktu'];
		$rumusvix = $total_waktu+$waktu;
		echo "<input type='number' value='$rumusvix' class='form-control' id='total_waktu' readonly required name='total_waktu' >";
	}
function MinTWaktu()
    {

		$total_waktu=$_GET['total_waktu'];
		$waktu=$_GET['waktu'];
		$rumusvix = $total_waktu-$waktu;
		echo "<input type='number' value='$rumusvix' class='form-control' id='total_waktu' readonly required name='total_waktu' >";
	}
function HitungWaktu()
    {
		$id_customer=$_GET['id_customer'];
		$lotno=$_GET['lotno'];
		$idmaterial=$_GET['idmaterial'];
		$berat=$_GET['berat'];
		$density=$_GET['density'];
		$thickness=$_GET['thickness'];
		$lebar=$_GET['lebar'];
		$panjang=$_GET['panjang'];
		$lebarnew=$_GET['lebarnew'];
		$qty=$_GET['qty'];
		$pegangan=$_GET['pegangan'];
		$sisa=$_GET['sisa'];
		$jmlpisau=$_GET['jmlpisau'];
		$harga=$_GET['harga'];
		$total_panjang=$_GET['total_panjang'];
		$jml_pisau=$_GET['jml_pisau'];
		$jml_mother=$_GET['jml_mother'];
		$total_berat=$_GET['total_berat'];
		$loop=$_GET['id'];
		$faktorspeed = '31,5';
		$waktugantipisau = '3';
		$waktuganticoil = '21';
		$persentasehandling = 60/100;
		$totalpisau = $jml_pisau+$jmlpisau;
		$jumlahcoil = $jml_mother+$qty;
		$tpanjang= $total_panjang*$panjang;
		
		$waktuproses= $faktorspeed*$tpanjang;
		$waktugantipisau= $totalpisau*$waktugantipisau;
		$waktuganticoil= $jumlahcoil*$waktuganticoil;
		$totalwaktuproses = $waktuproses+$waktugantipisau+$waktuganticoil;
		$handling = $totalwaktuproses*$persentasehandling;
		$totalseluruhwaktu = $totalwaktuproses+$handling;
		echo "<div class='col-md-6'>
		<div class='col-sm-12'>
		<div class='form-group row'>
			<div class='col-md-12'>
				<label for='email_customer'>Waktu Proses</label>
			</div>
		</div>
		</div>
		<div class='col-sm-12'>
		<div class='form-group row'>
			<div class='col-md-4'>
				<label for='email_customer'>Waktu Proses</label>
			</div>
			<div class='col-md-8'>
					<input type='number' value='$waktuproses' class='form-control' id='wproses' readonly required name='wproses' >
			</div>
		</div>
		</div>
		<div class='col-sm-12'>
		<div class='form-group row'>
			<div class='col-md-4'>
				<label for='email_customer'>Setting Pisau</label>
			</div>
			<div class='col-md-8'>
					<input type='number' value='$waktugantipisau' class='form-control' id='spisau' readonly required name='spisau' >
			</div>
		</div>
		</div>
				<div class='col-sm-12'>
		<div class='form-group row'>
			<div class='col-md-4'>
				<label for='email_customer'>Ganti Coil dan Pengecekan</label>
			</div>
			<div class='col-md-8'>
					<input type='number' value='$waktuganticoil' class='form-control' id='gcoil' readonly required name='gcoil' >
			</div>
		</div>
		</div>
						<div class='col-sm-12'>
		<div class='form-group row'>
			<div class='col-md-4'>
				<label for='email_customer'>Total Waktu Proses</label>
			</div>
			<div class='col-md-8'>
					<input type='number' value='$totalwaktuproses' class='form-control' id='twproses' readonly required name='twproses' >
			</div>
		</div>
		</div>
		<div class='col-sm-12'>
		<div class='form-group row'>
			<div class='col-md-4'>
				<label for='email_customer'>Handling</label>
			</div>
			<div class='col-md-8'>
					<input type='number' value='$handling' class='form-control' id='handling' readonly required name='handling' >
			</div>
		</div>
		</div>
		<div class='col-sm-12'>
		<div class='form-group row'>
			<div class='col-md-4'>
				<label for='email_customer'>Total Waktu</label>
			</div>
			<div class='col-md-8'>
					<input type='number' value='$totalseluruhwaktu' class='form-control' id='twaktu' readonly required name='twaktu' >
			</div>
		</div>
		</div>
		</div>";
	}

  public function get_add(){
		$id 			= $this->uri->segment(3);
		$id_suplier 	= $this->uri->segment(4);
		$no 	= 0;
		$listpo = $this->db->query("SELECT * FROM tr_purchase_order WHERE id_suplier='".$id_suplier."' ")->result();
		// echo $qListResin; exit;
		$d_Header = "";
		// $d_Header .= "<tr>";
		$d_Header .= "<tr class='header_".$id."' id='trhead_".$id."'>";
		$d_Header .= "<td><select id='dt_nopo_".$id."' class='form-control input-md chosen-select' name='dt[".$id."][no_po]' required>";
		$d_Header .= "<option value=''>--Pilih--</option>";
					foreach ($listpo as $listpo){
		$d_Header .= "<option value='".$listpo->no_po."' >".$listpo->no_surat."</option>";
					};
		$d_Header .= "</select></td>";
		$d_Header .= "<td colspan='8'></td>";
		$d_Header .= "<td><button type='button' class='btn btn-sm btn-danger delPart' title='Delete Part'><i class='fa fa-close'></i></button>";
		$d_Header .= "</td>";
		$d_Header .= "</tr>";

		//add nya
		$d_Header .= "<tr id='add_".$id."_".$no."' class='header_".$id."'>";
			$d_Header .= "<td align='center'></td>";
			$d_Header .= "<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type='button' class='btn btn-sm btn-primary addSubPart' title='Add'><i class='fa fa-plus'></i>&nbsp;&nbsp;Add Material</button></td>";
			$d_Header .= "<td colspan='10' align='center'></td>";
		$d_Header .= "</tr>";

		//add part
		$d_Header .= "<tr id='add_".$id."'>";
			$d_Header .= "<td align='center'></td>";
			$d_Header .= "<td align='left'><button type='button' class='btn btn-sm btn-warning addPart' title='Add'><i class='fa fa-plus'></i>&nbsp;&nbsp;Add</button></td>";
			$d_Header .= "<td colspan='10' align='center'></td>";
		$d_Header .= "</tr>";

		 echo json_encode(array(
				'header'			=> $d_Header,
		 ));
	}

  public function get_add_sub(){
		$id 	= $this->uri->segment(3);
		$no 	= $this->uri->segment(4);
		$no_po 	= $this->uri->segment(5);
		$material = $this->db->query("SELECT * FROM dt_trans_po WHERE no_po = '".$no_po."'  ")->result();
		foreach($material as $material){
		$no++;
	$d_Header = "";
	$d_Header .= "<tr class='header_".$id."' id='header_".$id."_".$no."'>";
	$d_Header .= "<th></th>";
	$d_Header .= "<th				hidden	><input  type='text' 		value='".$material->id_dt_po."'		class='form-control' id='dt_iddtpo_".$id."_".$no."' 			required name='dt[".$id."][detail][".$no."][iddtpo]' 	readonly></th>";
	$d_Header .= "<th				hidden	><input  type='text' 		value='".$material->idmaterial."'	class='form-control' id='dt_idmaterial_".$id."_".$no."' 		required name='dt[".$id."][detail][".$no."][idmaterial]' 	readonly></th>";
	$d_Header .= "<th						><input  type='text' 		value='".$material->namamaterial."'	class='form-control' id='dt_namamaterial_".$id."_".$no."' 	required name='dt[".$id."][detail][".$no."][namamaterial]' readonly></th>";
	$d_Header .= "<th						><input  type='date' 		value='".$tanggal."'				class='form-control' id='dt_tanggal_".$id."_".$no."' 			required name='dt[".$id."][detail][".$no."][tanggal]' ></th>";
	$d_Header .= "<th						><input  type='text' 		value='".$material->panjang."'		class='form-control' id='dt_length_".$id."_".$no."' 			required name='dt[".$id."][detail][".$no."][length]' 		readonly></th>";
	$d_Header .= "<th						><input  type='number' 		value='".$material->lebar."'		class='form-control' id='dt_width_".$id."_".$no."' 			required name='dt[".$id."][detail][".$no."][width]'  		readonly></th>";
	$d_Header .= "<th						><input  type='number' 		value='".$material->width."'		class='form-control' id='dt_weight_".$id."_".$no."' 			required name='dt[".$id."][detail][".$no."][weight]' 		readonly></th>";
	$d_Header .= "<th						><input  type='number' 		value='".$material->qty."'				class='form-control' id='dt_qtyorder_".$id."_".$no."' 		required name='dt[".$id."][detail][".$no."][qtyorder]'     readonly></th>";
	$d_Header .= "<th						><input  type='number' 											class='form-control' id='dt_qtyrecive_".$id."_".$no."' 		required name='dt[".$id."][detail][".$no."][qtyrecive]' 	></th>";
	$d_Header .= "<th						><input  type='text' 											class='form-control' id='dt_lotno_".$id."_".$no."' 			required name='dt[".$id."][detail][".$no."][loto]' 		></th>";
	$d_Header .= "<td align='center'><button type='button' class='btn btn-sm btn-danger cancelSubPart' title='Delete Part'><i class='fa fa-close'></i></button></td>";
	$d_Header .= "</tr>";
	$d_Header .= "<td colspan='7' align='center'></td>";
	$d_Header .= "<tr id='add_".$id."_".$no."' class='header_".$id."'>";
	$d_Header .= "<td align='center'></td>";
	$d_Header .= "<td align='left'><button type='button' class='btn btn-sm btn-primary addSubPart' title='Add'><i class='fa fa-plus'></i>Add Material</button></td>";
	$d_Header .= "<td colspan='10' align='center'></td>";
	$d_Header .= "</tr>";
	}
		 echo json_encode(array(
				'header'			=> $d_Header,
		 ));

  }



function carilength2dt()
    {
		$id			=$_GET['id']; 
		$id2		=$_GET['id2']; 		
		$nopo		=$_GET['nopo'];
		$purchase	= $this->db->query("SELECT * FROM dt_trans_po WHERE id_dt_po = '".$nopo."' ")->result();
		echo "".$purchase[0]->panjang."";
	}
	
function SubSisaKg()
    {
		$id			=$_GET['id'];       
		$mainberat	=$_GET['mainberat'];
		$mainused	=$_GET['mainused'];
		$subberat	=$_GET['subberat'];
		$rumus1 	=$mainused+$subberat;
		$rumusfinal =$mainberat-$rumus1;
	
		echo "<input type='text' onkeyup='HitungPanjang(".$id.")' value='".$rumusfinal."' readonly placeholder='Used' class='form-control input-md maskM' id='dt_sisakg_".$id."' required name='dt[".$id."][sisakg]' >";
	}
function MinusSubUsed()
    {
		$id			=$_GET['id'];       
		$mainberat	=$_GET['mainberat'];
		$mainused	=$_GET['mainused'];
		$subberat	=$_GET['subberat'];
		$rumusfinal	=$mainused-$subberat; 
	
		echo "<input type='text' onkeyup='HitungPanjang(".$id.")' value='".$rumusfinal."' readonly placeholder='Used' class='form-control input-md maskM' id='dt_used_".$id."' required name='dt[".$id."][used]' >";
	}

function MinusSubSisaKg()
    {
		$id			=$_GET['id'];       
		$mainberat	=$_GET['mainberat'];
		$mainused	=$_GET['mainused'];
		$subberat	=$_GET['subberat'];
		$rumus1 	=$mainused-$subberat;
		$rumusfinal =$mainberat-$rumus1;
	
		echo "<input type='text' onkeyup='HitungPanjang(".$id.")' value='".$rumusfinal."' readonly placeholder='Used' class='form-control input-md maskM' id='dt_sisakg_".$id."' required name='dt[".$id."][sisakg]' >";
	}
function HitungSubPisauSatuan()
    {
		$id			=$_GET['id'];       
		$mainqty	=$_GET['mainqty'];
		$subqty		=$_GET['subqty'];
		$qty		=$subqty+$mainqty;
		$rumus1		=2*$qty;
		$rumusfinal	=$rumus1+2;
		
		echo "<input type='text' onkeyup='HitungPanjang(".$id.")' value='".$rumusfinal."' readonly placeholder='Pisau' class='form-control input-md maskM' id='dt_jmlpisau_".$id."' required name='dt[".$id."][jmlpisau]' >";
	}
function MinusSubPisauSatuan()
    {
		$id			=$_GET['id'];       
		$mainqty	=$_GET['mainqty'];
		$subqty		=$_GET['subqty'];
		$qty		=$subqty-$mainqty;
		$rumus1		=2*$qty;
		$rumusfinal	=$rumus1+2;
		
		echo "<input type='text' onkeyup='HitungPanjang(".$id.")' value='".$rumusfinal."' readonly placeholder='Pisau' class='form-control input-md maskM' id='dt_jmlpisau_".$id."' required name='dt[".$id."][jmlpisau]' >";
	}
function HitungPisauSatuan()
    {
		$id			=$_GET['id'];       
		$qty		=$_GET['qty'];
		$rumus1		=2*$qty;
		$rumusfinal	=$rumus1+2;
		
		echo "<input type='text' onkeyup='HitungPanjang(".$id.")' value='".$rumusfinal."' readonly placeholder='Piau' class='form-control input-md maskM' id='dt_jmlpisau_".$id."' required name='dt[".$id."][jmlpisau]' >";
	}
function HitungHargaSatuan()
    {
		$id				=$_GET['id'];       
		$panjang		=$_GET['panjang'];
		$jmlpisau		=$_GET['jmlpisau'];
		$pisau	= $this->db->query("SELECT * FROM cycletime_detail WHERE id_costcenter = 'B2000011-1' ")->result();
		$settingpisau = $pisau[0]->cycletime;
		$mother	= $this->db->query("SELECT * FROM cycletime_detail WHERE id_costcenter = 'B2000011-2' ")->result();
		$settingmother = $mother[0]->cycletime;
		$fspeed	= $this->db->query("SELECT * FROM cycletime_detail WHERE id_costcenter = 'B2000011-4' ")->result();
		$faktorspeed = $fspeed[0]->cycletime;
		$bpermenit	= $this->db->query("SELECT sum(presentase_rate) as totalbiaya FROM ms_rate_slitting")->result();
		$persen			=60/100;
		$rumus1			=$panjang*$faktorspeed;
		$rumus2			=$jmlpisau*$settingpisau;
		$rumus3			=$rumus1+$rumus2+$settingmother;
		$rumus4			=$rumus3*$persen;
		$rumus5			=$rumus3+$rumus4;
		$biayapermenit	=$bpermenit[0]->totalbiaya;
		$rumusfinal		=$rumus5*$biayapermenit;
		
		echo "<input type='number' onkeyup='HitungPanjang(".$id.")' value='".$rumusfinal."' readonly placeholder='Harga' class='form-control input-md' id='dt_harga_".$id."' required name='dt[".$id."][harga]' >";
	}
function HitungTotalPanjangSatuan()
    {
		$id				=$_GET['id'];       
		$panjang		=$_GET['panjang'];
		$jmlpisau		=$_GET['jmlpisau'];
		$profit			=$_GET['profit']/100;
		$persen			=60/100;
		$rumus1			=$panjang*31.5;
		$rumus2			=$jmlpisau*3;
		$rumus3			=$rumus1+$rumus2+21;
		$rumus4			=$rumus3*$persen;
		$rumus5			=$rumus3+$rumus4;
		$biayapermenit	=3890;
		$rumus6			=$rumus5*$biayapermenit;
		$rumus7			=$rumus6*$profit;
		$rumus8			=$rumus6+$rumus7;
		$rumusfinal=$rumus6+$rumus7;
		echo "<input type='number' onkeyup='HitungPanjang(".$id.")' value='".$rumusfinal."' readonly placeholder='Pisau' class='form-control input-md maskM' id='dt_totalpenawaran_".$id."' required name='dt[".$id."][totalpenawaran]' >";
	}
function HitungWaktuSatuan()
    {
		$id=$_GET['id'];       
		 $panjang=$_GET['panjang'];
		 $jmlpisau=$_GET['jmlpisau'];
		$pisau	= $this->db->query("SELECT * FROM cycletime_detail WHERE id_costcenter = 'B2000011-1' ")->result();
		$settingpisau = $pisau[0]->cycletime;
		$mother	= $this->db->query("SELECT * FROM cycletime_detail WHERE id_costcenter = 'B2000011-2' ")->result();
		$settingmother = $mother[0]->cycletime;
		$fspeed	= $this->db->query("SELECT * FROM cycletime_detail WHERE id_costcenter = 'B2000011-4' ")->result();
		$faktorspeed = $fspeed[0]->cycletime;
		$bpermenit	= $this->db->query("SELECT sum(presentase_rate) as totalbiaya FROM ms_rate_slitting")->result();
		$persen			=60/100;
		$rumus1			=$panjang*$faktorspeed;
		$rumus2			=$jmlpisau*$settingpisau;
		$rumus3			=$rumus1+$rumus2+$settingmother;
		$rumus4			=$rumus3*$persen;
		$rumusfinal=$rumus3+$rumus4;
		echo "<input type='text' onkeyup='HitungPanjang(".$id.")' value='".$rumusfinal."' readonly placeholder='Waktu' class='form-control input-md maskM' id='dt_waktu_".$id."' required name='dt[".$id."][waktu]' >";
	}
function HitungHargaaSatuan()
    {
		$id				=$_GET['id'];       
		$panjang		=$_GET['panjang'];
		$jmlpisau		=$_GET['jmlpisau'];
		$pisau	= $this->db->query("SELECT * FROM cycletime_detail WHERE id_costcenter = 'B2000011-1' ")->result();
		$settingpisau = $pisau[0]->cycletime;
		$mother	= $this->db->query("SELECT * FROM cycletime_detail WHERE id_costcenter = 'B2000011-2' ")->result();
		$settingmother = $mother[0]->cycletime;
		$fspeed	= $this->db->query("SELECT * FROM cycletime_detail WHERE id_costcenter = 'B2000011-4' ")->result();
		$faktorspeed = $fspeed[0]->cycletime;
		$bpermenit	= $this->db->query("SELECT sum(presentase_rate) as totalbiaya FROM ms_rate_slitting")->result();
		$persen			=60/100;
		$rumus1			=$panjang*$faktorspeed;
		$rumus2			=$jmlpisau*$settingpisau;
		$rumus3			=$rumus1+$rumus2+$settingmother;
		$rumus4			=$rumus3*$persen;
		$rumus5			=$rumus3+$rumus4;
		$biayapermenit	=$bpermenit[0]->totalbiaya;
		$rumusfinal		=$rumus5*$biayapermenit;
		
		echo "<input type='number' onkeyup='HitungPanjang(".$id.")' value='".$rumusfinal."' readonly placeholder='Harga' class='form-control input-md' id='dt_harga_".$id."' required name='dt[".$id."][harga]' >";
	}
function hitungsubwidth()
    {
		$id=$_GET['id'];
		$no=$_GET['id2']; 		
		$mainwidth=$_GET['mainwidth'];
		$subwidth=$_GET['subwidth'];
		$subqty=$_GET['subqty'];
		$subbaru=$subwidth*$subqty;
		$rumusfinal= number_format($mainwidth+$subbaru,2);
		echo "<input type='text' onkeyup='HitungPanjang(".$id.")' value='".$rumusfinal."' readonly placeholder='Width' class='form-control input-md maskM' id='dt_lebarnew_".$id."' required name='dt[".$id."][lebarnew]' >";
	}
function minussubwidth()
    {
		$id=$_GET['id'];
		$no=$_GET['id2']; 		
		$mainwidth=$_GET['mainwidth'];
		$subwidth=$_GET['subwidth'];
		$subqty=$_GET['subqty'];
		$subbaru=$subwidth*$subqty;
		$rumusfinal= number_format($mainwidth-$subbaru,2);
		echo "<input type='text' onkeyup='HitungPanjang(".$id.")' value='".$rumusfinal."' readonly placeholder='Width' class='form-control input-md maskM' id='dt_lebarnew_".$id."' required name='dt[".$id."][lebarnew]' >";
	}
function KunciSub()
    {
		$id=$_GET['id'];
		$no=$_GET['id2']; 		
		$subqty=$_GET['subqty'];
		$subwidth=$_GET['subwidth'];
		$subberat=$_GET['subberat'];
		$subberatreq=$_GET['subberatreq'];
		$subqcoil=$_GET['subqcoil'];
		echo"<td align='left'>Width (mm)</td>
        <td align='left'>
        <input type='number' value='".$subwidth."' name='dt[".$id."][detail][".$no."][subwidth]' readonly class='form-control input-md' placeholder='Width'  id='subwidth_".$id."_".$no."' '>
				</td>
        <td align='left'>Qty Coil</td>
        <td align='left'>
        <input type='number' value='".$subqty."' name='dt[".$id."][detail][".$no."][subqty]' readonly class='form-control input-md' placeholder='Qty'   id='subqty_".$id."_".$no."' >
        </td>
		<td align='left'>Weight</td>
        <td align='left'>
        <input type='number' value='".$subberat."' name='dt[".$id."][detail][".$no."][subberat]' readonly class='form-control input-md' placeholder='Berat'   id='subberat_".$id."_".$no."' >
        </td>
		<td align='left'>Weight Request</td>
        <td align='left'>
        <input type='number' value='".$subberatreq."' readonly name='dt[".$id."][detail][".$no."][beratreq]' class='form-control input-md formsubagain' placeholder='berat request'   id='subberatreq_".$id."_".$no."' >
        </td>
		<td align='left'>Qty Coil</td>
        <td align='left'>
        <input type='number' value='".$subqcoil."' readonly name='dt[".$id."][detail][".$no."][qcoil]' class='form-control input-md' placeholder='berat request'   id='subqcoil_".$id."_".$no."' >
        </td>
		<td align='center'>
		<button type='button' class='btn btn-sm btn-danger cancelSubPart' title='Delete Part'><i class='fa fa-close'></i></button>
		</td>";
	}
function hitungsubqty()
    {
		$id=$_GET['id'];
		$no=$_GET['id2']; 		
		$mainqty=$_GET['mainqty'];
		$subqty=$_GET['subqty'];
		$rumusfinal= number_format($mainqty+$subqty,2);
		echo "<input type='text' onkeyup='HitungPanjang(".$id.")' value='".$rumusfinal."' readonly placeholder='Qty' class='form-control input-md maskM' id='dt_qty_".$id."' required name='dt[".$id."][qty]' >";
	}
function minussubqty()
    {
		$id=$_GET['id'];
		$no=$_GET['id2']; 		
		$mainqty=$_GET['mainqty'];
		$subqty=$_GET['subqty'];
		$rumusfinal= number_format($mainqty-$subqty,2);
		echo "<input type='text' onkeyup='HitungPanjang(".$id.")' value='".$rumusfinal."' readonly placeholder='Qty' class='form-control input-md maskM' id='dt_qty_".$id."' required name='dt[".$id."][qty]' >";
	}
function HitungPegangan()
    {
		$id=$_GET['id'];       
	   $thickness=$_GET['thickness'];
		if($thickness>0.2){
			$rumus = '1';
		}else{
			$rumus = '2';
		}
		echo "<input type='text' onkeyup='HitungPanjang(".$id.")' value='".$rumus."' readonly placeholder='pegangan' class='form-control input-md maskM' id='dt_pegangan_".$id."' required name='dt[".$id."][pegangan]' >";
	}
function HitungPanjang()
    {
        $berat=$_GET['berat'];
		if(empty($berat)){
			$berat1 = '1';
		}else{
			$berat1 = $berat;
		}
		$density=$_GET['density'];
		if(empty($density)){
			$density1 = '1';
		}else{
			$density1 = $density;
		}
		$thickness=$_GET['thickness'];
		if(empty($thickness)){
			$thickness1 = '1';
		}else{
			$thickness1 = $thickness;
		}
		$lebar=$_GET['lebar'];
		if(empty($lebar)){
			$lebar1 = '1';
		}else{
			$lebar1 = $lebar; 
		}
		$id=$_GET['id'];
		$rumus1 = $density1*$thickness1*$lebar1;
		$rumus_final= number_format($berat1/$rumus1*1000,2);
		echo "<input type='text' onkeyup='HitungPanjang(".$id.")' value='".$rumus_final."' readonly placeholder='Length' class='form-control input-md maskM' id='dt_panjang_".$id."' required name='dt[".$id."][panjang]' >";
	}
  public function SaveNew(){
		$Arr_Kembali	= array();
		$code = $this->Slitting_model->generate_code();
		$id_data = $this->Slitting_model->BuatID();
		$no_surat = $this->Slitting_model->BuatNomor();
		$data			= $this->input->post();
		$session 		= $this->session->userdata('app_session');
    $Detail 	= $data['dt'];
    $ArrHeader	 = [
							'id_data'			=> $id_data,
							'id_incoming'		=> $no_surat,
							'id_suplier'		=> $post['id_suplier'],
							'id_gudang'			=> $post['id_gudang'],
							'tanggal'			=> $post['tanggal'],
							'pic'				=> $post['pic'],
							'pib'				=> $post['pib'],
							'no_invoice'		=> $post['no_invoice'],
							'keterangan'		=> $post['ket']
                            ]; 
    $ArrDetail	= array();
    $ArrDetail2	= array();
    foreach($Detail AS $val => $valx){
      $urut				= sprintf('%02s',$val);
							$ArrDetail[$val]['id_data']				= $id_data;
							$ArrDetail[$val]['id_incoming']			= $no_surat;
							$ArrDetail[$val]['id_detail_incoming']	= $id_data.'-'.$urut;
							$ArrDetail[$val]['no_po']				= $valx['no_po'];
      foreach($valx['detail'] AS $val2 => $valx2){
			$ArrDetail2[$val2.$val]['id_data']				= $id_data;
			$ArrDetail2[$val2.$val]['id_incoming']			= $no_surat;
			$ArrDetail2[$val2.$val]['id_detail_incoming']	= $code.'-'.$urut;
			$ArrDetail2[$val2.$val]['id_material'] 			= $valx2['id_material'];
			$ArrDetail2[$val2.$val]['nama_material'] 		= $valx2['nama_material'];
			$ArrDetail2[$val2.$val]['length'] 				= $valx2['length'];
			$ArrDetail2[$val2.$val]['width'] 				= $valx2['width'];
			$ArrDetail2[$val2.$val]['weight'] 				= $valx2['weight'];
			$ArrDetail2[$val2.$val]['qty_order'] 			= $valx2['qty_order'];
			$ArrDetail2[$val2.$val]['qty_recive'] 			= $valx2['qty_recive'];
			$ArrDetail2[$val2.$val]['tgl_datang'] 			= $valx2['tanggal'];
			$ArrDetail2[$val2.$val]['lotno'] 				= $valx2['loto'];
      }
	       foreach($valx['detail'] AS $val2 => $valx2){
			$ArrStok[$val2.$val]['id_category3']		= $valx2['id_material'];
			$ArrStok[$val2.$val]['nama_material'] 		= $valx2['nama_material'];
			$ArrStok[$val2.$val]['lotno'] 				= $valx2['loto'];
			$ArrStok[$val2.$val]['qty'] 				= $valx2['qtyrecive'];
			$ArrStok[$val2.$val]['length'] 				= $valx2['length'];
			$ArrStok[$val2.$val]['weight'] 				= $valx2['weight'];
			$ArrStok[$val2.$val]['totalweight'] 		= $valx2['qtyrecive']*$valx2['weight'];
			$ArrStok[$val2.$val]['aktif'] 				= 'Y';
			$ArrStok[$val2.$val]['id_gudang'] 			= $post['id_gudang'];
      }
    }
	$this->db->trans_start();
			$this->db->insert('tr_penawaran_slitting', $ArrHeader);
      if(!empty($ArrDetail)){
  			$this->db->insert_batch('dt_penawaran_slitting', $ArrDetail);
      }
      if(!empty($ArrDetail)){
        $this->db->insert_batch('dt_penawaran_slitting_width', $ArrDetail2);
      }
	        if(!empty($ArrDetail)){
        $this->db->insert_batch('dt_penawaran_slitting_width', $ArrStok);
      }
		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$Arr_Data	= array(
				'pesan'		=>'Save gagal disimpan ...',
				'status'	=> 0
			);
		}
		else{
			$this->db->trans_commit();
			$Arr_Data	= array(
				'pesan'		=>'Save berhasil disimpan. Thanks ...',
				'status'	=> 1
			);
		}

		echo json_encode($Arr_Data);
	}
	public function save_edit(){
		$Arr_Kembali	= array();
		$data			= $this->input->post();
		$code 			= $data['id_slitting'];
		$no_surat 		= $data['no_surat'];
		$session 		= $this->session->userdata('app_session');
    $Detail 	= $data['dt'];
    $ArrHeader		= array(
							'id_slitting'			=> $code,
							'no_surat'				=> $no_surat,
							'tgl_penawaran'			=> date('Y-m-d'),
							'id_customer'			=> $data['id_customer'],
							'mata_uang'				=> $data['mata_uang'],
							'total_panjang'			=> $data['total_panjang'],
							'pic_customer'			=> $data['pic_cutomer'],
							'valid_until'			=> $data['valid_until'],
							'jml_pisau'				=> $data['jml_pisau'],
							'jml_mother'			=> $data['jml_mother'],
							'total_berat'			=> $data['total_berat'],
							'total_waktu'			=> $data['total_waktu'],
							'created_on'			=> date('Y-m-d H:i:s'),
							'created_by'			=> $this->auth->user_id()
    );
    $ArrDetail	= array();
    $ArrDetail2	= array();
    foreach($Detail AS $val => $valx){
      $urut				= sprintf('%02s',$val);
 							$ArrDetail[$val]['id_slitting']		    	= $code;
							$ArrDetail[$val]['id_dt_slitting']			= $code.'-'.$urut;
							$ArrDetail[$val]['idmaterial']		        = $valx['idmaterial'];
							$ArrDetail[$val]['nama_material']		    = $valx['nama_material'];
							$ArrDetail[$val]['berat']		        	= $valx['berat'];
							$ArrDetail[$val]['density']		        	= $valx['density'];
							$ArrDetail[$val]['thickness']		        = $valx['thickness'];
							$ArrDetail[$val]['lebar']					= $valx['lebar'];
							$ArrDetail[$val]['panjang']		    		= $valx['panjang'];
							$ArrDetail[$val]['lebarnew']		    	= $valx['lebarnew'];
							$ArrDetail[$val]['qty']		    			= $valx['qty'];
							$ArrDetail[$val]['pegangan']		    	= $valx['pegangan'];
							$ArrDetail[$val]['sisa']		    		= $valx['sisa'];
							$ArrDetail[$val]['used']		    		= $valx['used'];
							$ArrDetail[$val]['sisakg']		    		= $valx['sisakg'];
							$ArrDetail[$val]['harga']		    		= $valx['harga'];
							$ArrDetail[$val]['jmlpisau']		    	= $valx['jmlpisau'];
							$ArrDetail[$val]['waktu']		    		= $valx['waktu'];
							$ArrDetail[$val]['nama_material']		    = $valx['nama_material'];
							$ArrDetail[$val]['profit']		    		= $valx['profit'];
							$ArrDetail[$val]['totalpenawaran']		    = $valx['totalpenawaran'];
							$ArrDetail[$val]['hargadeal']		    	= $valx['hargadeal'];
      foreach($valx['detail'] AS $val2 => $valx2){
			$ArrDetail2[$val2.$val]['id_slitting']		= $code;
			$ArrDetail2[$val2.$val]['id_dt_slitting']	= $code.'-'.$urut;
			$ArrDetail2[$val2.$val]['subwidth'] 		= $valx2['subwidth'];
			$ArrDetail2[$val2.$val]['subqty'] 			= $valx2['subqty'];
			$ArrDetail2[$val2.$val]['subberat'] 		= $valx2['subberat'];
			$ArrDetail2[$val2.$val]['beratreq'] 		= $valx2['beratreq'];
			$ArrDetail2[$val2.$val]['qcoil'] 		= $valx2['qcoil'];
      }
    }
	$this->db->trans_start();
			$this->db->insert('tr_penawaran_slitting', $ArrHeader);
      if(!empty($ArrDetail)){
  			$this->db->insert_batch('dt_penawaran_slitting', $ArrDetail);
      }
      if(!empty($ArrDetail)){
        $this->db->insert_batch('dt_penawaran_slitting_width', $ArrDetail2);
      }
		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$Arr_Data	= array(
				'pesan'		=>'Save gagal disimpan ...',
				'status'	=> 0
			);
		}
		else{
			$this->db->trans_commit();
			$Arr_Data	= array(
				'pesan'		=>'Save berhasil disimpan. Thanks ...',
				'status'	=> 1
			);
		}

		echo json_encode($Arr_Data);
	}
	public function list_center(){
		$id = $this->uri->segment(3);
		$query	 	= "SELECT * FROM ms_costcenter WHERE id_dept='".$id."' ORDER BY nama_costcenter ASC";
		$Q_result	= $this->db->query($query)->result();
		$option 	= "<option value='0'>Select an Option</option>";
		foreach($Q_result as $row)	{
		$option .= "<option value='".$row->nama_costcenter."'>".strtoupper($row->nama_costcenter)."</option>";
		}
		echo json_encode(array(
			'option' => $option
		));
	}
	public function PrintHeader(){
		ob_clean();
		ob_start();
        $this->auth->restrict($this->managePermission);
        $id = $this->uri->segment(3);
		$data['header'] = $this->Slitting_model->get_data('tr_penawaran_slitting','id_slitting',$id);
		$data['detail']  = $this->Slitting_model->get_data('dt_penawaran_slitting','id_slitting',$id);
		$this->load->view('print',$data);
		$html = ob_get_contents();

		require_once('./assets/html2pdf/html2pdf/html2pdf.class.php');
		$html2pdf = new HTML2PDF('P','A4','en',true,'UTF-8',array(0, 0, 0, 0));
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($html);
		ob_end_clean();
		$html2pdf->Output('Penawran.pdf', 'I');
	}
  public function edit_cycletime(){

  	$Arr_Kembali	= array();
		$data			    = $this->input->post();
    // print_r($data);
    // exit;
		$session 		   = $this->session->userdata('app_session');
    $Detail 	     = $data['Detail'];
    $id_material	 = $data['id_time'];

    $ArrHeader		  = array(
      'id_time'			=> $id_material,
      'id_product'	=> $data['produk'],
      'updated_by'	=> $session['id_user'],
      'updated_date'	=> date('Y-m-d H:i:s')
    );



    $ArrDetail	= array();
    $ArrDetail2	= array();
    foreach($Detail AS $val => $valx){
      $urut				= sprintf('%02s',$val);
      $ArrDetail[$val]['id_time'] 			= $id_material;
      $ArrDetail[$val]['id_costcenter'] = $id_material."-".$urut;
      $ArrDetail[$val]['costcenter'] 		= $valx['costcenter'];
      $ArrDetail[$val]['machine'] 			= $valx['machine'];
      $ArrDetail[$val]['mould'] 				= $valx['mould'];
      foreach($valx['detail'] AS $val2 => $valx2){
        $ArrDetail2[$val2.$val]['id_time'] 			= $id_material;
        $ArrDetail2[$val2.$val]['id_costcenter'] = $id_material."-".$urut;
        $ArrDetail2[$val2.$val]['id_process'] 	= $valx2['process'];
        $ArrDetail2[$val2.$val]['cycletime'] 		= $valx2['cycletime'];
        $ArrDetail2[$val2.$val]['qty_mp'] 			= $valx2['qty_mp'];
        $ArrDetail2[$val2.$val]['note'] 				= $valx2['note'];
      }
    }

    // print_r($ArrHeader);
		// print_r($ArrDetail);
		// print_r($ArrDetail2);
		// exit;

		$this->db->trans_start();
      $this->db->where('id_time', $id_material);
			$this->db->update('cycletime_header', $ArrHeader);

      $this->db->delete('cycletime_detail_header', array('id_time' => $id_material));
      $this->db->delete('cycletime_detail_detail', array('id_time' => $id_material));

      if(!empty($ArrDetail)){
  			$this->db->insert_batch('cycletime_detail_header', $ArrDetail);
      }
      if(!empty($ArrDetail)){
        $this->db->insert_batch('cycletime_detail_detail', $ArrDetail2);
      }
		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$Arr_Data	= array(
				'pesan'		=>'Save gagal disimpan ...',
				'status'	=> 0
			);
		}
		else{
			$this->db->trans_commit();
			$Arr_Data	= array(
				'pesan'		=>'Save berhasil disimpan. Thanks ...',
				'status'	=> 1
			);
		}

		echo json_encode($Arr_Data);
	}
public function SaveNewHeader()
    {
        $this->auth->restrict($this->addPermission);
		$post = $this->input->post();
		$code = $this->Slitting_model->generate_code();
		$no_surat = $this->Slitting_model->BuatNomor();
		$this->db->trans_begin();
		$data = [
							'id_slitting'			=> $code,
							'no_surat'				=> $no_surat,
							'tgl_penawaran'			=> date('Y-m-d'),
							'id_customer'			=> $post['id_customer'],
							'mata_uang'				=> $post['mata_uang'],
							'total_panjang'			=> $post['total_panjang'],
							'pic_customer'			=> $post['pic_cutomer'],
							'valid_until'			=> $post['valid_until'],
							'jml_pisau'				=> $post['jml_pisau'],
							'jml_mother'			=> $post['jml_mother'],
							'total_berat'			=> $post['total_berat'],
							'wproses'				=> $post['wproses'],
							'spisau'				=> $post['spisau'],
							'gcoil'					=> $post['gcoil'],
							'twproses'				=> $post['twproses'],
							'total_harga_penawaran'				=> $post['total_harga_penawaran'],
							'handling'				=> $post['handling'],
							'twaktu'				=> $post['twaktu'],
							'bproses'				=> $post['bproses'],
							'ttlhgpenawaran'		=> $post['ttlhgpenawaran'],
							'hgpkgrp'				=> $post['hgpkgrp'],
							'hgpkgdl'				=> $post['hgpkgdl'],
							'created_on'			=> date('Y-m-d H:i:s'),
							'created_by'			=> $this->auth->user_id()
                            ];
            //Add Data
               $this->db->insert('tr_penawaran_slitting',$data);
 $ArrDetail	= array();
 $ArrDetail2	= array();
	    $dt 	= $data['dt'];
		$numb1 =0;
		foreach($dt AS $val => $use){
		$numb1++;
							$ArrDetail[$val]['id_slitting']		    	= $code;
							$ArrDetail[$val]['id_dt_slitting']			= $code.'-'.$numb1;
							$ArrDetail[$val]['lotno']		        	= $use['lotno'];
							$ArrDetail[$val]['idmaterial']		        = $use['idmaterial'];
							$ArrDetail[$val]['nama_material']		    = $use['nama_material'];
							$ArrDetail[$val]['berat']		        	= $use['berat'];
							$ArrDetail[$val]['density']		        	= $use['density'];
							$ArrDetail[$val]['thickness']		        = $use['thickness'];
							$ArrDetail[$val]['lebar']					= $use['lebar'];
							$ArrDetail[$val]['panjang']		    		= $use['panjang'];
							$ArrDetail[$val]['lebarnew']		    	= $use['lebarnew'];
							$ArrDetail[$val]['qty']		    			= $use['qty'];
							$ArrDetail[$val]['pegangan']		    	= $use['pegangan'];
							$ArrDetail[$val]['sisa']		    		= $use['sisa'];
							$ArrDetail[$val]['harga']		    		= $use['harga'];
							$ArrDetail[$val]['jmlpisau']		    	= $use['jmlpisau'];
							$ArrDetail[$val]['waktu']		    		= $use['waktu'];
							$ArrDetail[$val]['nama_material']		    = $use['nama_material'];
							$ArrDetail[$val]['profit']		    		= $use['profit'];
							$ArrDetail[$val]['totalpenawaran']		    = $use['totalpenawaran'];
							$ArrDetail[$val]['hargadeal']		    	= $use['hargadeal'];
								foreach($use['detail'] AS $val2 => $valx2){
									$ArrDetail2[$val2.$val]['id_slitting']		= $code;
									$ArrDetail2[$val2.$val]['id_dt_slitting']	= $code.'-'.$numb1;
									$ArrDetail2[$val2.$val]['subwidth'] 		= $valx2['subwidth'];
									$ArrDetail2[$val2.$val]['subqty'] 			= $valx2['subqty'];
								  }
			
		    }
		
                    $this->db->insert('dt_penawaran_slitting',$ArrDetail);
					$this->db->insert('dt_penawaran_slitting_width',$ArrDetail2);
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

  public function delete_cycletime(){

  	$Arr_Kembali	= array();
		$data			    = $this->input->post();
    // print_r($data);
    // exit;
		$session 		   = $this->session->userdata('app_session');
    $id_material	 = $data['id'];

    $ArrHeader		  = array(
      'deleted'			=> "Y",
      'deleted_by'	=> $session['id_user'],
      'deleted_date'	=> date('Y-m-d H:i:s')
    );

		$this->db->trans_start();
      $this->db->where('id_time', $id_material);
			$this->db->update('cycletime_header', $ArrHeader);
		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$Arr_Data	= array(
				'pesan'		=>'Delete gagal disimpan ...',
				'status'	=> 0
			);
		}
		else{
			$this->db->trans_commit();
			$Arr_Data	= array(
				'pesan'		=>'Delete berhasil disimpan. Thanks ...',
				'status'	=> 1
			);
		}

		echo json_encode($Arr_Data);
	}

}

?>
