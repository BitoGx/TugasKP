<?php

  //Memanggil Connection.php
  require_once "connection.php";
    
  function PopulateSupplier($conn)
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
      echo "<select name ='supplier'>";
      do
      {
        list($idsupplier,$nama,$pic)=$row;
        echo "<option value='$idsupplier'> $nama - $pic </option>";
      }
      while($row=mysqli_fetch_row($hasil));
      echo "</select>";
    }
    else
    {
      echo "<center><h2>Tidak ada Akun</h2></center>";
    }
  }
  
  function PopulateReceiver($conn)
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
      echo "<select name ='receiver'>";
      do
      {
        list($idreceiver,$nama,$nik,$jabatan)=$row;
        echo "<option value='$idreceiver'> $nama - $nik - $jabatan </option>";
      }
      while($row=mysqli_fetch_row($hasil));
      echo "</select>";
    }
    else
    {
      echo "<center><h2>Tidak ada Akun</h2></center>";
    }
  }
?>