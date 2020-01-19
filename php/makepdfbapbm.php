<?php


include "../php/connection.php";
require_once '..\vendor\autoload.php';

// Mengambil variabel yang dibutuhkan
$Id = $_POST['id'];
$fulldesc ="";

//Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
$sql="select  S.Nama_Supplier, S.PIC, R.Nama_Receiver, R.NIK, R.Jabatan, T.Tanggal from Transaksi as T, Receiver as R, Supplier as S where T.SupplierId = S.IdSupplier and T.ReceiverId = R.IdReceiver and T.Jenis_Transaksi = 'BAPBM' and T.IdTransaksi = '$Id'";

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
  list($nama_supplier,$pic,$nama_receiver,$nik,$jabatan,$tanggal)=$row;
}

//Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
$sql="select B.Description, count(*) as Counter from Transaksi as T, Detail_Transaksi as DT, Barang as B where T.IdTransaksi = DT.TransaksiId and T.IdTransaksi = '$Id' and DT.BarangId = B.IdBarang group by B.Description";

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
  $x = 0;
  do
  {
    list($desc,$counter)=$row;
    
    if($x == 0)
    {
      $fulldesc = $desc." ".$counter." UNIT";
    }
    else
    {
      $fulldesc .= ", ".$desc." ".$counter." UNIT";
    }
    $x = $x + 1; 
  }
  while($row=mysqli_fetch_row($hasil));
}

$hari = date("N");

switch ($hari) 
{
  case 1:
    $hari = "Senin";
    break;
  case 2:
    $hari = "Selasa";
    break;
  case 3:
    $hari = "Rabu";
    break;
  case 4:
    $hari = "Kamis";
    break;
  case 5:
    $hari = "Jumat";
    break;
  case 6:
    $hari = "Sabtu";
    break;
  case 7:
    $hari = "Minggu";
    break;
}

$tanggal = date("d");

switch ($tanggal) 
{
  case 1:
    $tanggal = "Satu";
    break;
  case 2:
    $tanggal = "Dua";
    break;
  case 3:
    $tanggal = "Tiga";
    break;
  case 4:
    $tanggal = "Empat";
    break;
  case 5:
    $tanggal = "Lima";
    break;
  case 6:
    $tanggal = "Enam";
    break;
  case 7:
    $tanggal = "Tujuh";
    break;
	case 8:
    $tanggal = "Delapan";
    break;
	case 9:
    $tanggal = "Sembilan";
    break;
  case 10:
    $tanggal = "Sepuluh";
    break;
  case 11:
    $tanggal = "Sebelas";
    break;
  case 12:
    $tanggal = "Dua Belas";
    break;
  case 13:
    $tanggal = "tiga Belas";
    break;
  case 14:
    $tanggal = "Empat Belas";
    break;
  case 15:
    $tanggal = "Lima Belas";
    break;
  case 16:
    $tanggal = "Enam Belas";
    break;
  case 17:
    $tanggal = "Tujuh Belas";
    break;
  case 18:
    $tanggal = "Delapan Belas";
    break;
  case 19:
    $tanggal = "Sembilan Belas";
    break;
  case 20:
    $tanggal = "Dua Puluh";
    break;
  case 21:
    $tanggal = "Dua Puluh Satu";
    break;
  case 22:
    $tanggal = "Dua Puluh Dua";
    break;
  case 23:
    $tanggal = "Dua Puluh Tiga";
    break;
  case 24:
    $tanggal = "Dua Puluh Empat";
    break;
  case 25:
    $tanggal = "Dua Puluh Lima";
    break;
  case 26:
    $tanggal = "Dua Puluh Enam";
    break;
  case 27:
    $tanggal = "Dua Puluh Tujuh";
    break;
  case 28:
    $tanggal = "Dua Puluh Delapan";
    break;
  case 29:
    $tanggal = "Dua Puluh Sembilan";
    break;		
  case 30:
    $tanggal = "Tiga Puluh ";
    break;
  case 31:
    $tanggal = "Tiga Puluh Satu";
    break;		
}

$bulan = date("m");

switch ($bulan) 
{
  case 1:
    $bulan = "Januari";
    break;
  case 2:
    $bulan = "Februari";
    break;
  case 3:
    $bulan = "Maret";
    break;
  case 4:
    $bulan = "April";
    break;
  case 5:
    $bulan = "Mei";
    break;
  case 6:
    $bulan = "Juni";
    break;
  case 7:
    $bulan = "Juli";
    break;
  case 8:
    $bulan = "Agustus";
    break;
  case 9:
    $bulan = "September";
    break;
  case 10:
    $bulan = "Oktober";
    break;
  case 11:
    $bulan = "November";
    break;
  case 12:
    $bulan = "Desember";
    break;
}

function Penyebut($nilai) 
{
  $nilai = abs($nilai);
  $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
  $temp = "";
  if ($nilai < 12) 
  {
    $temp = " ". $huruf[$nilai];
  } 
  else if ($nilai <20) 
  {
    $temp = penyebut($nilai - 10). " Belas";
  } 
  else if ($nilai < 100) 
  {
    $temp = penyebut($nilai/10)." Puluh". penyebut($nilai % 10);
  } 
  else if ($nilai < 200) 
  {
    $temp = " Seratus" . penyebut($nilai - 100);
  } 
    else if ($nilai < 1000) 
  {
    $temp = penyebut($nilai/100) . " Ratus" . penyebut($nilai % 100);
  } 
  else if ($nilai < 2000) 
  {
    $temp = " Seribu" . penyebut($nilai - 1000);
  } 
  else if ($nilai < 1000000) 
  {
    $temp = penyebut($nilai/1000) . " Ribu" . penyebut($nilai % 1000);
  }    
  return $temp;
}

