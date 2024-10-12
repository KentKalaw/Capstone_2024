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

$author_profile = isset($thread['profile']) && $thread['profile'] ? $thread['profile'] : '../images/ub-logo.png';

// Function to fetch all replies for a thread
function fetch_replies($thread_id, $conn, $parent_id = null) {
    $parent_condition = $parent_id === null ? "p.parent_id IS NULL" : "p.parent_id = $parent_id";
    $query = "SELECT p.id, p.content, p.created_at, a.fname, a.lname, a.profile
              FROM forum_replies p
              JOIN alumni a ON p.author_id = a.id
              WHERE p.thread_id = '$thread_id' AND $parent_condition
              ORDER BY p.created_at ASC";
    return mysqli_query($conn, $query);
}

// Function to render replies recursively
function render_replies($thread_id, $conn, $parent_id = null, $depth = 0) {
    $replies = fetch_replies($thread_id, $conn, $parent_id);
    $output = '<div class="reply-thread">';
    while ($reply = mysqli_fetch_assoc($replies)) {
        $reply_profile = $reply['profile'] ? $reply['profile'] : '../images/ub-logo.png';
        $output .= "
        <div class='reply-item'>
            <div class='reply-content'>
                <img src='{$reply_profile}' alt='Reply Author's Profile' class='rounded-circle reply-avatar'>
                <div class='reply-body'>
                    <div class='reply-bubble'>
                        <strong>{$reply['fname']} {$reply['lname']}</strong>
                        <p>{$reply['content']}</p>
                    </div>
                    <div class='reply-actions'>
                        <small class='text-muted'>" . date('F d, Y \a\t h:i A', strtotime($reply['created_at'])) . "</small>
                        <button class='btn btn-link text-muted p-0 ms-2' type='button' data-bs-toggle='collapse' data-bs-target='#replyForm{$reply['id']}' aria-expanded='false'>
                            Reply
                        </button>
                    </div>
                    <div class='collapse mt-2' id='replyForm{$reply['id']}'>
                        <form method='POST' action='reply_to_reply.php'>
                            <input type='hidden' name='thread_id' value='{$thread_id}'>
                            <input type='hidden' name='parent_id' value='{$reply['id']}'>
                            <div class='input-group'>
                                <textarea class='form-control' name='content' rows='1' placeholder='Write your reply here...' required></textarea>
                                <button type='submit' class='btn btn-primary btn-sm'>Reply</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            " . render_replies($thread_id, $conn, $reply['id'], $depth + 1) . "
        </div>";
    }
    $output .= '</div>';
    return $output;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'];
    $username = $_SESSION['username'];

    // Get the user (admin) details from the database
    $result = mysqli_query($conn, "SELECT id FROM users WHERE username = '$username'");
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