<?php
  //Memanggil file connection php untuk menghubungkann ke Database
  require_once "connection.php";
  if(isset($_POST['serialnumber']) || isset($_POST['pengirim']) || isset($_POST['tanggalterima']) || isset($_POST['penerima']) || isset($_POST['jenistransaksi']))
  {
    /*
    *Menyimpan Variabel yang di kirim menggunakan method POST
    *Mengubah isi variabel pengirim dan penerima dan PIC ke Uppercase
    */
    $pengirim       = $_POST['pengirim'];
    $pengirim       = strtoupper($pengirim);
    $penerima       = $_POST['penerima'];
    $penerima       = strtoupper($penerima);
    $jenistransaksi = $_POST['jenistransaksi'];
    $date           = $_POST['tanggalterima'];
    $descnumber     = count($_POST["descnumber"]);
    $serialnumber   = count($_POST["serialnumber"]);
    
    //Menambahkan data transaksi kedalam tabel transaksi pbm
    $sql="insert into transaksi_pbm (SupplierId,FirstPartyId,Tanggal) value ('$pengirim','$penerima','$date')";
    $hasil=mysqli_query ($conn,$sql); 
    
    /*
     * Mengecek apakah perintah query yang dijalankan gagal atau berhasil
     * jika berhasil akan mengambil id dari data yang ditambahkan terakhir
     * dan menyimpannya di variabel $last_id_supplier
     * jika gagal akan menampilkan pesan dan mengembalikannya ke form tambah penerimaan baran masuk
     */
    if($hasil)
    {
      $last_id_supplier = mysqli_insert_id($conn);
      /*
       * Melakukan perulangan hingga semua data barang dan detail transaksi selesai masuk kedalam database
       * jika selesai akan dikembalikan ke daftar penerimaan barang masuk
       */
      for($i=0; $i<$descnumber; $i++)  
      {
        /*
         * Menyimpan deskripsi dan serial number ke variabel
         * Mengubah isi variabel description dan serial menjadi Uppercase
         */
        $description = $_POST["descnumber"][$i];
        $description = strtoupper($description);
        $serial      = $_POST["serialnumber"][$i];
        $serial      = strtoupper($serial);
      
        //Mengecek apakah barang dengan serial number tersebut sudah terdaftar di database
        $sql="select * from barang where IdBarang='$serial'";
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
         * dan dikembalikan ke form tambah penerimaan baran masuk
         * jika belum terdaftar maka akan ditambahkan kedalam database 
         */
        if($row)
        {
          echo "Maaf barang dengan Serial Number = $serial sudah terdaftar di database";
          header("Refresh: 5; ../pages/formtambahpenerimaan.php");
        }
        else
        {
          //Menambahkan data barang kedalam tabel barang
          $sql="insert into barang value ('$serial','$description','Masuk')"; 
          $hasil=mysqli_query ($conn,$sql);

          /*
           * Mengecek apakah perintah query yang dijalankan gagal atau berhasil
           * jika berhasil akan memasukan data barang dan transaksi kedalam detail transaksi pbm
           * jika gagal akan menampilkan pesan dan dikembalikan ke form tambah penerimaan barang masuk
           */
          if($hasil)
          {
            //Menambahkan data barang dan transaksi kedalam tabel detail pbm
            $sql="insert into detail_pbm (TransaksiPbmId,BarangId) value ('$last_id_supplier','$serial')";
            $hasil=mysqli_query ($conn,$sql);
            
            /*
             * Mengecek apakah perintah query yang dijalankan gagal atau berhasil
             * jika berhasil akan melanjutkan sampai loop selesai ( $i melebihi $descnumber )
             * jika gagal akan menampilkan pesan dan dikembalikan ke form tambah penerimaan barang masuk
             */
            if(!$hasil)
            {
              echo "Maaf detail transaksi gagal ditambahkan ";
              header("Refresh: 5; ../pages/formtambahpenerimaan.php");
            }
          }
          else
          {
            echo "Maaf barang dengan Serial Number = $serial yang ditambahkan gagal";
            header("Refresh: 5; ../pages/formtambahpenerimaan.php");
          }
        }
      }
      header("location: ../pages/simpenerimaan.php"); 
    }
    else
    {
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
