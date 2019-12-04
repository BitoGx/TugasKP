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
	<title>Barang Masuk</title>
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
            <li><a href="barang_masuk.php">Barang Masuk</a></li>
						<li><a href="#" class="vMenu--active">Input Barang Masuk</a></li>
            <li><a href="barang_keluar.php">Barang Keluar</a></li>
					</ul>
				</div>
				<div class="app__main">
					<div class="text-container">
						<h3 class="app__main__title">Input Barang Masuk</h3>
						<p></p>
            <form role='form' name='formupload' action='../php/sim_barang_masuk.php' method='post' enctype='multipart/form-data' onsubmit='return FileCheck()'>
              <label>Pilih No.Surat</label>
              <!-- dropdown -->
              <input placeholder='No.Surat' type='text' id='no_surat' name='no_surat' required>
              <label>Scan Kode SN</label>
              <input placeholder='Scan Kode SN' type='text' id='kode_sn' name='kode_sn' required>
              <label>Tanggal</label>
              <input placeholder='Masukkan Tanggal' type='text' id='tgl' name='tgl' required>
              <br>
              <label>DO Number</label>
              <input placeholder='Masukkan Nomor Delivery Order' type='text' id='no_do' name='no_do' required>
              <label>Project Name</label>
              <input placeholder='Masukkan Nama Proyek' type='text' id='project_name' name='project_name' required>
              <label>SN</label>
              <input placeholder='Masukkan SN' type='text' id='sn' name='sn' required>
              <label>Package S/N</label>
              <input placeholder='Masukkan Package S/N' type='text' id='sn_barang' name='sn_barang' required>
              <label>Material Code</label>
              <input placeholder='Masukkan Material Code' type='text' id='material_code' name='material_code' required>
              <label>Description</label>
              <input placeholder='Masukkan Material Code' type='text' id='description' name='description' required>
              <label>Scan Barcode</label>
              <input placeholder='Scan Barcode' type='text' id='barcode' name='barcode' required>
              <label>Manufacture</label>
              <input placeholder='Masukkan Manufacture' type='text' id='manufacture' name='manufacture' required>
              <label>Devices</label>
              <input placeholder='Masukkan Devices' type='text' id='devices' name='devices' required>
              <label>Model Type</label>
              <input placeholder='Masukkan Model Type' type='text' id='model_type' name='model_type' required>
              <label>Qty</label>
              <input placeholder='Masukkan Jumlah' type='text' id='jumlah' name='jumlah' required>
              <label>Unit</label>
              <input placeholder='Masukkan Satuan' type='text' id='satuan' name='satuan' required>
              <label>Status Barang</label>
              <input placeholder='Masukkan Status Barang' type='text' id='status_barang' name='status_barang' required>
              <label>Supplier</label>
              <input placeholder='Masukkan Kode Supplier' type='text' id='kode_supplier' name='kode_supplier' required>
              <label>Harga</label>
              <input placeholder='Masukkan Harga' type='text' id='harga' name='harga' required>
              <label>Receive By</label>
              <input placeholder='Masukkan Nama Penerima' type='text' id='nama_receive_by' name='nama_receive_by' required>
              <br>
              <label>Tanggal Input</label>
              <input placeholder='Masukkan Tanggal Input' type='text' id='tgl_input' name='tgl_input' required>
              <label>Tanggal Update</label>
              <input placeholder='Masukkan Tanggal Update' type='text' id='tgl_update' name='tgl_update' required>
              <label>Pro Status</label>
              <input placeholder='Pro Status' type='text' id='pro_status' name='pro_status' required>
              <label>No.Surat</label>
              <input placeholder='Masukkan No.Surat Masuk' type='text' id='no_surat_masuk' name='no_surat_masuk' required>
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