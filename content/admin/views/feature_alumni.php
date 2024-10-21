<?php include_once('./backend/client.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Alumnite</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="../css/feature_alumni.css"/>
  <link rel="icon" type="image/png" sizes="512x512" href="../../assets/img/favicon/logo.png">
</head>

<body>
<?php include_once('./loader/loader.php'); ?>
  <?php include_once('./sidebar/sidebar.php'); ?>

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
        <h3 class="text-themecolor" style="font-size: 1.5em; color:#752738 !important; margin-bottom: 5px;">Feature Alumni</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)" style="color:#000 !important;">Home</a></li>
            <li class="breadcrumb-item active">Feature Alumni</li>
        </ol>
    </div>
</div>

    <div class="container my-5">
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
        echo '<div class="col-md-7 d-flex flex-column align-items-center justify-content-center p-4" style="background-color: #F8F9FA;">';
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

    <!-- Add the Record Table Below -->
    <div class="container-fluid mt-3">
    <div class="d-flex justify-content-start mb-3 button-group">
        <button class="btn btn-outline-secondary me-2 active" style="box-shadow: none;" onclick="window.location='index.php'">Alumnite</button>
    </div>

    <h2 class="fs-4 mb-2 pt-2 px-3" style="color:#752738; margin-top:20px;">Feature Alumni Table</h2>
      <div class="table-responsive">
      <div class="col-lg-12 d-flex align-items-stretch" class="card w-100" style="border-radius:10px">
      <div class="card w-100" style="border-radius:10px;padding:10px">
        <table class="table vm no-th-brd pro-of-month" style="border-radius:10px" id="example">
          <thead style="background:#8E8B82;color:#FFF;border-radius:10px">
            <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Position</th>
            <th>Company</th>
            <th>Course</th>
            <th>Year Graduated</th>
            <th><center>Action</th> 
            </tr>
          </thead>
          <tbody>
          <?php
									include('../../connect.php');
									$result = $conn->query("SELECT * FROM profile1");
										while($row = $result->fetch_assoc()) {
                    $feature_id = $row['id'];
										$username = $row['username'];
										$profile = $row['image'];
											  echo '<tr>';
                        echo '  <td valign="top" style="width:10%"><img src="'.$profile.'" style="width:100px;height:100px"></td>';
                        echo '  <td valign="top" >'.$row['name'].'</td>';
                        echo '  <td valign="top" >'.$row['position'].'</td>';
                        echo '  <td valign="top" >'.$row['company'].'</td>';
                        echo '  <td valign="top" >'.$row['course'].'</td>';
                        echo '  <td valign="top" >'.$row['year'].'</td>';
											 echo '  <td width="20%"><center><a href="approve_feature.php?id='.$row['id'].'" class="btn btn-secondary">Approve</a> <a href="update_feature.php?id='.$row['id'].'" class="btn btn-primary">Update</a> <a href="delete_feature.php?id='.$row['id'].'" onclick="return confirm(\'Are you sure you want to delete this record?\')" class="btn btn-danger">Delete</a></td>';
                                            echo '</tr>';
										  }
									$conn->close();
									?>
            </tr>
            <!-- Add more rows as necessary -->
          </tbody>
        </table>
      </div>
      </div>
      </div>
    </div>

  </div> <!-- End of page-content-wrapper -->


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function () {
      el.classList.toggle("toggled");
    };
  </script>

  <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
      <script type="text/javascript" src="https://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.1/js/jquery.dataTables.min.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/1.0.0/css/dataTables.responsive.css">
      <script type="text/javascript" src="https://cdn.datatables.net/responsive/1.0.0/js/dataTables.responsive.js"></script>
	  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script>
			$(document).ready(function() {
			$('#example').DataTable( {
			responsive: true
			} );
			} );
			</script>
</body>

</html>
