
<!--
<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
-->
<link href="<?php echo base_url();?>assets/css/mpdf-bootstrap.css" rel="stylesheet" type="text/css">
	
<?php
	$no_transaksi	= antixss(dekrip($this->uri->segment(4)));
	
	$strans			= $this->db->query("SELECT a.*, RIGHT(a.tgl_transaksi, 8) AS jam_transaksi, d.`nama` AS nm_admin FROM trans a LEFT JOIN pengguna d ON a.`useradd` = d.`no_register` WHERE a.jenis = 'apotik' AND a.no_transaksi = '".$no_transaksi."'");
	$htrans				= $strans->num_rows();
	if(empty($no_transaksi) || $htrans == 0){
		echo"Tidak ada data untuk dicetak...";
	}else{
		$dtrans			= $strans->result_array();

		include"global/phpqrcode/qrlib.php";
		QRCode::png(base_url()."cekdok/kuitansi-transapotik/".enkrip($no_transaksi),"qrcode/kuitansi-transapotik-".$no_transaksi,"Q",4,2);
		
		
		include'public/inc/pdf/kop1.php';
		$header 		= $kopganteng;
		$margin_top		= 20;
		$margin_right	= 5;
		$margin_left	= 5;					
?>

<style>
	.area_gendeng{
		padding:0px 0px;
	}
	
	.tabel_kosong{
		width:100%;
	}
	.tabel_kosong td{
		padding-top:10px;
	}
	.ttd_wong{
		padding-left:320px;
	}
	
	.tabel_gendeng{
		font-size:9pt;
		width:100%;
	}
	.tabel_gendeng th{
		border-color:#000;
		border-width:1px;
	}
	.tabel_gendeng td{
		border-color:#000;
		border-width:1px;
		padding: 2px 0px;
	}
	.table tbody tr td{
		padding:4px 10px;
	}
	
	
	.detail_duit{
		border-top:0px;
	}
	

	/* mulai untuk header */
	.daleman_header{
		width:100%;
		margin-top:-50px;
		margin-bottom:0px;
	}
	.daleman_header h3{
		text-transform:uppercase;
		font-size:15px;
		font-weight:bold;
		margin:0px;
	}
	.daleman_header h2{
		text-transform:uppercase;
		font-size:17px;
		font-weight:bold;
		margin:0px;
	}
	.daleman_header h1{
		text-transform:uppercase;
		font-size:34px;
		font-weight:bold;
		margin:0px;
	}
	.daleman_header h5{
		font-size:12px;
		margin:0px;
	}
</style>


<!--
<div style="border-bottom:2px solid #302C2C;margin-bottom:5px;"></div>
-->

<div class="area_gendeng">

	<div class="" style="width:100%;border-bottom:2px solid #000;padding-bottom:4px;">
		<div style="font-size:16px;float:left;width:49%;font-weight:bold;">KUITANSI PEMBAYARAN</div>
		<div style="font-size:12px;float:right;text-align:right;width:49%;font-weight:bold;padding-top:3px;" class="text-danger">#<?php echo $no_transaksi;?></div>
	</div>

	
	<div style="font-size:11px;text-align:right;padding:5px 0px;">
		<b><?php echo tgl_indo($dtrans[0]['tgl_transaksi'],"a")." ".$dtrans[0]['jam_transaksi'];?></b>
	</div>
	

	
	<table class="table tabel_gendeng" style="margin-bottom:0px;">
		<thead>
			
		</thead>
		<tbody>
			<tr>
				<th class='bg-dark text-center' style="width:40px;background:#000;color:#fff;">#</th>
				<th class='bg-dark' style="background:#000;color:#fff;">Item</th>
				<th class='bg-dark text-right' style="background:#000;color:#fff;">@Harga</th>
				<th class='bg-dark text-center' style="background:#000;color:#fff;">QTY</th>
				<th class='bg-dark text-right' style="background:#000;color:#fff;">Total</th>
			</tr>
			<?php
				$nodata		= 1;
				$total_obat	= 0;
				$sdata		= $this->db->query("SELECT a.*, b.no_obat, b.nm_obat FROM trans_obat a LEFT JOIN obat b ON a.id_obat = b.id_obat WHERE a.no_transaksi = '".$no_transaksi."'");
				foreach($sdata->result_array() as $ddata){
					echo"
						<tr>
							<td class='text-center'>".$nodata.".</td>
							<td>
								".$ddata['nm_obat']."
							</td>
							<td class='text-right'>".rupiah($ddata['harga_satuan']).",-</td>
							<td class='text-center'>".$ddata['qty']."</td>
							<td class='text-right'>".rupiah($ddata['total_harga']).",-</td>
						</tr>
					";
					$total_obat	= $total_obat + $ddata['total_harga'];
					$nodata++;
				}
			?>
			
			<tr>
				<td rowspan="5" colspan="2">
					
				</td>
				<td class="text-right" style="">Total</td>
				<td class="text-left" style="width:50px;">: Rp</td>
				<td class="text-right" style="width:130px;"><?php echo rupiah($dtrans[0]['total_kotor']);?>,-</td>
			</tr>
			<tr>
				<td class="text-right" style="border-top:0px;">Potongan</td>
				<td class="text-left" style="width:50px;border-top:0px;">: Rp</td>
				<td class="text-right" style="width:130px;border-top:0px;"><?php echo rupiah($dtrans[0]['potongan']);?>,-</td>
			</tr>
			<tr>
				<td class="text-right" style="border-top:0px;"><b>Grand Total</b></td>
				<td class="text-left" style="width:50px;border-top:0px;"><b>: Rp</b></td>
				<td class="text-right text-danger" style="width:130px;border-top:0px;"><b><?php echo rupiah($dtrans[0]['total_bersih']);?>,-</b></td>
			</tr>
			<tr>
				<td class="text-right" style="border-top:0px;">Total Bayar</td>
				<td class="text-left" style="width:50px;border-top:0px;">: Rp</td>
				<td class="text-right" style="width:130px;border-top:0px;"><?php echo rupiah($dtrans[0]['cash']);?>,-</td>
			</tr>
			<tr>
				<td class="text-right" style="border-top:0px;">Kembali</td>
				<td class="text-left" style="width:50px;border-top:0px;">: Rp</td>
				<td class="text-right" style="width:130px;border-top:0px;"><?php echo rupiah($dtrans[0]['kembali']);?>,-</td>
			</tr>
			<tr>
				<td rowspan="1" style="border-top:0px;padding-left:0px;" colspan="5">
					<div style="text-transform:capitalize;"><i>Terbilang: <?php echo penyebut($dtrans[0]['total_bersih']);?> rupiah</i></div>
				</td>
			</tr>
		</tbody>
	</table>
	
	<div style="width:100%;border-top:2px solid #000;">
<!--
		<span style="float:left;font-size:12px;">Keterangan: <?php echo $dtrans[0]['keterangan'];?></span>
-->
	<br>
	</div>
	
	<table class="tabel_gendeng">
		<tr>
			<td rowspan="3" style="width:450px;"><img src="<?php echo base_url()."qrcode/kuitansi-transapotik-".$no_transaksi;?>" style="border:1px solid #000;width:100px;"></td>
			<td>Petugas,</td>
		</tr>
		<tr>
			<td>
				<br>
				<br>
				<br>
				<br>
				<br>
			</td>
		</tr>
		<tr>
			<td><u><b><?php echo $dtrans[0]['nm_admin'];?></b></u></td>
		</tr>
	</table>
						
						
	<div style="width:100%;border-bottom:1px dashed #000;margin-top:20px;"></div>						
						
						
						
</div>

<?php
}
?>
