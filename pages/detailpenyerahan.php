<?php
  session_start();
  include "../php/connection.php";
  if(isset($_SESSION['Loggedin']) != true)
  {
    header("location: kelolaakun.php");
    session_destroy();
  }
?>
<html lang='en'>
<head>
	<meta class="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Detail Serah Terima Material</title>
	<link rel='stylesheet' href='../css/style.min.css' />
  <link rel='stylesheet' href='../css/style.css' />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
<body>
	<!-- navbar -->
	<div class="navbar">
		<nav class="nav__mobile"></nav>
		<div class="container">
			<div class="navbar__inner">
				<a href="../index.php" class="navbar__logo"><img src="../images/Telkom_hi_res_02.png" style="width:94px"></a>
				<nav class="navbar__menu">
					<ul>
						<?php
              if(isset($_SESSION['Loggedin']))
              {
                echo "<li><a href='../php/session_logout.php'>Logout</a></li>";
              }
              else
              {
                echo "<li><a href='../pages/login.php'>Login</a></li>";
              }
            ?>
					</ul>
				</nav>
				<div class="navbar__menu-mob"><a href="" id='toggle'><svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="black" d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z" class=""></path></svg></a></div>
			</div>
		</div>
	</div>
	<!-- Page content -->
	<div class="app">
		<div class="container">
			<div class="app__inner">
				<div class="app__menu">
					<ul class="vMenu">
						<li><b><a href="../index.php">Dokumen</a></b></li>
            <li><b>SIM</b></li>
						<li><a href="simbarang.php">Daftar Barang</a></li>
						<li><a href="simpenerimaan.php">Penerimaan Barang Masuk</a></li>
						<li><a href="simpenyerahan.php">Serah Terima Material</a></li>
            <li><a href="#" class="vMenu--active">Detail Serah Terima Material</a></li>
						<li><a href="simpengirim.php">Pihak Pengirim</a></li>
						<li><a href="simfirstreceiver.php">Pihak Penerima / Pihak Pertama</a></li>
						<li><a href="simsecondreceiver.php">Pihak Kedua</a></li>
            <li><b><a href='kelolaakun.php'>Pengaturan</a></b></li>
					</ul>
				</div>
				<div class="app__main">
					<div class="text-container">
						<h3 class="app__main__title">Detail Serah Terima Material</h3>
            <?php
              
              //Memilih database
              mysqli_select_db($conn,"tubesKP");
              
              $Id = $_POST['id'];
              
              echo "
              <form role='form' name='downloadpdf' id='downloadpdf' action='../php/makepdfbastm.php' method='post' onsubmit=''>
                <input type='submit' value='Download PDF' name='Download' class='button button__accent'>
                <input type='hidden' id='id' name='id' value='$Id'>
              </form>
              ";
              
              //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
              $sql="select T.IdTransaksiStm,F.Nama,F.NIK,F.Jabatan,S.Nama,S.NoNIK,S.Jabatan,T.Tanggal from receiver_first_party as F, second_party as S, transaksi_stm as T where T.FirstPartyId = F.IdFirstParty and T.SecondPartyId = S.IdSecondParty";
    
              //Menjalankan perintah query dan menyimpannya dalam variabel hasil
              $hasil=mysqli_query ($conn,$sql);

              $row=mysqli_fetch_row($hasil);
              
              if($row)
              {
                list($idtransaksi,$nama1,$nik1,$jabatan1,$nama2,$nonik2,$jabatan2,$tanggal)=$row;
              }
            ?>
            <h3>Pihak Pertama</h3>
						<pre>Nama Pengirim : <?php echo "$nama1"; ?></pre>
            <pre>NIK           : <?php echo "$nik1"; ?></pre>
            <pre>Jabatan       : <?php echo "$jabatan1"; ?></pre>
            <h3>Pihak Kedua</h3>
            <pre>Nama          : <?php echo "$nama2"; ?></pre>
            <pre>NIK           : <?php echo "$nonik2"; ?></pre>
            <pre>Jabatan       : <?php echo "$jabatan2"; ?></pre>
            <table border='1'>
              <tr>
                <td colspan=2 style="text-align:center" >Daftar Barang Keluar </td>
              </tr>
              <tr>
                <td style="text-align:center">Serial Number </td>
                <td style="text-align:center">Description </td>
              </tr>
              <?php
              
                //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
                $sql="select B.IdBarang, B.Description from transaksi_stm as T, detail_stm as DT, barang as B where T.IdTransaksiStm = DT.TransaksiStmId and T.IdTransaksiStm = '$Id' and DT.BarangId = B.IdBarang";
                
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
                    echo "<tr>
                            <td style='text-align:center'>$serialnumber</td>
                            <td style='text-align:center'>$deskripsi</td>
                          </tr>";
                  }
                  while($row=mysqli_fetch_row($hasil));
                }
                else
                {
                  echo "<tr><td colspan=2><center><h2>Tidak ada Barang</h2></center></tr></td>";
                }
                ?>
            </table>
					</div>
				</div>
			</div>
		</div>
	</div>
  <script src='../js/app.js'></script>
</body>
</html>