<?php
  session_start();
  echo $_SESSION['Control'];
  session_destroy();
?>