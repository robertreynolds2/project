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
  <div class="container"><p class="navbar-brand fa fa-car fa-2x " href="mobil.php">   Mobil Tersedia</p></div>
  <?php
      include 'koneksi.php';
      $kolom = 100;
      $i=1; 
      $query=mysqli_query($con, "SELECT * FROM tbl_mobil");
      while ($data=mysqli_fetch_array($query)) {
        if(($i) % $kolom == 1) {    
        echo'
        <div class="container wrapper row">';     
        }  
        ?>
        <div class="col-sm-6">
        <div class="card mb-4" style="max-width: 540px;">
        <div class="row no-gutters">
        <div class="col-md-4">
        <img src="images/<?php echo $data['gambar'];?>" class="card-img" alt="gambar" width="150px" height="150px">
        </div>
        <div class="col-md-6">
        <div class="card-body">
        <h5 class="card-title"><?php echo $data['nama'];?></h5>
        <p class="card-text"><?php echo "Warna : ".$data[2];?></p>
        <p class="card-text"><?php echo "Plat : ".$data[3];?></p>
        <p class="card-text"><?php echo "Kursi : ".$data[4];?></p>
        <a class="btn btn-primary fa fa-eye" href="pesan.php?id=<?php echo $data[0];?>">  Details</a>
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