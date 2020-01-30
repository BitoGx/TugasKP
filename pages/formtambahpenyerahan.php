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
	<title>Tambah Serah Terima</title>
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
            <li><b><a href="../index.php">Dokumen</a></b></li>
            <li><b>SIM</b></li>
						<li><a href="simbarang.php">Daftar Barang</a></li>
						<li><a href="simpenerimaan.php">Penerimaan Barang Masuk</a></li>
						<li><a href="simpenyerahan.php">Serah Terima Material</a></li>
						<li><a href="#" class="vMenu--active">Tambah Serah Terima</a></li>
						<li><a href="simpengirim.php">Pihak Pengirim</a></li>
						<li><a href="simfirstreceiver.php">Pihak Penerima / Pihak Pertama</a></li>
						<li><a href="simsecondreceiver.php">Pihak Kedua</a></li>
            <li><b><a href='kelolaakun.php'>Pengaturan</a></b></li>
					</ul>
				</div>
				<div class="app__main">
					<div class="text-container">
						<h3 class="app__main__title">Form Tambah Serah Terima</h3>
						<p>Silahkan isi informasi Serah Terima yang akan ditambah</p>
            <form role="form" name="tambahtransaksi" id="tambahtransaksi" action="../php/tambahpenyerahan.php" method="post" onsubmit="">
              <label>Pihak Pertama</label>
              <?php
                include_once "../php/populate.php";
                echo "<select name ='firstparty'>";
                echo "  <option selected disabled>- Pilih Pihak Pertama -</option>";
                PopulateFirstReceiver($conn);
                echo "</select>";
              ?>
              <label>Pihak Kedua</label>
              <?php
                echo "<select name ='secondparty'>";
                echo "  <option selected disabled>- Pilih Pihak Kedua -</option>";
                PopulateSecondReceiver($conn);
                echo "</select>";
              ?>
              <label>Tanggal Penyerahan</label>
              <input type="text" id="tanggalpenyerahan" name="tanggalpenyerahan" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" placeholder="YYYY-MM-DD" required>
              <table class="table table-bordered" id="dynamic_field">
                <tr>
                  <td><label>Serial Number Barang Keluar</label></td>
                </tr>
                <tr>
                  <td><input type="text" name="serialnumber[]" placeholder="Serial Number" class="form-control name_list" required/></td>  
                  <td><button type="button" name="add" id="add" class="button button__accent">Add More</button></td>  
                </tr>  
              </table>  
              <p>
                <input type="submit" value="Tambah" name="submit" class="button button__accent">
              </p>
            </form>
					</div>
				</div>
			</div>
		</div>
	</div>

  <script src='../js/app.js'></script>
  <script>  
  $(document).ready(function()
  {  
    var i=1;  
    $('#add').click(function()
    {  
      i++;  
      $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="serialnumber[]" placeholder="Serial Number" class="form-control name_list" required/></td><td><button type="button" name="remove" id="'+i+'" class="button button__accent">X</button></td></tr>');
      
    });  
    $(document).on('click', '.button__accent', function()
    {  
      var button_id = $(this).attr("id");   
      $('#row'+button_id+'').remove();  
    });  
    $('#submit').click(function()
    {            
      $.ajax(
      {  
        url:"../php/tambahpenyerahan.php",  
        method:"POST",  
        data:$('#add_name').serialize(),  
        success:function(data)  
        {  
          alert(data);  
          $('#add_name')[0].reset();  
        }  
      });  
    });  
  }); 
  </script>
</body>
</html>