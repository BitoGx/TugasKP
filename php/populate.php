<?php
  //Memanggil file connection php untuk menghubungkann ke Database
  require_once "connection.php";
  
  // Fungsi untuk mengisi pilihan untuk Pihak Pengirim
  function PopulateSupplier($conn)
  {
    $sql="select * from supplier";
    $hasil=mysqli_query ($conn,$sql);
    $row=mysqli_fetch_row($hasil);
    do
    {
      list($idsupplier,$nama,$pic)=$row;
      echo "<option value='$idsupplier'> $nama - $pic </option>";
    }
    while($row=mysqli_fetch_row($hasil));
  }
  
  // Fungsi untuk mengisi pilihan untuk Pihak Penerima / Pihak Pertama
  function PopulateFirstReceiver($conn)
  {
    $sql="select * from receiver_first_party";
    $hasil=mysqli_query ($conn,$sql);
    $row=mysqli_fetch_row($hasil);
    do
    {
      list($idreceiver,$nama,$nik,$jabatan)=$row;
      echo "<option value='$idreceiver'> $nama - $nik - $jabatan </option>";
    }
    while($row=mysqli_fetch_row($hasil));
  }
  
  // Fungsi untuk mengisi pilihan untuk Pihak Kedua
  function PopulateSecondReceiver($conn)
  {
    $sql="select * from second_party";
    $hasil=mysqli_query ($conn,$sql);
    $row=mysqli_fetch_row($hasil);
    do
    {
      list($idreceiver,$nama,$nonik,$jabatan,$tempatkerja)=$row;
      echo "<option value='$idreceiver'> $nama - $nonik - $jabatan - $tempatkerja </option>";
    }
    while($row=mysqli_fetch_row($hasil));
  }
?>