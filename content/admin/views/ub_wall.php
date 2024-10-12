<?php include_once('./client/client.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Alumnite</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../css/admin.css" />
</head>

<body>
<?php include_once('./loader/loader.php'); ?>
  <?php include_once('./sidebar/sidebar.php'); ?>

  <div id="page-content-wrapper">

    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4 border-bottom" id="top-bar">
      <div class="d-flex align-items-center justify-content-between w-100">
        <div class="d-flex align-items-center">
          <i class="fa fa-bars primary-text fs-4 me-3" id="menu-toggle"  aria-hidden="true"></i>
          <h2 class="fs-4 m-0" style="color:#752738">UB Wall</h2>
        </div>
        <li class="d-flex align-items-center">
          <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="../images/admin-logo.jpg" alt="Admin Avatar" class="rounded-circle me-2" style="width: 40px; height: 40px;">
          <span class="fs-6 admin-text">Administrator &nbsp;</span></a>
        </li>
      </div>
    </nav>


    <h2 class="fs-4 mb-2 pt-2 px-3" style="color:#752738; margin-top:20px;">Programs, News & Updates</h2>

<!-- Breadcrumb below the title -->
<ol class="breadcrumb col-md-4 px-3">
  <li class="breadcrumb-item">
    <a href="index.php" style="color: black;">Home</a>
  </li>
  <li class="breadcrumb-item active" aria-current="page">
    UB Wall
  </li>
</ol>






  </div> <!-- End of page-content-wrapper -->


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
