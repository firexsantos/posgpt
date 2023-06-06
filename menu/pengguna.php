

<div class="container mt-5">
    <?php
        if(isset($_POST['tambah'])){
            $nm_user = $_POST['nm_user'];
            $username = $_POST['username'];
            $password = md5($_POST['password']);

            $simpan = mysqli_query($con, "INSERT INTO users (nm_user, username, `password`) VALUE ('".$nm_user."','".$username."','".$password."')");
            if($simpan){
                echo"<div class='alert alert-success'>Data berhasil ditambahkan.</div>";
            }else{
                echo"<div class='alert alert-danger'>Gagal menambahkan data.</div>";
            }
        }else if(isset($_POST['edit'])){
            $id_user = $_POST['id_user'];
            $nm_user = $_POST['nm_user'];
            $username = $_POST['username'];

            $simpan = mysqli_query($con, "UPDATE users SET nm_user = '".$nm_user."', username = '".$username."' WHERE id_user = '".$id_user."'");
            if($simpan){
                echo"<div class='alert alert-success'>Data berhasil diubah.</div>";
            }else{
                echo"<div class='alert alert-danger'>Gagal mengubah data.</div>";
            }
        }else if(isset($_POST['editpass'])){
            $id_user = $_POST['id_user'];
            $password = md5($_POST['password']);
            $simpan = mysqli_query($con, "UPDATE users SET `password` = '".$password."' WHERE id_user = '".$id_user."'");
            if($simpan){
                echo"<div class='alert alert-success'>Password berhasil diubah.</div>";
            }else{
                echo"<div class='alert alert-danger'>Gagal mengubah Password.</div>";
            }
        }else if(isset($_POST['hapus'])){
            $proses = mysqli_query($con, "DELETE FROM users WHERE id_user = '".$_POST['id_user']."'");
            if($proses){
                echo"<div class='alert alert-success'>Data berhasil dihapus.</div>";
            }else{
                echo"<div class='alert alert-danger'>Gagal menghapus data.</div>";
            }
        }
    ?>
    <h1>Data Pengguna</h1>
    <div class="card">
        <div class="card-header">
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Data</a>
        </div>
        <table class="table table-hover mb-0">
            <thead>
                <tr class="bg-dark text-light">
                    <th>#</th>
                    <th>Nama User</th>
                    <th>Username</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $nodata = 1;
                    $sdata = mysqli_query($con, "SELECT * FROM users");
                    while($ddata = mysqli_fetch_array($sdata)){
                        echo"
                            <tr>
                                <td>".$nodata."</td>
                                <td>".$ddata['nm_user']."</td>
                                <td>".$ddata['username']."</td>
                                <td>
                                    <div class='btn-group'>
                                        <a href='#' class='btn btn-primary btn-sm btedit' data-id='".$ddata['id_user']."' data-nama='".$ddata['nm_user']."' data-username='".$ddata['username']."' data-bs-toggle='modal' data-bs-target='#modalEdit'>Edit</a>
                                        <a href='#' class='btn btn-warning btn-sm bteditpass' data-bs-toggle='modal' data-bs-target='#modalEditPass' data-id='".$ddata['id_user']."' data-nama='".$ddata['nm_user']."'>Edit Password</a>
                                        <a href='#' class='btn btn-danger btn-sm bthapus' data-bs-toggle='modal' data-bs-target='#modalHapus' data-id='".$ddata['id_user']."' data-nama='".$ddata['nm_user']."'>Hapus</a>
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
              <label for="nama" class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control" id="nama" name="nm_user" placeholder="Nama Lengkap" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Username</label>
              <input type="text" class="form-control" name="username" placeholder="Username" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Password</label>
              <input type="password" class="form-control" name="password" placeholder="Password" required>
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
          <input type="hidden" name="id_user" id="id_user_edit">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control" id="nm_user_edit" name="nm_user" placeholder="Nama Lengkap" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Username</label>
              <input type="text" class="form-control" id="username_edit" name="username" placeholder="Username" required>
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


<div class="modal fade" id="modalEditPass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post">
          <input type="hidden" name="id_user" id="id_user_editpass">
            <div class="mb-3">
              <label for="email" class="form-label">Password Baru</label>
              <input type="password" class="form-control" name="password" placeholder="Ketik Password Baru" required>
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-primary" name="editpass">Simpan</button>
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
            <input type="hidden" name="id_user" id="id_user_hapus">
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
			$('#id_user_hapus').val(id);
			document.getElementById("nama_hapus").innerHTML = nama;
			//console.log("data : " + nama);
		});

        $(document).on('click', '.btedit', function() {
			const id 	= $(this).data('id');
			const nama 	= $(this).data('nama');
			const username 	= $(this).data('username');
			$('#id_user_edit').val(id);
			$('#nm_user_edit').val(nama);
			$('#username_edit').val(username);
		});

        $(document).on('click', '.bteditpass', function() {
			const id 	= $(this).data('id');
			$('#id_user_editpass').val(id);
		});
    });
  </script>