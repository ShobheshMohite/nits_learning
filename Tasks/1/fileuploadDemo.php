<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form action="" method="POST" enctype="multipart/form-data">
    <label for="file">Select File: </label>
    <input type="file" id="fileupload" name="fileupload"> <br>

    <?php
    if (isset($_FILES["fileupload"])) {

      $file_name = $_FILES["fileupload"]["name"];
      $file_size = $_FILES["fileupload"]["size"];
      $file_temp = $_FILES["fileupload"]["tmp_name"];
      $file_type = $_FILES["fileupload"]["type"];

      if (move_uploaded_file($file_temp, "uploaded_files/" . $file_name)) {
        echo "" . $file_name . " Uploaded Successfully On The Server :)";
        echo "<br>";
      } else {
        echo "<h2>Failed To Uplaod Selected File  :(</h2>";
      }

    }
    ?>

    <button type="submit">Submit</button>
  </form>
</body>

</html>