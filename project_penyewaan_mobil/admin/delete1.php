<?php
/*
  Created By
  DEDI HUMAEDI
  18102140043
  APLIKASI RENTAL MOBIL
  UAS PEMROGRAMAN WEB II
*/
include 'koneksi.php';
$id = $_GET['id'];
$sql = mysqli_query($con, "DELETE FROM transaksi WHERE id_trans = '$id'");
if($sql){
    echo "<script>alert('Berhasil di hapus')</script><meta content=\"0; url=laporan.php\" http-equiv=\"refresh\">";
}else{
    echo "<script>alert('Gagal di hapus')</script><meta content=\"0; url=laporan.php\" http-equiv=\"refresh\">";
}
?>