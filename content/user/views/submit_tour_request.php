<?php
include('../../auth.php');
include('../../connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $alumni_id = $_POST['alumni_id']; 
    $student_number = $_POST['student_number'];
    $fullname = $_POST['fullname'];    
    $email = $_POST['email'];       
    $number = $_POST['number'];   
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $special_request = $_POST['special_request'];   
    
    $fromDate = date('F j, Y g:ia', strtotime($fromDate));
    $toDate = date('F j, Y g:ia', strtotime($toDate));

    // Check if the alumni has already requested
    $check_sql = "SELECT * FROM campus_tour WHERE alumni_id = $alumni_id";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        // If a record exists, show alert
        echo '<script>alert("You have already submitted a Campus Tour request."); window.location="index.php";</script>';
        exit; // Exit to prevent further processing
    } else {
        // Insert a new record with Pending status
        $insert_sql = "INSERT INTO campus_tour (alumni_id, student_number, fullname, email, number, status, fromDate, toDate, special_request) VALUES ($alumni_id, '$student_number', '$fullname', '$email', '$number', 'Pending', '$fromDate', '$toDate', '$special_request')";
        
        if ($conn->query($insert_sql) === TRUE) {
            echo '<script>alert("Campus Tour request submitted. Please wait for further details"); window.location="campus_tour.php";</script>';
        } else {
            echo '<script>alert("Error: ' . $conn->error . '"); window.location="index.php";</script>';
        }
        exit; // Exit to prevent further processing
    }
}
?>