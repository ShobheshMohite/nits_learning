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

// Prepare and bind then execute
$stmt = $conn->prepare("INSERT INTO customer (firstname, middlename, lastname, gender, dob, mobile, email, state_id, city_id) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssii", $firstname, $middlename, $lastname, $gender, $dob, $mobile, $email, $state, $city);

if ($stmt->execute()) {
  // Fetch the last inserted ID
  $lastInsertId = $stmt->insert_id;

  // Retrieve
  $fetchSql = "SELECT * c.id, c.firstname, c.middlename, c.lastname, c.gender, c.dob, c.mobile, c.email, s.name as s_name, ct.name as c_name 
                 FROM customer c
                 JOIN states s ON c.state_id = s.id
                 JOIN cities ct ON c.city_id = ct.id";
  $fetchStmt = $conn->prepare($fetchSql);
  $fetchStmt->bind_param("i", $lastInsertId);
  $fetchStmt->execute();
  $result = $fetchStmt->get_result();

  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Display user details
    echo '<h2 style="text-align:center;">Customer Added Successfully</h2>';
    echo '<table border="1" cellpadding="10" cellspacing="0" style="margin: 0 auto; border-collapse: collapse;">';
    echo '<tr><th>ID</th><td>' . htmlspecialchars($user['id']) . '</td></tr>';
    echo '<tr><th>First Name</th><td>' . htmlspecialchars($user['firstname']) . '</td></tr>';
    echo '<tr><th>Middle Name</th><td>' . htmlspecialchars($user['middlename']) . '</td></tr>';
    echo '<tr><th>Last Name</th><td>' . htmlspecialchars($user['lastname']) . '</td></tr>';
    echo '<tr><th>Gender</th><td>' . htmlspecialchars($user['gender']) . '</td></tr>';
    echo '<tr><th>Date of Birth</th><td>' . htmlspecialchars($user['dob']) . '</td></tr>';
    echo '<tr><th>Mobile</th><td>' . htmlspecialchars($user['mobile']) . '</td></tr>';
    echo '<tr><th>Email</th><td>' . htmlspecialchars($user['email']) . '</td></tr>';
    echo '<tr><th>State</th><td>' . htmlspecialchars($user['s_name']) . '</td></tr>';
    echo '<tr><th>City</th><td>' . htmlspecialchars($user['c_name']) . '</td></tr>';
    echo '</table>';
    echo '</div>';
  } else {
    echo '<div><h2 style="text-align:center;">Error: Unable to retrieve user details</h2></div>';
  }

  // Close the fetch statement
  $fetchStmt->close();
} else {
  echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>