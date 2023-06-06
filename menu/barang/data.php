

<div class="container mt-5">
    <?php
        if(isset($_POST['tambah'])){
            $kode_barang = $_POST['kode_barang'];
            $nm_barang = $_POST['nm_barang'];
            $id_barangsat = $_POST['id_barangsat'];
            $id_barangjns = $_POST['id_barangjns'];
            $harga_beli = $_POST['harga_beli'];
            $harga_jual = $_POST['harga_jual'];
            $stok = $_POST['stok'];

            $scek = mysqli_query($con, "SELECT * FROM barang WHERE kode_barang = '".$kode_barang."'");
            $hcek = mysqli_num_rows($scek);
            if($hcek > 0){
                echo"<div class='alert alert-danger'>Gagal menambah data! Kode barang sudah ada.</div>";
            }else{
                $simpan = mysqli_query($con, "INSERT INTO barang (kode_barang, nm_barang, id_barangsat, id_barangjns, harga_beli, harga_jual, stok, useradd) VALUE ('".$kode_barang."','".$nm_barang."','".$id_barangsat."','".$id_barangjns."','".$harga_beli."','".$harga_jual."','".$stok."','".$sesuser."')");
                if($simpan){
                    echo"<div class='alert alert-success'>Data berhasil ditambahkan.</div>";
                }else{
                    echo"<div class='alert alert-danger'>Gagal menambahkan data.</div>";
                }
            }
        }else if(isset($_POST['edit'])){
            $id_barang = $_POST['id_barang'];
            $kode_barang = $_POST['kode_barang'];
            $nm_barang = $_POST['nm_barang'];
            $id_barangsat = $_POST['id_barangsat'];
            $id_barangjns = $_POST['id_barangjns'];
            $harga_beli = $_POST['harga_beli'];
            $harga_jual = $_POST['harga_jual'];
            $stok = $_POST['stok'];

            $scek = mysqli_query($con, "SELECT * FROM barang WHERE kode_barang = '".$kode_barang."' AND id_barang <> '".$id_barang."'");
            $hcek = mysqli_num_rows($scek);
            if($hcek > 0){
                echo"<div class='alert alert-danger'>Gagal menambah data! Kode barang sudah ada.</div>";
            }else{
                $simpan = mysqli_query($con, "UPDATE barang SET kode_barang = '".$kode_barang."',nm_barang = '".$nm_barang."',id_barangsat = '".$id_barangsat."',id_barangjns = '".$id_barangjns."',harga_beli = '".$harga_beli."',harga_jual = '".$harga_jual."',stok = '".$stok."' WHERE id_barang = '".$id_barang."'");
                if($simpan){
                    echo"<div class='alert alert-success'>Data berhasil diubah.</div>";
                }else{
                    echo"<div class='alert alert-danger'>Gagal mengubah data.</div>";
                }
            }
        }else if(isset($_POST['hapus'])){
            $proses = mysqli_query($con, "DELETE FROM barang WHERE id_barang = '".$_POST['id_barang']."'");
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
                    <th class='text-center'>#</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Satuan</th>
                    <th>Jenis</th>
                    <th class='text-end'>Hrg. Beli</th>
                    <th class='text-end'>Hrg. Jual</th>
                    <th class='text-center'>Stok</th>
                    <th class='text-center'>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $nodata = 1;
                    $sdata = mysqli_query($con, "SELECT a.*, b.`nm_barangjns`, c.`nm_barangsat` FROM barang a LEFT JOIN barangjns b ON a.`id_barangjns` = b.`id_barangjns` LEFT JOIN barangsat c ON a.`id_barangsat` = c.`id_barangsat`");
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
                                <td class='text-center'>
                                    <div class='btn-group'>
                                        <a href='#' class='btn btn-primary btn-sm btedit' data-id='".$ddata['id_barang']."' data-kode='".$ddata['kode_barang']."' data-nama='".$ddata['nm_barang']."' data-sat='".$ddata['id_barangsat']."' data-jns='".$ddata['id_barangjns']."' data-hbeli='".$ddata['harga_beli']."' data-hjual='".$ddata['harga_jual']."' data-stok='".$ddata['stok']."' data-bs-toggle='modal' data-bs-target='#modalEdit'>Edit</a>
                                        <a href='#' class='btn btn-danger btn-sm bthapus' data-bs-toggle='modal' data-bs-target='#modalHapus' data-id='".$ddata['id_barang']."' data-nama='".$ddata['nm_barang']."'>Hapus</a>
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
              <label for="nama" class="form-label">Kode Barang</label>
              <input type="text" class="form-control" id="nama" name="kode_barang" placeholder="Kode Barang" required>
            </div>
            <div class="mb-3">
              <label for="nama" class="form-label">Nama Barang</label>
              <input type="text" class="form-control" id="nama" name="nm_barang" placeholder="Nama Barang" required>
            </div>
            <div class="mb-3">
              <label for="nama" class="form-label">Satuan</label>
              <select class="form-control" name="id_barangsat" required>
                <option value="">[ Pilih Satuan Barang ]</option>
                <?php
                    $sjen = mysqli_query($con, "SELECT * FROM barangsat");
                    while($djen = mysqli_fetch_array($sjen)){
                        echo"<option value='".$djen['id_barangsat']."'>".$djen['nm_barangsat']."</option>";
                    }
                ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="nama" class="form-label">Jenis</label>
              <select class="form-control" name="id_barangjns" required>
                <option value="">[ Pilih Jenis Barang ]</option>
                <?php
                    $sjen = mysqli_query($con, "SELECT * FROM barangjns");
                    while($djen = mysqli_fetch_array($sjen)){
                        echo"<option value='".$djen['id_barangjns']."'>".$djen['nm_barangjns']."</option>";
                    }
                ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="nama" class="form-label">Harga Beli</label>
              <input type="number" class="form-control" id="nama" name="harga_beli" placeholder="Harga Beli" required>
            </div>
            <div class="mb-3">
              <label for="nama" class="form-label">Harga Jual</label>
              <input type="number" class="form-control" id="nama" name="harga_jual" placeholder="Harga Jual" required>
            </div>
            <div class="mb-3">
              <label for="nama" class="form-label">Stok</label>
              <input type="number" class="form-control" id="nama" name="stok" placeholder="Stok" required>
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
          <input type="hidden" name="id_barang" id="id_barang_edit">
          <div class="mb-3">
              <label for="nama" class="form-label">Kode Barang</label>
              <input type="text" class="form-control" name="kode_barang" id="kode_barang_edit" placeholder="Kode Barang" required>
            </div>
            <div class="mb-3">
              <label for="nama" class="form-label">Nama Barang</label>
              <input type="text" class="form-control" name="nm_barang" id="nm_barang_edit" placeholder="Nama Barang" required>
            </div>
            <div class="mb-3">
              <label for="nama" class="form-label">Satuan</label>
              <select class="form-control" name="id_barangsat" id="id_barangsat_edit" required>
                <option value="">[ Pilih Satuan Barang ]</option>
                <?php
                    $sjen = mysqli_query($con, "SELECT * FROM barangsat");
                    while($djen = mysqli_fetch_array($sjen)){
                        echo"<option value='".$djen['id_barangsat']."'>".$djen['nm_barangsat']."</option>";
                    }
                ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="nama" class="form-label">Jenis</label>
              <select class="form-control" name="id_barangjns" id="id_barangjns_edit" required>
                <option value="">[ Pilih Jenis Barang ]</option>
                <?php
                    $sjen = mysqli_query($con, "SELECT * FROM barangjns");
                    while($djen = mysqli_fetch_array($sjen)){
                        echo"<option value='".$djen['id_barangjns']."'>".$djen['nm_barangjns']."</option>";
                    }
                ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="nama" class="form-label">Harga Beli</label>
              <input type="number" class="form-control" name="harga_beli" id="harga_beli_edit" placeholder="Harga Beli" required>
            </div>
            <div class="mb-3">
              <label for="nama" class="form-label">Harga Jual</label>
              <input type="number" class="form-control" name="harga_jual" id="harga_jual_edit" placeholder="Harga Jual" required>
            </div>
            <div class="mb-3">
              <label for="nama" class="form-label">Stok</label>
              <input type="number" class="form-control" name="stok" id="stok_edit" placeholder="Stok" required>
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
            <input type="hidden" name="id_barang" id="id_barang_hapus">
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
			$('#id_barang_hapus').val(id);
			document.getElementById("nama_hapus").innerHTML = nama;
			//console.log("data : " + nama);
		});

        $(document).on('click', '.btedit', function() {
			const id 	= $(this).data('id');
			const kode 	= $(this).data('kode');
			const nama 	= $(this).data('nama');
			const sat 	= $(this).data('sat');
			const jns 	= $(this).data('jns');
			const hbeli 	= $(this).data('hbeli');
			const hjual 	= $(this).data('hjual');
			const stok 	= $(this).data('stok');
			$('#id_barang_edit').val(id);
			$('#kode_barang_edit').val(kode);
			$('#nm_barang_edit').val(nama);
			$('#id_barangsat_edit').val(sat);
			$('#id_barangjns_edit').val(jns);
			$('#harga_jual_edit').val(hbeli);
			$('#harga_beli_edit').val(hjual);
			$('#stok_edit').val(stok);
		});
    });
  </script>