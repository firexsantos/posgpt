<?php
    include"koneksi.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - <?= identitas() ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
</head>

<body>
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <div class="text-center">
          <img src="assets/images/logo.png" class="mb-4" style="width:200px;">
        </div>
        <div class="card">
          <div class="card-header">
            <h4>Login <?= identitas() ?></h4>
          </div>
          <div class="card-body">
            <?php
                if(isset($_POST['login'])){
                    $username = $_POST['username'];
                    $password = md5($_POST['password']);
                    $query = mysqli_query($con, "SELECT * FROM users WHERE `username` = '".$username."' AND `password` = '".$password."'");
                    $hitung = mysqli_num_rows($query);
                    if($hitung > 0){
                        $data = mysqli_fetch_array($query);
                        $_SESSION['id_user'] = $data['id_user'];
                        header("Location: dash.php");
                    }else{
                       echo"<div class='alert alert-danger'>Username dan Password tidak cocok.</div>"; 
                    }
                }
            ?>
            <form method="post">
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
              </div>
              <div class="text-center">
                <button type="reset" class="btn btn-default">Reset</button>
                <button type="submit" name="login" class="btn btn-primary">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
