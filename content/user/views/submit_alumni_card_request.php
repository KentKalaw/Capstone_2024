<?php
include('../../auth.php');
include('../../connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $alumni_id = $_POST['alumni_id']; 
    $fullname = $_POST['fullname'];    
    $student_number = $_POST['student_number'];
    $department = $_POST['department'];      
    $course = $_POST['course'];   
    $year_graduated = $_POST['year_graduated'];   

    // Check if the alumni has already requested a yearbook
    $check_sql = "SELECT * FROM alumni_privilege_card WHERE alumni_id = $alumni_id";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        // If a record exists, show alert
        echo '<script>alert("You have already submitted a Yearbook Delivery request."); window.location="index.php";</script>';
        exit; // Exit to prevent further processing
    } else {
        // Insert a new record with Pending status
        $insert_sql = "INSERT INTO alumni_privilege_card (alumni_id, fullname, student_number, department, course, year_graduated, date, status) VALUES ($alumni_id, '$fullname', '$student_number', '$department', '$course', '$year_graduated', CURRENT_TIMESTAMP, 'Pending')";
        
        if ($conn->query($insert_sql) === TRUE) {
            echo '<script>alert("Alumni Privilege Card request submitted. We will verify if you are elligible or not. Please wait for further details"); window.location="alumni_card.php";</script>';
        } else {
            echo '<script>alert("Error: ' . $conn->error . '"); window.location="index.php";</script>';
        }
        exit; // Exit to prevent further processing
    }
}
?>