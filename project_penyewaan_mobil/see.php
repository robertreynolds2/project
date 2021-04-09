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
$id = $_GET['id'];
$nama = $_SESSION['nama'];
$sql = mysqli_query($con, "SELECT * FROM transaksi WHERE id_trans='$id'");
$data = mysqli_fetch_array($sql);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print</title>
    <link rel="stylesheet" href="bootstrap/css/style.css"/>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.css" />
  </head>
  <body>
        <h5 class="card-title">Laporan Transaksi <?php echo $data['nama'];?></h5>
        <div class="col-sm-4 invoice-col">
              <address>
                <strong>Rental Mobil Dedi Humaedi</strong><br>
                Jl. Arya Santika No. 02<br>
                Kec. Tigaraksa, Tangerang,<br>
                Banten 15720<br>
                Phone: +6281385351530<br>
                Email: dedisadja97@gmail.com
              </address>
            </div>
          </div>
        <div class="row">
            <div class="col-xs-10 table-responsive">
              <table class="table table-striped">
                <thead>
                <tr><th>Nama</th><th>Menyewa</th><th>Warna</th><th>Plat</th><th>Tanggal Transaksi</th><th>Tanggal Pengembalian</th></tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $data[1]; ?></td>
                        <td><?php echo $data[2]; ?></td>
                        <td><?php echo $data[3]; ?></td>
                        <td><?php echo $data[4]; ?></td>
                        <td><?php echo $data[5]; ?></td>
                        <td><?php echo $data[6]; ?></td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td><b>Total Biaya</b></td>
                        <td><b><?php echo "Rp. ".$data[4]; ?></b></td>
                    </tr>
                </tbody>
              </table>
            </div>
        </div>
  </body>
  <script>window.print()</script> 
</html>