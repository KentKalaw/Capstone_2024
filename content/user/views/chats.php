<?php
session_start();
include('../../connect.php');
$date = date('F d, Y');
$username1 = $_SESSION['username'];
$id = $_GET['id'];

// Get the profile picture of the other user
$sql_user = "SELECT profile FROM alumni WHERE username = '$id'";
$result_user = $conn->query($sql_user);
$profile_pic = '../images/ub-logo.png'; // Default profile picture
if ($row_user = $result_user->fetch_assoc()) {
    if (!empty($row_user['profile'])) {
        $profile_pic = $row_user['profile'];
    }
}


// Get messages
$sql = "SELECT * FROM message WHERE (user1 = '$username1' AND user2 = '$id') OR (user1 = '$id' AND user2 = '$username1')";
$result = $conn->query($sql);

$previous_date = '';

while($row = $result->fetch_assoc()) {
    $user1 = $row['user1'];
    $user2 = $row['user2'];
    $message = $row['message'];
    $file = $row['file'];
    $current_date = date('F d, Y', strtotime($row['date']));
    $time = date('h:i A', strtotime($row['date']));
    
    // Show date separator if it's a new date
    if ($current_date != $previous_date) {
        echo '<div class="text-center mb-3">';
        echo '<span class="badge bg-light text-dark px-3 py-2 rounded-pill">' . $current_date . '</span>';
        echo '</div>';
        $previous_date = $current_date;
    }

    if ($user1 == $username1) {
        // Sent messages (right-aligned)
        echo '<div class="message-row sent">';
        echo '<div class="message-content">';
        if (!empty($message)) {
            echo '<p class="mb-1">' . nl2br(htmlspecialchars($message)) . '</p>';
        }
        if (!empty($file)) {
            echo '<div class="message-attachment">';
            echo '<img src="' . htmlspecialchars($file) . '" class="message-img" style="height: 300px;; width: 100%; border-radius: 10px; margin-top: 5px; " alt="Attachment">';
            echo '</div>';
        }
        echo '<span class="message-time">' . $time . '</span>';
        echo '</div>';
        echo '</div>';
    } else {
        // Received messages (left-aligned)
        echo '<div class="message-row received">';
        echo '<img src="' . $profile_pic . '" alt="Profile" class="profile-img">';
        echo '<div class="message-content">';
        if (!empty($message)) {
            echo '<p class="mb-1">' . nl2br(htmlspecialchars($message)) . '</p>';
        }
        if (!empty($file)) {
            echo '<div class="message-attachment">';
            echo '<img src="' . htmlspecialchars($file) . '" class="message-img"  style="height: 300px;; width: 100%; border-radius: 10px; margin-top: 5px; " alt="Attachment">';
            echo '</div>';
        }
        echo '<span class="message-time">' . $time . '</span>';
        echo '</div>';
        echo '</div>';
    }

    // Add spacing between message groups
    if ($result->num_rows > 1) {
        echo '<div style="height: 8px;"></div>';
    }
}

// If no messages, show a welcome message
if ($result->num_rows == 0) {
    echo '<div class="text-center text-muted mt-4">';
    echo '<i class="fas fa-comments fa-3x mb-3"></i>';
    echo '<p>No messages yet. Start the conversation!</p>';
    echo '</div>';
}
?>
