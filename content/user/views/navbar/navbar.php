<head>
  <link rel="stylesheet" href="../css/navbar.css"> 
</head>

<nav class="navbar navbar-expand-lg navbar-light py-4 px-4 border-bottom" id="top-bar">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
