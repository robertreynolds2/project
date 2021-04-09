<?php
/*
  Created By
  DEDI HUMAEDI
  18102140043
  APLIKASI RENTAL MOBIL
  UAS PEMROGRAMAN WEB II
*/
error_reporting(0);
include 'koneksi.php';
$sql = mysqli_query($con, "SELECT * FROM users");
$row = mysqli_fetch_array($sql);
$user = $_POST['username'];
$pw = md5($_POST['password']);
if($user == $row['username'] && $pw == $row['password']){
  session_start();
  $_SESSION['name'] = $row['name'];
  header('location:mobil.php');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Administrator</title>
    <link href="../bootstrap/css/style.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="row justify-content-center mt-5">
        <div class="col-md-4">
          <div class="card">
            <div class="card-header"><h5 class="text-center">Login <span class="font-weight-bold text-primary">Admin</span></h5></div>
            <div class="card-body">
              <form action="" method="post">
                <div class="form-group">
                  <input type="text" name="username" class="form-control" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" name="ingat">
                  <label class="custom-control-label" >Remember me</label>
                </div>
                <div class="form-group">
                  <input type="submit" name="" value="Login" class="btn btn-primary btn-block">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
<?php
session_start();
if(isset($_SESSION['name'])){
  header('location:mobil.php');
}
?>