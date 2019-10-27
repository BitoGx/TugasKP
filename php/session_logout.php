<?php
  session_start();
  //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
  if(isset($_SESSION['Loggedin']))
  {
    session_unset();
    session_destroy();
    header("location: ../index.php");
  }
  else
  {
    header("location: ../index.php");
  }
?>