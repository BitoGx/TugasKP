<?php
  //Memanggil file connection php untuk menghubungkann ke Database
  require_once "connection.php";
  if(isset($_POST['namapengirim']) && isset($_POST['picpengirim']) && isset($_POST['submit']))
  {
    /*
     * Menyimpan kedalam variabel dari data yang kirim menggunakan method POST
     * Mengubah isi variabel nama pengirim ( supplier ) dan PIC ke Uppercase
     */
    $nama = $_POST['namapengirim'];
    $nama = strtoupper($nama);
    $pic  = $_POST['picpengirim'];
    $pic  = strtoupper($pic);
    
    //Mengecek apakah Nama PIC dengan Nama Pengirim ( Supplier ) sudah terdaftar di database
    $sql="select * from supplier where Nama_Supplier='$nama' and PIC='$pic'";
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
     * dan dikembalikan ke form tambah pengirim
     * jika belum terdaftar maka akan ditambahkan kedalam database 
     */
    if($row)
    {
      echo "Maaf Supplier $nama dengan PIC $pic sudah terdaftar di dalam database";
      header("Refresh: 5; ../pages/formtambahpengirim.php");
    }
    else
    {
      $sql="insert into supplier (Nama,PIC) value ('$nama','$pic')";
      $hasil=mysqli_query ($conn,$sql);
      
      /*
       * Mengecek apakah perintah query yang dijalankan gagal atau berhasil
       * jika berhasil akan dipindahkan ke halaman daftar pengirim ( Supplier )
       * jika gagal akan dikembalikan ke halaman tambah pengirim
       */
      if($hasil)
      {
        header("location: ../pages/simpengirim.php");
      }
      else
      {
        echo "Maaf data pengirim yang ditambahkan gagal<br>";
        header("Refresh: 5; ../pages/formtambahpengirim.php");
      }
    }
  }
  else
  {
    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "session_check_dalam.php";
  }
?>
