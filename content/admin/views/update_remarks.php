<?php
include('../../auth.php');
include('../../connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $yearbook_id = $_POST['yearbook_id'];
    $remarks = $_POST['remarks'];

    $update_sql = "UPDATE yearbook SET remarks = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("si", $remarks, $yearbook_id);

    if ($stmt->execute()) {
        echo '<script>alert("Remarks updated successfully."); window.location="view_approved_yearbook.php";</script>';
    } else {
        echo '<script>alert("Error: ' . $stmt->error . '"); window.location="view_approved_yearbook.php";</script>';
    }
}
?>