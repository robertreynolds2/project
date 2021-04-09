<?php
/*
  Created By
  DEDI HUMAEDI
  18102140043
  APLIKASI RENTAL MOBIL
  UAS PEMROGRAMAN WEB II
*/
include 'koneksi.php';
session_start();
if(!isset($_SESSION['nama'])){
  header('location:index.php');
}

$id = $_GET['id'];
$sql = mysqli_query($con, "SELECT * FROM tbl_mobil WHERE id_mobil=$id");
$data = mysqli_fetch_array($sql);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RENTAL MOBIL</title>
    <link rel="stylesheet" href="bootstrap/css/style.css"/>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.css" />
  </head>
  <body>
<nav class="navbar navbar-expand-lg navbar-success bg-light"><?php include 'menu.php';?></nav><br>
    <div class="col-sm-8">
        <div class="card mb-1" style="max-width: 540px;">
            <div class="row no-gutters">
                <div class="col-md-10">
                <img src="images/<?php echo $data['gambar'];?>" class="card-img" alt="gambar" height="100%">
                </div>
            <div class="col-md-6">
        <div class="card-body">
        <h5 class="card-title"><?php echo $data['nama'];?></h5>
        <p class="card-text"><?php echo "Warna : ".$data[2];?></p>
        <p class="card-text"><?php echo "Plat : ".$data[3];?></p>
        <p class="card-text"><?php echo "Kursi : ".$data[4];?></p>
        <h5 class="card-title">Harga : <?php echo number_format($data['harga'],0,",",".");?> /Hari<h5>
        <a class="btn btn-primary fa fa-whatsapp " href="cekout.php?id=<?php echo $data['id_mobil'];?>"> Pesan</a>
    </div>
 </div>
</body>
</html>