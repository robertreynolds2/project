<?php
/*
  Created By
  DEDI HUMAEDI
  18102140043
  APLIKASI RENTAL MOBIL
  UAS PEMROGRAMAN WEB II
*/
session_start();
if(!isset($_SESSION['nama'])){
    header('location:index.php');
}
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
  <div class="container"><p class="navbar-brand fa fa-money fa-2x " href="mobil.php">   Laporan Transaksi </p></div>
  <?php
      include 'koneksi.php';
      $nama = $_SESSION['nama'];
      $kolom = 100;
      $i=1;
      $query=mysqli_query($con, "SELECT * FROM transaksi WHERE nama='$nama'");
      while ($data=mysqli_fetch_array($query)) {
        if(($i) % $kolom == 1) {    
        echo'
        <div class="container wrapper row">';     
        }  
        ?>
        <div class="col-sm-6">
        <div class="card mb-5" style="max-width: 550px;">
        <div class="row no-gutters">
        <div class="col-md-6">
        <img src="images/<?php echo $data[7];?>" class="card-img" alt="gambar" width="100px" height="100px">
        </div>
        <div class="col-md-10">
        <div class="card-body">
        <h5 class="card-title">Nama : <?php echo $data[1];?></h5>
        <p class="card-text">Menyewa : <?php echo $data[2];?></p>
        <p class="card-text">Warna : <?php echo $data[3];?></p>
        <p class="card-text">Harga : <?php echo $data[4];?> /Hari</p>
        <p class="card-text">Tanggal Transaksi : <?php echo $data[5];?></p>
        <p class="card-text">Tanggal Pengembalian : <?php echo $data[6];?></p>
        <a class="btn btn-success fa fa-eye" href="see.php?id=<?php echo $data['id_trans'];?>"> Lihat</a>
        <a class="btn btn-danger fa fa-trash" href="delete.php?id=<?php echo $data['id_trans'];?>"> Hapus</a>
        </div>
        </div>
        </div>
        </div>
        </div>
        <?php
        if(($i) % $kolom == 0) {    
          echo'</div>';        
      }
      $i++;
      }
      ?>
  </body>
</html>