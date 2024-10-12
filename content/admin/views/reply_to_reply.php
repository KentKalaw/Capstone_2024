<?php
session_start(); // Start the session to access session variables
include('../../connect.php'); // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $thread_id = $_POST['thread_id'];
    $parent_id = $_POST['parent_id'];
    $content = $_POST['content'];
    $username = $_SESSION['username'];

    // Get the author (alumni) details from the database
    $result = mysqli_query($conn, "SELECT id FROM users WHERE username = '$username'");
    $admin_id = mysqli_fetch_assoc($result);
    $author_id = $admin_id['id'];

    // Insert the new reply into the database
    $sql = "INSERT INTO forum_replies (thread_id, parent_id, content, author_id) VALUES ('$thread_id', '$parent_id', '$content', '$author_id')";
    if (mysqli_query($conn, $sql)) {
        header("Location: thread_details.php?id=$thread_id");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>