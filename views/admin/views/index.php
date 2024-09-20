<?php
include('../../auth.php');
include('../../connect.php');
$username = $_SESSION['username'];
$sql1 = "SELECT * FROM login WHERE username = '$username'";
$result1 = $conn->query($sql1);
while($row1 = $result1->fetch_assoc()) {
	$type = $row1['type'];
	if($type != 'admin') {
		echo '<script>window.location="../logout.php";</script>';
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Alumnite</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../css/admin.css" />
   <!-- Facebox -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/facebox/1.3.8/facebox.min.css" media="screen" rel="stylesheet" type="text/css"/>

</head>

<body>
  
  <?php include_once('./sidebar/sidebar.php'); ?>

  <div id="page-content-wrapper">

    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4 border-bottom" id="top-bar">
      <div class="d-flex align-items-center justify-content-between w-100">
        <div class="d-flex align-items-center">
          <i class="fa fa-bars primary-text fs-4 me-3" id="menu-toggle"  aria-hidden="true"></i>
          <h2 class="fs-4 m-0" style="color:#752738">Dashboard</h2>
        </div>
        <li class="d-flex align-items-center">
          <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="../images/admin-logo.jpg" alt="Admin Avatar" class="rounded-circle me-2" style="width: 40px; height: 40px;">
          <span class="fs-6 admin-text">Administrator &nbsp;</span></a>
        </li>
      </div>
    </nav>

    <?php
				include('../../connect.php');
					$result1 = $conn->query("SELECT * FROM login WHERE status = 'Approved' AND type = 'alumni'");
					$count1 = $result1->num_rows;
					$result2 = $conn->query("SELECT * FROM program");
					$count2 = $result2->num_rows;
					$result3 = $conn->query("SELECT * FROM login WHERE type = 'alumni' AND status = 'Approved'");
					$count3 = $result3->num_rows;
					$result4 = $conn->query("SELECT * FROM gts WHERE q2 = 'Yes'");
					$count4 = $result4->num_rows;
					$result5 = $conn->query("SELECT * FROM profile1 WHERE status = 'Approved'");
					$count5 = $result5->num_rows;
				?>

    <!-- Dashboard Cards -->
    <div class="container-fluid px-4 mt-4">
      <div class="row">
        <!-- Registered Alumni Card -->
        <div class="col-md-3 mb-4">
          <div class="card text-secondary bg-light shadow h-100 py-2">
            <div class="card-body">
              <div class="text-center">
                <h6 class="card-title">Number of Registered Alumni</h6>
                <p class="card-text fs-2"><?php echo $count1 ?></p>
              </div>
            </div>
          </div>
        </div>

        <!-- Employed Alumni Card -->
        <div class="col-md-3 mb-4">
          <div class="card text-secondary bg-light shadow h-100 py-2">
            <div class="card-body">
              <div class="text-center">
                <h6 class="card-title">Employed Alumni</h6>
                <p class="card-text fs-2"><?php echo $count4 ?></p>
              </div>
            </div>
          </div>
        </div>

        <!-- Donation Tracking Card -->
        <div class="col-md-3 mb-4">
          <div class="card text-secondary bg-light shadow h-100 py-2">
            <div class="card-body">
              <div class="text-center">
                <h6 class="card-title">Donation Tracking</h6>
                <p class="card-text fs-2"><?php echo $count2 ?></p>
              </div>
            </div>
          </div>
        </div>

        <!-- Featured Alumni Card -->
        <div class="col-md-3 mb-4">
          <div class="card text-secondary bg-light shadow h-100 py-2">
            <div class="card-body">
              <div class="text-center">
                <h6 class="card-title">Featured Alumni</h6>
                <p class="card-text fs-2"><?php echo $count5 ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <!-- Events Hosted Card -->
        <div class="col-md-3 mb-4">
          <div class="card text-secondary bg-light shadow h-100 py-2">
            <div class="card-body">
              <div class="text-center">
                <h6 class="card-title">Number of Events Available</h6>
                <p class="card-text fs-2">15</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Yearbook Delivery Approval Card -->
        <div class="col-md-3 mb-4">
          <div class="card text-secondary bg-light shadow h-100 py-2">
            <div class="card-body">
              <div class="text-center">
                <h6 class="card-title">Number of Yearbook Delivery Approval</h6>
                <p class="card-text fs-2">100</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Alumni Card Approval Card -->
        <div class="col-md-3 mb-4">
          <div class="card text-secondary bg-light shadow h-100 py-2">
            <div class="card-body">
              <div class="text-center">
                <h6 class="card-title">Number of Alumni Card Approval</h6>
                <p class="card-text fs-2">8</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Top Visitors Card -->
        <div class="col-md-3 mb-4">
          <div class="card text-secondary bg-light shadow h-100 py-2">
            <div class="card-body">
              <div class="text-center">
                <h6 class="card-title">Number of Top Visitors</h6>
                <p class="card-text fs-2">450</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>  
    <!-- Dashboard Cards End -->
  
    
    <?php
				include('../../connect.php');
					$result1aa = $conn->query("SELECT * FROM login WHERE status = 'Pending'");
					$count1aa = $result1aa->num_rows;
				?>

    <h2 class="fs-4 my-5 b-0 pt-4 px-3" style="color:#752738">Record Table</h2>

    <!-- Add the Record Table Below -->
    <div class="container-fluid mt-3">
    <div class="d-flex justify-content-start mb-3 button-group">
        <button class="btn btn-outline-secondary me-2 active" style="box-shadow: none;" onclick="window.location='index.php'">Alumnite</button>
        <button class="btn btn-outline-secondary me-2" style="box-shadow: none;">GTS Reports</button>
        <button class="btn btn-outline-secondary me-2" style="box-shadow: none;">Initiative Program</button>
        <button class="btn btn-outline-secondary me-2" style="box-shadow: none;" onclick="window.location='approval.php'">For Approval [<?php echo $count1aa ?>] </button>
        <select name="department" id="username" required id="department" class="form-select form-select-lg" onchange="go(this.value)" style="width: 100%; max-width: 400px; font-size:1rem; outline=none;">
        <option value="" disabled selected>Select Department</option>
              <option>Senior High School</option>
							<option>College of Allied Medical Sciences</option>
<option>College of Arts and Sciences</option>
<option>College of Business, Accountancy, and Hospitality Management</option>
<option>College of Criminal Justice Education</option>
<option>College of Education</option>
<option>College of Engineering</option>
<option>College of Information and Communications Technology</option>
<option>College of Nursing and Midwifery</option>
<option>College of Technical Education</option>
						</select>
      </div>
      <script>
							function go(val) {
								window.location='view_students.php?dept='+val;
							}
						</script>

      <div class="table-responsive">
      <div class="col-lg-12 d-flex align-items-stretch" class="card w-100" style="border-radius:10px">
      <div class="card w-100" style="border-radius:10px;padding:10px">
        <table class="table vm no-th-brd pro-of-month" style="border-radius:10px" id="example">
          <thead style="background:#8E8B82;color:#FFF;border-radius:10px">
            <tr>
              <th>Register ID</th>
              <th>Date Registered</th>
              <th>Name</th>
              <th>Batch Year</th>
              <th>Proof</th>
              <th>Course</th>
            </tr>
          </thead>
          <tbody>
          <?php
									include('../../connect.php');
									$sql = "SELECT * FROM login WHERE status = 'Approved' AND type = 'alumni'";
									$result = $conn->query($sql);
										while($row = $result->fetch_assoc()) {
										$username =$row['username'];
									$sql1 = "SELECT * FROM alumni WHERE username = '$username'";
									$result1 = $conn->query($sql1);
									while($row1 = $result1->fetch_assoc()) {
										$id =$row1['id'];
										$ub_id  = sprintf("%04d", $id);
										$fname =$row1['fname'];
										$lname =$row1['lname'];
										$year =$row1['year'];
										$department =$row1['department'];
										$course =$row1['course'];
										$file =$row1['file'];
										$date =$row1['date'];
									}
                  $date = date('F d, Y',strtotime($date));
                  echo '<tr>';
              echo '<td>'.$ub_id.'</td>';
              echo '<td>'.$date.'</td>';
              echo '<td>'.$fname.' '.$lname.'</td>';
              echo '<td>'.$year.'</td>';
              echo '  <td><a href="view_file.php?id='.$id.'" rel="facebox" target="_blank" class="bg-transparent">View File</a></td>';
              echo '  <td>'.$course.'</td>';
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function () {
      el.classList.toggle("toggled");
    };
  </script>
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/facebox/1.3.8/facebox.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/facebox/1.3.8/facebox.min.js"></script>

  
  <script type="text/javascript">
    $(document).ready(function($) {
      $('a[rel=facebox]').facebox();
    });
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
