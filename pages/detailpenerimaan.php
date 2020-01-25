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
	<title>Tambah Penerimaan</title>
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
                echo "<li><a href='../index.php'>Dashboard</a></li>";
                echo "<li><a href='kelolaakun.php'>Kelola Akun</a></li>";
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
						<li><a href="sim.php">Daftar Barang</a></li>
						<li><a href="simpenerimaan.php">Penerimaan Barang Masuk</a></li>
						<li><a href="#" class="vMenu--active">Detail Penerimaan Barang Masuk</a></li>
						<li><a href="simpenyerahan.php">Serah Terima Material</a></li>
						<li><a href="simpengirim.php">Pihak Pengirim</a></li>
						<li><a href="simfirstreceiver.php">Pihak Penerima / Pihak Pertama</a></li>
						<li><a href="simsecondreceiver.php">Pihak Kedua</a></li>
					</ul>
				</div>
				<div class="app__main">
					<div class="text-container">
						<h3 class="app__main__title">Detail Penerimaan Barang Masuk</h3>
            <?php
              // Menyimpan Id dari transaksi yang dipilih kedalam variabel
              $Id = $_POST['id'];
              
              // Membuat form untuk membuat dokumen
              echo "
              <form role='form' name='downloadpdf' id='downloadpdf' action='../php/makepdfbapbm.php' method='post' onsubmit=''>
                <input type='submit' value='Download PDF' name='Download' class='button button__accent'>
                <input type='hidden' id='id' name='id' value='$Id'>
              </form>
              ";
              
              //Mengambil data Nama, PIC dari tabel Pengirim, Nama, NIK, Jabatan dari tabel Penerima dan tanggal dari tabel transaksi pbm berdasarkan dengan IdTransaksiPbm
              $sql="select  S.Nama, S.PIC, R.Nama, R.NIK, R.Jabatan, T.Tanggal  from transaksi_pbm as T, receiver_first_party as R, supplier as S where T.SupplierId = S.IdSupplier and T.FirstPartyId = R.IdFirstParty and T.IdTransaksiPbm = '$Id'";
              
              /*
               * Mengecek apakah perintah query yang dijalankan gagal atau berhasil
               * jika berhasil akan mengambil data di row sesuai perintah query sebelumnya
               * jika gagal akan memberikan nilai false
               */
              $hasil=mysqli_query ($conn,$sql);
              if($hasil)
              {
                $row=mysqli_fetch_row($hasil);
              }
              else
              {
                $row = false;
              }
              
              // Menyimpan data kedalam variabel yang berada di dalam array $row
              if($row)
              {
                list($nama_supplier,$pic,$nama_receiver,$nik,$jabatan,$tanggal)=$row;
              }
            ?>
            <h3>Pihak Pengirim</h3>
						<pre>Nama Pengirim : <?php echo "$nama_supplier"; ?></pre>
            <pre>PIC           : <?php echo "$pic"; ?></pre>
            <h3>Pihak Penerima</h3>
            <pre>Nama          : <?php echo "$nama_receiver"; ?></pre>
            <pre>NIK           : <?php echo "$nik"; ?></pre>
            <pre>Jabatan       : <?php echo "$jabatan"; ?></pre>
            <table border='1'>
              <tr>
                <td colspan=2 style="text-align:center" >Daftar Barang Masuk </td>
              </tr>
              <tr>
                <td style="text-align:center">Serial Number </td>
                <td style="text-align:center">Description </td>
              </tr>
              <?php
                //Mengambil data IdBarang dan Deskripsi dari tabel barang berdasarkan dengan IdTransaksiPbm
                $sql="select B.IdBarang, B.Description from transaksi_pbm as T, detail_pbm as DT, barang as B where T.IdTransaksiPbm = DT.TransaksiPbmId and T.IdTransaksiPbm = '$Id' and DT.BarangId = B.IdBarang";
                $hasil=mysqli_query ($conn,$sql);
                
                /*
                 * Mengecek apakah perintah query yang dijalankan gagal atau berhasil
                 * jika berhasil akan mengambil data di row sesuai perintah query sebelumnya
                 * jika gagal akan memberikan nilai false
                 */
                if($hasil)
                {
                  $row=mysqli_fetch_row($hasil);
                }
                else
                {
                  $row = false;
                }
                
                /* 
                 * Jika array $row kosong akan menampilkan pesan
                 * jika array $row memilki isi akan dilakukan perulangan sebanyak isi array
                 * dan menampilkan isi dari array tersebut
                 */
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