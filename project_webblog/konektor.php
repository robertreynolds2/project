<?php

// host databasse
$host = "localhost";

// Username Database
$user = "root";

//password databse
$pass = "";

// database
$db = "db_webblog";

// connect dengan mysql
$koneksi = mysqli_connect($host, $user, $pass, $db);

if(!$koneksi){
    echo "Gagal Konek". die(mysqli_error($koneksi)); // Jika koneksi gagal akan menampilkan gagal konek
}
?>