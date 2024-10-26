<?php include_once('./backend/client.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alumni - Alumnite</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="icon" type="image/png" sizes="512x512" href="../../assets/img/favicon/logo.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/ub_wall.css"/>
</head>

<body>
<?php include_once('./loader/loader.php'); ?>
  <?php include_once('./sidebar/sidebar.php'); ?>
  <?php include_once('./backend/programs_sql.php');?>
  <?php include_once('./backend/ub_wall_sql.php'); $newsResult = getNewsUpdates($conn);  ?>

  <div id="page-content-wrapper">

    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4 border-bottom" id="top-bar">
      <div class="d-flex align-items-center justify-content-between w-100">
        <div class="d-flex align-items-center">
          <i class="fa fa-bars primary-text fs-4 me-3" id="menu-toggle" aria-hidden="true"></i>
          <h2 class="fs-4 m-0" style="color:#752738"></h2>
        </div>
        <li class="d-flex align-items-center">
          <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="<?php echo $file ?>" alt="Admin Avatar" class="rounded-circle me-2" style="width: 40px; height: 40px;" onclick="window.location='profile.php'">
            <span class="fs-6 alumni-text" onclick="window.location='profile.php'"><?php echo $fname . ' ' . $lname ?> &nbsp; </span>
          </a>
        </li>
      </div>
    </nav>

    <div class="d-flex px-3 py-3 align-items-center" style="margin-bottom: 20px;">
    <img src="<?php echo $file ?>" style="width:90px; height:75px; border-radius:50%; margin-right: 15px;">
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
    <!-- Programs Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-uppercase fw-bold" style="color: #752738;">Programs</h2>
            <hr class="mb-4">
        </div>
    </div>


        <div class="row g-4 mb-5 d-flex justify-content-center">
            <?php while ($program = mysqli_fetch_assoc($programs)) : ?>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="<?php echo htmlspecialchars($program['image']); ?>" style="width: 100%; height: 200px;" class="card-img-top" alt="<?php echo htmlspecialchars($program['title']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($program['title']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($program['subtitle']); ?></p>
                            <div class="d-grid">
                                <a class="btn btn-primary" style="background-color: #752738; border: none;" href='donations.php'>Donate Now</a>
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
                            <img src="<?php echo htmlspecialchars($news['postImage']); ?>" class="img-fluid rounded-start" alt="<?php echo htmlspecialchars($news['postTitle']); ?>">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($news['postTitle']); ?></h5>
                                <p class="card-subtitle mb-2"><?php echo htmlspecialchars($news['postSubTitle']); ?></p>
                                <p class="card-text"><small class="text-muted">Posted <?php echo timeAgo($news['postDate']); ?></small></p>
                                <a href="news_detail.php?id=<?php echo $news['id']; ?>" class="btn btn-sm" style="background-color: #752738; color: white;">Read More</a>
                            </div>
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function() {
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

<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

</body>

</html>
