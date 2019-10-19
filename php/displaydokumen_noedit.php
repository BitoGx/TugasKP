<?php
  
  //Memanggil Connection.php
  require_once "connection.php";
  
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
              <th> File_Path </td>
              <th> Status </td>
            </tr>";
    do
    {
      list($Judul,$Author,$Tahun,$Tanggal,$Path,$Status)=$row;
      $Judul = ucwords($Judul);
      echo "<form action='php/editdokumen.php' method='post' onsubmit='return FormValidation()'>";
      //status (0 = tidak tersedia, 1 = tersedia)
      echo "<tr>
              <td> $Judul </td>
              <td> $Author </td>
              <td> $Tahun </td>
              <td> $Tanggal </td>
              <td> $Path </td>
              <td> $Status </td>
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
?>