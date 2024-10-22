<?php include_once('./backend/client.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Alumnite</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="../css/admin.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="icon" type="image/png" sizes="512x512" href="../../assets/img/favicon/logo.png">
</head>



<body>
<?php include_once('./loader/loader.php'); ?>
  <?php include_once('./sidebar/sidebar.php'); ?>
  <?php include_once('./backend/programs_admin_sql.php'); ?>
  <?php include_once('./backend/ub_wall_admin_sql.php'); $newsResult = getNewsUpdates($conn);  ?>
    
  <div id="page-content-wrapper">

    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4 border-bottom" id="top-bar">
      <div class="d-flex align-items-center justify-content-between w-100">
        <div class="d-flex align-items-center">
          <i class="fa fa-bars primary-text fs-4 me-3" id="menu-toggle"  aria-hidden="true"></i>
          <h2 class="fs-4 m-0" style="color:#752738"></h2>
        </div>
        <li class="d-flex align-items-center">
          <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="../images/admin-logo.jpg" alt="Admin Avatar" class="rounded-circle me-2" style="width: 40px; height: 40px;">
          <span class="fs-6 admin-text">Administrator &nbsp;</span></a>
        </li>
      </div>
    </nav>


    <div class="d-flex px-3 py-3 align-items-center" style="margin-bottom: 20px;">
    <img src="../images/admin-logo.jpg" style="width:90px; height:75px; border-radius:50%; margin-right: 15px;">
    <div class="col-md-5">
        <h3 class="text-themecolor" style="font-size: 1.5em; color:#752738 !important; margin-bottom: 5px;">Programs, News, and Updates</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)" style="color:#000 !important;">Home</a></li>
            <li class="breadcrumb-item active">UB Wall</li>
        </ol>
    </div>
</div>

    <!-- START HERE -->
    <div class="container my-5">
    <div class="d-flex justify-content-end">
    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addNewsModal">
        Add News
    </button>
</div>
    <!-- Programs Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-uppercase fw-bold" style="color: #752738;">Programs</h2>
            <hr class="mb-4">
        </div>
    </div>

        <!-- Program Card 1 -->
        <div class="row g-4 mb-5 d-flex justify-content-center">
            <?php while ($program = mysqli_fetch_assoc($programs)) : ?>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="<?php echo htmlspecialchars($program['image']); ?>" style="width: 100%; height: 200px;" class="card-img-top" alt="<?php echo htmlspecialchars($program['title']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($program['title']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($program['subtitle']); ?></p>
                            <div class="d-grid">
                                <a class="btn btn-primary" style="background-color: #752738; border: none;" href='programs.php'>Check Donations</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>


   <!-- News & Updates Section -->
<div class="row mb-4">
    <div class="col-12">
        <h2 class="text-uppercase fw-bold" style="color: #752738;">News & Updates</h2>
        <hr class="mb-4">
    </div>
</div>

