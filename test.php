<?php
  include "php/connection.php";
?>
<html>
  <head>
    <title>Test Page</title>
  </head>
  <body>
    <center>
      <h1>TEST PAGE</h1>
      <form action="php/upload.php" method="post" enctype="multipart/form-data"> Select file to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload File" name="submit">
      </form>
    </center>
    <?php
      include "php/display.php";
    ?>
  </body>
</html>