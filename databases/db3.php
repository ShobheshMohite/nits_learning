<!-- INSERT DATA IN TABLE -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully <br>";

// <!-- create database -->
$sql = "INSERT INTO MyGuests(firstname,lastname,email) VALUES('shuhbs','Doe','shubhs@gmail.com')";

if ($conn->query($sql) === TRUE) {
  echo "Record Inserted Successfully";
} else {
  echo "Error : " . $conn->error;
}
$conn->close();
?>