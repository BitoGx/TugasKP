<?php
 
  //Session Start
  session_start();
  
  //Memanggil file connection php untuk menghubungkann ke Database
  require_once "connection.php";
  
  if(isset($_POST['namasupplier']) || isset($_POST['picsupplier']))
  {
    /*
    *Menyimpan Variabel yang di kirim menggunakan method POST
    *Mengubah isi variabel nama barang ke CamelCase
    */
    $nama = $_POST['namasupplier'];
    $nama = strtoupper($nama);
    $pic  = $_POST['picsupplier'];
    $pic  = strtoupper($pic);
    
    //Memilih database
    mysqli_select_db($conn,"tubesKP");

    //Mempersiapkan Command Query  untuk mengecek apakah Username yang ditambahkan sudah ada atau belum
    $sql="select * from supplier where Nama_Supplier='$nama' and PIC='$pic'";

    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);

    //Mengambil 1 baris hasil dari perintah query
    $row=mysqli_fetch_row($hasil);

    if($row)
    {
      echo "Maaf Supplier $nama dengan PIC $pic sudah terdaftar di dalam database";
      header("Refresh: 5; ../pages/formtambahsupplier.php");
    }
    else
    {
      //Mempersiapkan Command Query  untuk menambahkan User baru
      $sql="insert into supplier (Nama_Supplier,PIC) value ('$nama','$pic')";

      //Menjalankan perintah query dan menyimpannya dalam variabel hasil
      $hasil=mysqli_query ($conn,$sql);

      //Menjalankan perintah perulangan sebanyak yang dibutuhkan
      if($hasil)
      {
        header("location: ../pages/supplier.php");
      }
      else
      {
        //Jika Penambahan User gagal akan menampilkan pesan error
        echo "Maaf data supplier yang ditambahkan gagal";
        header("Refresh: 5; ../pages/formtambahsupplier.php");
      }
    }
  }
  else
  {
    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "session_check_dalam.php";
  }
?>
