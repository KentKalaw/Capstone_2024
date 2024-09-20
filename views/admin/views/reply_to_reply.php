<?php
session_start(); // Start the session to access session variables
include('../../connect.php'); // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure the required POST variables are set
    $content = $_POST['content'] ?? '';
    $parent_id = $_POST['parent_id'] ?? '';
    $thread_id = $_POST['thread_id'] ?? ''; // Retrieve thread_id from POST
    $username = $_SESSION['username'] ?? ''; // Check if username is set in session

    // Check if the username is set
    if (empty($username)) {
        die('User not logged in.');
    }

    // Get the author (alumni) details from the database
    $result = mysqli_query($conn, "SELECT id FROM alumni WHERE username = '$username'");
    if (!$result) {
        die('Error fetching alumni details: ' . mysqli_error($conn));
    }
    
    $alumni = mysqli_fetch_assoc($result);
    $author_id = $alumni['id'] ?? null;

    // Check if author_id is found
    if (!$author_id) {
        die('Author not found.');
    }

    // Insert the new post (reply) with the parent_id into the database
    $sql = "INSERT INTO threads_posts (thread_id, content, author_id, parent_id) 
            VALUES ('$thread_id', '$content', '$author_id', '$parent_id')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: thread_details.php?id=$thread_id");
        exit();
    } else {
        die('Error inserting reply: ' . mysqli_error($conn));
    }
}
?>