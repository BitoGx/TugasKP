<?php
  //Session Start
  session_start();
  
  if(isset($_POST['username']) || isset($_POST['password']))
  {
    /*
    *Menyimpan Variabel yang di kirim menggunakan method POST
    *Mengubah isi variabel ke lowercase
    */
    $username=$_POST['username'];
    $username = strtolower($username);
    $password=$_POST['password'];
    $password = sha1($password);
    
    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "connection.php";
  
    //Memilih database
    mysqli_select_db($conn,"tubesKP");
  
    //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
    $sql="select Nama,Bagian,Id_Admin from admin where Username='$username' and Password='$password' and Status=1";
  
    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);
  
    //Mengambil 1 baris hasil dari perintah query
    $row=mysqli_fetch_row($hasil);

    
    //Menjalankan perintah perulangan sebanyak yang dibutuhkan
    if($row)
    {
      list($Nama,$Bagian,$Id_Admin)=$row;
      $_SESSION['Nama']=$Nama;
      $_SESSION['Bagian']=$Bagian;
      $_SESSION['Id_Admin']=$Id_Admin;
      $_SESSION['Loggedin'] = "true";
      header("location: ../index.php");
    }
    //Jika Username atau Password salah maka menampilkan pesan salah
    else
    {
      echo "<center><h1>USERNAME DAN PASSWORD SALAH</h1></center>";
      header("Refresh: 3; http://localhost/tugasKP/pages/login.php");
    }
  }
  else
  {
    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "session_check_dalam.php";
  }
?>