<?php
include('../../auth.php');
include('../../connect.php');
$username = $_SESSION['username'];

// Get the logged-in user details
$sql1 = "SELECT * FROM alumni WHERE username = '$username'";
$result1 = $conn->query($sql1);
while($row1 = $result1->fetch_assoc()) {
    $fname = $row1['fname'];
    $lname = $row1['lname'];
    $occupation = $row1['occupation'];
    $company = $row1['company'];
    $city = $row1['city'];
    $region = $row1['region'];
    $program = $row1['program'];
    $file = $row1['profile'];
    if ($file == '') {
        $file = '../images/ub-logo.png';
    }
}

$r = mysqli_query($conn, "SELECT * FROM audit WHERE username = '$username' AND action = 'Alumni account logged in'");
$c = mysqli_num_rows($r);
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

  <link rel="stylesheet" href="../css/user.css" />
</head>

<body>
  
  <?php include_once('./sidebar/sidebar.php'); ?>

  <div id="page-content-wrapper">

    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4 border-bottom" id="top-bar">
      <div class="d-flex align-items-center justify-content-between w-100">
        <div class="d-flex align-items-center">
          <i class="fa fa-bars primary-text fs-4 me-3" id="menu-toggle" aria-hidden="true"></i>
          <h2 class="fs-4 m-0" style="color:#752738">Dashboard</h2>
        </div>
        <li class="d-flex align-items-center">
          <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="<?php echo $file ?>" alt="Admin Avatar" class="rounded-circle me-2" style="width: 40px; height: 40px;" onclick="window.location='profile.php'">
            <span class="fs-6 alumni-text" onclick="window.location='profile.php'"><?php echo $fname . ' ' . $lname ?> &nbsp; </span>
          </a>
        </li>
      </div>
    </nav>

    <!-- Featured Alumni Section -->
    <div class="container my-5">
      <h3 class="text-center mb-4" style="color:#752738;">Featured Alumni</h3>
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
            $year =$row1['year'];
			$course =$row1['course'];

            // Set the first item as active
            $active = $i == 0 ? 'active' : '';
            echo '<div class="carousel-item ' . $active . '"  data-bs-interval="5000">';
            echo '<img src="' . $profile . '" class="d-block w-100" alt="' . $name . '">';
            echo '<div class="carousel-caption">';
            echo '<h5>' .$name. '</h5>';
            echo '<p class="positioncompany">' . $position . ' - ' . $company . '</p>';
            echo '<p class="courseyear">' . $course . ', ' . $year . '</p>';
            echo '</div>';
            echo '</div>';
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
