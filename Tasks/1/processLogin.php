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

//upload files
if (isset($_FILES["upload"])) {

  $file_name = $_FILES["upload"]["name"];
  $file_size = $_FILES["upload"]["size"];
  $file_temp = $_FILES["upload"]["tmp_name"];
  $file_type = $_FILES["upload"]["type"];

  $files = "uploaded_files/" . basename($file_name);



  if (move_uploaded_file($file_temp, "uploaded_files/" . $file_name)) {
    echo "" . $file_name . " Uploaded Successfully On The Server :)";
    echo "<br>";

  } else {
    echo "<h2>Failed To Uplaod Selected File  :(</h2>";
  }

}

$stmt = $conn->prepare("INSERT INTO customer (firstname, middlename, lastname, gender, dob, mobile, email, state_id, city_id,files)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?)");
$stmt->bind_param("sssssssiis", $firstname, $middlename, $lastname, $gender, $dob, $mobile, $email, $state, $city, $files);

if ($stmt->execute()) 
{
  echo '<script>alert("Customer details inserted successfully."); window.location.href = "view.php";</script>';
}
$conn->close();
?>