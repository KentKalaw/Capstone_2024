<?php
session_start();
include('../../connect.php');
$date = date('F d, Y');
$username1 = $_SESSION['username'];
$id = $_GET['id'];

$sql = "SELECT * FROM message WHERE (user1 = '$username1' AND user2 = '$id') OR (user1 = '$id' AND user2 = '$username1')";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    $user1 = $row['user1'];
    $user2 = $row['user2'];
    $message = $row['message'];
    $file = $row['file'];
    $date = date('F d, Y h:i A', strtotime($row['date']));

    if ($user1 == $username1) {
        // Right-aligned messages (for current user)
        echo '<div class="row mb-5 justify-content-end">';
        echo '<div class="col-auto bg-primary text-dark p-3 rounded-3 shadow" style="max-width: 75%; word-wrap: break-word;">';
        echo '<p class="mb-1 fw-bold text-dark">' . nl2br(htmlspecialchars($message)) . '</p>';
        if ($file != '') {
            echo '<img src="' . htmlspecialchars($file) . '" class="img-fluid my-2" style="max-width: 100%;">';
        }
        echo '<small class="text-dark d-block">' . $date . '</small>';
        echo '</div>';
        echo '</div>';
    } else {
        // Left-aligned messages (from the other user)
        echo '<div class="row mb-3 justify-content-start">';
        echo '<div class="col-auto bg-white text-dark p-3 rounded-3 shadow-sm" style="max-width: 75%; word-wrap: break-word;">';
        echo '<p class="mb-1 fw-bold ">' . nl2br(htmlspecialchars($message)) . '</p>';
        if ($file != '') {
            echo '<img src="' . htmlspecialchars($file) . '" class="img-fluid my-2" style="max-width: 100%;">';
        }
        echo '<small class="text-dark d-block">' . $date . '</small>';
        echo '</div>';
        echo '</div>';
    }
}
?>
