<?php
include('../../auth.php');
include('../../connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $yearbook_id = isset($_POST['yearbook_id']) ? intval($_POST['yearbook_id']) : 0;
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    if ($yearbook_id > 0 && ($action === 'Approve' || $action === 'Decline')) {
        $newStatus = $action === 'Approve' ? 'Approved' : 'Declined';

        // Update the yearbook status
        $update_sql = "UPDATE yearbook SET request_status = '$newStatus' WHERE id = $yearbook_id";
        if ($conn->query($update_sql) === TRUE) {
            if ($newStatus === 'Approved') {
                        echo "<script>alert('Yearbook Status updated to Approved.'); window.location.href='yearbook.php';</script>";
                    }
                 else {
                    echo "<script>alert('Yearbook Status Declined.'); window.location.href='yearbook.php';</script>";
                }
    
}}}

?>
