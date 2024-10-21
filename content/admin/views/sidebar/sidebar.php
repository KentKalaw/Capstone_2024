<head>
  <link rel="stylesheet" href="../css/sidebar.css"> 
</head>
<?php $current_page = basename($_SERVER['PHP_SELF']); ?>


<div class="d-flex" id="wrapper">
    <!-- Sidebar Start -->
    <div class="side" id="sidebar-wrapper">
      <a href="index.php" class="brand-link">
        <img src="../images/ub-logo.png" alt="AdminLTE Logo" class="brand-image img-circle">
        <span class="brand-text font-weight-heavy">Alumnite</span>
      </a>

      <div class="list-group list-group-flush my-3">
  <a href="index.php" class="list-group-item list-group-item-action sidebar-admin <?php echo $current_page == 'index.php' ? 'active' : ''; ?>">
    <i class="fa-solid fa-book me-3" aria-hidden="true"></i>Dashboard
  </a>

  <a href="feature_alumni.php" class="list-group-item list-group-item-action sidebar-admin <?php echo $current_page == 'feature_alumni.php' ? 'active' : ''; ?>">
    <i class="fa-solid fa-user-graduate me-3" aria-hidden="true"></i>Featured Alumni
  </a>

  <a href="forums.php" class="list-group-item list-group-item-action sidebar-admin <?php echo $current_page == 'forums.php' ? 'active' : ''; ?>">
    <i class="fa fa-users me-3" aria-hidden="true"></i>Forums
  </a>

  <a href="programs.php" class="list-group-item list-group-item-action sidebar-admin <?php echo $current_page == '#' ? 'active' : ''; ?>">
    <i class="fa-solid fa-hand-holding-heart me-3" aria-hidden="true"></i>Initiative Programs
  </a>

  <a href="events.php" class="list-group-item list-group-item-action sidebar-admin <?php echo $current_page == 'events.php' ? 'active' : ''; ?>">
    <i class="fa fa-calendar me-3" aria-hidden="true"></i>Event Management
  </a>

  <a href="view_alumni_privilege_card.php" class="list-group-item list-group-item-action sidebar-admin <?php echo $current_page == '#' ? 'active' : ''; ?>">
    <i class="fa fa-id-card me-3" aria-hidden="true"></i>Alumni Card
  </a>

  <a href="yearbook.php" class="list-group-item list-group-item-action sidebar-admin <?php echo $current_page == 'yearbook.php' ? 'active' : ''; ?>">
    <i class="fa fa-newspaper me-3" aria-hidden="true"></i>Yearbook
  </a>

  <a href="ub_wall.php" class="list-group-item list-group-item-action sidebar-admin <?php echo $current_page == 'ub_wall.php' ? 'active' : ''; ?>">
    <i class="fa fa-map me-3" aria-hidden="true"></i>UB Wall
  </a>

  <a href="gts.php" class="list-group-item list-group-item-action sidebar-admin <?php echo $current_page == 'gts.php' ? 'active' : ''; ?>">
    <i class="fa fa-file me-3" aria-hidden="true"></i>GTS
  </a>

  <a href="system_analytics.php" class="list-group-item list-group-item-action sidebar-admin <?php echo $current_page == 'system_analytics.php' ? 'active' : ''; ?>">
    <i class="fa fa-bar-chart me-3" aria-hidden="true"></i>System Analytics
  </a>

  <a href="system_logs.php" class="list-group-item list-group-item-action sidebar-admin <?php echo $current_page == 'system_logs.php' ? 'active' : ''; ?>">
    <i class="fa fa-desktop me-3" aria-hidden="true"></i>System Logs
  </a>

  <a href="../../logout.php" class="list-group-item list-group-item-action sidebar-admin text-danger fw-bold">
    <i class="fa fa-sign-out me-3" aria-hidden="true"></i>Logout
  </a>
</div>
    </div>
    <!-- Sidebar end -->


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
