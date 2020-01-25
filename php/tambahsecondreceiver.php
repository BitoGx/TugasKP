<?php
  //Memanggil file connection php untuk menghubungkann ke Database
  require_once "connection.php";
  if(isset($_POST['nama']) && isset($_POST['nonik']) && isset($_POST['jabatan']) && isset($_POST['tempatkerja']))
  {
    /*
     * Menyimpan kedalam variabel dari data yang kirim menggunakan method POST
     * Mengubah isi variabel nama dan jabatan ke Uppercase
     */
     
    $nama         = $_POST['nama'];
    $nama         = strtoupper($nama);
    $nonik        = $_POST['nonik'];
    $jabatan      = $_POST['jabatan'];
    $jabatan      = strtoupper($jabatan);
    $tempatkerja  = $_POST['tempatkerja'];
    $tempatkerja  = strtoupper($tempatkerja);

    //Mengecek apakah NIK dengan Jabatan dan kerja di Tempat Kerja yang sama sudah terdaftar di database
    $sql="select * from second_party where NoNIK='$nonik' and Jabatan = '$jabatan' and TempatKerja = $tempatkerja";
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
     * dan dikembalikan ke form tambah pihak kedua
     * jika belum terdaftar maka akan ditambahkan kedalam database 
     */
    if($row)
    {
      echo "Maaf NIK $nik dengan Jabatan $jabatan yang bekerja di $tempatkerja sudah terdaftar di dalam database";
      header("Refresh: 5; ../pages/formtambahsecondreceiver.php");
    }
    else
    {
      $sql="insert into second_party (Nama,NoNIK,Jabatan,TempatKerja) value ('$nama','$nonik','$jabatan','$tempatkerja')";
      $hasil=mysqli_query ($conn,$sql);
      
      /*
       * Mengecek apakah perintah query yang dijalankan gagal atau berhasil
       * jika berhasil akan dipindahkan ke halaman daftar pihak kedua
       * jika gagal akan dikembalikan ke halaman tambah pihak kedua
       */
      if($hasil)
      {
        header("location: ../pages/simsecondreceiver.php");
      }
      else
      {
        echo "Maaf data pihak kedua yang ditambahkan gagal";
        header("Refresh: 5; ../pages/formtambahsecondreceiver.php");
      }
    }
  }
  else
  {
    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "session_check_dalam.php";
  }
?>
