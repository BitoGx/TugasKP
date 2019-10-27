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
	<title>Edit Akun</title>
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
            <!-- menu ini hanya bisa terlihat dan di akses oleh akun admin -->
					</ul>
				</div>
				<div class="app__main">
					<div class="text-container">
						<h3 class="app__main__title">Form Edit Akun</h3>
						<p>Silahkan ubah informasi Akun yang akan diubah</p>
            <?php
              echo "<form role='form' action='../php/editakun.php' method='post'>";
              $Status = $_POST['status'];
              $IdAdmin = $_POST['id'];
              echo "<input type='hidden' id='id' name='id' value='$IdAdmin'>";
              if(isset($_POST['editakun']))
              {
                $Nama = $_POST['nama'];
                $Bagian = $_POST['bagian'];
                echo "<label>Nama</label>
                      <input placeholder='Masukkan Nama' type='text' id='nama' name='nama' value='$Nama' required>
                      <label>Bagian</label>
                      <input placeholder='Masukkan Bagian' type='text' id='bagian' name='bagian' pattern='[A-Za-z ]+' value='$Bagian' required>
                      <label>Status</label>";
              }
              if(isset($_POST['editpassword']))
              {
                echo "<label>Password Lama</label>
                      <input placeholder='&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;' type='password' id='password' name='password' required>
                      <label>Password Baru</label>
                      <input placeholder='&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;' type='password' id='pass1' name='newpassword' onkeyup='PassCheck()' required>
                      <label>Konfirmasi Password Baru</label>
                      <input placeholder='&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;' type='password' id='pass2' onkeyup='PassCheck()' required>
                      <span id='message'></span>";
              }
              if($Status == "Aktif")
              {
                echo "<div class='double'>
                      <p class='half'>
                        <input name='status' type='radio' id='radio1' value=1 checked/>
                        <label for='radio1'>Aktif</label>
                      </p>
                      <p class='half'>
                        <input name='status' type='radio' id='radio2' value=0 />
                        <label for='radio2'>Tidak Aktif</label>
                      </p>
                    </div>";
              }
              else
              {
                echo "<div class='double'>
                      <p class='half'>
                        <input name='status' type='radio' id='radio1' value=1 />
                        <label for='radio1'>Aktif</label>
                      </p>
                      <p class='half'>
                        <input name='status' type='radio' id='radio2' value=0 checked/>
                        <label for='radio2'>Tidak Aktif</label>
                      </p>
                    </div>";
              }
              echo "<p>
                      <input type='submit' value='Edit' name='submit' class='button button__accent'>
                    </p>"; 
            ?>
					</div>
				</div>
			</div>
		</div>
	</div>

<script src='../js/app.js'></script>
</body>
</html>