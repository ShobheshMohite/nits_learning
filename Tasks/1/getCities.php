<?php
header('Content-Type: application/json');

if (isset($_GET['state_id'])) {
  $state_id = intval($_GET['state_id']);

  $conn = new mysqli('localhost', 'root', '', 'customer_login');

  if ($conn->connect_error) {
    echo json_encode(['error' => 'Database connection failed']);
    exit;
  }

  $stmt = $conn->prepare("SELECT id, name FROM cities WHERE state_id = ?");
  $stmt->bind_param("i", $state_id);
  
  $stmt->execute();
  $result = $stmt->get_result();

  $cities = [];
  while ($row = $result->fetch_assoc()) {
    $cities[] = $row;
  }

  echo json_encode($cities);
  exit;
} else {
  echo json_encode(['error' => 'State ID is missing']);
  exit;
}
?>