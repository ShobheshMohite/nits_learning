<?php
$cookie_name = "user";
$cookie_value = "shobheshmohite";

setcookie($cookie_name, $cookie_value, time() + (86400 * 30) );
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php
  if (!isset($_COOKIE[$cookie_name])) {
    echo "$cookie_name" . " is not set..";
  } else {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    print "Value is : " . $cookie_value;
  }
  ?>
</body>

</html>