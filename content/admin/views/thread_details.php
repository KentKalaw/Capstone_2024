<?php include_once('./backend/client.php'); ?>
<?php include_once('./backend/thread_details_admin_sql.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Alumnite</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
  <link rel="icon" type="image/png" sizes="512x512" href="../../assets/img/favicon/logo.png">
  <link rel="stylesheet" type="text/css" href="../css/forumss.css"/>
</head>

<body>
  
  <?php include_once('./sidebar/sidebar.php'); ?>
  <?php include_once('./loader/loader.php'); ?>

  <div id="page-content-wrapper">

 
  <?php include_once('./navbar/navbar.php'); ?>

    <div class="d-flex px-3 py-3 align-items-center" style="margin-bottom: 20px;">
    <img src="../images/admin-logo.jpg" style="width:90px; height:75px; border-radius:50%; margin-right: 15px;">
    <div class="col-md-5">
        <h3 class="text-themecolor" style="font-size: 1.5em; color:#752738 !important; margin-bottom: 5px;">Forum Thread Info</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="forums.php" style="color:#000 !important;">Forums</a></li>
            <li class="breadcrumb-item active">Forum Thread Info</li>
        </ol>
    </div>
</div>


    <div class="container my-5">

<h1 class="text-center mb-4"><?php echo $thread['title']; ?></h1>

 <!-- Display the main thread -->
 <div class="row mb-4">
            <div class="col-lg-12 mx-auto">
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
            <div class="col-lg-12 mx-auto">
                <form method="POST" action="">
                    <textarea class="form-control mb-2" name="content" rows="1" placeholder="Write your reply here..." required></textarea>
                    <button type="submit" class="btn btn-dark btn-sm">Submit Reply</button>
                </form>
            </div>
        </div>

        <!-- Display replies -->
        <div class="row mb-4">
    <div class="col-md-12 mx-auto">
        <div class="replies-section">
            <h4 class="mb-4" style="color:#752738">Replies</h4>
            <?php 
$replies = render_replies($thread_id, $conn);
if (empty($replies)) {
    echo '<div class="alert alert-info mt-3">
            <i class="fas fa-info-circle me-2"></i>There are currently no replies to this thread.
          </div>';
} else {
    echo $replies;
}
?>
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
