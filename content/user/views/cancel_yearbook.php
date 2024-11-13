<?php
include('../../auth.php');
include('../../connect.php');

$alumni_id = $_GET['alumni_id'];

// Check if the user has a pending yearbook request
$yearbook_sql = "SELECT * FROM yearbook WHERE alumni_id = $alumni_id AND request_status = 'Pending'";
$yearbook_result = $conn->query($yearbook_sql);

if ($yearbook_result->num_rows > 0) {

    $update_sql = "DELETE FROM yearbook WHERE alumni_id = " . $yearbook_result->fetch_assoc()['alumni_id'];
    if ($conn->query($update_sql) === TRUE) {
        echo '<script>alert("Yearbook request cancelled successfully."); window.location="yearbook.php";</script>';
    } else {
        echo "Error cancelling yearbook request: " . $conn->error;
    }
} else {
    echo "No pending yearbook request found.";
}
?>