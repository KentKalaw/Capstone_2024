<?php include_once('./backend/client.php'); ?>
<?php include_once('./backend/top_online_visitor_sql.php'); ?>



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
  <link rel="stylesheet" type="text/css" href="../css/alumni.css"/>
</head>

<body>
<?php include_once('./loader/loader.php'); ?>
  
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
            <img src="<?php echo $file ?>" alt="Admin Avatar" class="rounded-circle me-2" style="width: 40px; height: 40px;" onclick="window.location='profile.php'">
            <span class="fs-6 alumni-text" onclick="window.location='profile.php'"><?php echo $fname . ' ' . $lname ?> &nbsp; </span>
          </a>
        </li>
      </div>
    </nav>

    

    <div class="d-flex px-3 py-3 align-items-center" style="margin-bottom: 20px;">
    <img src="<?php echo $file ?>" style="width:90px; height:75px; border-radius:50%; margin-right: 15px;">
    <div class="col-md-5">
        <h3 class="text-themecolor" style="font-size: 1.5em; color:#752738 !important; margin-bottom: 5px;">Dashboard</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)" style="color:#000 !important;">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>
</div>




    <!-- Featured Alumni Section -->
    <div class="container my-5">
      <h3 class="text-center mb-4" style="color:#752738;">Featured Alumni</h3>
      <hr class="mb-4">
      <div id="featuredAlumniCarousel" class="carousel slide" data-bs-ride="carousel" style="background-color:#BCB2AC; border-radius: 25px; overflow: hidden;">

        <img src="../../assets/img/branding/header.png" alt="Logo" class="carousel-logo">
        <!-- Dynamic Carousel Indicators -->
        <div class="carousel-indicators">
          <?php
          // Fetch all approved featured alumni
          $result1 = mysqli_query($conn, "SELECT * FROM profile1 WHERE status = 'Approved'");
          $i = 0;
          while ($row1 = mysqli_fetch_array($result1)) {
            $active = $i == 0 ? 'active' : ''; // Set the first indicator as active
            echo '<button type="button" data-bs-target="#featuredAlumniCarousel" data-bs-slide-to="' . $i . '" class="' . $active . '" aria-current="true"></button>';
            $i++;
          }
          ?>
        </div>

      <!-- Dynamic Carousel Items -->
      <div class="carousel-inner">
    <?php
    $result1 = mysqli_query($conn, "SELECT * FROM profile1 WHERE status = 'Approved'");
    $i = 0;
    while ($row1 = mysqli_fetch_array($result1)) {
        $profile = $row1['image'];
        if ($profile == '') {
            $profile = '../images/ub-logo.png';
        }
        $username = $row1['username'];
        $name = $row1['name'];
        $position = $row1['position'];
        $company = $row1['company'];
        $year = $row1['year'];
        $course = $row1['course'];
        $a4 = $row1['a4'];

        // Set the first item as active
        $active = $i == 0 ? 'active' : '';
        echo '<div class="carousel-item ' . $active . '" data-bs-interval="5000" style="box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2) !important;">';
        echo '<div class="row no-gutters" style="height: 100%;">'; // Flex row for full height

        // Left column for image
        echo '<div class="col-md-5 d-flex align-items-center justify-content-center" style="background-color: #F8F9FA;">';
        echo '<img src="' . $profile . '" class="img-fluid" alt="' . $name . '" style="max-height: 100%; max-width: 100%;">'; // Responsive image
        echo '</div>';

        // Right column for information
        echo '<div class="dev-carousel col-md-7 d-flex flex-column align-items-center justify-content-center p-4" style="background-color: #F8F9FA;">';
        echo '<h1 class="text-center" style="font-weight:bold;">' . $name . '</h1>';
        echo '<p class="text-center">' . $a4 . '</p>';
        echo '<h5 class="text-center positioncompany" style="font-weight:bold;">' . $position . ' - ' . $company . '</h5>';
        echo '<h5 class="text-center courseyear" style="font-weight:bold;">' . $course . ', Batch ' . $year . '</h5>';
        echo '</div>';
        
        echo '</div>'; // End of row
        echo '</div>'; // End of carousel-item
        $i++;
    }
    ?>
