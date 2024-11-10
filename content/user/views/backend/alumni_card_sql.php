<?php

$sql = "SELECT fullname, student_number, department, course, year_graduated, date, file, status FROM alumni_privilege_card WHERE alumni_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $alumni_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // Fetch the alumni details
  $row = $result->fetch_assoc();
  $fullname = $row['fullname'] ? $row['fullname'] : 'N/A';
  $student_number = $row['student_number'] ? $row['student_number'] : 'N/A';
  $department = $row['department'] ? $row['department'] : 'N/A';
  $course = $row['course'] ? $row['course'] : 'N/A';
  $year_graduated = $row['year_graduated'] ? $row['year_graduated'] : 'N/A';
  $date = $row['date'] ? $row['date'] : 'N/A';
  $idphoto = $row['file'] ? $row['file'] : 'N/A';
  $status = $row['status'] ? $row['status'] : 'No request submitted yet';

} else {
  // Set default values if no data found
  $fullname = 'N/A';;
  $student_number ='N/A';;
  $department = 'N/A';
  $course = 'N/A';
  $year_graduated = 'N/A';
  $date = 'N/A';
  $idphoto = 'N/A';
  $status = 'No request submitted yet';
}

$stmt->close();
$conn->close();

?>