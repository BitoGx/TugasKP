<?php

  //Memanggil Connection.php
  require_once "connection.php";
    
  function DisplayIndex($conn)
  {
    //Memilih database
    mysqli_select_db($conn,"tubesKP");
  
    //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
    $sql="select R.Judul,R.Author,R.Tahun_Dibuat,R.Tanggal_Unggah,A.Bagian,A.Nama,R.Id_Buku,R.File_path from repo as R, admin as A where R.Id_Admin = A.Id_Admin";
  
    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);
  
    //Mengambil 1 baris hasil dari perintah query
    $row=mysqli_fetch_row($hasil);
  
    if($row)
    {
      echo "<div style='overflow-x:auto;'>
            <table border='1'>
              <tr>
                <th> Judul </td>
                <th> Author </td>
                <th> Tahun Dibuat </td>
                <th> Tanggal Unggah </td>
                <th> Bagian </td>
                <th> Penanggung Jawab </td>
                <th> Baca Online </td>
                <th> Download </td>
              </tr>";
      do
      {
        list($Judul,$Author,$Tahun,$Tanggal,$Bagian,$Nama,$IdBuku,$Path)=$row;
        $Judul = ucwords($Judul);
        echo "<form action='php/hapus_barang.php' method='post' onsubmit='return FormValidation()'>";
        echo "<tr>
                <td> $Judul </td>
                <td> $Author </td>
                <td> $Tahun </td>
                <td> $Tanggal </td>
                <td> $Bagian </td>
                <td> $Nama </td>
                <td> <a target='_blank' rel='noopener noreferrer' href='pages/pdfviewer/web/viewer.html?file=../../$Path'>Baca Online...</a> </td>
                <td> <a href='pages/$Path' download>Download</a> </td>
              </tr>";
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
  
  function DisplayDokumen($conn)
  {
    //Memilih database
    mysqli_select_db($conn,"tubesKP");
  
    //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
    $sql="select Judul,Author,Tahun_Dibuat,Tanggal_Unggah,File_Path,Status,Id_Buku from repo";
  
    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);
  
    //Mengambil 1 baris hasil dari perintah query
    $row=mysqli_fetch_row($hasil);
  
    if($row)
    {
      echo "<div style='overflow-x:auto;'>
            <table border='1'>
              <tr>
                <th> Judul </td>
                <th> Author </td>
                <th> Tahun Dibuat </td>
                <th> Tanggal Unggah </td>
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
        list($Judul,$Author,$Tahun,$Tanggal,$Path,$Status,$IdBuku)=$row;
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
                <td> $Judul </td>
                <input type='hidden' id='docname' name='docname' value='$Judul'>
                <td> $Author </td>
                <input type='hidden' id='authorname' name='authorname' value='$Author'>
                <td> $Tahun </td>
                <input type='hidden' id='year' name='year' value='$Tahun'>
                <td> $Tanggal </td>
                <td> $Path </td>
                <input type='hidden' id='filename' name='filename' value='$Path'>
                <td> $Status </td>
                <input type='hidden' id='status' name='status' value='$Status'>";
        if(isset($_SESSION['Loggedin']))
        {
          echo "<th> <input type='submit' value='Edit' name='submit'> </td>
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
  
    //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
    $sql="select Nama,Bagian,Username,Status,Id_Admin from admin";
  
    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);
  
    //Mengambil 1 baris hasil dari perintah query
    $row=mysqli_fetch_row($hasil);
  
    if($row)
    {
      echo "<div style='overflow-x:auto;'>
            <table border='1'>
              <tr>
                <th> Nama </td>
                <th> Bagian </td>
                <th> Username </td>
                <th> Status </td>
                <th> Action </td>
              </tr>";
      do
      {
        list($Nama,$Bagian,$Username,$Status)=$row;
        if($Status == 1 )
        {
          $Status = "Aktif";
        }
        else
        {
          $Status = "Tidak Aktif";
        }
        echo "<form action='php/editakun.php' method='post' onsubmit='return FormValidation()'>";
        echo "<tr>
                <td> $Nama </td>
                <td> $Bagian </td>
                <td> $Username </td>
                <td> $Status </td>
                <td> <a href=../pages/formeditakun.php>Edit</a> </td>
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
?>