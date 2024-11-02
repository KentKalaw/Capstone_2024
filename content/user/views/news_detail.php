<?php include_once('./backend/client.php'); ?>
<?php include_once('./backend/programs_sql.php'); ?>
<?php include_once('./backend/ub_wall_sql.php'); ?>
<?php

$news_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$news_item = getNewsDetails($conn, $news_id);

if (!$news_item) {
  header("Location: ub_wall.php");
  exit;
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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="icon" type="image/png" sizes="512x512" href="./assets/img/favicon/logo.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/alumni.css"/>
</head>

<body>
<?php include_once('./loader/loader.php'); ?>
  <?php include_once('./sidebar/sidebar.php'); ?>

  <div id="page-content-wrapper">

  <?php include_once('./navbar/navbar.php'); ?>

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
      <!-- News Title and Subtitle -->
      <h1 class="mb-4 text-dark"><?php echo htmlspecialchars($news_item['postTitle']); ?></h1>
      <h4 class="mb-4 text-secondary"><?php echo htmlspecialchars($news_item['postSubTitle']); ?></h4>

      <!-- Post Date -->
      <p class="text-muted">
        <i class="fa fa-clock"></i> 
        Posted <?php echo timeAgo($news_item['postDate']); ?>
      </p>

      <!-- News Image -->
      <?php if (!empty($news_item['postImage'])): ?>
      <div class="text-center mb-4">
        <img src="<?php echo htmlspecialchars($news_item['postImage']); ?>" class="img-fluid rounded shadow-sm" alt="<?php echo htmlspecialchars($news_item['postTitle']); ?>" style="width: 100%; max-height: 500px; object-fit: fit;">
      </div>
      <?php endif; ?>

      <!-- News Content -->
      <div class="news-content">
        <p class="lead">
          <?php 
          // Ensure newlines are displayed properly
          $content = str_replace(['\r', '\n'], ["\r", "\n"], $news_item['postContent']);
          echo nl2br(htmlspecialchars($content)); 
          ?>
        </p>
      </div>

      <!-- Separator Line -->
      <hr class="my-4">

      <!-- Back Button -->
      <div class="text-end">
        <a href="ub_wall.php" class="btn btn-warning">
          <i class="fa fa-arrow-left"></i> Back to News
        </a>
      </div>
    </div>

    <div id="spacing"> </div>
<style>
  #spacing {
    height: 10px;
  }
</style>

            
  </div> <!-- End of container -->


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function () {
      el.classList.toggle("toggled");
    };
  </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

</body>

</html>

