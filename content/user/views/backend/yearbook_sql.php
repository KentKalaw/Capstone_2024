<?php

$sql = "SELECT student_number, fullname, request_status, address, order_id, remarks FROM yearbook WHERE alumni_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $alumni_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // Fetch the alumni details
  $row = $result->fetch_assoc();
  $student_number = $row['student_number'];
  $fullname = $row['fullname'];
  $request_status = $row['request_status'] ? $row['request_status'] : 'No request submitted yet';
  $address = $row['address'] ? $row['address'] : 'N/A';
  $order_id = $row['order_id'] ? $row['order_id'] : 'N/A';
  $remarks = $row['remarks'];
} else {
  // Set default values if no data found
  $student_number = 'N/A';
  $fullname = 'N/A';
  $request_status = 'No request submitted yet';
  $address = 'N/A';
  $order_id = 'N/A';
  $remarks = 'N/A';
}

$stmt->close();
$conn->close();

?>
