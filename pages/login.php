<?php
  session_start();
  if(isset($_SESSION['Loggedin']))
  {
    header("location: ../index.php");
  }
?>
<html lang='en'>
<head>
	<meta class="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Login</title>
	<link rel='stylesheet' href='../css/style.min.css' />
</head>
<body>
	<!-- navbar -->
	<div class="navbar">
		<nav class="nav__mobile"></nav>
		<div class="container">
			<div class="navbar__inner">
				<a href="../index.php" class="navbar__logo"><img src="../images/Telkom_hi_res_02.png" style="width:94px"></a>
				<nav class="navbar__menu">
					<!-- navbar menu-->
				</nav>
				<div class="navbar__menu-mob"><a href="" id='toggle'><svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z" class=""></path></svg></a></div>
			</div>
		</div>
	</div>
	<!-- Authentication pages -->
	<div class="auth">
		<div class="container">
			<div class="auth__inner">
				<div class="auth__media">
					<img src="../images/undraw_selfie.svg">
				</div>
				<div class="auth__auth">
					<h1 class="auth__title">Masuk ke akun anda</h1>
					<p>Silahkan masukan username dan password untuk login.</p>
					<form method='post' action="../php/session_login.php" autocompelete="new-password" role="form" class="form" name="login">
						<label>Username</label>
						<input type="text" name="username" id='username' placeholder="Masukkan Username" autofocus required>
						<label>Password</label>
						<input type="password" name="password" id='password' placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" autocomplete="off" required>
            <a href="../index.php"><button type="button" name="back" class="button button__accent">Back</button></a>
						<button type="submit" name="submit" class="button button__accent">Log in</button>
					</form>
				</div>
			</div>
		</div>
	</div>
<script src='../js/app.min.js'></script>
</body>
</html>