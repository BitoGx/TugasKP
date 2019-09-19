<?php
  
  require_once "connection.php";
  
  $target_dir = "../uploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $allowedMB = 5000000;
  $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"]))
  {
    $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false)
    {
      echo "Nice - " . $check["mime"] . ".";
      $uploadOk = 1;
    }
    else
    {
      echo "File type is not supported.";
      $uploadOk = 0;
    }
  }
  
  // Check if file already exists
  if (file_exists($target_file)) 
  {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }
  
  // Check file size 5MB
  if ($_FILES["fileToUpload"]["size"] > $allowedMB) 
  {
    echo "Sorry, your file is too large. Max 5Mb.";
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
      
      //Memilih database
      mysqli_select_db($conn,"tubesKP");

      //Mempersiapkan Command Query  untuk mengecek apakah barang yang ditambahkan sudah ada atau belum
      $sql="insert into library(Judul,Nama_Penulis,Genre,Tahun,Status,File_Path) values ('Test','Test','Test',2020,1,'$target_file')";

      //Menjalankan perintah query dan menyimpannya dalam variabel hasil
      $hasil=mysqli_query ($conn,$sql);
      
      if($hasil)
      {
        header("location: ../test.php");
      }
      else
      {
        echo "Oof.. <br>";
        echo "$sql<br>";
      }
    }
    else
    {
      echo "Sorry, there was an error uploading your file.";
    }
  }
?>

