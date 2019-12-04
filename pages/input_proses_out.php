<?php
  session_start();
  include "../php/connection.php";
  if(isset($_SESSION['Loggedin']) != true)
  {
    header("location: keloladokumen.php");
    session_destroy();
  }
?>
<html lang='en'>
<head>
	<meta class="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Proses Out</title>
	<link rel='stylesheet' href='../css/style.min.css' />
  <link rel='stylesheet' href='../css/style.css' />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
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
						<li><a href="../index.php">Proses In</a></li>
            <li><a href="proses_out.php">Proses Out</a></li>
						<li><a href="#" class="vMenu--active">Input Proses Out</a></li>
            <li><a href="barang_masuk.php">Barang Masuk</a></li>
            <li><a href="barang_keluar.php">Barang Keluar</a></li>
					</ul>
				</div>
				<div class="app__main">
					<div class="text-container">
						<h3 class="app__main__title">Input Proses Out</h3>
						<p></p>
            <form role='form' name='formupload' action='../php/sim_proses_out.php' method='post' enctype='multipart/form-data' onsubmit='return FileCheck()'>
              <label>No.Surat</label>
              <input placeholder='Masukkan No.Surat' type='text' id='no_surat' name='no_surat' required>
              <label>Tanggal Input</label>
              <input placeholder='Masukkan Tanggal Input' type='text' id='tgl_input' name='tgl_input' required>
              <label>Tanggal Update</label>
              <input placeholder='Masukkan Tanggal Update' type='text' id='tgl_update' name='tgl_update' required>
              <label>Tanggal Order</label>
              <input placeholder='Masukkan Tanggal Order' type='text' id='tgl_order' name='tgl_order' required>
              <br>
              <label>No.Id</label>
              <input placeholder='Masukkan No.Id' type='text' id='no_id' name='no_id' required>
              <label>No.Urut</label>
              <input placeholder='Masukkan No.Urut' type='text' id='no_urut' name='no_urut' required>
              <br>
              <label>Witel</label>
              <!-- dropdown -->
              <input placeholder='Masukkan Nama Witel' type='text' id='nama_witel' name='nama_witel' required>
              <label>User - Mitra</label>
              <!-- dropdown -->
              <input placeholder='Masukkan Nama Mitra' type='text' id='nama_mitra' name='nama_mitra' required>
              <br>
              <label>Material & Jumlah</label>
              <input placeholder='Material & Jumlah' type='text' id='mtr_jml' name='mtr_jml' required>
              <label>Nama Material 1</label>
              <input placeholder='Nama Material' type='text' id='nm_mtr' name='nm_mtr_1' required>
              <label>Jumlah</label>
              <input placeholder='Jumlah Material' type='text' id='jml_mtr_1' name='nm_mtr' required>
              <label>Nama Material 2</label>
              <input placeholder='Nama Material' type='text' id='nm_mtr' name='nm_mtr_2' required>
              <label>Jumlah</label>
              <input placeholder='Jumlah Material' type='text' id='jml_mtr_2' name='nm_mtr' required>
              <label>Nama Material 3</label>
              <input placeholder='Nama Material' type='text' id='nm_mtr' name='nm_mtr_3' required>
              <label>Jumlah</label>
              <input placeholder='Jumlah Material' type='text' id='jml_mtr_3' name='nm_mtr' required>
              <label>Nama Material 4</label>
              <input placeholder='Nama Material' type='text' id='nm_mtr' name='nm_mtr_4' required>
              <label>Jumlah</label>
              <input placeholder='Jumlah Material' type='text' id='jml_mtr_4' name='nm_mtr' required>
              <label>Nama Material 5</label>
              <input placeholder='Nama Material' type='text' id='nm_mtr' name='nm_mtr_5' required>
              <label>Jumlah</label>
              <input placeholder='Jumlah Material' type='text' id='jml_mtr_5' name='nm_mtr' required>
              <br>
              <label>NODIN</label>
              <input placeholder='No. NODIN' type='text' id='no_nodin' name='no_nodin' required>
              <label>Keperluan</label>
              <input placeholder='Keperluan' type='text' id='keperluan' name='keperluan' required>
              <br>
              <label>Pemohon</label>
              <input placeholder='Nama Pemohon' type='text' id='nama_pemohon' name='nama_pemohon' required>
              <label>NIK</label>
              <input placeholder='NIK Pemberi' type='text' id='nik_pemohon' name='nik_pemohon' required>
              <label>Jabatan</label>
              <input placeholder='Jabatan Pemberi' type='text' id='jabatan_pemohon' name='jabatan_pemohon' required>
              <label>No. Telepon</label>
              <input placeholder='+62 **** **** ****' type='text' id='tlp_penerima' name='tlp_penerima' required>
              <br>
              <label>Pemberi</label>
              <!-- dropdown -->
              <input placeholder='Nama Pemberi' type='text' id='nama_pemberi' name='nama_pemberi' required>
              <label>NIK</label>
              <input placeholder='NIK Penerima' type='text' id='nik_penerima' name='nik_penerima' required>
              <label>Jabatan</label>
              <input placeholder='Jabatan Penerima' type='text' id='jabatan_penerima' name='jabatan_penerima' required>
              <br>
              <label>Mengetahui</label>
              <!-- dropdown -->
              <input placeholder='Nama Mengetahui' type='text' id='nama_mengetahui' name='nama_mengetahui' required>
              <label>NIK</label>
              <input placeholder='NIK Mengetahui' type='text' id='nik_mengetahui' name='nik_mengetahui' required>
              <label>Jabatan</label>
              <input placeholder='Jabatan Mengetahui' type='text' id='jabatan_mengetahui' name='jabatan_mengetahui' required>
              <br>
              <label>Remark</label>
              <input placeholder='keterangan' type='text' id='jabatan_mengetahui' name='jabatan_mengetahui' required>
              <br>
              <p>
                <input type='submit' value='Submit' name='submit' class='button button__accent'>
              </p>
            </form>
					</div>
				</div>
			</div>
		</div>
	</div>

<script src='../js/app.js'></script>
</body>
</html>