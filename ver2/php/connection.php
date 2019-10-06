 <?php
  $dbhost = "localhost";
  $dbname = "tubesKP";
  $dbuser = "root";
  $dbpass = "";

  // Buat Koneksi
  $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  // Check Koneksi Nerhasil atau Tidak
  if (!$conn) 
  {
    die("Connection failed: " . mysqli_connect_error());
  }  
?>