</div>

        <!-- Carousel Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#featuredAlumniCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#featuredAlumniCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>

    <div class="container my-5">
    <h3 class="text-center mb-4" style="color:#752738;">Announcement</h3>
    <hr class="mb-4">

    <div class="row justify-content-center">
        <div class="col-lg-11 col-md-10">
            <?php
            // Fetch pinned posts first
            $result = mysqli_query($conn, "SELECT * FROM post WHERE pin = '1' ORDER BY ID DESC");
            $hasPosts = false; // Initialize a flag to track if there are any posts

            while ($row = mysqli_fetch_array($result)) {
                $hasPosts = true; // If we have at least one post, set the flag to true
                $username = $row['username'];
                $post = $row['post'];
                $date = date('F d, Y h:i A', strtotime($row['date']));

                // Fetch user profile data
                $result1 = mysqli_query($conn, "SELECT * FROM alumni WHERE username = '$username'");
                $row1 = mysqli_fetch_array($result1);
                $profile = $row1['profile'] ?: '../images/ub-logo.png'; // default profile image
                $name = $row1['fname'] . ' ' . $row1['lname'];

                // Announcement card for pinned post
                echo '<div class="card mb-4 shadow-sm border-warning">';
                echo '<div class="card-body">';
                echo '<div class="d-flex align-items-center">';
                echo '<img src="' . $profile . '" class="rounded-circle me-3" style="width: 60px; height: 60px;">';
                echo '<div>';
                echo '<h5 class="card-title mb-1">' . $name . '</h5>';
                echo '<p class="card-text mb-2">' . $post . '</p>';
                echo '<small class="text-muted">' . $date . '</small>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }

            // Fetch other posts (non-pinned)
            $result = mysqli_query($conn, "SELECT * FROM post WHERE pin <> '1' ORDER BY ID DESC");
            while ($row = mysqli_fetch_array($result)) {
                $hasPosts = true; // At least one post found
                $username = $row['username'];
                $post = $row['post'];
                $date = date('F d, Y h:i A', strtotime($row['date']));

                // Fetch user profile data or set as admin
                if ($username == 'admin') {
                    $name = 'Administrator';
                    $profile = '../images/ub-logo.png';
                } else {
                    $result1 = mysqli_query($conn, "SELECT * FROM alumni WHERE username = '$username'");
                    $row1 = mysqli_fetch_array($result1);
                    $profile = $row1['profile'] ?: '../images/ub-logo.png'; // default profile image
                    $name = $row1['fname'] . ' ' . $row1['lname'];
                }

                // Announcement card for non-pinned post
                echo '<div class="card mb-2 shadow-sm border-light">';
                echo '<div class="card-body">';
                echo '<div class="d-flex align-items-center">';
                echo '<img src="' . $profile . '" class="rounded-circle me-3" style="width: 60px; height: 60px;">';
                echo '<div>';
                echo '<h5 class="card-title mb-1">' . $name . '</h5>';
                echo '<p class="card-text mb-2">' . $post . '</p>';
                echo '<small class="text-muted">' . $date . '</small>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }

            // If there are no posts, display a "No announcements currently" message
            if (!$hasPosts) {
                echo '<div class="alert alert-warning text-center" role="alert">';
                echo 'No announcements currently.';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>

<div class="container my-5">
<h3 class="text-center mb-4" style="color:#752738;">Top Online Visitor</h3>
<hr class="mb-4">
<div class="row mx-auto justify-content-center">
    <div class="col-md-7">
        <div class="table-container mx-auto">
            <table class="table table-bordered text-center">
                <thead>
                    <tr></tr> 
                </thead>
                <tbody>
                    <tr>
                        <td colspan='2' style="color: #752738;">Today's Top Online Visitors<br>(<?php echo date('F j, Y'); ?>) </td>
                    </tr>
                    
                    <?php
                    if (mysqli_num_rows($loginResult) > 0) {
                        $rank = 1; // Initialize rank counter

                        // Loop through each visitor
                        while ($row = mysqli_fetch_assoc($loginResult)) {
                            echo "<tr>";
                            echo "<td style='text-align:center!important;'>" . $rank . ".</td>"; // Display rank
                            echo "<td style='text-align:left!important;'>" . $row['fname'] . ' '. $row['lname'] . "</td>"; // Display visitor username
                            echo "</tr>";
                            $rank++;
                        }
                    } else {
                        // If no visitors, display a message
                        echo "<tr><td colspan='2' class='text-center'>No Top Online Visitors this week</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
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

</body>

</html>
