<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "customer_login");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$fetchSql = "SELECT c.id, c.firstname, c.middlename, c.lastname, c.gender, c.dob, c.mobile, c.email, s.name as s_name, ct.name as c_name 
                 FROM customer c
                 JOIN states s ON c.state_id = s.id
                 JOIN cities ct ON c.city_id = ct.id";

$result = $conn->query($fetchSql) or die("" . $conn->error);


echo '<div style="text-align:center; align-items:center;margin-bottom: 20px;">';
echo '<form action="index.php" method="GET" style="display:inline-block;">';
echo '<button type="submit" style="background-color:#4CAF50; color:white; padding:10px 20px; border:none; border-radius:5px; font-size:16px; cursor:pointer;">Home</button>';
echo '</form>';
echo '</div>';

if ($result->num_rows > 0) {

  // Display user details
  echo '<h2 style="text-align:center; font">Customer Data</h2>';
  echo '<table border="1" cellpadding="10" cellspacing="0" style="margin: 0 auto; border-collapse: collapse;">';
  echo '<tr>';
  echo '<th>ID</th>';
  echo '<th>First Name</th>';
  echo '<th>Middle Name</th>';
  echo '<th>Last Name</th>';
  echo '<th>Gender</th>';
  echo '<th>Date of Birth</th>';
  echo '<th>Mobile</th>';
  echo '<th>Email</th>';
  echo '<th>State</th>';
  echo '<th>City</th>';
  echo '<th>Action</th>';
  echo '</tr>';

  //access all results
  while ($user = $result->fetch_assoc()) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($user['id']) . '</td>';
    echo '<td>' . htmlspecialchars($user['firstname']) . '</td>';
    echo '<td>' . htmlspecialchars($user['middlename']) . '</td>';
    echo '<td>' . htmlspecialchars($user['lastname']) . '</td>';
    echo '<td>' . htmlspecialchars($user['gender']) . '</td>';
    echo '<td>' . htmlspecialchars($user['dob']) . '</td>';
    echo '<td>' . htmlspecialchars($user['mobile']) . '</td>';
    echo '<td>' . htmlspecialchars($user['email']) . '</td>';
    echo '<td>' . htmlspecialchars($user['s_name']) . '</td>';
    echo '<td>' . htmlspecialchars($user['c_name']) . '</td>';

    //add edit button
    echo '<td>';
    echo '<div style="display: flex">';
    echo '<form method="POST" action="edit.php" style="margin:0">';
    echo '<input type="hidden" name="edit_id" value="' . $user['id'] . '">';
    echo '<button type="submit" style="background-color: #D6D31D; color:white; padding:10px 20px; border:none; border-radius:5px; font-size:16px; cursor:pointer; margin-right:10px ; ">EDIT</button>';


    echo '</form>';
    //delete button
    echo '<form method="POST" action="delete.php" style="margin:0">';
    echo '<input type="hidden" name="delete_id" value="' . $user['id'] . '">';
    echo '<button type="submit" style="background-color: red; color:white; padding:10px 20px; border:none; border-radius:5px; font-size:16px; cursor:pointer;">DELETE</button>';

    echo '</form>';
    echo '</div>';
    echo '</td>';

    echo '</tr>';
  }
  echo '</table>';
  echo '</div>';
} else {
  echo '<div><h2 style="text-align:center;">Error: Unable to retrieve user details</h2></div>';
}

?>