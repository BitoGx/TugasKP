<?php
  session_start();
  //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
  if(isset($_SESSION['Loggedin']))
  {
    unset($_SESSION['Loggedin']);
    session_destroy();
    header("location: ../pages/index.php");
  }
  else
  {
    header("location: ../pages/index.php");
  }
?>