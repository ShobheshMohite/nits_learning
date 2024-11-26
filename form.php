<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<a href="demo_phpfile.php?subject=PHP&web=W3schools.com">Test $GET</a>  

  <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
    Name: <input type="text" name="fname">
    <input type="submit">
  </form>
  
  <?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      $name = htmlspecialchars($_POST["fname"]);
      if(empty($name)){
        echo "Name Is Empty"; 
      } else {
        echo $name;
      }

    }
  ?>


</body>
</html>