<?php
  //Memanggil file connection php untuk menghubungkann ke Database
  require_once "connection.php";
  if(isset($_POST['nama']) && isset($_POST['nik']) && isset($_POST['jabatan']))
  {
    /*
     * Menyimpan kedalam variabel dari data yang kirim menggunakan method POST
     * Mengubah isi variabel nama dan jabatan ke Uppercase
     */
    $nama     = $_POST['nama'];
    $nama     = strtoupper($nama);
    $nik      = $_POST['nik'];
    $jabatan  = $_POST['jabatan'];
    $jabatan  = strtoupper($jabatan);

    //Mengecek apakah NIK dengan Jabatan  sudah terdaftar di database
    $sql="select * from receiver_first_party where NIK='$nik' and Jabatan = '$jabatan'";
    $hasil=mysqli_query ($conn,$sql);
    
    /*
     * Mengecek apakah perintah query yang dijalankan gagal atau berhasil
     * jika berhasil akan mengambil row sesuai perintah query sebelumnya
     * jika gagal akan memberikan nilai false
     */
    if($hasil)
    {
      $row=mysqli_fetch_row($hasil);
    }
    else
    {
      $row = false;
    }
    /*
     * Mengecek apakah $row memiliki data atau tidak
     * jika didalam $row ada datanya akan menampilkan pesan sudah terdaftar 
     * dan dikembalikan ke form tambah penerima
     * jika belum terdaftar maka akan ditambahkan kedalam database 
     */
    if($row)
    {
      echo "Maaf NIK $nik dengan Jabatan $jabatan sudah terdaftar di dalam database";
      header("Refresh: 5; ../pages/formtambahfirstreceiver.php");
    }
    else
    {
      $sql="insert into receiver_first_party (Nama,NIK,Jabatan) value ('$nama','$nik','$jabatan')";
      $hasil=mysqli_query ($conn,$sql);
      
      /*
       * Mengecek apakah perintah query yang dijalankan gagal atau berhasil
       * jika berhasil akan dipindahkan ke halaman daftar Penerima
       * jika gagal akan dikembalikan ke halaman tambah penerima
       */
      if($hasil)
      {
        header("location: ../pages/simfirstreceiver.php");
      }
      else
      {
        echo "Maaf data penerima yang ditambahkan gagal";
        header("Refresh: 5; ../pages/formtambahfirstreceiver.php");
      }
    }
  }
  else
  {
    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "session_check_dalam.php";
  }
?>
