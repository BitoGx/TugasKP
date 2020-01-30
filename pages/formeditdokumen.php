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
	<title>Edit Dokumen</title>
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
						<li><a href="keloladokumen.php">Kelola Dokumen</a></li>
            <li><a href="#" class="vMenu--active">Edit Dokumen</a></li>
            <li><b><a href='simbarang.php'>SIM</a></b></li>
            <li><b><a href='kelolaakun.php'>Pengaturan</a></b></li>
					</ul>
				</div>
				<div class="app__main">
					<div class="text-container">
						<h3 class="app__main__title">Form Edit Dokumen</h3>
						<p>Silahkan ubah informasi Dokumen yang akan diubah</p>
            <form role="form" name="formedit" action="../php/editdokumen.php" method="post" enctype="multipart/form-data" onsubmit="return SubmitCheck()">
            <?php
              $Judul  = $_POST['docname'];
              $Tahun  = $_POST['year'];
              $Path   = $_POST['filename'];
              $Id     = $_POST['id'];
              $Type   = $_POST['type'];
              
              echo "<input type='hidden' id='id_dokumen' name='id_dokumen' value='$Id'>
                    <input type='hidden' id='path' name='path' value='$Path'>
                    <input type='hidden' id='type' name='type' value='$Path'>
                    <label>Nama Dokumen</label>
                    <input placeholder='Masukkan Nama Dokumen' type='text' id='docname' name='docname' value='$Judul' required>
                    <label>Tahun Dibuat</label>
                    <input placeholder='Masukkan Tahun' type='text' id='year' name='year' pattern='[0-9]{4}' value='$Tahun' required>
                    <label>File Dokumen Lama = $Path</label>
                    <label>File Dokumen Baru</label>
                    <label class='custom-file-upload'>
                      <input id='file' type='file' id='file' name='fileToUpload' onchange='return UploadCheck()'/>
                      <i class='fa fa-cloud-upload'></i> Upload File
                      <img id='check' src='../images/error.png' style='width:16px'>
                    </label>
                    <p>
                      <input type='submit' value='Edit' name='submit' class='button button__accent'>
                    </p>";      
            ?>
            </form>
					</div>
				</div>
			</div>
		</div>
	</div>

<script src='../js/app.js'></script>
</body>
</html>