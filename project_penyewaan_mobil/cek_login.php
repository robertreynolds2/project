<?php
/*
  Created By
  DEDI HUMAEDI
  18102140043
  APLIKASI RENTAL MOBIL
  UAS PEMROGRAMAN WEB II
*/
include 'koneksi.php';
$user = $_POST['username'];
$pw = $_POST['password'];
$sql = mysqli_query($con, "SELECT * FROM customer WHERE username='$user'");
$row = mysqli_fetch_array($sql);
if($user == $row['username'] && $pw == $row['password']){
  session_start();
  $_SESSION['nama'] = $row['nama'];
  header('location:home.php');
}else{
  header('location:index.php');
}
?>