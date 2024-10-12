<?php include_once('./client/client.php'); ?>

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

    $result = mysqli_query($conn, "SELECT id FROM alumni WHERE username = '$username'");
    $alumni = mysqli_fetch_assoc($result);
    $author_id = $alumni['id'];

    $sql = "INSERT INTO forum_replies (thread_id, content, author_id) VALUES ('$thread_id', '$content', '$author_id')";
    if (mysqli_query($conn, $sql)) {
        header("Location: thread_details.php?id=$thread_id");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni - Alumnite</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="stylesheet" href="../css/forumss.css" />
</head>

<body>
  
  <?php include_once('./sidebar/sidebar.php'); ?>

  <div id="page-content-wrapper">

    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4 border-bottom" id="top-bar">
      <div class="d-flex align-items-center justify-content-between w-100">
        <div class="d-flex align-items-center">
          <i class="fa fa-bars primary-text fs-4 me-3" id="menu-toggle" aria-hidden="true"></i>
          <h2 class="fs-4 m-0" style="color:#752738"></h2>
        </div>
        <li class="d-flex align-items-center">
          <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="<?php echo $file ?>" alt="Admin Avatar" class="rounded-circle me-2" style="width: 40px; height: 40px;">
            <span class="fs-6 alumni-text"><?php echo $fname . ' ' . $lname ?> &nbsp;</span>
          </a>
        </li>
      </div>
    </nav>

    <div class="d-flex px-3 py-3 align-items-center" style="margin-bottom: 20px;">
    <img src="<?php echo $file ?>" style="width:90px; height:75px; border-radius:50%; margin-right: 15px;">
    <div class="col-md-5">
        <h3 class="text-themecolor" style="font-size: 1.5em; color:#752738 !important; margin-bottom: 5px;">Forum Thread Info</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="forums.php" style="color:#000 !important;">Forums</a></li>
            <li class="breadcrumb-item active">Forum Thread Info</li>
        </ol>
    </div>
</div>

    <div class="container my-5">
        <h2 class="text-center mb-4" style="color:#752738"><?php echo $thread['title']; ?></h2>

        <!-- Display the main thread -->
        <div class="row mb-4">
            <div class="col-lg-8 mx-auto">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <img src="<?php echo $author_profile; ?>" alt="Author's Profile" class="rounded-circle me-3" style="width: 60px; height: 60px;">
                            <div>
                                <h5 class="mb-0"><?php echo $thread['fname'] . ' ' . $thread['lname']; ?></h5>
                                <p class="text-muted">Posted on <?php echo date('F d, Y', strtotime($thread['created_at'])); ?></p>
                            </div>
                        </div>
                        <p><?php echo $thread['content']; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form to submit a reply to the main thread -->
        <div class="row mb-4">
            <div class="col-lg-8 mx-auto">
                <form method="POST" action="">
                    <textarea class="form-control mb-2" name="content" rows="1" placeholder="Write your reply here..." required></textarea>
                    <button type="submit" class="btn btn-dark btn-sm">Submit Reply</button>
                </form>
            </div>
        </div>

        <!-- Display replies -->
        <div class="row mb-4">
    <div class="col-lg-8 mx-auto">
        <div class="replies-section">
            <h4 class="mb-4" style="color:#752738">Replies</h4>
            <?php echo render_replies($thread_id, $conn); ?>
        </div>
    </div>
</div>
    </div>
  </div> <!-- End of page-content-wrapper -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function() {
      el.classList.toggle("toggled");
    };
  </script>
  <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/facebox/1.3.8/facebox.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/facebox/1.3.8/facebox.min.js"></script>

</body>

</html>