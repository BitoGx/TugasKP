<?php
 
  //Session Start
  session_start();
  
  //Memanggil file connection php untuk menghubungkann ke Database
  require_once "connection.php";
  
  if(isset($_POST['serialnumber']) && isset($_POST['firstparty']) || isset($_POST['tanggalpenyerahan']) || isset($_POST['secondparty']))
  {
    /*
    *Menyimpan Variabel yang di kirim menggunakan method POST
    *Mengubah isi variabel nama barang ke CamelCase
    */
   
    
    $firstparty     = $_POST['firstparty'];
    $firstparty     = strtoupper($firstparty);
    $secondparty    = $_POST['secondparty'];
    $secondparty    = strtoupper($secondparty);
    $date           = $_POST['tanggalpenyerahan'];
    $serialnumber   = count($_POST["serialnumber"]);
    
    
    //Memilih database
    mysqli_select_db($conn,"tubesKP");
    
    //Mempersiapkan Command Query  untuk menambahkan User baru
    $sql="insert into transaksi_stm (FirstPartyId,SecondPartyId,Tanggal) value ('$firstparty','$secondparty','$date')";
    
    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql); 
    
    if($hasil)
    {
      $last_id_supplier = mysqli_insert_id($conn);
      
      if($serialnumber > 0)  
      {  
        for($i=0; $i<$serialnumber; $i++)  
        {
          //Menyimpan serial number ke variabel
          $serial = $_POST["serialnumber"][$i];
          $serial = strtoupper($serial);
        
          //Mempersiapkan Command Query  untuk menambahkan User baru
          $sql="update barang set Status='Keluar' where IdBarang='$serial'"; 

          //Menjalankan perintah query dan menyimpannya dalam variabel hasil
          $hasil=mysqli_query ($conn,$sql);

          //Menjalankan perintah perulangan sebanyak yang dibutuhkan
          if($hasil)
          {
            //Mempersiapkan Command Query  untuk menambahkan User baru
            $sql="insert into detail_stm (TransaksiStmId,BarangId) value ('$last_id_supplier','$serial')";
            
            //Menjalankan perintah query dan menyimpannya dalam variabel hasil
            $hasil=mysqli_query ($conn,$sql);
              
            if(!$hasil)
              {
                //Jika Penambahan User gagal akan menampilkan pesan error
                echo "Maaf detail transaksi gagal ditambahkan ";
                header("Refresh: 5; ../pages/formtambahpenyerahan.php");
              }
            }
            else
            {
              //Jika Penambahan User gagal akan menampilkan pesan error
              echo "Maaf barang dengan Serial Number = $serial yang ditambahkan gagal";
              header("Refresh: 5; ../pages/formtambahpenyerahan.php");
            }
          }
          header("location: ../pages/simpenyerahan.php");
      }
    }
    else
    {
      //Jika Penambahan User gagal akan menampilkan pesan error
      echo "Maaf data penerimaan barang masuk gagal ditambahkan";
      header("Refresh: 5; ../pages/formtambahpenyerahan.php");
    }
  }
  else
  {
    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "session_check_dalam.php";
  }
?>
