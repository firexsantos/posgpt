<link href="<?php echo identitas("url");?>assets/css/mpdf-bootstrap.css" rel="stylesheet" type="text/css">
	
<?php
    $header 		= "";
    $margin_top		= 20;
    $margin_right	= 5;
    $margin_left	= 5;

    $nama_dokumen   = "Laporan Stok Barang";
    $judul_pdf      = "Laporan Stok Barang";
    
        		
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
                <tr class="bg-dark text-light">
                    <th class='text-center'>#</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Satuan</th>
                    <th>Jenis</th>
                    <th class='text-end'>Hrg. Beli</th>
                    <th class='text-end'>Hrg. Jual</th>
                    <th class='text-center'>Stok</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $nodata = 1;
                    $sdata = mysqli_query($con, "SELECT a.*, b.`nm_barangjns`, c.`nm_barangsat` FROM barang a LEFT JOIN barangjns b ON a.`id_barangjns` = b.`id_barangjns` LEFT JOIN barangsat c ON a.`id_barangsat` = c.`id_barangsat` ORDER BY a.stok DESC");
                    while($ddata = mysqli_fetch_array($sdata)){
                        echo"
                            <tr>
                                <td class='text-center'>".$nodata."</td>
                                <td>".$ddata['kode_barang']."</td>
                                <td>".$ddata['nm_barang']."</td>
                                <td>".$ddata['nm_barangsat']."</td>
                                <td>".$ddata['nm_barangjns']."</td>
                                <td class='text-end'>".rupiah($ddata['harga_beli'])."</td>
                                <td class='text-end'>".rupiah($ddata['harga_jual'])."</td>
                                <td class='text-center'>".$ddata['stok']."</td>
                            </tr>
                        ";
                        $nodata++;
                    }
                ?>
            </tbody>
</table>

			
						
						
						
</div>

