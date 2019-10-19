<?php
  
  //Memanggil Connection.php
  require_once "connection.php";
  
  //Memilih database
  mysqli_select_db($conn,"tubesKP");
  
  //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
  $sql="select Nama,Bagian,Username,Password,Status,Id_Admin from admin";
  
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
              <th> Password </td>
              <th> Status </td>
              <th> Action </td>
            </tr>";
    do
    {
      list($Nama,$Bagian,$Username,$Password,$Status)=$row;
      echo "<form action='php/editakun.php' method='post' onsubmit='return FormValidation()'>";
      //password sudah di decryp dari sha1
      //status (0 = tidak aktif, 1 = aktif)
      echo "<tr>
              <td> $Nama </td>
              <td> $Bagian </td>
              <td> $Username </td>
              <td> $Password </td>
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
?>