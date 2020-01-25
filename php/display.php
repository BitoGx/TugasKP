<?php

  //Memanggil Connection.php
  require_once "connection.php";
  
  //Fungsi untuk memanggil Semua Dokumen PBM yang tercatat pada database
  function DisplayIndexPbm($conn)
  {
    $sql="select R.NamaDokumen,R.TahunDibuat,R.TanggalTerakhirDiubah,A.Bagian,A.Nama,R.Filepath from repo_pbm as R, admin as A where R.AdminId = A.IdAdmin";
    $hasil=mysqli_query ($conn,$sql);
    if($hasil)
    {
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
                <th> Nama Dokumen </td>
                <th> Tahun Dibuat </td>
                <th> Tanggal Terakhir Diubah </td>
                <th> Bagian </td>
                <th> Penanggung Jawab </td>
                <th colspan='2'> Action </td>
              </tr>";
      do
      {
        list($namadokumen,$tahun,$tanggalubah,$bagian,$nama,$path)=$row;
        echo "<tr>
                <td> $namadokumen </td>
                <td> $tahun </td>
                <td> $tanggalubah </td>
                <td> $bagian </td>
                <td> $nama </td>
                <td> <a target='_blank' rel='noopener noreferrer' href='pages/pdfviewer/web/viewer.html?file=../../$path'>
                      <button type='button' class='button button__primary'>Baca Online</button></a> </td>
                <td> <a href='pages/$path' download>
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
  
  //Fungsi untuk memanggil Semua Dokumen STM yang tercatat pada database
  function DisplayIndexStm($conn)
  {
    $sql="select R.NamaDokumen,R.TahunDibuat,R.TanggalTerakhirDiubah,A.Bagian,A.Nama,R.Filepath from repo_stm as R, admin as A where R.AdminId = A.IdAdmin";
    $hasil=mysqli_query ($conn,$sql);
    if($hasil)
    {
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
                <th> Nama Dokumen </td>
                <th> Tahun Dibuat </td>
                <th> Tanggal Terakhir Diubah </td>
                <th> Bagian </td>
                <th> Penanggung Jawab </td>
                <th colspan='2'> Action </td>
              </tr>";
      do
      {
        list($namadokumen,$tahun,$tanggalubah,$bagian,$nama,$path)=$row;
        echo "<tr>
                <td> $namadokumen </td>
                <td> $tahun </td>
                <td> $tanggalubah </td>
                <td> $bagian </td>
                <td> $nama </td>
                <td> <a target='_blank' rel='noopener noreferrer' href='pages/pdfviewer/web/viewer.html?file=../../$path'>
                      <button type='button' class='button button__primary'>Baca Online</button></a> </td>
                <td> <a href='pages/$path' download>
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
    
    $sql="select Judul,Tahun_Dibuat,Tanggal_Unggah,Tanggal_Terakhir_Diubah,File_Path,Id_Dokumen from repo";
    $hasil=mysqli_query ($conn,$sql);
    if($hasil)
    {
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
                <th> Nama Dokumen </td>
                <th> Tahun Dibuat </td>
                <th> Tanggal Unggah </td>
                <th> Tanggal Terakhir Diubah </td>
                <th> File Name </td>";
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
        list($namadoc,$tahun,$tanggal,$tanggalubah,$path,$iddokumen)=$row;
        $namadoc = ucwords($namadoc);
        $path = substr($path,11);
        echo "<form action='../pages/formeditdokumen.php' method='post'>";
        echo "<tr>
                <input type='hidden' id='id' name='id' value='$iddokumen'>
                <td> $namadoc </td>
                <input type='hidden' id='docname' name='docname' value='$namadoc'>
                <td> $tahun </td>
                <input type='hidden' id='year' name='year' value='$tahun'>
                <td> $tanggal </td>
                <td> $tanggalubah </td>
                <td> $path </td>
                <input type='hidden' id='filename' name='filename' value='$path'>";
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
    $level   = $_SESSION['Level'];
    $idadmin = $_SESSION['IdAdmin'];
    if($level == 1)
    {
      $sql="select Nama,Bagian,Username,Status,IdAdmin from admin";
    }
    else
    {
      $sql="select Nama,Bagian,Username,Status,IdAdmin from admin where IdAdmin = $idadmin";
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
        list($nama,$bagian,$username,$status,$idadmin)=$row;
        if($status == 1 )
        {
          $status = "Aktif";
        }
        else
        {
          $status = "Tidak Aktif";
        }
        echo "<form action='../pages/formeditakun.php' method='post' onsubmit='return FormValidation()'>";
        echo "<tr>
                <input type='hidden' id='id' name='id' value='$idadmin'>
                <td> $nama </td>
                <input type='hidden' id='nama' name='nama' value='$nama'>
                <td> $bagian </td>
                <input type='hidden' id='bagian' name='bagian' value='$bagian'>
                <td> $username </td>
                <td> $status </td>
                <input type='hidden' id='status' name='status' value='$status'>
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
    //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
    $sql="select * from barang where Status = 'Masuk'";
  
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
      echo "<center><h2>Tidak ada Barang</h2></center>";
    }
  }
  
  function DisplayPengirim($conn)
  {
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
  
  function DisplayFirstReceiver($conn)
  {
    //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
    $sql="select * from receiver_first_party";
  
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
         list($idfirstparty,$nama,$nik,$jabatan)=$row;
         echo "<tr>
                <input type='hidden' id='id' name='id' value='$idfirstparty'>
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
  
  function DisplaySecondReceiver($conn)
  {
    //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
    $sql="select * from second_party";
  
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
                <th> NIK/No Telp </th>
                <th> Jabatan </th>
                <th> Tempat Kerja </th>
              </tr>";
      do
      {
        list($idsecondparty,$nama,$nik,$jabatan,$tempatkerja)=$row;
         echo "<tr>
                <input type='hidden' id='id' name='id' value='$idsecondparty'>
                <td> $nama </td>
                <td> $nik </td>
                <td> $jabatan </td>
                <td> $tempatkerja </td>
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
  
  function DisplayPenerimaanBarangMasuk($conn)
  {

    //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
    $sql="select T.IdTransaksiPbm, S.Nama, S.PIC, R.Nama, R.NIK, R.Jabatan, T.Tanggal from transaksi_pbm as T, receiver_first_party as R, supplier as S where T.SupplierId = S.IdSupplier and T.FirstPartyId = R.IdFirstParty";
  
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
                <th> Nama Pengirim </th>
                <th> PIC </th>
                <th> Nama Penerima </th>
                <th> NIK </th>
                <th> Jabatan </th>
                <th> Tanggal </th>
                <th> Detail </th>
              </tr>";
      do
      {
        list($idtransaksi,$nama_supplier,$pic,$nama_receiver,$nik,$jabatan,$tanggal)=$row;
        echo "<form role='form' name='BAPBM' id='BAPBM' action='../pages/detailpenerimaan.php' method='post' onsubmit=''>
                <tr>
                  <td> $nama_supplier </td>
                  <td> $pic </td>
                  <td> $nama_receiver </td>
                  <td> $nik </td>
                  <td> $jabatan </td>
                  <td> $tanggal </td>
                  <td> <input type='submit' value='Detail' name='detail' class='button button__primary'>
                     <input type='hidden' id='id' name='id' value='$idtransaksi'> </td>
                </tr>
              </form>";
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
  
  function DisplaySerahTerimaMaterial($conn)
  {
    //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
    $sql="select T.IdTransaksiStm,F.Nama,F.NIK,F.Jabatan,S.Nama,S.NoNIK,S.Jabatan,T.Tanggal from receiver_first_party as F, second_party as S, transaksi_stm as T where T.FirstPartyId = F.IdFirstParty and T.SecondPartyId = S.IdSecondParty";
    
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
                <th> Pihak Pertama </th>
                <th> NIK </th>
                <th> Jabatan </th>
                <th> Pihak Kedua </th>
                <th> NIK </th>
                <th> Jabatan </th>
                <th> Tanggal </th>
                <th> Detail </th>
              </tr>";
      do
      {
        list($idtransaksi,$nama1,$nik1,$jabatan1,$nama2,$nonik2,$jabatan2,$tanggal)=$row;
        echo " <form role='form' name='BASTM' id='BASTM' action='../pages/detailpenyerahan.php' method='post' onsubmit=''>
              <tr>  
                <td>$nama1</td>
                <td>$nik1</td>
                <td>$jabatan1</td>
                <td>$nama2</td>
                <td>$nonik2</td>
                <td>$jabatan2</td>
                <td>$tanggal</td>
                <td> <input type='submit' value='Detail' name='detail' class='button button__primary'>
                     <input type='hidden' id='id' name='id' value='$idtransaksi'></td>
              </tr>
              </form>";
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