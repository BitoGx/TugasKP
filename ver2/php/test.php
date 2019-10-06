<?php
  session_start();
  if(isset($_SESSION['Loggedin']) and $_SESSION['Loggedin'] == false)
  {
    //header("location: ../pages/login.php");
    echo "True";
    exit;
  }
  else
  {
    echo "false";
  }
?>