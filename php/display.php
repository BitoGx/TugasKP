<?php
  
  //Memanggil Connection.php
  require_once "connection.php";
  
  //Memilih database
  mysqli_select_db($conn,"tubesKP");
  
  //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
  $sql="select R.Judul,R.Author,R.Tahun_Dibuat,R.Tanggal_Unggah,A.Bagian,A.Nama,R.Id_Buku from repo as R, admin as A where R.Id_Admin = A.Id_Admin";
  
  //Menjalankan perintah query dan menyimpannya dalam variabel hasil
  $hasil=mysqli_query ($conn,$sql);
  
  //Mengambil 1 baris hasil dari perintah query
  $row=mysqli_fetch_row($hasil);
  
  if($row)
  {
    echo "<table border='1'>
            <tr>
              <td> Judul </td>
              <td> Author </td>
              <td> Tahun Dibuat </td>
              <td> Tanggal Unggah </td>
              <td> Bagian </td>
              <td> Penanggung Jawab </td>
              <td> Baca Online </td>
              <td> Download </td>
            </tr>";
    do
    {
      list($Judul,$Author,$Tahun,$Tanggal,$Bagian,$Nama,$IdBuku)=$row;
      $Judul = ucwords($Judul);
      echo "<form action='php/hapus_barang.php' method='post' onsubmit='return FormValidation()'>";
      echo "<tr>
              <td> $Judul </td>
              <td> $Author </td>
              <td> $Tahun </td>
              <td> $Tanggal </td>
              <td> $Bagian </td>
              <td> $Nama </td>
              <td>  </td>
              <td></td>
            </tr>";
      echo "</form>";
    }
    while($row=mysqli_fetch_row($hasil));
    echo "</table>";
  }
  else
  {
    echo "<center><h1>Tidak ada Dokumen</h1></center>";
  }
?>