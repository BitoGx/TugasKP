<?php
  
  //Session Start
  session_start();
  
  //Memanggil file connection php untuk menghubungkann ke Database
  require_once "connection.php";
  
  if(isset($_POST['docname']) || isset($_POST['authorname']) || isset($_POST['year']))
  {
    
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $allowedMB = 100000000;
    $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"]))
    {
      $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false)
      {
        $uploadOk = 1;
      }
      else
      {
        echo $check;
        echo "<br> AAAAA <be>";
        echo "File type is not supported.";
        $uploadOk = 0;
        header("Refresh: 5; http://localhost/tugasKP/pages/uploadpage.php");
      }
    }
  
    // Check if file already exists
    if (file_exists($target_file)) 
    {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
      header("Refresh: 5; http://localhost/tugasKP/pages/uploadpage.php");
    }
  
    // Check file size 100Mb
    if ($_FILES["fileToUpload"]["size"] > $allowedMB) 
    {
      echo "Sorry, your file is too large. Max 100Mb.";
      $uploadOk = 0;
    }
  
    // Allow certain file formats
    if($FileType != "pdf") 
    {
      echo "Sorry, only PDF files are allowed.";
      $uploadOk = 0;
    }
  
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0)
    {
      echo "Sorry, your file was not uploaded."; 
    }
    // if everything is ok, try to upload file
    else 
    {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
      {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
      
        /*
        *Menyimpan Variabel yang di kirim menggunakan method POST
        *Mengubah isi variabel ke lowercase
        */
        $docname=$_POST['docname'];
        $docname = strtolower($docname);
        $authorname=$_POST['authorname'];
        $idadmin=$_SESSION['Id_Admin'];
        $year=$_POST['year'];
        $date=date("Y-m-d");
  
        //Memilih database
        mysqli_select_db($conn,"tubesKP");

        //Mempersiapkan Command Query  untuk mengecek apakah barang yang ditambahkan sudah ada atau belum
        $sql="insert into repo(Id_Admin,Judul,Author,Tanggal_Unggah,Tahun_Dibuat,File_Path) values ($idadmin,'$docname','$authorname','$date',$year,'$target_file')";

        //Menjalankan perintah query dan menyimpannya dalam variabel hasil
        //$hasil = false;
        $hasil=mysqli_query ($conn,$sql);
      
        if($hasil)
        {
          header("location: ../pages/keloladokumen.php");
        }
        else
        {
          echo "Database gagal di update";
          unlink($target_file);
          header("Refresh: 5; http://localhost/tugasKP/pages/uploadpage.php");
        }
      }
      else
      {
        echo "Sorry, there was an error uploading your file.";
        header("Refresh: 5; http://localhost/tugasKP/pages/uploadpage.php");
      }
    }   
  }
  else
  {
    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "session_check_dalam.php";
  }
?>

