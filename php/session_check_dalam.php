<?php
  if((!isset($_SESSION['Loggedin']) and $_SESSION['Loggedin'] == false) or ($_SESSION['Status'] == 0))
  {
    header("location: ../pages/login.php");
    exit;
  }
?>