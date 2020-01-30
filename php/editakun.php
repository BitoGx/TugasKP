<?php
  
  //Session Start
  session_start();
  
  //Memanggil Connection.php
  require_once "connection.php";
  
  if(isset($_POST['nama']) || isset($_POST['bagian']) || isset($_POST['status']) || isset($_POST['password']) || isset($_POST['newpassword']) || isset($_POST['id']))
  {
    //Menyimpan Variabel yang di kirim menggunakan method POST
    $status   = $_POST['status'];
    $iduser   = $_POST['id'];
    
    //Memilih database
    mysqli_select_db($conn,"tubesKP");
    
    if(isset($_POST['nama']) && isset($_POST['bagian']) && isset($_POST['status']) && isset($_POST['id']))
    {
      //Menyimpan Variabel yang di kirim menggunakan method POST
      $nama     = $_POST['nama'];
      $nama     = ucwords($nama);
      $bagian   = $_POST['bagian'];
      $bagian   = ucwords($bagian);
      
      //Mempersiapkan Command Query  untuk mengecek apakah barang yang ditambahkan sudah ada atau belum
      $sql="update user set Nama = '$nama', Bagian = '$bagian', Status = '$status' where IdUser = $iduser";
      
      //Menjalankan perintah query dan menyimpannya dalam variabel hasil
      $hasil=mysqli_query ($conn,$sql);
      
      if($hasil)
      {
        header("location: ../pages/kelolaakun.php");
      }
      else
      {
        echo "Database gagal di update";
        header("Refresh: 5; http://localhost/TugasKP/pages/kelolaakun.php");
      }
    }
    if(isset($_POST['password']) && isset($_POST['newpassword']) && isset($_POST['id']) && isset($_POST['status']))
    {
      //Menyimpan Variabel yang di kirim menggunakan method POST
      $password = $_POST['password'];
      $password = sha1($password);
      $newpass  = $_POST['newpassword'];
      $newpass  = sha1($newpass);
      
      //Mempersiapkan Command Query  untuk mengecek apakah barang yang ditambahkan sudah ada atau belum
      $sql="select * from user where IdUser = $iduser and Password = '$password'";
      
      //Menjalankan perintah query dan menyimpannya dalam variabel hasil
      $hasil=mysqli_query ($conn,$sql);
      
      //Mengecek apakah terjadi perubahan di dalam database atau tidak
      $row=mysqli_affected_rows($hasil);
      
      if($row)
      {
        //Mempersiapkan Command Query  untuk mengecek apakah barang yang ditambahkan sudah ada atau belum
        $sql="update user set Password = '$newpass', Status = '$status' where IdUser = $iduser and Password = '$password'";
      
        //Menjalankan perintah query dan menyimpannya dalam variabel hasil
        $hasil=mysqli_query ($conn,$sql);
        
        if($hasil)
        {
          header("location: ../pages/kelolaakun.php");
        }
        else
        {
          echo "Database gagal di update";
          header("Refresh: 5; http://localhost/TugasKP/pages/kelolaakun.php");
        }
      }
      else
      {
        echo "Maaf password lama yang anda masukkan salah";
        header("Refresh: 5; http://localhost/TugasKP/pages/kelolaakun.php");
      }
    }
  }
  else
  {
    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "session_check_dalam.php";
  }