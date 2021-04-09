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
$nam = $_SESSION['nama'];
$id = $_GET['id'];
$sql = mysqli_query($con, "SELECT * FROM tbl_mobil WHERE id_mobil=$id");
$data = mysqli_fetch_array($sql);
$sql1 = mysqli_query($con, "SELECT * FROM customer WHERE nama='$nam'");
$row = mysqli_fetch_array($sql1);
$date = date('d-M-Y,  h:i:s A');
$yesterday = date('d-M-Y,  h:i:s A', strtotime('+1 days', strtotime($date)));
$harga = number_format($data['harga'],0,",",".");
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
        <div class="card mb-11" style="max-width: 540px;">
                <div class="col-md-155">
                    <div class="card-body">
                    <img src="images/<?php echo $data['gambar'];?>" class="card-img" alt="gambar" width="150px" height="150px">
                    <p class="card-text">Nama : <?php echo $row[1];?></p>
                    <p class="card-text">Menyewa : <?php echo $data[1];?></p>
                    <p class="card-text">Warna : <?php echo $data[2];?></p>
                    <p class="card-text">Harga : <?php echo $harga;?> /Hari</p>
                    <p class="card-text">Tanggal Transaksi : <?php echo $date;?></p>
                    <p class="card-text">Tanggal Pengembalian : <?php echo $yesterday;?></p>
                    <p class="card-text"><b>NOTE : MOHON MENGEMBALIKAN MOBIL TEPAT WAKTU</b></p>
                    <form method="post">
                    <input type="submit" name="cekout" value=" Proses" class="btn btn-primary" / >
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php
if(isset($_POST['cekout'])){
    $query = mysqli_query($con, "INSERT INTO transaksi VALUES ('','$row[1]','$data[1]','$data[2]','$harga','$date','$yesterday','$data[5]','$data[0]')");
    if($query){
        echo "Transaksi successfully. <a class=\"btn btn-success fa fa-paper-plane\" href=\"transaksi.php\"> View TX</a>";
    }
}

?>
