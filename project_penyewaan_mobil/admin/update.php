<?php
/*
  Created By
  DEDI HUMAEDI
  18102140043
  APLIKASI RENTAL MOBIL
  UAS PEMROGRAMAN WEB II
*/
session_start();
if(!isset($_SESSION['name'])){
  header('location:index.php');
}
if($_SESSION['name'] != "Admin"){
  header('location:../index.php');
}

include 'koneksi.php';
$id = $_GET['id'];
$query = mysqli_query($con, "SELECT * FROM tbl_mobil WHERE id_mobil = '$id'");
$data = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RENTAL MOBIL</title>
    <link rel="stylesheet" href="../bootstrap/css/style.css"/>
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.css" />
  </head>
  <body>
<nav class="navbar navbar-expand-lg navbar-success bg-light"><?php include 'menu.php';?></nav><br>
<div class="container">
	<br/>
    <div>
	<form action="" method="post" enctype="multipart/form-data">
        <fieldset>
        <div class="container"><p class="navbar-brand fa fa-bus fa-2x " href="mobil.php">   Update Data Mobil </p></div>
		<table width="25%" border="0">
        <thead>
        <tr>
        <td><?php echo '<img width="200px" height="150px" src="../images/'.$data[5].'"/>';?> 
        </td>
        </tr>
            <tbody>
			<tr> 
				<td>Merk</td>
				<td><input type="text" name="nama" class="form-control" value="<?php echo $data[1];?> "></td>
			</tr>
			<tr> 
				<td>Warna</td>
				<td><input type="text" name="warna" class="form-control" value="<?php echo $data[2];?>" ></td>
			</tr>
			<tr> 
				<td>Plat</td>
				<td><input type="text" name="plat" class="form-control" value="<?php echo $data[3];?> "></td>
			</tr>
            <tr> 
				<td>Kursi</td>
				<td><input type="text" name="kursi" class="form-control" value="<?php echo $data[4];?> "></td>
			</tr>
            <tr> 
				<td>Harga</td>
				<td><input type="text" name="harga" class="form-control" value="<?php echo $data[6];?> "></td>
			</tr>
            <tr> 
				<td>Gambar</td>
				<td><input type="file" name="gambar"/></td>
            </tr>
			<tr> 
				<td></td>
                <br>    
				<td><div><input type="submit" name="Submit" value="Update" class="btn btn-primary"/></div></td>
			</tr>
            </tbody>
		</table>
        </fieldset>
	</form>
	</div>
	<?php
        include("koneksi.php");
        if(isset($_POST['Submit'])){
            $temp = $_FILES['gambar']['tmp_name'];
            $name = $_FILES['gambar']['name'];
            $size = $_FILES['gambar']['size'];
            $type = $_FILES['gambar']['type'];
            $nama = $_POST['nama'];
            $warna = $_POST['warna'];
            $plat = $_POST['plat'];
            $kursi = $_POST['kursi'];
            $harga = $_POST['harga'];
            $folder = "../images/";
            if ($size < 2048000 and ($type =='image/jpg' or $type == 'image/png')) {
                move_uploaded_file($temp, $folder . $name);
                $result = mysqli_query($con, "UPDATE tbl_mobil SET nama='$nama',warna='$warna',plat='$plat',kursi='$kursi',gambar='$name', harga='$harga' WHERE id_mobil='$id'");
                echo "Update successfully. <a class=\"btn btn-success\" href='mobil.php'>View Mobil</a>";
            }else{
                echo "<b>Gagal Upload File</b>";
        }
    }
  ?>
    </div>
</body>
</html>