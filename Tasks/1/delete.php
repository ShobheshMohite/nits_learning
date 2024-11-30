<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "customer_login");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

echo '<div style="text-align:center; margin-bottom: 20px;">';
echo '<form action="index.php" method="GET" style="display:inline-block;">';
echo '<button type="submit" style="background-color:#4CAF50; color:white; padding:10px 20px; border:none; border-radius:5px; font-size:16px; cursor:pointer;">Home</button>';
echo '</form>';
echo '</div>';

//delete record
if (isset($_POST['delete_id'])) {
  $delete_id = $_POST['delete_id'];
  $query = "DELETE FROM customer WHERE id= ?";
  $result = $conn->prepare($query);
  $result->bind_param("i", $delete_id);

  if ($result->execute()) {
    echo '<script>alert("Customer details removed successfully."); window.location.href = "view.php";</script>';
  } else {
    echo "<div style='text-align:center;color:red;'> Error Deleting The Selected Data</div>";
  }

}

?>