

<div class="container mt-5">
    <?php
        if(isset($_POST['tambah'])){
            $nm_barangsat = $_POST['nm_barangsat'];

            $simpan = mysqli_query($con, "INSERT INTO barangsat (nm_barangsat) VALUE ('".$nm_barangsat."')");
            if($simpan){
                echo"<div class='alert alert-success'>Data berhasil ditambahkan.</div>";
            }else{
                echo"<div class='alert alert-danger'>Gagal menambahkan data.</div>";
            }
        }else if(isset($_POST['edit'])){
            $id_barangsat = $_POST['id_barangsat'];
            $nm_barangsat = $_POST['nm_barangsat'];

            $simpan = mysqli_query($con, "UPDATE barangsat SET nm_barangsat = '".$nm_barangsat."' WHERE id_barangsat = '".$id_barangsat."'");
            if($simpan){
                echo"<div class='alert alert-success'>Data berhasil diubah.</div>";
            }else{
                echo"<div class='alert alert-danger'>Gagal mengubah data.</div>";
            }
        }else if(isset($_POST['hapus'])){
            $proses = mysqli_query($con, "DELETE FROM barangsat WHERE id_barangsat = '".$_POST['id_barangsat']."'");
            if($proses){
                echo"<div class='alert alert-success'>Data berhasil dihapus.</div>";
            }else{
                echo"<div class='alert alert-danger'>Gagal menghapus data.</div>";
            }
        }
    ?>
    <h1>Master Satuan Barang</h1>
    <div class="card">
        <div class="card-header">
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Data</a>
        </div>
        <table class="table table-hover mb-0">
            <thead>
                <tr class="bg-dark text-light">
                    <th>#</th>
                    <th>Nama Satuan Barang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $nodata = 1;
                    $sdata = mysqli_query($con, "SELECT * FROM barangsat");
                    while($ddata = mysqli_fetch_array($sdata)){
                        echo"
                            <tr>
                                <td>".$nodata."</td>
                                <td>".$ddata['nm_barangsat']."</td>
                                <td>
                                    <div class='btn-group'>
                                        <a href='#' class='btn btn-primary btn-sm btedit' data-id='".$ddata['id_barangsat']."' data-nama='".$ddata['nm_barangsat']."' data-bs-toggle='modal' data-bs-target='#modalEdit'>Edit</a>
                                        <a href='#' class='btn btn-danger btn-sm bthapus' data-bs-toggle='modal' data-bs-target='#modalHapus' data-id='".$ddata['id_barangsat']."' data-nama='".$ddata['nm_barangsat']."'>Hapus</a>
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


<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama Satuan Barang</label>
              <input type="text" class="form-control" id="nama" name="nm_barangsat" placeholder="Nama Satuan Barang" required>
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-primary" name="tambah">Simpan</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post">
          <input type="hidden" name="id_barangsat" id="id_barangsat_edit">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama Satuan Barang</label>
              <input type="text" class="form-control" id="nm_barangsat_edit" name="nm_barangsat" placeholder="Nama Satuan Barang" required>
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-primary" name="edit">Simpan</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


<div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post">
            <input type="hidden" name="id_barangsat" id="id_barangsat_hapus">
            <div class="alert alert-danger">Anda yakin akan menghapus data <b id="nama_hapus"></b>? data yang sudah dihapus tidak bisa dikembalikan lagi.</div>
            <div class="text-end">
              <button type="submit" class="btn btn-danger" name="hapus">Ya! Hapus Permanen Data</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
		$(document).on('click', '.bthapus', function() {
			const id 	= $(this).data('id');
			const nama 	= $(this).data('nama');
			$('#id_barangsat_hapus').val(id);
			document.getElementById("nama_hapus").innerHTML = nama;
			//console.log("data : " + nama);
		});

        $(document).on('click', '.btedit', function() {
			const id 	= $(this).data('id');
			const nama 	= $(this).data('nama');
			$('#id_barangsat_edit').val(id);
			$('#nm_barangsat_edit').val(nama);
		});
    });
  </script>