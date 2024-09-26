<head>
  <link rel="stylesheet" href="../css/sidebar.css"> 
</head>
<div class="d-flex" id="wrapper">
    <!-- Sidebar Start -->
    <div class="side" id="sidebar-wrapper">
      <a href="index.php" class="brand-link">
        <img src="../images/ub-logo.png" alt="AdminLTE Logo" class="brand-image img-circle">
        <span class="brand-text font-weight-heavy">Alumnite</span>
      </a>

      <div class="list-group list-group-flush my-3">
  <a href="index.php" class="list-group-item list-group-item-action">
    <i class="fa-solid fa-book me-3"  aria-hidden="true"></i>Dashboard
  </a>

  <li><a href="profile.php" class="list-group-item list-group-item-action">
    <i class="fa fa-user-circle me-3"  aria-hidden="true"></i>Profile
  </a></li>

  

  <li><a href="events.php" class="list-group-item list-group-item-action">
    <i class="fa fa-calendar me-3"  aria-hidden="true"></i>Events
  </a></li>

  <li> <a href="forums.php" class="list-group-item list-group-item-action">
    <i class="fa fa-users me-3"  aria-hidden="true"></i>Forums
  </a> </li>

  <li> <a href="alumni_card.php" class="list-group-item list-group-item-action">
    <i class="fa fa-id-card me-3"  aria-hidden="true"></i>Alumni Card
  </a> </li>
  
  <li> <a href="#" class="list-group-item list-group-item-action">
    <i class="fa fa-newspaper me-3"  aria-hidden="true"></i>Yearbook
  </a> </li>

  <li> <a href="#" class="list-group-item list-group-item-action">
    <i class="fa fa-map me-3 "  aria-hidden="true"></i>UB Wall
  </a> </li>

  <li> <a href="gts.php" class="list-group-item list-group-item-action">
    <i class="fa fa-file me-3"  aria-hidden="true"></i>GTS
  </a> </li>

  <?php
                        $username = $_SESSION['username'];
                        $r = mysqli_query($conn,"SELECT * FROM message WHERE user2 = '$username' AND status = ''");
                        $c = mysqli_num_rows($r);
                        ?>
  <li><a href="message.php" class="list-group-item list-group-item-action">
    <i class="fa fa-comments me-3"  aria-hidden="true"></i>Messages [<?php echo $c ?>]
  </a></li>

  <li><a href="../../logout.php" class="list-group-item list-group-item-action text-danger fw-bold" >
    <i class="fa fa-sign-out me-3"  aria-hidden="true"></i>Logout
  </a></li>

  

</div>
    </div>
    <!-- Sidebar end -->


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
