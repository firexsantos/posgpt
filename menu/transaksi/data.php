<div class="container mt-5">
  <h1>Transaksi Penjualan</h1>
  <div class="card">
    <div class="card-header">
      <a href="dash.php?menu=add-transaksi" class="btn btn-primary">Tambah Transaksi</a>
    </div>
    <table class="table table-hover mb-0">
      <htead>
        <tr>
          <th class='text-center'>#</th>
          <th>No. Transaksi</th>
          <th>Tanggal</th>
          <th>Admin</th>
          <th class='text-end'>Grand</th>
          <th class='text-center'>Aksi</th>
        </tr>
      </htead>
      <tbody>
        <?php
          $nodata = 1;
          $sdata = mysqli_query($con, "SELECT a.*, LEFT(a.tgladd, 10) AS tanggal, b.`nm_user` FROM transaksi a LEFT JOIN users b ON a.`useradd` = b.`id_user` ORDER BY a.`no_transaksi` DESC");
          while($ddata = mysqli_fetch_array($sdata)){
            if($ddata['status'] == "blengkap"){
              $tomboaksi = "
                <a href='dash.php?menu=add-transaksi&id=".$ddata['no_transaksi']."' class='btn btn-primary'>Edit</a>
                <a href='#' class='btn btn-danger'>Hapus</a>
              ";
            }else{
              $tomboaksi = "<a href='#' class='btn btn-dark'>Cetak</a>";
            }
            echo"
              <tr>
                <td class='text-center'>".$nodata."</td>
                <td>".$ddata['no_transaksi']."</td>
                <td>".tgl_indo($ddata['tanggal'],"a")."</td>
                <td>".$ddata['nm_user']."</td>
                <td class='text-end'>".rupiah($ddata['grand'])."</td>
                <td class='text-center'>
                  <div class='btn-group'>
                    ".$tomboaksi."
                  </div>
                </td>
              </tr>
            ";
            $nodata++;
          }
        ?>
      </tbody>
    </table>
  </div>
</div>