<?php
 
  //Session Start
  session_start();
  
  //Memanggil file connection php untuk menghubungkann ke Database
  require_once "connection.php";
  
  if(isset($_POST['serialnumber']) || isset($_POST['deskripsibarang']))
  {
    /*
    *Menyimpan Variabel yang di kirim menggunakan method POST
    *Mengubah isi variabel nama barang ke CamelCase
    */
    $serialnumber = $_POST['serialnumber'];
    $deskripsi    = $_POST['deskripsibarang'];
    if(!empty($_POST['submitbatch']))
    {
      $batch = true;
    }
    else
    {
      $batch = false;
    }
    
    //Memilih database
    mysqli_select_db($conn,"tubesKP");

    //Mempersiapkan Command Query  untuk mengecek apakah Username yang ditambahkan sudah ada atau belum
    $sql="select * from barang where IdBarang='$serialnumber'";

    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);

    //Mengambil 1 baris hasil dari perintah query
    $row=mysqli_fetch_row($hasil);

    if($row)
    {
      echo "Maaf Serial Number barang sudah terdaftar di dalam database";
      header("Refresh: 5; ../pages/formtambahbarang.php");
    }
    else
    {
      //Mempersiapkan Command Query  untuk menambahkan User baru
      $sql="insert into barang (IdBarang,Description) value ('$serialnumber','$deskripsi')";

      //Menjalankan perintah query dan menyimpannya dalam variabel hasil
      $hasil=mysqli_query ($conn,$sql);

      //Menjalankan perintah perulangan sebanyak yang dibutuhkan
      if($hasil)
      {
        if($batch)
        {
          header("location: ../pages/formtambahbarang.php?desc=$deskripsi");
        }
        else
        {
          header("location: ../pages/sim.php");
        }
      }
      else
      {
        //Jika Penambahan User gagal akan menampilkan pesan error
        echo "Maaf barang yang ditambahkan gagal";
        header("Refresh: 5; ../pages/formtambahbarang.php");
      }
    }
  }
  else
  {
    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "session_check_dalam.php";
  }
?>
