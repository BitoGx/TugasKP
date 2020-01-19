<?php

require_once '..\vendor\autoload.php';

// Mengambil variabel yang dibutuhkan
$Id = $_POST['id'];

//Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
$sql="select IdTransaksi,SupplierId,ReceiverId,Tanggal from Transaksi where Jenis_Transaksi = 'BASTM' and IdTransaksi = '$Id'";
    
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
  list($idtransaksi,$idpertama,$idkedua,$tanggal)=$row;
               
  //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
  $sql="select Nama_Receiver,NIK,Jabatan from Receiver where IdReceiver = '$idpertama'";
        
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
    list($nama1,$nik1,$jabatan1)=$row;
                  
    //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
    $sql="select Nama_Receiver,NIK,Jabatan from Receiver where IdReceiver = '$idkedua'";
       
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
      list($nama2,$nik2,$jabatan2)=$row;
    }
    else
    {
      echo "<center><h2>Tidak ada Dokumen</h2></center>";
    }
  }
  else
  {
    echo "<center><h2>Tidak ada Dokumen</h2></center>";
  }
}


$mpdf = new \Mpdf\Mpdf();

$mpdf->WriteHTML('<h1>Hello world!</h1>');
$mpdf->Output();
?>

<html>
  <body>
    <p style="font-family:arial; padding: 113px 76px 76px 76px;">
    <table width='1150px' border='0' align='center'>
      <tr>
        <td colspan='3'><img src='../images/Telkom_hi_res.png' style="width:280px"></td>
      </tr>
      <tr align='center'>
        <td colspan='3'>
            <font size='5'><b>BERITA ACARA<br>SERAH TERIMA MATERIAL<br></b></font>
            <font size='4'>Nomor : BASTM/2016.02.18/SK-023/19</font>
        </td>
      </tr>
      <tr>
        <td colspan='3'>&nbsp;</td>
      </tr>
    </table>
    <table width='1150px' border='0' align='center' style="font-size:18;">
      <tr align='justify'>
        <td colspan='3'>
            Pada Hari ini Kamis, tanggal Delapan Belas bulan Pebruari tahun Dua Ribu Enam Belas, telah diserahkan FIBERHOME ONT AN5506-06 sebanyak 19 UNIT dan aksesoris lainnya. Kami yang bertanda tangan dibawah ini :
      </tr>
      <tr>
        <td colspan='3'>&nbsp;</td>
      </tr>
      <tr align='justify'>
        <td colspan='3'>
            <i>Disebut <b>PIHAK PERTAMA</b></i> :
      </tr>
      <tr>
        <td>Nama</td>
        <td colspan='2'>ADRIYUN</td>
      </tr>
      <tr>
        <td>NIK</td>
        <td colspan='2'>631293</td>
      </tr>
      <tr>
        <td>Jabatan</td>
        <td colspan='2'>OFF 1 PROJECT ADM-SUPPORT</td>
      </tr>
      <tr>
        <td colspan='3'>&nbsp;</td>
      </tr>
      <tr align='justify'>
        <td colspan='3'>
            <i>Disebut <b>PIHAK KEDUA</b></i> :
      </tr>
      <tr>
        <td>Nama</td>
        <td colspan='2'>YAYA</td>
      </tr>
      <tr>
        <td>NIK</td>
        <td colspan='2'>622745</td>
      </tr>
      <tr>
        <td>Jabatan</td>
        <td colspan='2'>SUPERVISOR TELKOM GROUP</td>
      </tr>
      <tr>
        <td colspan='3'>&nbsp;</td>
      </tr>
      <tr align='justify'>
        <td colspan='3'>
            Demikianlah berita acara serah terima material ini di perbuat oleh kedua belah pihak, adapun barang-barang tersebut dalam keadaan baik dan cukup, sejak penandatanganan berita acara ini, maka barang tersebut, menjadi tanggung jawab <i>PIHAK KEDUA</i>, memelihara/merawat dengan baik serta dipergunakan untuk keperluan (tempat dimana barang itu dibutuhkan)
      </tr>
      <tr>
        <td colspan='3'>&nbsp;</td>
      </tr>
    </table>
    <table width='1150px' border='0' align='center' style="font-size:18;">
      <tr align='center'>
        <td width='33%'>&nbsp;</td>
        <td width='33%'>&nbsp;</td>
        <td width='33%'>Bandung, 18 Pebruari 2016</td>
      </tr>
      <tr align='center'>
        <td width='33%'>Yang Menerima</td>
        <td width='33%'>&nbsp;</td>
        <td width='33%'>Yang Menyerahkan</td>
      </tr>
      <tr align='center'>
        <td width='33%'><b>WITEL JABAR TENGAH</b></td>
        <td width='33%'>&nbsp;</td>
        <td width='33%'>&nbsp;</td>
      </tr>
      <tr height='150px'>
        <td colspan='3'>&nbsp;</td>
      </tr>
      <tr align='center'>
        <td width='33%'>YAYA</td>
        <td width='33%'>&nbsp;</td>
        <td width='33%'>ADRIYUN</td>
      </tr>
      <tr align='center'>
        <td width='33%'>NIK : 622745</td>
        <td width='33%'>&nbsp;</td>
        <td width='33%'>NIK : 631293</td>
      </tr>
      <tr align='center'>
        <td width='33%'>&nbsp;</td>
        <td width='33%'>Mengetahui / Menyetujui</td>
        <td width='33%'>&nbsp;</td>
      </tr>
      <tr align='center'>
        <td width='33%'>&nbsp;</td>
        <td width='33%'><b>MANAGER PROJECT DATA MGT. & ADMIN</b></td>
        <td width='33%'>&nbsp;</td>
      </tr>
      <tr align='center'>
        <td width='33%'>&nbsp;</td>
        <td width='33%'>KHUSNAWAN</td>
        <td width='33%'>&nbsp;</td>
      </tr>
      <tr height='150px'>
        <td colspan='3'>&nbsp;</td>
      </tr>
      <tr align='center'>
        <td width='33%'>&nbsp;</td>
        <td width='33%'>NIK : 740304</td>
        <td width='33%'>&nbsp;</td>
      </tr>
      <tr>
        <td colspan='3'>&nbsp;</td>
      </tr>
      <tr align='left'>
        <td colspan='3'>Note: Daftar Barang beserta Serial Number terlampir.</td>
      </tr>
    </table>
    </p>
  </body>
</html>