<?php
include('../../auth.php');
include('../../connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_id = $_POST['event_id'];
    $alumni_id = $_POST['alumni_id'];
    $role = $_POST['role']; // Capture the selected role
    $username = $_SESSION['username'];

    if (isset($_POST['volunteer'])) {
        // Check if the volunteer request already exists
        $check_sql = "SELECT * FROM events_volunteer WHERE event_id = $event_id AND alumni_id = $alumni_id";
        $check_result = $conn->query($check_sql);

        if ($check_result->num_rows > 0) {
            // If the record exists, show alert
            echo '<script>alert("You already submitted a volunteer request."); window.location="events.php";</script>';
            exit; // Exit to prevent further processing
        } else {
            // Insert a new record with 'Pending' status and the selected role
            $insert_sql = "INSERT INTO events_volunteer (event_id, alumni_id, username, role, volunteerStatus) 
                           VALUES ($event_id, $alumni_id, '$username', '$role', 'Pending')";
            if ($conn->query($insert_sql) === TRUE) {
                echo '<script>alert("Volunteer request submitted as ' . $role . ' is successful. We will email you for further details. Please wait for an update."); window.location="events.php";</script>';
            } else {
                echo '<script>alert("Error: ' . $conn->error . '"); window.location="events.php";</script>';
            }
            exit; // Exit to prevent further processing
        }
    }
}
?>