<link href="<?php echo identitas("url");?>assets/css/mpdf-bootstrap.css" rel="stylesheet" type="text/css">
	
<?php
    $header 		= "";
    $margin_top		= 20;
    $margin_right	= 5;
    $margin_left	= 5;

    $jenis = trim(@$_GET['jenis']);	
    $tahun = trim(@$_GET['tahun']);	
    $bulan = trim(@$_GET['bulan']);	
    $tanggal = trim(@$_GET['tanggal']);

	if($jenis == "tahun"){
        $sdata	= mysqli_query($con, "SELECT a.*, LEFT(a.tgladd, 10) AS tanggal, b.`nm_user` FROM transaksi a LEFT JOIN users b ON a.`useradd` = b.`id_user` WHERE LEFT(a.tgladd, 4) = '".$tahun."' ORDER BY a.`no_transaksi` DESC");
        $nama_dokumen   = "Laporan Transaksi Penjualan Tahun " . $tahun;
        $judul_pdf      = "Laporan Transaksi Penjualan Tahun " . $tahun;
    }else if($jenis == "bulan"){
        $sdata	= mysqli_query($con, "SELECT a.*, LEFT(a.tgladd, 10) AS tanggal, b.`nm_user` FROM transaksi a LEFT JOIN users b ON a.`useradd` = b.`id_user` WHERE LEFT(a.tgladd, 7) = '".$tahun."-".$bulan."' ORDER BY a.`no_transaksi` DESC");

		$sbulan = mysqli_query($con,"SELECT * FROM bulan WHERE no_bulan = '".$bulan."'");
		$dbulan = mysqli_fetch_array($sbulan);

        $nama_dokumen   = "Laporan Transaksi Penjualan Bulan ".$dbulan['nm_bulan']." ".$tahun;
        $judul_pdf      = "Laporan Transaksi Penjualan Bulan ".$dbulan['nm_bulan']." ".$tahun;
    }else if($jenis == "tanggal"){
        $sdata	= mysqli_query($con, "SELECT a.*, LEFT(a.tgladd, 10) AS tanggal, b.`nm_user` FROM transaksi a LEFT JOIN users b ON a.`useradd` = b.`id_user` WHERE LEFT(a.tgladd, 10) = '".$tanggal."' ORDER BY a.`no_transaksi` DESC");
        $nama_dokumen   = "Laporan Transaksi Penjualan Tanggal " . tgl_indo($tanggal);
        $judul_pdf      = "Laporan Transaksi Penjualan Tanggal " . tgl_indo($tanggal);
    }
    
        		
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

    .kolom_surat{
        font-size:9pt;
    }
</style>


<div class="area_gendeng">


    <div style="padding-top:5px;" class="kolom_surat">
	    <h5 style="margin-bottom:0px;font-size:10pt;" class="text-uppercase"><b><?= $nama_dokumen ?></b></h5>
    </div>
	<br>



<table class="table table-bordered tabel_gendeng" style="font-size:8pt">
	<thead>
		<tr>
		<th class='text-center'>#</th>
          <th>No. Transaksi</th>
          <th>Tanggal</th>
          <th>Admin</th>
          <th class='text-right'>Grand</th>
		</tr>
	</thead>
	<tbody>
        <?php
            $nodata = 1;
            $grandtotal = 0;
			while($ddata = mysqli_fetch_array($sdata)){
			  echo"
				<tr>
				  <td class='text-center'>".$nodata."</td>
				  <td>".$ddata['no_transaksi']."</td>
				  <td>".tgl_indo($ddata['tanggal'],"a")."</td>
				  <td>".$ddata['nm_user']."</td>
				  <td class='text-right'>".rupiah($ddata['grand'])."</td>
				</tr>
			  ";
			  $grandtotal = $grandtotal + $ddata['grand'];
			  $nodata++;
			}
        ?>
        <tr>
            <th colspan="4" class="text-right">GRAND TOTAL :</th>
            <th class="text-right text-danger">Rp <?= rupiah($grandtotal) ?>,-</th>
        </tr>
    </tbody>
</table>

			
						
						
						
</div>

