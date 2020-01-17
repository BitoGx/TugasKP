<?php
 
  //Session Start
  session_start();
  
  //Memanggil file connection php untuk menghubungkann ke Database
  require_once "connection.php";
  
  if(isset($_POST['serialnumber']) || isset($_POST['deskripsi']) || isset($_POST['supplier']) || isset($_POST['tanggalterima']) || isset($_POST['receiver']) || isset($_POST['jenistransaksi']))
  {
    /*
    *Menyimpan Variabel yang di kirim menggunakan method POST
    *Mengubah isi variabel nama barang ke CamelCase
    */
   
    $deskripsi      = $_POST['deskripsi'];
    $supplier       = $_POST['supplier'];
    $receiver       = $_POST['receiver'];
    $jenistransaksi = $_POST['jenistransaksi'];
    $date           = $_POST['tanggalterima'];
    $number         = count($_POST["serialnumber"]);
    
    //Memilih database
    mysqli_select_db($conn,"tubesKP");
    
    //Mempersiapkan Command Query  untuk menambahkan User baru
    $sql="insert into transaksi (SupplierId,ReceiverId,Tanggal,Jenis_Transaksi) value ('$supplier','$receiver','$date','$jenistransaksi')";
    
    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql); 
    
    if($hasil)
    {
      $last_id_supplier = mysqli_insert_id($conn);
      
      if($number > 0)  
      {  
        for($i=0; $i<$number; $i++)  
        {
          //Menyimpan serial number ke variabel
          $serialnumber = $_POST["serialnumber"][$i];
        
          //Mempersiapkan Command Query  untuk mengecek apakah Username yang ditambahkan sudah ada atau belum
          $sql="select * from barang where IdBarang=$serialnumber";
  
          //Menjalankan perintah query dan menyimpannya dalam variabel hasil
          $hasil=mysqli_query ($conn,$sql); 
        
          if($hasil)
          {
            echo "Maaf Serial Number barang sudah terdaftar di dalam database";
            header("Refresh: 5; ../pages/formtambahpenerimaan.php");
          }
          else
          {
            //Mempersiapkan Command Query  untuk menambahkan User baru
            $sql="insert into barang value ('$serialnumber','$deskripsi')"; 

            //Menjalankan perintah query dan menyimpannya dalam variabel hasil
            $hasil=mysqli_query ($conn,$sql);

            //Menjalankan perintah perulangan sebanyak yang dibutuhkan
            if($hasil)
            {
              //Mempersiapkan Command Query  untuk menambahkan User baru
              $sql="insert into detail_transaksi (TransaksiId,BarangId) value ('$last_id_supplier','$serialnumber')";
            
              //Menjalankan perintah query dan menyimpannya dalam variabel hasil
              $hasil=mysqli_query ($conn,$sql);
              
              if(!$hasil)
              {
                //Jika Penambahan User gagal akan menampilkan pesan error
                echo "Maaf detail transaksi gagal ditambahkan ";
                header("Refresh: 5; ../pages/formtambahpenerimaan.php");
              }
            }
            else
            {
              //Jika Penambahan User gagal akan menampilkan pesan error
              echo "Maaf barang dengan Serial Number = $serialnumber yang ditambahkan gagal";
              header("Refresh: 5; ../pages/formtambahpenerimaan.php");
            }
          } 
        }
        header("location: ../pages/simpenerimaan.php");
      }
    }
    else
    {
      //Jika Penambahan User gagal akan menampilkan pesan error
      echo "Maaf data penerimaan barang masuk gagal ditambahkan";
      header("Refresh: 5; ../pages/formtambahpenerimaan.php");
    }
  }
  else
  {
    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "session_check_dalam.php";
  }
?>
