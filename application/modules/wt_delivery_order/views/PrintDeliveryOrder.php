<html>
<head>
  <title>Cetak PDF</title>
<style>
    #tables td, th {
		border: 1px solid grey;
        padding: 0 px;
		font-size: 12px;
		border-collapse: collapse;
    } 
	.clearth{
		border: 0px;
		border-collapse: collapse;
	}
</style>
</head>
<body>
<?php
	foreach($header as $header){
	} 
?>
<table border="0px" cellspacing="0" width='100%' valign="top">
    <tr>
        <td align="left"width="70%" valign="top" >
            <img src='<?=$_SERVER['DOCUMENT_ROOT'];?>/demo_erp/assets/images/logo_waterco.png' alt="" height='100' width='250'>
        </td>
        <td align="right" valign="top" width="30%">
			<br>
            PT WATERCO INDONESIA<br>
            Inkopal Plaza Kelapa Gading Blok B, No.31-32 <br> 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Jl. Boulevard Barat Kelapa Gading Jakarta Utara 14240<br>
            Email:anyimdede18@gmail.com/anyim.dede@waterco.co.id<br>
            Telp. 021-45851480 Hp. 08179113323, 081384388864
        </td>
    </tr>
</table>
<hr>

<h5 align="center">DELIVERY ORDER</h5>
<?php
$customer =$this->db->query("SELECT * FROM master_customers WHERE id_customer='$header->id_customer'")->row();
$top =$this->db->query("SELECT * FROM ms_top WHERE id_top='$header->top'")->row();

$tgl=$header->tgl_do;
?>
<table border="0" width='100%' align="left">

<tr>
	<td width="350" align="left">
	<table>
	
	<tr>
		<td align='left'>Date</td><td align='left'>:</td><td align='left'><?= date('d-F-Y', strtotime($header->tgl_do)) ?></td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left' width="150">Kepada Yth.</td>
    </tr>
	<tr>
		<td align='left'>No DO.</td><td align='left'>:</td><td align='left'><?= $header->no_surat?></td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left' width="150"><?=$customer->name_customer?></td>
	</tr>
	<tr>
		<td align='left'>No SPPB.</td><td align='left'>:</td><td align='left'></td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left' width="150"><?=ucwords(strtolower($customer->address_office))?></td>
	</tr>
	<tr>
		<td align='left'>No PO.</td><td align='left'>:</td><td align='left'></td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left' width="150">Att.&nbsp; Bpk/Ibu.<?=$header->pic_customer?></td>
	</tr>
	
	<tr>
		<td align='left'></td><td align='left'></td><td align='left'></td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left' width="150">Telp.&nbsp; <?=$customer->telephone?></td>
	</tr>
	<tr>
		<td align='left'></td><td align='left'></td><td align='left'></td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align='left' width="150"></td>
	</tr>
	</table>
</td>	
</tr>
</table>

<br>
    <table id="tables" border="0" width='100%' align="left">
	<thead>
			<tr height = '60'>
            <th align="center" width="20">No</th>
			<th align="center" width="350">Produk</th>
			<th align="center" width="30">Qty</th>
			<th align="center" width="150">Serial Number</th>
			<th align="center" width="150">No Kartu Garansi</th>
			</tr>
			<tr></tr>

	</thead>    
	<tbody>
			<?	
               $n0 =0;
               foreach($detail as $detail){
				$no++;
			?>
			<tr>
            <td align="center"><?= $no ?></td>
			<td align="left">&nbsp;<?= $detail->nama_produk ?></td>
			<td align="center"><?= number_format($detail->qty_delivery) ?></td>
			<td align="left"><?= $detail->serial_number ?></td>
			<td align="left"><?= $detail->kartu_garansi ?></td>
			</tr>
			<?}?>
	</tbody>
            

</table>



<table border="0" width='100%' align="left">
    <tr>

        <td width="200" align="left"><br><br>
        <table>
        <tr><td align='center'>Dibuat Oleh,</td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='center'><u><?='(-------------------------)'?></u> </td></tr>
        <tr><td align='center'></td></tr>	
        </table>
        </td>
        <td width="200" align="left"><br><br>
        <table>
        <tr><td align='center'>Menyetujui</td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='center'><u><?='(-------------------------)'?></u></td></tr>
        <tr><td align='center'></td></tr>	
        </table>
        </td>
        <td width="200" align="left"><br><br>
        <table>
        <tr><td align='center'>Ekspedisi</td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='center'><u><?='(-------------------------)'?></u></td></tr>
        <tr><td align='center'></td></tr>	
        </table>
        </td>
        <table>
        <tr><td align='center' border='0.2'>Barang diterima dengan baik &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td></tr>
        </table>
        <td width="200" align="left"><br><br>
        <table>
        <tr><td align='center'>Diterima Oleh</td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='right'></td></tr>
        <tr><td align='center'><u><?='(-------------------------)'?></u></td></tr>
        <tr><td align='center'></td></tr>	
        </table>
        </td>    
    </tr>
    <tr>
        <td width="800" align="left"><br><br>
        <table border='0.2'>
        <tr><td align='center'>CATATAN : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <br><br><br></td></tr>
        </table>
        </td>
    </tr>
</table>


