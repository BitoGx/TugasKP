<?php
  session_start();
  //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
  if($_SESSION['Control'] == false)
  {
    if($_SESSION['Control'] == true)
    {
      header("location: ../pages/index.php");
    }
  }
  else
  {
    unset($_SESSION['Control']);
    session_destroy();
    header("location: ../pages/login.php");
  }
?>