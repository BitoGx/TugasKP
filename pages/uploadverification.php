  <?php
    session_start();
    include "../php/connection.php";
  ?>
<!DOCTYPE html>
<html lang='en'>
<head>
	<meta class="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Second Page</title>
	<link rel='stylesheet' href='../css/style.min.css' />
</head>
<body>
	<!-- navbar -->
	<div class="navbar">
		<nav class="nav__mobile"></nav>
		<div class="container">
			<div class="navbar__inner">
				<a href="../index.php" class="navbar__logo">Logo</a>
				<nav class="navbar__menu">
					<ul>
						<?php
              if(isset($_SESSION['Loggedin']))
              {
                echo "<li><a href='php/session_logout.php'>Logout</a></li>";
              }
              else
              {
                echo "<li><a href='../pages/login.php'>Login</a></li>";
              }
            ?>
					</ul>
				</nav>
				<div class="navbar__menu-mob"><a href="" id='toggle'><svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z" class=""></path></svg></a></div>
			</div>
		</div>
	</div>
	<!-- Page content -->
	<div class="app">
		<div class="container">
			<div class="app__inner">
				<div class="app__menu">
					<ul class="vMenu">
						<li><a href="../index.php">Main Menu</a></li>
						<li><a href="#" class="vMenu--active">Upload PDF</a></li>
					</ul>
				</div>
				<div class="app__main">
					<div class="text-container">
						<h3 class="app__main__title">This is the main area</h3>
						<p>Write or do whatever you want here!</p>
            <a href="uploadpage.php"><button type="button" name="uploadpdf" class="button button__accent">Upload PDF</button></a> <b>*Login user only</b>
            <br>
            <?php
              include "../php/display.php";
            ?>
					</div>
				</div>
			</div>
		</div>
	</div>

<script src='../js/app.min.js'></script>
</body>
</html>