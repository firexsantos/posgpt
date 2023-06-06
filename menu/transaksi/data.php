<div class="container mt-5">
  <?php
    if(isset($_POST['hapus'])){
      $no_transaksi = $_POST['no_transaksi'];
      $simpan = mysqli_query($con, "DELETE FROM transaksi WHERE no_transaksi = '".$no_transaksi."'");
      if($simpan){
          mysqli_query($con, "DELETE FROM transaksi_detail WHERE no_transaksi = '".$no_transaksi."'");
          header("Location: dash.php?menu=transaksi");
      }else{
          echo"<div class='alert alert-danger'>Terjadi kesalahan, data gagal diproses.</div>";
      }
    }
  ?>
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
                <a href='dash.php?menu=add-transaksi&id=".$ddata['no_transaksi']."' class='btn btn-primary btn-sm'>Edit</a>
                <a href='#' data-bs-toggle='modal' data-bs-target='#modalHapus' class='btn btn-danger bthapus btn-sm' data-id='".$ddata['no_transaksi']."' data-nama='".$ddata['no_transaksi']."'>Hapus</a>
              ";
            }else{
              $tomboaksi = "<a href='pdf.php?menu=kuitansi&id=".$ddata['no_transaksi']."' class='btn btn-dark btn-sm' target='_blank'>Cetak</a>";
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


<div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <input type="hidden" name="no_transaksi" id="no_transaksi_hapus">
                    <div class="alert alert-danger">Anda yakin akan menghapus data <b id="nama_hapus"></b>? data yang sudah dihapus tidak bisa dikembalikan lagi.</div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-danger" name="hapus">Ya! Hapus Data</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).on('click', '.bthapus', function() {
      const id 	= $(this).data('id');
      const nama 	= $(this).data('nama');
      $('#no_transaksi_hapus').val(id);
      document.getElementById("nama_hapus").innerHTML = nama;
      //console.log("data : " + nama);
    });
  </script>