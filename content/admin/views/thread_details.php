<?php
include('../../auth.php');
include('../../connect.php');
$username = $_SESSION['username'];
$sql1 = "SELECT * FROM users WHERE username = '$username'";
$result1 = $conn->query($sql1);
while($row1 = $result1->fetch_assoc()) {
	$type = $row1['type'];
	if($type != 'admin') {
		echo '<script>window.location="../logout.php";</script>';
	}

}

?>

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

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Alumnite</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
  <link rel="stylesheet" href="../css/forums.css" />
</head>

<body>
  
  <?php include_once('./sidebar/sidebar.php'); ?>

  <div id="page-content-wrapper">

 
  <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4 border-bottom" id="top-bar">
      <div class="d-flex align-items-center justify-content-between w-100">
        <div class="d-flex align-items-center">
          <i class="fa fa-bars primary-text fs-4 me-3" id="menu-toggle"  aria-hidden="true"></i>
          <h2 class="fs-4 m-0" style="color:#752738">Dashboard</h2>
        </div>
        <li class="d-flex align-items-center">
          <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="../images/admin-logo.jpg" alt="Admin Avatar" class="rounded-circle me-2" style="width: 40px; height: 40px;">
          <span class="fs-6 admin-text">Administrator &nbsp;</span></a>
        </li>
      </div>
    </nav>


    <div class="container my-5">

<h1 class="text-center mb-4"><?php echo $thread['title']; ?></h1>

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

<!-- Display main replies -->
<div class="row mb-4">
    <div class="col-lg-8 mx-auto">
        <h4 class="mb-4" style="color:#752738">Replies</h4>

        <?php if (mysqli_num_rows($posts_result) > 0): ?>
            <?php while ($post = mysqli_fetch_assoc($posts_result)): 
                $reply_profile = $post['profile'] ? $post['profile'] : '../images/ub-logo.png'; // Default profile picture
            ?>
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <img src="<?php echo $reply_profile; ?>" alt="Reply Author's Profile" class="rounded-circle me-3" style="width: 50px; height: 50px;">
                        <div>
                            <h5 class="mb-0"><?php echo $post['fname'] . ' ' . $post['lname']; ?></h5>
                            <p class="text-muted"><?php echo date('F d, Y', strtotime($post['created_at'])); ?></p>
                        </div>
                    </div>
                    <p><?php echo $post['content']; ?></p>

                    <!-- Form to reply to this reply -->
                    <form method="POST" action="reply_to_reply.php">
                        <input type="hidden" name="thread_id" value="<?php echo $thread_id; ?>">
                        <input type="hidden" name="parent_id" value="<?php echo $post['id']; ?>">
                        <textarea class="form-control mb-2" name="content" rows="1" placeholder="Reply to this comment..."></textarea>
                        <button type="submit" class="btn btn-dark btn-sm">Reply</button>
                    </form>

                    <!-- Display child replies -->
                    <?php
                        $child_replies = fetch_child_replies($post['id'], $conn);
                        while ($child_post = mysqli_fetch_assoc($child_replies)):
                            $child_profile = $child_post['profile'] ? $child_post['profile'] : '../images/ub-logo.png';
                    ?>
                        <div class="ms-5 mt-3 card shadow-sm">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="<?php echo $child_profile; ?>" alt="Reply Author's Profile" class="rounded-circle me-3" style="width: 40px; height: 40px;">
                                    <div>
                                        <h6 class="mb-0"><?php echo $child_post['fname'] . ' ' . $child_post['lname']; ?></h6>
                                        <p class="text-muted small"><?php echo date('F d, Y', strtotime($child_post['created_at'])); ?></p>
                                    </div>
                                </div>
                                <p><?php echo $child_post['content']; ?></p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>There are currently no replies to this thread.</p>
        <?php endif; ?>
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
