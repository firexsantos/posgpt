<link href="assets/css/mpdf-bootstrap.css" rel="stylesheet" type="text/css">
	
<?php
	$no_transaksi	= trim(@$_GET['id']);
	
	$strans			= mysqli_query($con, "SELECT a.*, LEFT(a.tgladd, 10) AS tgl_transaksi, MID(a.tgladd, 12, 5) AS jam_transaksi, b.`nm_user` FROM transaksi a LEFT JOIN users b ON a.`useradd` = b.`id_user` WHERE a.no_transaksi = '".$no_transaksi."'");
	$htrans = mysqli_num_rows($strans);
	if(empty($no_transaksi) || $htrans == 0){
		echo"Tidak ada data untuk dicetak...";
	}else{
		$dtrans			= mysqli_fetch_array($strans);

		include"vendor/phpqrcode/qrlib.php";
		QRCode::png(identitas("url")."cekdok.php?menu=kuitansi&id=".$no_transaksi,"qrcode/kuitansi-".$no_transaksi,"Q",4,2);
		
		$header 		= "";
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
		<b><?php echo tgl_indo($dtrans['tgl_transaksi'],"a")." ".$dtrans['jam_transaksi'];?></b>
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
				$sdata		= mysqli_query($con,"SELECT a.*, b.nm_barang FROM transaksi_detail a LEFT JOIN barang b ON a.kode_barang = b.kode_barang WHERE a.no_transaksi = '".$no_transaksi."'");
				while($ddata = mysqli_fetch_array($sdata)){
					echo"
						<tr>
							<td class='text-center'>".$nodata.".</td>
							<td>
								".$ddata['nm_barang']."
							</td>
							<td class='text-right'>".rupiah($ddata['harga']).",-</td>
							<td class='text-center'>".$ddata['qty']."</td>
							<td class='text-right'>".rupiah($ddata['total']).",-</td>
						</tr>
					";
					$nodata++;
				}
			?>
			
			<tr>
				<td rowspan="3" colspan="2">
					
				</td>
				<td class="text-right" style="">Grand Total</td>
				<td class="text-left" style="width:50px;">: Rp</td>
				<td class="text-right" style="width:130px;font-weight:bold;"><?php echo rupiah($dtrans['grand']);?>,-</td>
			</tr>
			<tr>
				<td class="text-right" style="border-top:0px;">Total Bayar</td>
				<td class="text-left" style="width:50px;border-top:0px;">: Rp</td>
				<td class="text-right" style="width:130px;border-top:0px;"><?php echo rupiah($dtrans['bayar']);?>,-</td>
			</tr>
			<tr>
				<td class="text-right" style="border-top:0px;">Kembali</td>
				<td class="text-left" style="width:50px;border-top:0px;">: Rp</td>
				<td class="text-right" style="width:130px;border-top:0px;"><?php echo rupiah($dtrans['kembali']);?>,-</td>
			</tr>
			<tr>
				<td rowspan="1" style="border-top:0px;padding-left:0px;" colspan="5">
					<div style="text-transform:capitalize;"><i>Terbilang: <?php echo penyebut($dtrans['grand']);?> rupiah</i></div>
				</td>
			</tr>
		</tbody>
	</table>
	
	<div style="width:100%;border-top:2px solid #000;">
	<br>
	</div>
	
	<table class="tabel_gendeng">
		<tr>
			<td rowspan="3" style="width:450px;"><img src="<?php echo identitas("url")."qrcode/kuitansi-".$no_transaksi;?>" style="border:1px solid #000;width:100px;"></td>
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
			<td><u><b><?php echo $dtrans['nm_user'];?></b></u></td>
		</tr>
	</table>
						
						
	<div style="width:100%;border-bottom:1px dashed #000;margin-top:20px;"></div>						
						
						
						
</div>

<?php
}
?>
