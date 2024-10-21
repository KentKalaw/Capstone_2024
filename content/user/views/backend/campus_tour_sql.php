<?php

$sql = "SELECT student_number, fullname, email, number, status, special_request, approved_date FROM campus_tour WHERE alumni_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $alumni_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // Fetch the alumni details

  $row = $result->fetch_assoc();
  $student_number = $row['student_number'] ? $row['student_number'] : 'N/A';
  $fullname = $row['fullname'] ? $row['fullname'] : 'N/A';
  $email = $row['email'] ? $row['email'] : 'N/A';
  $number = $row['number'] ? $row['number'] : 'N/A';
  $status = $row['status'] ? $row['status'] : 'No request submitted yet';
  $special_request = $row['special_request'] ? $row['special_request'] : 'N/A';
  $approved_date = $row['approved_date'] ? $row['approved_date'] : 'N/A';


} else {
  // Set default values if no data found
  $student_number = 'N/A';
  $fullname = 'N/A';
  $email = 'N/A';
  $number = 'N/A';
  $status = 'No request submitted yet';
  $special_request = 'N/A';
  $approved_date = 'N/A';
}

$stmt->close();
$conn->close();

?>
