<?php
 
  //Session Start
  session_start();
  
  //Memanggil file connection php untuk menghubungkann ke Database
  require_once "connection.php";
  
  if(isset($_POST['username']) || isset($_POST['nama']) || isset($_POST['bagian']) || isset($_POST['pass1'])|| isset($_POST['pass2']))
  {
    /*
    *Menyimpan Variabel yang di kirim menggunakan method POST
    *Mengubah isi variabel nama barang ke CamelCase
    */
    $username = $_POST['username'];
    $username = strtolower($username);
    $username = str_replace(' ','', $username);
    $nama     = $_POST['nama'];
    $nama     = strtolower($nama);
    $nama     = ucwords($nama);
    $pass     = $_POST['pass1'];
    $pass     = sha1($pass);
    $bagian   = $_POST['bagian'];

    //Memilih database
    mysqli_select_db($conn,"tubesKP");

    //Mempersiapkan Command Query  untuk mengecek apakah Username yang ditambahkan sudah ada atau belum
    $sql="select * from admin where Username='$username'";

    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);

    //Mengambil 1 baris hasil dari perintah query
    $row=mysqli_fetch_row($hasil);

    if($row)
    {
      echo "Maaf Username sudah terdaftar di dalam database";
      header("Refresh: 5; ../pages/formtambahakun.php");
    }
    else
    {
      //Mempersiapkan Command Query  untuk menambahkan User baru
      $sql="insert into admin (Username,Nama,Password,Bagian) value ('$username','$nama','$pass','$bagian')";

      //Menjalankan perintah query dan menyimpannya dalam variabel hasil
      $hasil=mysqli_query ($conn,$sql);

      //Menjalankan perintah perulangan sebanyak yang dibutuhkan
      if($hasil)
      {
        header("location: ../pages/kelolaakun.php");
      }
      else
      {
        //Jika Penambahan User gagal akan menampilkan pesan error
        echo "User yang ditambahkan gagal";
        header("Refresh: 5; ../pages/formtambahakun.php");
      }
    }
  }
  else
  {
    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "session_check_dalam.php";
  }
?>
