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
	<title>Kelola Dokumen</title>
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
            <li><b>Dokumen</b></li>
						<li><a href="../index.php">Daftar Dokumen</a></li>
						<li><a href="#" class="vMenu--active">Kelola Dokumen</a></li>
            <?php
            if(isset($_SESSION['Loggedin']))
            {
              echo "<li><b><a href='simbarang.php'>SIM</a></b></li>
                    <li><b><a href='kelolaakun.php'>Pengaturan</a></b></li>";
            }
            ?>
					</ul>
				</div>
				<div class="app__main">
					<div class="text-container">
						<h3 class="app__main__title">Halaman Kelola Dokumen</h3>
						<p>Disini anda bisa melihat list Dokumen yang sudah di upload, dan juga bisa Mengedit Dokumen yang sudah diupload</p>
            <h4>Daftar Dokumen Penerimaan Barang Masuk</h4>
            <br>
            <?php
              include_once "../php/display.php";
              DisplayDokumenPbm($conn)
            ?>
            <h4>Daftar Dokumen Serah Terima Material</h4>
            <?php
              DisplayDokumenStm($conn)
            ?>
					</div>
				</div>
			</div>
		</div>
	</div>

<script src='../js/app.min.js'></script>
</body>
</html>