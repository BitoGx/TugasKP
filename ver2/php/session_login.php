<?php
  //Session Start
  session_start();
  
  //ob_start();
  
  if(isset($_POST['email']))
  {
    /*
    *Menyimpan Variabel yang di kirim menggunakan method POST
    *Mengubah isi variabel ke lowercase
    */
    $email=$_POST['email'];
    $email = strtolower($email);
    $password=$_POST['password'];
    $password = $password;
    $_SESSION['Loggedin'] = "true";
    
    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "connection.php";
  
    //Memilih database
    mysqli_select_db($conn,"tubesKP");
  
    //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
    $sql="select * from admin where username='$email' and password=sha1('$password')";
  
    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);
  
    //Mengambil 1 baris hasil dari perintah query
    $row=mysqli_fetch_row($hasil);

    
    //Menjalankan perintah perulangan sebanyak yang dibutuhkan
    if($row)
    {
      header("location: ../pages/index.php");
    }
    //Jika Username atau Password salah maka menampilkan pesan salah
    else
    {
      echo "<center><h1>USERNAME DAN PASSWORD SALAH</h1></center>";
      $_SESSION['Loggedin']="false";
      header("Refresh: 5; http://localhost/tugasKP/pages/login.php");
    }
  }
  else
  {
    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "session_check_dalam.php";
  }
?>