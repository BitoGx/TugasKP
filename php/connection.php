 <?php
  $dbhost = "localhost";
  $dbname = "sim";
  $dbuser = "root";
  $dbpass = "";

  // Buat Koneksi
  $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  
  mysqli_select_db($conn,"sim");

  // Check Koneksi Nerhasil atau Tidak
  if (!$conn) 
  {
    die("Connection failed: " . mysqli_connect_error());
  }  
?>