<!-- News Cards -->
<?php 
$initialNewsResult = getNewsUpdates($conn, 0, 4);
if ($initialNewsResult && mysqli_num_rows($initialNewsResult) > 0) : 
?>
    <div class="row g-4">
        <?php while ($news = mysqli_fetch_assoc($initialNewsResult)) : ?>
            <div class="col-md-6">
                <div class="card mb-3 shadow-sm">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="<?php echo htmlspecialchars($news['postImage']); ?>" class="img-fluid rounded-start h-100 w-100" alt="<?php echo htmlspecialchars($news['postTitle']); ?>">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($news['postTitle']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($news['postSubTitle']); ?></p>
                                <p class="card-text"><small class="text-muted">Posted <?php echo timeAgo($news['postDate']); ?></small></p>
                                <a href="news_detail.php?id=<?php echo $news['id']; ?>" class="btn btn-sm" style="background-color: #752738; color: white;">Read More</a>
                                <a href="" 
                                class="btn btn-link text-secondary" 
                                data-bs-toggle="modal" data-bs-target="#updateModal-<?php echo $news['id']; ?>">
                                <i class="fas fa-cog"></i>

                                <a href="delete_news.php?id=<?php echo $news['id']; ?>" 
                                class="btn btn-link text-danger" 
                                style="" 
                                onclick="return confirm('Are you sure you want to delete this news?');">
                                <i class="fa fa-trash-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    <div class="modal fade" id="updateModal-<?php echo $news['id'];?>" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Event Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="news_update.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="news_id" value="<?php echo $news['id']; ?>">
                    <!-- News Title -->
                    <div class="mb-3">
                        <label for="postTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" name="postTitle" id="postTitle" value="<?php echo htmlspecialchars($news['postTitle']); ?>" required>
                    </div>

                    <!-- News SubTitle -->
                    <div class="mb-3">
                        <label for="postSubTitle" class="form-label">SubTitle</label>
                        <textarea class="form-control" name="postSubTitle" id="postSubTitle" rows="2" required><?php echo htmlspecialchars($news['postSubTitle']); ?></textarea>
                    </div>

                    <!-- News Content -->
                    <div class="mb-3">
                        <label for="postContent" class="form-label">Content</label>
                        <textarea class="form-control" name="postContent" id="postContent" rows="8" required><?php echo htmlspecialchars($news['postContent']); ?></textarea>
                    </div>
                    
                    <button type="submit" name="submit" class="btn btn-primary">Update News</button>
                </form>
            </div>
        </div>
    </div>
</div>
        <?php endwhile; ?>
    </div>
<?php else: ?>
    <p>No news available at the moment.</p>
<?php endif; ?>

    <!-- Load More Button -->
    <div class="row mt-4">
    <div class="col-12 text-center">
        <button id="loadMoreNews" class="btn btn-outline-secondary px-4">Load More</button>
    </div>
</div>
    
  </div> <!-- End of container -->

  <div class="modal fade" id="addNewsModal" tabindex="-1" aria-labelledby="addNewsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewsModalLabel">Add News</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="add_news.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="newsTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" name="postTitle" required>
                    </div>
                    <div class="mb-3">
                        <label for="newsSubtitle" class="form-label">Subtitle</label>
                        <input type="text" class="form-control" name="postSubTitle" required>
                    </div>
                    <div class="mb-3">
                        <label for="newsContent" class="form-label">Content</label>
                        <textarea class="form-control" name="postContent" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="newsImage" class="form-label">Image</label>
                        <input type="file" id="upload" class="form-control" style=""  accept="image/png, image/gif, image/jpeg">
                        <textarea  name="file" id="file" style="display:none"></textarea>
                    </div>
                    <script>
                const fileInput = document.getElementById('upload');
                fileInput.addEventListener('change', (e) => {
                // get a reference to the file
                const file = e.target.files[0];

                // encode the file using the FileReader API
                const reader = new FileReader();
                reader.onloadend = () => {

                    // use a regex to remove data url part
                    const base64String = reader.result;
                        document.getElementById('file').value =reader.result; 
                        document.getElementById('img').src = reader.result; 
                    console.log(base64String);
                };
                reader.readAsDataURL(file);});
            </script>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" style="background-color: #752738; border: none;">Add News</button>
                </div>
            </form>
        </div>
    </div>
</div>





  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function () {
      el.classList.toggle("toggled");
    };
  </script>

<script>
$(document).ready(function() {
    var offset = 4; // Start after the initial 4 items
    $('#loadMoreNews').click(function() {
        $.ajax({
            url: 'load_more_news.php',
            method: 'POST',
            data: { offset: offset },
            success: function(response) {
                if (response.trim() !== '') {
                    // Append the new items to the existing row
                    $('.row.g-4:last').append(response);
                    offset += 4; // Increase offset for next load
                } else {
                    $('#loadMoreNews').hide(); // Hide button if no more news
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX error: " + status + ": " + error);
            }
        });
    });
});
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

</body>

</html>
