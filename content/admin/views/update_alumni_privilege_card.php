<?php
include('../../auth.php');
include('../../connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $card_id = isset($_POST['card_id']) ? intval($_POST['card_id']) : 0;
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    if ($card_id > 0 && ($action === 'Approve' || $action === 'Decline')) {
        $newStatus = $action === 'Approve' ? 'Approved' : 'Declined';

        // Update the yearbook status
        $update_sql = "UPDATE alumni_privilege_card SET status = '$newStatus' WHERE id = $card_id";
        if ($conn->query($update_sql) === TRUE) {
            if ($newStatus === 'Approved') {
                        echo "<script>alert('Alumni Privilege Card Status updated to Approved.'); window.location.href='view_alumni_privilege_card.php';</script>";
                    }
                 else {
                    echo "<script>alert('Alumni Privilege Card Status Declined.'); window.location.href='view_alumni_privilege_card.php';</script>";
                }
    
}}}

?>