$tahun = date("Y");
$tahun = Penyebut($tahun);

$tanggalttd  = date("d");
$tanggalttd .= " ".$bulan;
$tanggalttd .= " ".date("Y");
$tanggalfull = date("Y.m.d");


$doc =
"
<table width='1150px' border='0' align='center'>
  <tr>
    <td colspan='3'><img src='../images/Telkom_hi_res.png' style='width:280px'></td>
  </tr>
  <tr>
    <td colspan='3' align='center'>
      <font size='5'><b>BERITA ACARA<br>PENERIMAAN BARANG MASUK<br></b></font>
      <font size='4'>Nomor : BAPBM/$tanggalfull/SK-$Id</font>
    </td>
  </tr>
  <tr>
    <td colspan='3'>&nbsp;</td>
  </tr>
</table>
<table width='1150px' border='0' align='center' style='font-size:18;'>
  <tr>
    <td colspan='3' align='justify'>
    Pada Hari ini $hari, tanggal $tanggal bulan $bulan tahun $tahun, telah diterima $fulldesc dan aksesoris lainnya.
  </tr>
  <tr>
    <td colspan='3'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='3' align='justify'>
    Barang tersebut telah diserahkan oleh, <b>PIHAK PENGIRIM</b> :
  </tr>
  <tr>
    <td>Nama Pengirim</td>
    <td colspan='2'>: $nama_supplier</td>
  </tr>
  <tr>
    <td>PIC</td>
   <td colspan='2'>: $pic</td>
  </tr>
  <tr>
    <td colspan='3'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='3' align='justify'>
    Dan telah diterima oleh, <b>PIHAK PENERIMA</b></i> :
  </tr>
  <tr>
    <td>Nama</td>
    <td colspan='2'>: $nama_receiver</td>
  </tr>
  <tr>
    <td>NIK</td>
    <td colspan='2'>: $nik</td>
  </tr>
  <tr>
    <td>Jabatan</td>
  <td colspan='2'>: $jabatan</td>
  </tr>
  <tr>
    <td colspan='3'>&nbsp;</td>
  </tr>
  <tr align='justify'>
    <td colspan='3'>
    Demikianlah berita acara penerimaan barang masuk ini di perbuat, adapun barang-barang tersebut telah diterima dalam keadaan baik dan sesuai dengan jumlah, sejak penandatanganan berita acara ini, maka barang tersebut menjadi tanggung jawab <i>PIHAK PENERIMA</i>.
  </tr>
  <tr>
    <td colspan='3'>&nbsp;</td>
  </tr>
</table>
<table width='1150px' border='0' align='center' style='font-size:18;'>
  <tr>
    <td width='33%'>&nbsp;</td>
    <td width='33%'>&nbsp;</td>
    <td width='33%' align='center'>Bandung,  $tanggalttd</td>
  </tr>
  <tr>
    <td width='33%' align='center'>Mengetahui / Menyetujui</td>
    <td width='33%'>&nbsp;</td>
    <td width='33%' align='center'>Yang Menerima</td>
  </tr>
  <tr>
    <td width='33%' align='center'><b>MANAGER PROJECT DATA MGT. & ADMIN</b></td>
    <td width='33%'>&nbsp;</td>
    <td width='33%'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='3' height='150px'>&nbsp;</td>
  </tr>
  <tr>
    <td width='33%' align='center'>KHUSNAWAN</td>
    <td width='33%'>&nbsp;</td>
    <td width='33%' align='center'>ADRIYUN</td>
  </tr> 
  <tr>
    <td width='33%' align='center'>NIK : 740304</td>
    <td width='33%'>&nbsp;</td>
    <td width='33%' align='center'>NIK : $nik</td>
  </tr>
  <tr>
    <td colspan='3'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='3'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='3'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='3'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='3'>&nbsp;</td>
  </tr>
  <tr >
    <td colspan='3' align='left'>Note: Daftar Barang beserta Serial Number terlampir.</td>
  </tr>
</table>
";

$tabelbarang =  
"
  <table border='1' width='80%' align='center'>
    <thead>
      <tr>
        <td align='center'>Serial Number</td>
        <td align='center'>Description</td>
      </tr>
    </thead>
  <tbody>
";

//Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
$sql="select B.IdBarang, B.Description from Transaksi as T, Detail_Transaksi as DT, Barang as B where T.IdTransaksi = DT.TransaksiId and T.IdTransaksi = '$Id' and DT.BarangId = B.IdBarang";

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
  do
  {
    list($serialnumber,$deskripsi)=$row;
    $tabelbarang .= '<tr>
                       <td>'.$serialnumber.'</td>   
                       <td>'.$deskripsi.'</td> 
                     </tr>';
  }
  while($row=mysqli_fetch_row($hasil));
}

$tabelbarang .= '</tbody></table>';

$docname = "BAPBM".$tanggalfull."SK-".$Id;

$mpdf = new \Mpdf\Mpdf();

$mpdf->setFooter('{PAGENO}');
$mpdf->WriteHTML($doc);

$mpdf->AddPage();
$mpdf->WriteHTML($tabelbarang);

$mpdf->Output('../uploads/'.$docname.'.pdf', \Mpdf\Output\Destination::FILE);


?>