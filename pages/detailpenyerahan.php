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
	<title>Tambah Penerimaan</title>
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
                echo "<li><a href='../index.php'>Dashboard</a></li>";
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
						<li><a href="sim.php">Daftar Barang</a></li>
						<li><a href="simpenerimaan.php">Penerimaan Barang Masuk</a></li>
						<li><a href="simpenyerahan.php">Serah Terima Material</a></li>
            <li><a href="#" class="vMenu--active">Detail Serah Terima Material</a></li>
						<li><a href="supplier.php">Supplier</a></li>
						<li><a href="penerima.php">Penerima</a></li>
					</ul>
				</div>
				<div class="app__main">
					<div class="text-container">
						<h3 class="app__main__title">Detail Serah Terima Material</h3>
            <?php
              
              //Memilih database
              mysqli_select_db($conn,"tubesKP");
              
              $Id = $_POST['id'];
              
              echo "
              <form role='form' name='downloadpdf' id='downloadpdf' action='../php/makepdfbastm.php' method='post' onsubmit=''>
                <input type='submit' value='Download PDF' name='Download' class='button button__accent'>
                <input type='hidden' id='id' name='id' value='$Id'>
              </form>
              ";
              
              //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
              $sql="select IdTransaksi,SupplierId,ReceiverId,Tanggal from Transaksi where Jenis_Transaksi = 'BASTM' and IdTransaksi = '$Id'";
    
              //Menjalankan perintah query dan menyimpannya dalam variabel hasil
              $hasil=mysqli_query ($conn,$sql);
  
              if($hasil)
              {
                //Mengambil 1 baris hasil dari perintah query
                $row=mysqli_fetch_row($hasil);
              }
              else
              {
                $row = false;
              }
              
              if($row)
              {
                list($idtransaksi,$idpertama,$idkedua,$tanggal)=$row;
                
                //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
                $sql="select Nama_Receiver,NIK,Jabatan from Receiver where IdReceiver = '$idpertama'";
        
                //Menjalankan perintah query dan menyimpannya dalam variabel hasil
                $hasil=mysqli_query ($conn,$sql);
                
                if($hasil)
                {
                  //Mengambil 1 baris hasil dari perintah query
                  $row=mysqli_fetch_row($hasil);
                }
                else
                {
                  $row = false;
                }
                
                if($row)
                {
                  list($nama1,$nik1,$jabatan1)=$row;
                  
                  //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
                  $sql="select Nama_Receiver,NIK,Jabatan from Receiver where IdReceiver = '$idkedua'";
        
                  //Menjalankan perintah query dan menyimpannya dalam variabel hasil
                  $hasil=mysqli_query ($conn,$sql);
  
                  if($hasil)
                  {
                    //Mengambil 1 baris hasil dari perintah query
                    $row=mysqli_fetch_row($hasil);
                  }
                  else
                  {
                    $row = false;
                  }
                  if($row)
                  {
                    list($nama2,$nik2,$jabatan2)=$row;
                  }
                  else
                  {
                    echo "<center><h2>Tidak ada Dokumen</h2></center>";
                  }
                }
                else
                {
                  echo "<center><h2>Tidak ada Dokumen</h2></center>";
                }
              }
            ?>
            <h3>Pihak Pertama</h3>
						<pre>Nama Pengirim : <?php echo "$nama1"; ?></pre>
            <pre>NIK           : <?php echo "$nik1"; ?></pre>
            <pre>Jabatan       : <?php echo "$jabatan1"; ?></pre>
            <h3>Pihak Kedua</h3>
            <pre>Nama          : <?php echo "$nama2"; ?></pre>
            <pre>NIK           : <?php echo "$nik2"; ?></pre>
            <pre>Jabatan       : <?php echo "$jabatan2"; ?></pre>
            <table border='1'>
              <tr>
                <td colspan=2 style="text-align:center" >Daftar Barang Masuk </td>
              </tr>
              <tr>
                <td style="text-align:center">Serial Number </td>
                <td style="text-align:center">Description </td>
              </tr>
              <?php
              
                //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
                $sql="select B.IdBarang, B.Description from Transaksi as T, Detail_Transaksi as DT, Barang as B where T.IdTransaksi = DT.TransaksiId and T.IdTransaksi = '$Id' and DT.BarangId = B.IdBarang";
                
                //Menjalankan perintah query dan menyimpannya dalam variabel hasil
                $hasil=mysqli_query ($conn,$sql);
                
                if($hasil)
                {
                  //Mengambil 1 baris hasil dari perintah query
                  $row=mysqli_fetch_row($hasil);
                }
                else
                {
                  $row = false;
                }
              
                if($row)
                {
                  do
                  {
                    list($serialnumber,$deskripsi)=$row;
                    echo "<tr>
                            <td style='text-align:center'>$serialnumber</td>
                            <td style='text-align:center'>$deskripsi</td>
                          </tr>";
                  }
                  while($row=mysqli_fetch_row($hasil));
                }
                else
                {
                  echo "<tr><td colspan=2><center><h2>Tidak ada Dokumen</h2></center></tr></td>";
                  echo "$sql<br>";
                }
                ?>
            </table>
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
      $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="descnumber[]" placeholder="Deskripsi" class="form-control name_list"  required/></td><td><input type="text" name="serialnumber[]" placeholder="Serial Number" class="form-control name_list" required/></td><td><button type="button" name="remove" id="'+i+'" class="button button__accent">X</button></td></tr>');
      
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
        url:"../php/tambahpenerimaan.php",  
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