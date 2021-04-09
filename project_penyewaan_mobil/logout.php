<?php
/*
  Created By
  DEDI HUMAEDI
  18102140043
  APLIKASI RENTAL MOBIL
  UAS PEMROGRAMAN WEB II
*/
    session_start();
    $_SESSION['nama'] = '';
    unset($_SESSION['nama']);
    session_unset();
    session_destroy();
    header("Location: index.php");
?>