<?php
include('../../auth.php');
include('../../connect.php');

$alumni_id = $_GET['alumni_id'];

// Check if the user has a pending campus tour request
$campus_tour_sql = "SELECT * FROM campus_tour WHERE alumni_id = $alumni_id AND status = 'Pending'";
$campus_tour_result = $conn->query($campus_tour_sql);

if ($campus_tour_result->num_rows > 0) {

    $update_sql = "DELETE FROM campus_tour WHERE alumni_id = " . $campus_tour_result->fetch_assoc()['alumni_id'];
    if ($conn->query($update_sql) === TRUE) {
        echo '<script>alert("Campus Tour request cancelled successfully."); window.location="campus_tour.php";</script>';
    } else {
        echo "Error cancelling campus tour request: " . $conn->error;
    }
} else {
    echo "No pending campus tour request found.";
}
?>