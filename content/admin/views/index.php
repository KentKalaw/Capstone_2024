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
</head>

<body>
<?php include_once('./loader/loader.php'); ?>
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

   <?php include_once('./dashboardcard.php'); ?>
    <!-- Dashboard Cards End -->
  
    <!-- Admin's announcement post here -->
<?php
		if(isset($_POST['post'])) {
			$post = $_POST['post'];
			date_default_timezone_set('Asia/Manila');
			$date = date('Y-m-d H:i:s');
			$username = $_SESSION['username'];
			$a = $conn->query("INSERT INTO post (post,date,username) VALUES ('$post','$date','$username')");
			
					date_default_timezone_set('Asia/Manila');
					$message = 'Admin posted a post';
					$date = date('F d, Y h:i A');
				$save = $conn->query("INSERT INTO audit (username,action, timestamp)VALUES ('$username','$message','$date')");
        echo '<script>alert("Announcement has been posted."); window.location="index.php";</script>';

		}
		?>

<h2 class="fs-4 my-5 b-0 pt-4 px-3" style="color:#752738">Announcements</h2>

<div class="container-fluid px-3">
  <form action="#" method="POST" class="row g-3">
    <div class="col-12">
      <label for="post" class="form-label">Enter announcement here:</label>
      <textarea class="form-control" id="post" name="post" rows="3" required></textarea>
    </div>
    <div class="col-md-1">
      <button type="submit" class="btn btn-primary w-100 mb-4">Post</button>
    </div>
  </form>
</div>

<!-- Announcement cards -->

<div class="row justify-content-center"> 
    <div class="col-lg-11 col-md-10">
        <?php
        // Fetch pinned posts first
        $result = mysqli_query($conn, "SELECT * FROM post WHERE pin = '1' ORDER BY ID DESC");
        $hasPosts = false; // Initialize a flag to track if there are any posts

        while ($row = mysqli_fetch_array($result)) {
            $hasPosts = true; // If we have at least one post, set the flag to true
            $postId = $row['id']; // Unique post ID
            $username = $row['username'];
            $post = $row['post'];
            $date = date('F d, Y h:i A', strtotime($row['date']));

            // Fetch user profile data
            $result1 = mysqli_query($conn, "SELECT * FROM alumni WHERE username = '$username'");
            $row1 = mysqli_fetch_array($result1);
            $profile = $row1['profile'] ?: '../images/ub-logo.png'; // default profile image
            $name = $row1['fname'] . ' ' . $row1['lname'];

            // Announcement card for pinned post
            echo '<div class="card mb-4 shadow-sm border-warning position-relative">';
            echo '<div class="card-body">';
            echo '<div class="d-flex align-items-center">';

            // Profile image and user details
            echo '<img src="' . $profile . '" class="rounded-circle me-3" style="width: 60px; height: 60px;">';
            echo '<div>';
            echo '<h5 class="card-title mb-1">' . $name . '</h5>';
            echo '<p class="card-text mb-2">' . $post . '</p>';
            echo '<small class="text-muted">' . $date . '</small>';
            echo '</div>';

            // Trashcan icon for delete (top-right corner)
            echo '<div class="position-absolute" style="top: 10px; right: 10px;">';
            echo '<a href="delete_post.php?id=' . $postId . '" onclick="return confirm(\'Are you sure you want to delete this post?\')" class="text-danger">';
            echo '<i class="fas fa-trash-alt"></i>';
            echo '</a>';
            echo '</div>'; // End of trashcan icon

            echo '</div>'; // End of d-flex alignment
            echo '</div>'; // End of card body
            echo '</div>'; // End of card
        }

        // Fetch other posts (non-pinned)
        $result = mysqli_query($conn, "SELECT * FROM post WHERE pin <> '1' ORDER BY ID DESC");
        while ($row = mysqli_fetch_array($result)) {
            $hasPosts = true; // At least one post found
            $postId = $row['id']; // Unique post ID
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
            echo '<div class="card mb-2 shadow-sm border-light position-relative">';
            echo '<div class="card-body">';
            echo '<div class="d-flex align-items-center">';

            // Profile image and user details
            echo '<img src="' . $profile . '" class="rounded-circle me-3" style="width: 60px; height: 60px;">';
            echo '<div>';
            echo '<h5 class="card-title mb-1">' . $name . '</h5>';
            echo '<p class="card-text mb-2">' . $post . '</p>';
            echo '<small class="text-muted">' . $date . '</small>';
            echo '</div>';

            // Trashcan icon for delete (top-right corner)
            echo '<div class="position-absolute" style="top: 10px; right: 10px;">';
            echo '<a href="del_post.php?id='.$row['id'].'" onclick="return confirm(\'Are you sure you want to delete this post?\')" class="text-danger">';
            echo '<i class="fas fa-trash-alt"></i>';
            echo '</a>';
            echo '</div>'; // End of trashcan icon

            echo '</div>'; // End of d-flex alignment
            echo '</div>'; // End of card body
            echo '</div>'; // End of card
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


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function () {
      el.classList.toggle("toggled");
    };
  </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/facebox/1.3.8/facebox.min.js"></script>
<script>
    $(document).ready(function() {
        $('a[rel*=facebox]').facebox();
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
