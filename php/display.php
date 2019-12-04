<?php

  //Memanggil Connection.php
  require_once "connection.php";
    
  function DisplayIndex($conn)
  {
    //Memilih database
    mysqli_select_db($conn,"tubesKP");
  
    //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
    $sql="select R.Judul,R.Author,R.Tahun_Dibuat,R.Tanggal_Terakhir_Diubah,A.Bagian,A.Nama,R.File_path from repo as R, admin as A where R.Id_Admin = A.Id_Admin and R.Status = 1";
  
    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);
  
    //Mengambil 1 baris hasil dari perintah query
    $row=mysqli_fetch_row($hasil);
  
    if($row)
    {
      echo "<div style='overflow-x:auto;'>
            <table border='1'>
              <tr>
                <th> Judul </td>
                <th> Author </td>
                <th> Tahun Dibuat </td>
                <th> Tanggal Terakhir Diubah </td>
                <th> Bagian </td>
                <th> Penanggung Jawab </td>
                <th colspan='2'> Action </td>
              </tr>";
      do
      {
        list($Judul,$Author,$Tahun,$TanggalUbah,$Bagian,$Nama,$Path)=$row;
        $Judul = ucwords($Judul);
        echo "<tr>
                <td> $Judul </td>
                <td> $Author </td>
                <td> $Tahun </td>
                <td> $TanggalUbah </td>
                <td> $Bagian </td>
                <td> $Nama </td>
                <td> <a target='_blank' rel='noopener noreferrer' href='pages/pdfviewer/web/viewer.html?file=../../$Path'>
                      <button type='button' class='button button__primary'>Baca Online</button></a> </td>
                <td> <a href='pages/$Path' download>
                      <button type='button' class='button button__primary'>Download</button></a> </td>
              </tr>";
      }
      while($row=mysqli_fetch_row($hasil));
      echo "</table>
            </div>";
    }
    else
    {
      echo "<center><h2>Tidak ada Dokumen</h2></center>";
    }
  }
  
  function DisplayDokumen($conn)
  {
    //Memilih database
    mysqli_select_db($conn,"tubesKP");
  
    //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
    $sql="select Judul,Author,Tahun_Dibuat,Tanggal_Unggah,Tanggal_Terakhir_Diubah,File_Path,Status,Id_Dokumen from repo";
  
    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);
  
    //Mengambil 1 baris hasil dari perintah query
    $row=mysqli_fetch_row($hasil);
  
    if($row)
    {
      echo "<div style='overflow-x:auto;'>
            <table border='1'>
              <tr>
                <th> Judul </td>
                <th> Author </td>
                <th> Tahun Dibuat </td>
                <th> Tanggal Unggah </td>
                <th> Tanggal Terakhir Diubah </td>
                <th> File Name </td>
                <th> Status </td>";
      if(isset($_SESSION['Loggedin']))
      {
        echo "  <th> Action </td>
              </tr>";
      }
      else
      {
        echo "</tr>";
      }
      do
      {
        list($Judul,$Author,$Tahun,$Tanggal,$TanggalUbah,$Path,$Status,$IdDokumen)=$row;
        $Judul = ucwords($Judul);
        if($Status == 1 )
        {
          $Status = "Tersedia";
        }
        else
        {
          $Status = "Tidak Tersedia";
        }
        $Path = substr($Path,11);
        echo "<form action='../pages/formeditdokumen.php' method='post'>";
        //status (0 = tidak tersedia, 1 = tersedia)
        echo "<tr>
                <input type='hidden' id='id' name='id' value='$IdDokumen'>
                <td> $Judul </td>
                <input type='hidden' id='docname' name='docname' value='$Judul'>
                <td> $Author </td>
                <input type='hidden' id='authorname' name='authorname' value='$Author'>
                <td> $Tahun </td>
                <input type='hidden' id='year' name='year' value='$Tahun'>
                <td> $Tanggal </td>
                <td> $TanggalUbah </td>
                <td> $Path </td>
                <input type='hidden' id='filename' name='filename' value='$Path'>
                <td> $Status </td>
                <input type='hidden' id='status' name='status' value='$Status'>";
        if(isset($_SESSION['Loggedin']))
        {
          echo "<th> <input type='submit' value='Edit' name='submit' class='button button__primary'> </td>
              </tr>";
        }
        else
        {
          echo "</tr>";
        }
        echo "</form>";
      }
      while($row=mysqli_fetch_row($hasil));
      echo "</table>
            </div>";
    }
    else
    {
      echo "<center><h2>Tidak ada Dokumen</h2></center>";
    }
  }
  
  function DisplayAkun($conn)
  {
    //Memilih database
    mysqli_select_db($conn,"tubesKP");
    $level   = $_SESSION['Level'];
    $idadmin = $_SESSION['Id_Admin'];
    
    //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
    if($level == 1)
    {
      $sql="select Nama,Bagian,Username,Status,Id_Admin from admin";
    }
    else
    {
      $sql="select Nama,Bagian,Username,Status,Id_Admin from admin where Id_Admin = $idadmin";
    }
  
    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);
  
    //Mengambil 1 baris hasil dari perintah query
    $row=mysqli_fetch_row($hasil);
  
    if($row)
    {
      echo "<div style='overflow-x:auto;'>
            <table border='1'>
              <tr>
                <th> Nama </th>
                <th> Bagian </th>
                <th> Username </th>
                <th> Status </th>
                <th colspan=2> Action </th>
              </tr>";
      do
      {
        list($Nama,$Bagian,$Username,$Status,$IdAdmin)=$row;
        if($Status == 1 )
        {
          $Status = "Aktif";
        }
        else
        {
          $Status = "Tidak Aktif";
        }
        echo "<form action='../pages/formeditakun.php' method='post' onsubmit='return FormValidation()'>";
        echo "<tr>
                <input type='hidden' id='id' name='id' value='$IdAdmin'>
                <td> $Nama </td>
                <input type='hidden' id='nama' name='nama' value='$Nama'>
                <td> $Bagian </td>
                <input type='hidden' id='bagian' name='bagian' value='$Bagian'>
                <td> $Username </td>
                <td> $Status </td>
                <input type='hidden' id='status' name='status' value='$Status'>
                <td>  <input type='submit' value='Edit Akun' name='editakun' class='button button__primary'> </td>
                <td>  <input type='submit' value='Edit Password' name='editpassword' class='button button__primary'> </td>
              </tr>";
        echo "</form>";
      }
      while($row=mysqli_fetch_row($hasil));
      echo "</table>
            </div>";
    }
    else
    {
      echo "<center><h2>Tidak ada Akun</h2></center>";
    }
  }
  
  function DisplayProsesIn($conn)
  {
    //Memilih database
    mysqli_select_db($conn,"tubesKP");
  
    //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
    $sql="";
  
    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);
  
    //Mengambil 1 baris hasil dari perintah query
    $row=mysqli_fetch_row($hasil);
  
    if($row)
    {
      echo "<div style='overflow-x:auto;'>
            <table border='1'>
              <tr>
                <th> ID </td>
                <th> Tanggal Input </td>
                <th> Tanggal Update </td>
                <th> Tanggal Order </td>
                <th> No. Urut </td>
                <th> No. Surat </td>
                <th> Pengirim </td>
                <th> Material & Jumlah </td>
                <th> Nama Material 1 </td>
                <th> Jumlah </td>
                <th> Nama Material 2 </td>
                <th> Jumlah </td>
                <th> PIC </td>
                <th> Penerima </td>
                <th> Mengetahui </td>
                <th> Keperluan </td>
                <th> Remark </td>
              </tr>
            </table>
            </div>";
    }
    else
    {
      echo "<center><h2>Tidak ada Dokumen</h2></center>";
    }
  }
  
  function DisplayProsesOut($conn)
  {
    //Memilih database
    mysqli_select_db($conn,"tubesKP");
  
    //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
    $sql="";
  
    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);
  
    //Mengambil 1 baris hasil dari perintah query
    $row=mysqli_fetch_row($hasil);
  
    if($row)
    {
      echo "<div style='overflow-x:auto;'>
            <table border='1'>
              <tr>
                <th> ID </td>
                <th> Tanggal Input </td>
                <th> Tanggal Update </td>
                <th> Tanggal Order </td>
                <th> No. Urut </td>
                <th> No. Surat </td>
                <th> Witel </td>
                <th> Mitra </td>
                <th> Material & Jumlah </td>
                <th> Nama Material 1 </td>
                <th> Jumlah </td>
                <th> Nama Material 2 </td>
                <th> Jumlah </td>
                <th> Nama Material 3 </td>
                <th> Jumlah </td>
                <th> Nama Material 4 </td>
                <th> Jumlah </td>
                <th> Nama Material 5 </td>
                <th> Jumlah </td>
                <th> NODIN </td>
                <th> Pemohon </td>
                <th> Penerima </td>
                <th> Pemberi </td>
                <th> Mengetahui </td>
                <th> Keperluan </td>
                <th> Remark </td>
              </tr>
            </table>
            </div>";
    }
    else
    {
      echo "<center><h2>Tidak ada Dokumen</h2></center>";
    }
  }
  
  function DisplayBarangMasuk($conn)
  {
    //Memilih database
    mysqli_select_db($conn,"tubesKP");
  
    //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
    $sql="";
  
    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);
  
    //Mengambil 1 baris hasil dari perintah query
    $row=mysqli_fetch_row($hasil);
  
    if($row)
    {
      echo "<div style='overflow-x:auto;'>
            <table border='1'>
              <tr>
                <th> ID </td>
                <th> DO Number </td>
                <th> Project Name </td>
                <th> Material Code </td>
                <th> Description </td>
                <th> Tanggal </td>
                <th> Kode SN </td>
                <th> SN </td>
                <th> Package S/N </td>
                <th> Material Code </td>
                <th> Description </td>
                <th> Barcode </td>
                <th> Devices </td>
                <th> Model Type </td>
                <th> Qty </td>
                <th> Unit </td>
                <th> Status Barang </td>
                <th> Supplier </td>
                <th> Harga </td>
                <th> Receive By </td>
                <th> Tanggal Input </td>
                <th> Tanggal Update </td>
                <th> Pro Status </td>
                <th> No.Surat </td>
                <th> Remark </td>
              </tr>
            </table>
            </div>";
    }
    else
    {
      echo "<center><h2>Tidak ada Dokumen</h2></center>";
    }
  }
  
  function DisplayBarangKeluar($conn)
  {
    //Memilih database
    mysqli_select_db($conn,"tubesKP");
  
    //Mempersiapkan Command Query  untuk mengambil data IdUser,Nama,Level berdasarkan Username dan Password
    $sql="";
  
    //Menjalankan perintah query dan menyimpannya dalam variabel hasil
    $hasil=mysqli_query ($conn,$sql);
  
    //Mengambil 1 baris hasil dari perintah query
    $row=mysqli_fetch_row($hasil);
  
    if($row)
    {
      echo "<div style='overflow-x:auto;'>
            <table border='1'>
              <tr>
                <th> ID </td>
                <th> DO Number </td>
                <th> Project Name </td>
                <th> Material Code </td>
                <th> Description </td>
                <th> Tanggal </td>
                <th> Kode SN </td>
                <th> SN </td>
                <th> Package S/N </td>
                <th> Material Code </td>
                <th> Description </td>
                <th> Barcode </td>
                <th> Devices </td>
                <th> Model Type </td>
                <th> Qty </td>
                <th> Unit </td>
                <th> Status Barang </td>
                <th> Supplier </td>
                <th> Harga </td>
                <th> Receive By </td>
                <th> Tanggal Input </td>
                <th> Tanggal Update </td>
                <th> Pro Status </td>
                <th> No.Surat </td>
                <th> Remark </td>
                <th> Tanggal Order </td>
                <th> No.Surat </td>
                <th> User - Mitra </td>
                <th> Pemberi </td>
                <th> Penerima </td>
              </tr>
            </table>
            </div>";
    }
    else
    {
      echo "<center><h2>Tidak ada Dokumen</h2></center>";
    }
  }
  
  
  
  function paginate($item_per_page, $current_page, $total_records, $total_pages, $page_url)
  {
    $pagination = '';
    if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
        $pagination .= '<ul class="pagination">';
        
        $right_links    = $current_page + 3; 
        $previous       = $current_page - 3; //previous link 
        $next           = $current_page + 1; //next link
        $first_link     = true; //boolean var to decide our first link
        
        if($current_page > 1){
			$previous_link = ($previous==0)?1:$previous;
            $pagination .= '<li class="first"><a href="'.$page_url.'?page=1" title="First">«</a></li>'; //first link
            $pagination .= '<li><a href="'.$page_url.'?page='.$previous_link.'" title="Previous"><</a></li>'; //previous link
                for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
                    if($i > 0){
                        $pagination .= '<li><a href="'.$page_url.'?page='.$i.'">'.$i.'</a></li>';
                    }
                }   
            $first_link = false; //set first link to false
        }
        
        if($first_link){ //if current active page is first link
            $pagination .= '<li class="first active">'.$current_page.'</li>';
        }elseif($current_page == $total_pages){ //if it's the last active link
            $pagination .= '<li class="last active">'.$current_page.'</li>';
        }else{ //regular current link
            $pagination .= '<li class="active">'.$current_page.'</li>';
        }
                
        for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
            if($i<=$total_pages){
                $pagination .= '<li><a href="'.$page_url.'?page='.$i.'">'.$i.'</a></li>';
            }
        }
        if($current_page < $total_pages){ 
				$next_link = ($i > $total_pages)? $total_pages : $i;
                $pagination .= '<li><a href="'.$page_url.'?page='.$next_link.'" >></a></li>'; //next link
                $pagination .= '<li class="last"><a href="'.$page_url.'?page='.$total_pages.'" title="Last">»</a></li>'; //last link
        }
        
        $pagination .= '</ul>'; 
    }
    return $pagination; //return pagination links
  }
?>