<?php
include('../../auth.php');
include('../../connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $alumni_id = $_POST['alumni_id'];   
    $croppedPhoto = $_POST['croppedPhoto'];

    $check_sql = "SELECT * FROM alumni_privilege_card WHERE alumni_id = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("i", $alumni_id);
    $stmt->execute();
    $check_result = $stmt->get_result();

    if ($check_result->num_rows > 0) {
        $insert_sql = "UPDATE alumni_privilege_card SET file = ? WHERE alumni_id = ? AND status = 'Pending'";
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param("si", $croppedPhoto, $alumni_id);
        
        if ($stmt->execute()) {
            echo '<script>alert("Alumni Card Photo has been updated."); window.location="alumni_card.php";</script>';
        } else {
            echo '<script>alert("Error: ' . $stmt->error . '"); window.location="index.php";</script>';
        }
        exit;
    }
}
?>