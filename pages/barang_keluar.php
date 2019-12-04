<?php
  session_start();
  include "../php/connection.php";
  if(isset($_SESSION['Loggedin']))
  {
    $Nama = $_SESSION['Nama'];
    $Bagian = $_SESSION['Bagian'];
  }
?>
<html lang='en'>
<head>
	<meta class="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Barang Keluar</title>
	<link rel='stylesheet' href='../css/style.min.css' />
  <link rel='stylesheet' href='../css/style.css' />
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
            <li><a href="#" class="vMenu--active">Barang Keluar</a></li>
					</ul>
				</div>
				<div class="app__main">
					<div class="text-container">
						<h3 class="app__main__title">Barang Keluar</h3>
						<p></p>
            <a href="input_barang_keluar.php"><button type="button" name="uploadpdf" class="button button__accent">Tambah</button></a>
            <?php
              if(isset($_SESSION['Loggedin']))
              {
                echo "<b>&nbsp;&nbsp;&nbsp;Hallo $Nama, dari bagian $Bagian</b><br>";
              }
              else
              {
                echo "<b>&nbsp;&nbsp;&nbsp;*Login user only</b><br>";
              }
              include_once "../php/display.php";
              DisplayBarangKeluar($conn)
            ?>
					</div>
				</div>
			</div>
		</div>
	</div>

<script src='../js/app.min.js'></script>
</body>
</html>