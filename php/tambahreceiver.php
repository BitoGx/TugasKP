<?php
 
  //Session Start
  session_start();
  
  //Memanggil file connection php untuk menghubungkann ke Database
  require_once "connection.php";
  
  if(isset($_POST['nama']) || isset($_POST['nik']) || isset($_POST['jabatan']))
  {
    /*
    *Menyimpan Variabel yang di kirim menggunakan method POST
    *Mengubah isi variabel nama barang ke CamelCase
    */
    $nama     = $_POST['nama'];
    $nama     = strtoupper($nama);
    
    if(!empty($_POST['nik']))
    {
      $nik    = $_POST['nik'];
    }
    else
    {
      $nik    = null;
    }
    $jabatan  = $_POST['jabatan'];
    $jabatan  = strtoupper($jabatan);
    
    
    
    //Memilih database
    mysqli_select_db($conn,"tubesKP");

    //Mempersiapkan Command Query  untuk mengecek apakah Username yang ditambahkan sudah ada atau belum
    $sql="select * from receiver where NIK='$nik' and Jabatan = '$jabatan'";

    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);

    //Mengambil 1 baris hasil dari perintah query
    $row=mysqli_fetch_row($hasil);

    if($row)
    {
      echo "Maaf NIK $nik sudah terdaftar di dalam database";
      header("Refresh: 5; ../pages/formtambahpenerima.php");
    }
    else
    {
      //Mempersiapkan Command Query  untuk menambahkan User baru
      $sql="insert into receiver (Nama_Receiver,NIK,Jabatan) value ('$nama','$nik','$jabatan')";

      //Menjalankan perintah query dan menyimpannya dalam variabel hasil
      $hasil=mysqli_query ($conn,$sql);

      //Menjalankan perintah perulangan sebanyak yang dibutuhkan
      if($hasil)
      {
        header("location: ../pages/penerima.php");
      }
      else
      {
        //Jika Penambahan User gagal akan menampilkan pesan error
        echo "Maaf data penerima yang ditambahkan gagal";
        header("Refresh: 5; ../pages/formtambahpenerima.php");
      }
    }
  }
  else
  {
    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "session_check_dalam.php";
  }
?>
