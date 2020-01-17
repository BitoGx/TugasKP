<?php

  //Memanggil Connection.php
  require_once "connection.php";
    
  function DisplayIndex($conn)
  {
    //Memilih database
    mysqli_select_db($conn,"tubesKP");
  
    //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
    $sql="select R.Judul,R.Author,R.Tahun_Dibuat,R.Tanggal_Terakhir_Diubah,A.Bagian,A.Nama,R.File_path from repo as R, admin as A where R.Id_Admin = A.Id_Admin and R.Status = 1";
  
    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);
  
    
    if($hasil)
    {
      //Mengambil 1 baris hasil dari perintah query
      $row=mysqli_fetch_row($hasil);
    }
    else
    {
      $row = false;
    }
    
  
    if($row)
    {
      echo "<div style='overflow-x:auto;'>
            <table border='1'>
              <tr>
                <th> Judul </td>
                <th> Author </td>
                <th> Tahun Dibuat </td>
                <th> Tanggal Terakhir Diubah </td>
                <th> Bagian </td>
                <th> Penanggung Jawab </td>
                <th colspan='2'> Action </td>
              </tr>";
      do
      {
        list($Judul,$Author,$Tahun,$TanggalUbah,$Bagian,$Nama,$Path)=$row;
        $Judul = ucwords($Judul);
        echo "<tr>
                <td> $Judul </td>
                <td> $Author </td>
                <td> $Tahun </td>
                <td> $TanggalUbah </td>
                <td> $Bagian </td>
                <td> $Nama </td>
                <td> <a target='_blank' rel='noopener noreferrer' href='pages/pdfviewer/web/viewer.html?file=../../$Path'>
                      <button type='button' class='button button__primary'>Baca Online</button></a> </td>
                <td> <a href='pages/$Path' download>
                      <button type='button' class='button button__primary'>Download</button></a> </td>
              </tr>";
      }
      while($row=mysqli_fetch_row($hasil));
      echo "</table>
            </div>";
    }
    else
    {
      echo "<center><h2>Tidak ada Dokumen</h2></center>";
    }
  }
  
  function DisplayDokumen($conn)
  {
    //Memilih database
    mysqli_select_db($conn,"tubesKP");
  
    //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
    $sql="select Judul,Author,Tahun_Dibuat,Tanggal_Unggah,Tanggal_Terakhir_Diubah,File_Path,Status,Id_Dokumen from repo";
  
    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);
  
    if($hasil)
    {
      //Mengambil 1 baris hasil dari perintah query
      $row=mysqli_fetch_row($hasil);
    }
    else
    {
      $row = false;
    }
  
    if($row)
    {
      echo "<div style='overflow-x:auto;'>
            <table border='1'>
              <tr>
                <th> Judul </td>
                <th> Author </td>
                <th> Tahun Dibuat </td>
                <th> Tanggal Unggah </td>
                <th> Tanggal Terakhir Diubah </td>
                <th> File Name </td>
                <th> Status </td>";
      if(isset($_SESSION['Loggedin']))
      {
        echo "  <th> Action </td>
              </tr>";
      }
      else
      {
        echo "</tr>";
      }
      do
      {
        list($Judul,$Author,$Tahun,$Tanggal,$TanggalUbah,$Path,$Status,$IdDokumen)=$row;
        $Judul = ucwords($Judul);
        if($Status == 1 )
        {
          $Status = "Tersedia";
        }
        else
        {
          $Status = "Tidak Tersedia";
        }
        $Path = substr($Path,11);
        echo "<form action='../pages/formeditdokumen.php' method='post'>";
        //status (0 = tidak tersedia, 1 = tersedia)
        echo "<tr>
                <input type='hidden' id='id' name='id' value='$IdDokumen'>
                <td> $Judul </td>
                <input type='hidden' id='docname' name='docname' value='$Judul'>
                <td> $Author </td>
                <input type='hidden' id='authorname' name='authorname' value='$Author'>
                <td> $Tahun </td>
                <input type='hidden' id='year' name='year' value='$Tahun'>
                <td> $Tanggal </td>
                <td> $TanggalUbah </td>
                <td> $Path </td>
                <input type='hidden' id='filename' name='filename' value='$Path'>
                <td> $Status </td>
                <input type='hidden' id='status' name='status' value='$Status'>";
        if(isset($_SESSION['Loggedin']))
        {
          echo "<th> <input type='submit' value='Edit' name='submit' class='button button__primary'> </td>
              </tr>";
        }
        else
        {
          echo "</tr>";
        }
        echo "</form>";
      }
      while($row=mysqli_fetch_row($hasil));
      echo "</table>
            </div>";
    }
    else
    {
      echo "<center><h2>Tidak ada Dokumen</h2></center>";
    }
  }
  
  function DisplayAkun($conn)
  {
    //Memilih database
    mysqli_select_db($conn,"tubesKP");
    $level   = $_SESSION['Level'];
    $idadmin = $_SESSION['Id_Admin'];
    
    //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
    if($level == 1)
    {
      $sql="select Nama,Bagian,Username,Status,Id_Admin from admin";
    }
    else
    {
      $sql="select Nama,Bagian,Username,Status,Id_Admin from admin where Id_Admin = $idadmin";
    }
  
    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);
  
    //Mengambil 1 baris hasil dari perintah query
    $row=mysqli_fetch_row($hasil);
  
    if($row)
    {
      echo "<div style='overflow-x:auto;'>
            <table border='1'>
              <tr>
                <th> Nama </th>
                <th> Bagian </th>
                <th> Username </th>
                <th> Status </th>
                <th colspan=2> Action </th>
              </tr>";
      do
      {
        list($Nama,$Bagian,$Username,$Status,$IdAdmin)=$row;
        if($Status == 1 )
        {
          $Status = "Aktif";
        }
        else
        {
          $Status = "Tidak Aktif";
        }
        echo "<form action='../pages/formeditakun.php' method='post' onsubmit='return FormValidation()'>";
        echo "<tr>
                <input type='hidden' id='id' name='id' value='$IdAdmin'>
                <td> $Nama </td>
                <input type='hidden' id='nama' name='nama' value='$Nama'>
                <td> $Bagian </td>
                <input type='hidden' id='bagian' name='bagian' value='$Bagian'>
                <td> $Username </td>
                <td> $Status </td>
                <input type='hidden' id='status' name='status' value='$Status'>
                <td>  <input type='submit' value='Edit Akun' name='editakun' class='button button__primary'> </td>
                <td>  <input type='submit' value='Edit Password' name='editpassword' class='button button__primary'> </td>
              </tr>";
        echo "</form>";
      }
      while($row=mysqli_fetch_row($hasil));
      echo "</table>
            </div>";
    }
    else
    {
      echo "<center><h2>Tidak ada Akun</h2></center>";
    }
  }
  
  function DisplayBarang($conn)
  {
    //Memilih database
    mysqli_select_db($conn,"tubesKP");
    
    //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
    $sql="select * from barang";
  
    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);
  
    //Mengambil 1 baris hasil dari perintah query
    $row=mysqli_fetch_row($hasil);
  
    if($row)
    {
      echo "<div style='overflow-x:auto;'>
            <table border='1'>
              <tr>
                <th> Serial Number </th>
                <th> Description </th>
              </tr>";
      do
      {
        list($serialnumber,$description)=$row;
         echo "<tr>
                <td> $serialnumber </td>
                <td> $description </td>
              </tr>";
      }
      while($row=mysqli_fetch_row($hasil));
      echo "</table>
            </div>";
    }
    else
    {
      echo "<center><h2>Tidak ada Akun</h2></center>";
    }
  }
  
  function DisplaySupplier($conn)
  {
    //Memilih database
    mysqli_select_db($conn,"tubesKP");
    
    //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
    $sql="select * from supplier";
  
    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);
  
    //Mengambil 1 baris hasil dari perintah query
    $row=mysqli_fetch_row($hasil);
  
    if($row)
    {
      echo "<div style='overflow-x:auto;'>
            <table border='1'>
              <tr>
                <th> Supplier / Nama Pengirim </th>
                <th> PIC </th>
              </tr>";
      do
      {
        list($idsupplier,$nama,$pic)=$row;
         echo "<tr>
                <input type='hidden' id='id' name='id' value='$idsupplier'>
                <td> $nama </td>
                <td> $pic </td>
              </tr>";
      }
      while($row=mysqli_fetch_row($hasil));
      echo "</table>
            </div>";
    }
    else
    {
      echo "<center><h2>Tidak ada Akun</h2></center>";
    }
  }
  
  function DisplayReceiver($conn)
  {
    //Memilih database
    mysqli_select_db($conn,"tubesKP");
    
    //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
    $sql="select * from receiver";
  
    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);
  
    //Mengambil 1 baris hasil dari perintah query
    $row=mysqli_fetch_row($hasil);
  
    if($row)
    {
      echo "<div style='overflow-x:auto;'>
            <table border='1'>
              <tr>
                <th> Nama </th>
                <th> NIK </th>
                <th> Jabatan </th>
              </tr>";
      do
      {
        list($idreceiver,$nama,$nik,$jabatan)=$row;
         echo "<tr>
                <input type='hidden' id='id' name='id' value='$idreceiver'>
                <td> $nama </td>
                <td> $nik </td>
                <td> $jabatan </td>
              </tr>";
      }
      while($row=mysqli_fetch_row($hasil));
      echo "</table>
            </div>";
    }
    else
    {
      echo "<center><h2>Tidak ada Akun</h2></center>";
    }
  }
  
  function DisplayTransaksi($conn)
  {
    //Memilih database
    mysqli_select_db($conn,"tubesKP");
  
    $sql="SELECT COUNT(ProductID) AS NumberOfProducts FROM Products; ";
  
  
  
    //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
    $sql="select S.Nama_Supplier, S.PIC, R.Nama_Receiver, R.NIK, R.Jabatan, T.Tanggal from Transaksi as T, Receiver as R, Supplier as S, Detail_Transaksi as DT where T.SupplierId = S.IdSupplier and T.ReceiverId = R.IdReceiver and T.IdTransaksi = DT.TransaksiId and T.Jenis_Transaksi = 'BAPBM'";
  
    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);
  
    if($hasil)
    {
      //Mengambil 1 baris hasil dari perintah query
      $row=mysqli_fetch_row($hasil);
    }
    else
    {
      $row = false;
    }
    
  
    if($row)
    {
      echo "<div style='overflow-x:auto;'>
            <table border='1'>
              <tr>
                <th> Nama Pengirim </td>
                <th> PIC </td>
                <th> Nama Penerima </td>
                <th> NIK </td>
                <th> Jabatan </td>
                <th> Tanggal </td>
              </tr>";
      do
      {
        list($nama_supplier,$pic,$nama_receiver,$nik,$jabatan,$tanggal)=$row;
        echo "<tr>
                <td> $nama_supplier </td>
                <td> $pic </td>
                <td> $nama_receiver </td>
                <td> $nik </td>
                <td> $jabatan </td>
                <td> $tanggal </td>
              </tr>";
      }
      while($row=mysqli_fetch_row($hasil));
      echo "</table>
            </div>";
    }
    else
    {
      echo "<center><h2>Tidak ada Dokumen</h2></center>";
    }
  }
?>