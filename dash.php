<?php
    include"koneksi.php";

    if(empty($sesuser)){
        header("Location: index.php");
    }

    $menu = trim(@$_GET['menu']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - <?= identitas() ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>

<body>
  <?php
    include"inc/nav.php";

    if(empty($menu)){
      include"menu/dash.php";
    }else if($menu == "pengguna"){
      include"menu/pengguna.php"; 
    }else if($menu == "barang"){
      include"menu/barang/data.php"; 
    }else if($menu == "transaksi"){
      include"menu/transaksi/data.php"; 
    }else if($menu == "add-transaksi"){
      include"menu/transaksi/add.php"; 
    }else if($menu == "barangjns"){
      include"menu/master/barangjns.php"; 
    }else if($menu == "barangsat"){
      include"menu/master/barangsat.php"; 
    }else if($menu == "lap-penjualan"){
      include"menu/formlap/lap_penjualan.php"; 
    }else{
      echo"<div class='alert alert-danger'>Halaman tidak ditemukan...</div>";
    }
  ?>

  

  
</body>

</html>
