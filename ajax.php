<?php
    include"koneksi.php";

    $jenis = trim(@$_GET['jenis']);

    if($jenis == "cekbarang"){
        header('Content-Type: application/json');
        $kode_barang = $_POST['kode_barang'];

        $sdata = mysqli_query($con, "SELECT a.*, b.`nm_barangjns`, c.`nm_barangsat` FROM barang a LEFT JOIN barangjns b ON a.`id_barangjns` = b.`id_barangjns` LEFT JOIN barangsat c ON a.`id_barangsat` = c.`id_barangsat` WHERE a.kode_barang = '".$kode_barang."'");
        $ddata = mysqli_fetch_array($sdata);

        $post_json = array(
            "nm_barang" => $ddata['nm_barang'],
            "nm_barangjns" => $ddata['nm_barangjns'],
            "nm_barangsat" => $ddata['nm_barangsat'],
            "harga_jual" => $ddata['harga_jual']
        );

        echo json_encode($post_json);
    }
?>