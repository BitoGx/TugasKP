<?php
 
  //Session Start
  session_start();
  
  //Memanggil file connection php untuk menghubungkann ke Database
  require_once "connection.php";
  
  if(isset($_POST['serialnumber']) || isset($_POST['supplier']) || isset($_POST['tanggalterima']) || isset($_POST['receiver']) || isset($_POST['jenistransaksi']))
  {
    /*
    *Menyimpan Variabel yang di kirim menggunakan method POST
    *Mengubah isi variabel nama barang ke CamelCase
    */
   
    
    $supplier       = $_POST['supplier'];
    $supplier       = strtoupper($supplier);
    $receiver       = $_POST['receiver'];
    $receiver       = strtoupper($receiver);
    $jenistransaksi = $_POST['jenistransaksi'];
    $date           = $_POST['tanggalterima'];
    $descnumber     = count($_POST["descnumber"]);
    $serialnumber   = count($_POST["serialnumber"]);
    
    
    //Memilih database
    mysqli_select_db($conn,"tubesKP");
    
    //Mempersiapkan Command Query  untuk menambahkan User baru
    $sql="insert into transaksi (SupplierId,ReceiverId,Tanggal,Jenis_Transaksi) value ('$supplier','$receiver','$date','$jenistransaksi')";
    
    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql); 
    
    if($hasil)
    {
      $last_id_supplier = mysqli_insert_id($conn);
      
      if($descnumber > 0)  
      {  
        for($i=0; $i<$descnumber; $i++)  
        {
          //Menyimpan deskripsi dan serial number ke variabel
          $description = $_POST["descnumber"][$i];
          $description = strtoupper($description);
          $serial = $_POST["serialnumber"][$i];
          $serial = strtoupper($serial);
        
          //Mempersiapkan Command Query  untuk mengecek apakah Username yang ditambahkan sudah ada atau belum
          $sql="select * from barang where IdBarang='$serial'";
  
          //Menjalankan perintah query dan menyimpannya dalam variabel hasil
          $hasil=mysqli_query ($conn,$sql);
          
          //Mengambil 1 baris hasil dari perintah query
          $row=mysqli_fetch_row($hasil);

          if($row)
          {
            echo "Maaf barang dengan Serial Number = $serial sudah terdaftar di database";
            header("Refresh: 5; ../pages/formtambahpenerimaan.php");
          }
          else
          {
            //Mempersiapkan Command Query  untuk menambahkan User baru
            $sql="insert into barang value ('$serial','$description','1')"; 

            //Menjalankan perintah query dan menyimpannya dalam variabel hasil
            $hasil=mysqli_query ($conn,$sql);

            //Menjalankan perintah perulangan sebanyak yang dibutuhkan
            if($hasil)
            {
              //Mempersiapkan Command Query  untuk menambahkan User baru
              $sql="insert into detail_transaksi (TransaksiId,BarangId) value ('$last_id_supplier','$serial')";
            
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
              echo "Maaf barang dengan Serial Number = $serial yang ditambahkan gagal";
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
