<?php
include('../../auth.php');
include('../../connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_id = $_POST['event_id'];
    $alumni_id = $_POST['alumni_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_SESSION['username'];

    if (isset($_POST['participate'])) {
        $check_sql = "SELECT * FROM events_participation WHERE event_id = $event_id AND alumni_id = $alumni_id";
        $check_result = $conn->query($check_sql);

        if ($check_result->num_rows > 0) {
            // If record exists, show alert
            echo '<script>alert("You already submitted a Participation."); window.location="events.php";</script>';
            exit; // Exit to prevent further processing
        } else {
            // Insert a new record with Pending status
            $insert_sql = "INSERT INTO events_participation (event_id, alumni_id, fname, lname, username, participationStatus) VALUES ($event_id, $alumni_id, '$fname', '$lname', '$username', 'Pending')";
            if ($conn->query($insert_sql) === TRUE) {
                echo '<script>alert("Participation submitted. We will email you for the details. Please wait for update."); window.location="events.php";</script>';
            } else {
                echo '<script>alert("Error: ' . $conn->error . '"); window.location="events.php";</script>';
            }
            exit; // Exit to prevent further processing
        }
    }
}
?>