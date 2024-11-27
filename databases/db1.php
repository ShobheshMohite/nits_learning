<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully <br>";

// <!-- create database -->
$sql = "CREATE DATABASE myDB";
if ($conn->query($sql)) {
  echo "Database Connected Successfully";
} else {
  echo "Error Creating Database : " . $conn->error;
}
$conn->close();
?>



