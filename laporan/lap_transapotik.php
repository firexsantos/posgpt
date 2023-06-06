<link href="<?php echo base_url();?>assets/css/mpdf-bootstrap.css" rel="stylesheet" type="text/css">
	
<?php
    include'public/inc/pdf/kop1.php';
    $header 		= $kopganteng;
    $margin_top		= 20;
    $margin_right	= 5;
    $margin_left	= 5;

    $type = antixss(dekrip($this->uri->segment(4)));	
	if($type == "tahun"){
        $tahun = antixss(dekrip($this->uri->segment(5)));
        $sdata	= $this->db->query("SELECT a.*, b.`nama` FROM trans a LEFT JOIN pengguna b ON a.`useradd` = b.`no_register` WHERE a.`jenis` = 'apotik' AND a.selesai = 'yes' AND LEFT(a.tgl_transaksi, 4) = '".$tahun."' ORDER BY a.`no_transaksi` DESC");
        $nama_dokumen   = "Laporan Transaksi Apotik " . $tahun;
        $judul_pdf      = "Laporan Transaksi Apotik " . $tahun;
    }else if($type == "bulan"){
        $bulan = antixss(dekrip($this->uri->segment(5)));
        $tahun = antixss(dekrip($this->uri->segment(6)));
        $sdata	= $this->db->query("SELECT a.*, b.`nama` FROM trans a LEFT JOIN pengguna b ON a.`useradd` = b.`no_register` WHERE a.`jenis` = 'apotik' AND a.selesai = 'yes' AND LEFT(a.tgl_transaksi, 7) = '".$tahun."-".$bulan."' ORDER BY a.`no_transaksi` DESC");

        $dbulan = $this->db->get_where("bulan", array("no_bulan" => $bulan))->result_array();
        $nama_dokumen   = "Laporan Transaksi Apotik ".$dbulan[0]['nm_bulan']." " . $tahun;
        $judul_pdf      = "Laporan Transaksi Apotik ".$dbulan[0]['nm_bulan']." " . $tahun;
    }else if($type == "tanggal"){
        $tgl_mulai = antixss(dekrip($this->uri->segment(5)));
        $tgl_sampai = antixss(dekrip($this->uri->segment(6)));
        $sdata	= $this->db->query("SELECT a.*, b.`nama` FROM trans a LEFT JOIN pengguna b ON a.`useradd` = b.`no_register` WHERE a.`jenis` = 'apotik' AND a.selesai = 'yes' AND (LEFT(a.tgl_transaksi, 10) BETWEEN '".$tgl_mulai."' AND '".$tgl_sampai."') ORDER BY a.`no_transaksi` DESC");

        if($tgl_mulai == $tgl_sampai){
            $nama_dokumen   = "Laporan Transaksi Apotik ".tgl_indo($tgl_mulai);
            $judul_pdf      = "Laporan Transaksi Apotik ".tgl_indo($tgl_mulai);
        }else{
            $nama_dokumen   = "Laporan Transaksi Apotik ".tgl_indo($tgl_mulai)." - ".tgl_indo($tgl_sampai);
            $judul_pdf      = "Laporan Transaksi Apotik ".tgl_indo($tgl_mulai)." - ".tgl_indo($tgl_sampai);
        }
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
			<th class="font-weight-bold" style="background:#000;color:#fff;">#</th>
			<th class="font-weight-bold" style="background:#000;color:#fff;">No. Transaksi</th>
			<th class="font-weight-bold" style="background:#000;color:#fff;">Tanggal</th>
			<th class="font-weight-bold" style="background:#000;color:#fff;">Admin</th>
			<th class="font-weight-bold text-right" style="background:#000;color:#fff;">Harga Obat</th>
			<th class="font-weight-bold text-right" style="background:#000;color:#fff;">Potongan</th>
			<th class="font-weight-bold text-right" style="background:#000;color:#fff;">Total</th>
		</tr>
	</thead>
	<tbody>
        <?php
            $nodata = 1;
            $totalbiaya = 0;
            $totalpotongan = 0;
            $grandtotal = 0;
            foreach($sdata->result_array() as $ddata) {
                echo"
                    <tr>
                        <td class='text-center'>".$nodata.".</td>
                        <td>" . $ddata['no_transaksi'] . "</td>
						<td>" . tgl_indo($ddata['tgl_transaksi'],"a") . "</td>
						<td>" . $ddata['nama'] . "</td>
						<td class='text-right'>" . rupiah($ddata['biaya_obat']) . ",-</td>
						<td class='text-right'>" . rupiah($ddata['potongan']) . "</td>
						<td class='text-right'>" . rupiah($ddata['total_bersih']) . ",-</td>
                    </tr>
                ";
                $totalbiaya = $totalbiaya + $ddata['biaya_obat'];
                $totalpotongan = $totalpotongan + $ddata['potongan'];
                $grandtotal = $grandtotal + $ddata['total_bersih'];
                $nodata++;
            }
        ?>
        <tr>
            <th colspan="4" class="text-right">GRAND TOTAL :</th>
            <th class="text-right text-danger">Rp <?= rupiah($totalbiaya) ?>,-</th>
            <th class="text-right text-danger">Rp <?= rupiah($totalpotongan) ?>,-</th>
            <th class="text-right text-danger">Rp <?= rupiah($grandtotal) ?>,-</th>
        </tr>
    </tbody>
</table>

			
						
						
						
</div>

