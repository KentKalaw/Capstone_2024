<?php
include('../../auth.php');
include('../../connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $alumni_id = $_POST['alumni_id'];  // Get the alumni ID
    $fullname = $_POST['fullname'];     // Get the full name
    $address = $_POST['address'];       // Get the delivery address
    $number = $_POST['number'];         // Get the phone number

    // Check if the alumni has already requested a yearbook
    $check_sql = "SELECT * FROM yearbook WHERE alumni_id = $alumni_id";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        // If a record exists, show alert
        echo '<script>alert("You have already submitted a Yearbook Delivery request."); window.location="index.php";</script>';
        exit; // Exit to prevent further processing
    } else {
        // Insert a new record with Pending status
        $insert_sql = "INSERT INTO yearbook (alumni_id, fullname, address, number, request_status, delivery_status) VALUES ($alumni_id, '$fullname', '$address', '$number', 'Pending', '')";
        
        if ($conn->query($insert_sql) === TRUE) {
            echo '<script>alert("Yearbook Delivery request submitted. We will contact you for further details."); window.location="yearbook.php";</script>';
        } else {
            echo '<script>alert("Error: ' . $conn->error . '"); window.location="index.php";</script>';
        }
        exit; // Exit to prevent further processing
    }
}
?>