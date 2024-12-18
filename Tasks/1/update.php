<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "customer_login");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_id'])) {
  $update_id = $_POST['update_id'];
  $firstname = $_POST['firstname'];
  $middlename = $_POST['middlename'];
  $lastname = $_POST['lastname'];
  $gender = $_POST['gender'];
  $dob = $_POST['dob'];
  $mobile = $_POST['mobile'];
  $email = $_POST['email'];
  $state_id = $_POST['state'];
  $city_id = $_POST['city'];

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

  // Validate required fields
  if (empty($firstname) || empty($lastname) || empty($gender) || empty($dob) || empty($mobile) || empty($email) || empty($state_id) || empty($city_id)) {
    echo '<script>alert("Please fill all required fields."); window.history.back();</script>';
    exit;
  }

  // Prepare the UPDATE SQL statement
  $update_sql = "UPDATE customer 
                   SET firstname = ?, middlename = ?, lastname = ?, gender = ?, dob = ?, mobile = ?, email = ?, state_id = ?, city_id = ? ,files = ?
                   WHERE id = ?";
  $stmt = $conn->prepare($update_sql);
  $stmt->bind_param("sssssssiisi", $firstname, $middlename, $lastname, $gender, $dob, $mobile, $email, $state_id, $city_id, $files, $update_id);

  // Execute the statement
  if ($stmt->execute()) {
    echo '<script>alert("Customer details updated successfully."); window.location.href = "view.php";</script>';
  } else {
    echo '<script>alert("Error updating record: ' . $stmt->error . '"); window.history.back();</script>';
  }

  $stmt->close();
} else {
  echo '<script>alert("Invalid request."); window.history.back();</script>';
}

// Close the connection
$conn->close();
?>