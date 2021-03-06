<?php
  
  //Session Start
  session_start();
  
  //Memanggil file connection php untuk menghubungkann ke Database
  require_once "connection.php";
  
  if(isset($_POST['docname']) && isset($_POST['year']))
  {
    $iddokumen = $_POST['id_dokumen'];
    $docname   = $_POST['docname'];
    $docname   = strtoupper($docname);
    $iduser    = $_SESSION['IdUser'];
    $year      = $_POST['year'];
    $type      = $_POST['type'];
    
    if(!($_FILES["fileToUpload"]["error"] == 4))
    {
      $delete_file = $_POST['path']; 
      $date        = date("YMdhis");
      $target_dir  = "../uploads/";
      $target_file = $target_dir . $date . "_" . basename($_FILES["fileToUpload"]["name"]);
      $delete_file = $target_dir . $delete_file;
      $uploadOk    = 1;
      $allowedMB   = 100000000;
      $FileType    = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  
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
          echo "File type is not supported.";
          $uploadOk = 0;
          header("Refresh: 5; http://localhost/tugasKP/pages/keloladokumen.php");
        }
      }
  
      // Check if file already exists
      if (file_exists($target_file)) 
      {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
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
        header("Refresh: 5; http://localhost/tugasKP/pages/keloladokumen.php");
      }
      // if everything is ok, try to upload file
      else 
      {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
        {
          /*
          *Menyimpan Variabel yang di kirim menggunakan method POST
          *Mengubah isi variabel ke lowercase
          */
          $date       = date("Y-m-d");
          
          if($type == "STM")
          {
            //Mempersiapkan Command Query  untuk mengecek apakah barang yang ditambahkan sudah ada atau belum
            $sql="update repo_stm set UserId = $iduser, NamaDokumen = '$docname', TanggalTerakhirDiubah = '$date', TahunDibuat = $year, FilePath = '$target_file' where IdDokumen = $iddokumen";
          }
          else
          {
            //Mempersiapkan Command Query  untuk mengecek apakah barang yang ditambahkan sudah ada atau belum
            $sql="update repo_pbm set UserId = $iduser, NamaDokumen = '$docname', TanggalTerakhirDiubah = '$date', TahunDibuat = $year, FilePath = '$target_file' where IdDokumen = $iddokumen";
          }
          //Menjalankan perintah query dan menyimpannya dalam variabel hasil
          $hasil=mysqli_query ($conn,$sql);
      
          if($hasil)
          {  
            unlink($delete_file);
            header("location: ../pages/keloladokumen.php");
          }
          else
          {
            echo "Database gagal di update";
            unlink($target_file);
            header("Refresh: 5; http://localhost/tugasKP/pages/keloladokumen.php");
          }
        }
        else
        {
          echo "Sorry, there was an error uploading your file.";
          header("Refresh: 5; http://localhost/tugasKP/pages/keloladokumen.php");
        }
      }
    }
    else
    {
      /*
      *Menyimpan Variabel yang di kirim menggunakan method POST
      *Mengubah isi variabel ke lowercase
      */
      $date       = date("Y-m-d");
      
      if($type == "STM")
      {
        //Mempersiapkan Command Query  untuk mengecek apakah barang yang ditambahkan sudah ada atau belum
        $sql="update repo_stm set UserId = $iduser, NamaDokumen = '$docname', TanggalTerakhirDiubah = '$date', TahunDibuat = $year where IdDokumen = $iddokumen";
      }
      else
      {
        //Mempersiapkan Command Query  untuk mengecek apakah barang yang ditambahkan sudah ada atau belum
        $sql="update repo_pbm set UserId = $iduser, NamaDokumen = '$docname', TanggalTerakhirDiubah = '$date', TahunDibuat = $year where IdDokumen = $iddokumen";
      }
      //Menjalankan perintah query dan menyimpannya dalam variabel hasil
      $hasil=mysqli_query ($conn,$sql);
      
      if($hasil)
      {
        header("location: ../pages/keloladokumen.php");
      }
      else
      {
        echo "Database gagal di update";
        echo "<br> $sql";
        header("Refresh: 5; http://localhost/tugasKP/pages/keloladokumen.php");
      }
    }  
  }
  else
  {
    //Memanggil fungsi untuk mengecek apakah user sudah login atau belum
    require_once "session_check_dalam.php";
  }
?>

