<?php
  session_start();
  include "../php/connection.php";
  if(isset($_SESSION['Loggedin']) != true)
  {
    header("location: uploadverification.php");
    session_destroy();
  }
?>
<html lang='en'>
<head>
	<meta class="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Tambah Akun</title>
	<link rel='stylesheet' href='../css/style.min.css' />
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
						<li><a href="../index.php">Dashboard</a></li>
						<li><a href="keloladokumen.php">Kelola Dokumen</a></li>
						<li><a href="#" class="vMenu--active">Edit Dokumen</a></li>
					</ul>
				</div>
				<div class="app__main">
					<div class="text-container">
						<h3 class="app__main__title">Form Edit Dokumen</h3>
						<p>Silahkan ubah informasi Dokumen yang akan diubah</p>
            <form role="form" name="formedit" action="../php/editdokumen.php" method="post" enctype="multipart/form-data" onsubmit="return SubmitCheck()">
            <?php
              $Judul  = $_POST['docname'];
              $Author = $_POST['authorname'];
              $Tahun  = $_POST['year'];
              $Path   = $_POST['filename'];
              $Status = $_POST['status'];
              $Id     = $_POST['id'];
              
              echo "<input type='hidden' id='id' name='id' value='$Id'>
                    <label>Nama Dokumen</label>
                    <input placeholder='Masukkan Nama Dokumen' type='text' id='docname' name='docname' value='$Judul' required>
                    <label>Nama Penulis</label>
                    <input placeholder='Masukkan Nama' type='text' name='authorname' pattern='[A-Za-z ]+' value='$Author' required>
                    <label>Tahun Dibuat</label>
                    <input placeholder='Masukkan Tahun' type='text' id='year' name='year' pattern='[0-9]{4}' value='$Tahun' required>
                    <label>File Dokumen Lama = $Path</label>
                    <label>File Dokumen Baru</label>
                    <label class='custom-file-upload'>
                      <input id='file' type='file' id='file' name='fileToUpload' onchange='return UploadCheck()'/>
                      <i class='fa fa-cloud-upload'></i> Upload File
                      <img id='check' src='../images/error.png' style='width:16px'>
                    </label>
                    <label>Status</label>";
              if($Status == "Tersedia")
              {
                echo "<div class='double'>
                      <p class='half'>
                        <input name='status' type='radio' id='radio1' value=1 checked/>
                        <label for='radio1'>Tersedia</label>
                      </p>
                      <p class='half'>
                        <input name='status' type='radio' id='radio2' value=0 />
                        <label for='radio2'>Tidak Tersedia</label>
                      </p>
                    </div>";
              }
              else
              {
                echo "<div class='double'>
                      <p class='half'>
                        <input name='status' type='radio' id='radio1' value=1 />
                        <label for='radio1'>Tersedia</label>
                      </p>
                      <p class='half'>
                        <input name='status' type='radio' id='radio2' value=0 checked/>
                        <label for='radio2'>Tidak Tersedia</label>
                      </p>
                    </div>";
              }
              echo "<p>
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