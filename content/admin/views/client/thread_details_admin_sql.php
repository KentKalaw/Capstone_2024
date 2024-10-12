<?php
$thread_id = isset($_GET['id']) ? $_GET['id'] : null;

$thread_result = mysqli_query($conn, "SELECT t.title, t.content, t.created_at, a.fname, a.lname, a.profile
                                      FROM forums t
                                      JOIN alumni a ON t.author_id = a.id
                                      WHERE t.id = '$thread_id'");


if (!$thread_result) {
    die('Error in thread query: ' . mysqli_error($conn));
}

$thread = mysqli_fetch_assoc($thread_result);

if (!$thread) {
    die('Thread not found.');
}

// Set the author profile image
$author_profile = isset($thread['profile']) && $thread['profile'] ? $thread['profile'] : '../images/ub-logo.png';



// Fetch the thread details
$posts_result = mysqli_query($conn, "SELECT p.id, p.content, p.created_at, a.fname, a.lname, a.profile
                                     FROM forum_replies p
                                     JOIN alumni a ON p.author_id = a.id
                                     WHERE p.thread_id = '$thread_id' AND p.parent_id IS NULL
                                     ORDER BY p.created_at ASC");

// Function to fetch child replies for a specific post
function fetch_child_replies($parent_id, $conn) {
    $child_posts_result = mysqli_query($conn, "SELECT p.id, p.content, p.created_at, a.fname, a.lname, a.profile
                                               FROM forum_replies p
                                               JOIN alumni a ON p.author_id = a.id
                                               WHERE p.parent_id = '$parent_id'
                                               ORDER BY p.created_at ASC");
    return $child_posts_result;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'];
    $username = $_SESSION['username'];

    // Get the author (alumni) details from the database
    $result = mysqli_query($conn, "SELECT id FROM alumni WHERE username = '$username'");
    $alumni = mysqli_fetch_assoc($result);
    $author_id = $alumni['id'];

    // Insert the new post (reply) into the database
    $sql = "INSERT INTO forum_replies (thread_id, content, author_id) VALUES ('$thread_id', '$content', '$author_id')";
    if (mysqli_query($conn, $sql)) {
        header("Location: thread_details.php?id=$thread_id");
        exit();
    }
}
?>