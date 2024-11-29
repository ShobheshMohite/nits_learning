<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "customer_login");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch input 
$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$lastname = $_POST['lastname'];
$gender = $_POST['gender'];
$dob = $_POST['dob'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$state = $_POST['state'];
$city = $_POST['city'];


$stmt = $conn->prepare("INSERT INTO customer (firstname, middlename, lastname, gender, dob, mobile, email, state_id, city_id) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssii", $firstname, $middlename, $lastname, $gender, $dob, $mobile, $email, $state, $city);

if ($stmt->execute()) 
{
  echo '<script>alert("Customer details inserted successfully."); window.location.href = "view.php";</script>';
}
$conn->close();
?>