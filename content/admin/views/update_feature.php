<?php include_once('./client/client.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Alumnite</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="../css/feature_alumni.css"/>
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
        <h3 class="text-themecolor" style="font-size: 1.5em; color:#752738 !important; margin-bottom: 5px;">Update Feature Alumni</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)" style="color:#000 !important;">Home</a></li>
            <li class="breadcrumb-item active">Update Feature Alumni</li>
        </ol>
    </div>
</div>

    <?php
				if(isset($_POST['submit'])) {
										include('../../connect.php');
	$name = mysqli_real_escape_string($conn,$_POST['name']);
					$position = mysqli_real_escape_string($conn,$_POST['position']);
					$company = mysqli_real_escape_string($conn,$_POST['company']);
					$course = mysqli_real_escape_string($conn,$_POST['course']);
					$year = mysqli_real_escape_string($conn,$_POST['year']);
					$a1 = mysqli_real_escape_string($conn,$_POST['a1']);
					$a2 = mysqli_real_escape_string($conn,$_POST['a2']);
					$a3 = mysqli_real_escape_string($conn,$_POST['a3']);
					$a4 = mysqli_real_escape_string($conn,$_POST['a4']);
					$image = $_POST['image'];
					$username = $_POST['username'];
					mysqli_query($conn,"DELETE FROM profile1 WHERE username = '$username'");
		mysqli_query($conn, "INSERT INTO profile1 (name,position,company,course,year,a1,a2,a3,a4,username,image)VALUES ('$name','$position','$company','$course','$year','$a1','$a2','$a3','$a4','$username','$image')");
					date_default_timezone_set('Asia/Manila');
					$message = 'Alumni updated profile';
					$date = date('F d, Y h:i A');
				$save = $conn->query("INSERT INTO audit (username,action, timestamp)VALUES ('$username','$message','$date')");
		echo '<script>alert("Featured Alumni has been updated");window.location="feature_alumni.php"</script>';
	
				}
				include('../../connect.php');
				$id = $_GET['id'];
									$result = mysqli_query($conn,"SELECT * FROM profile1 WHERE id = '$id'");
				$count = mysqli_num_rows($result);
				if($count>0) {
					while($row = mysqli_fetch_array($result)) {
						$username = $row['username'];
					$name = $row['name'];
					$position = $row['position'];
					$company = $row['company'];
					$course = $row['course'];
					$year = $row['year'];
					$a1 = $row['a1'];
					$a2 = $row['a2'];
					$a3 = $row['a3'];
					$a4 = $row['a4'];
					}
				} else {
					
					$name = "";
					$position = "";
					$company = "";
					$course =  "";
					$year =  "";
					$a1 =  "";
					$a2 =  "";
					$a3 =  "";
					$a4 =  "";
					
				}
				?>
    
    <!-- start here -->
     <div class="row px-5">
    <form action="" method="POST">
    <input type="hidden" name="username" value="<?php echo $username ?>">
      <div class="row">
        <div class="col-md-6 mb-3 text-start">
          <label for="name" class="form-label">Name:</label>
          <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
        </div>
        <div class="col-md-6 mb-3 text-start">
          <label for="position" class="form-label">Position:</label>
          <input type="text" class="form-control" id="position" name="position" value="<?php echo $position; ?>" required>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3 text-start">
          <label for="company" class="form-label">Company:</label>
          <input type="text" class="form-control" id="company" name="company" value="<?php echo $company; ?>" required>
        </div>
        <div class="col-md-6 mb-3 text-start">
          <label for="course" class="form-label">Course:</label>
          <input type="text" class="form-control" id="course" name="course" value="<?php echo $course; ?>" required>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3 text-start">
          <label for="year_graduated" class="form-label">Year Graduated:</label>
          <input type="text" class="form-control" id="year" name="year" value="<?php echo $year ?>" required>
        </div>
      </div>

      <div class="row">
        <div class="col-12 mb-3 text-start">
          <label for="question1" class="form-label">1. How did you come by choosing University of Batangas?</label>
          <textarea class="form-control" id="question1" name="a1" rows="3" required><?php echo $a1 ?></textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-12 mb-3 text-start">
          <label for="question2" class="form-label">2. What do you think is the greatest contribution UB has imparted to your holistic growth?</label>
          <textarea class="form-control" id="question2" name="a2" rows="3" required><?php echo $a2 ?></textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-12 mb-3 text-start">
          <label for="question3" class="form-label">3. How did your overall experience in UB take part in your self-formation as you strive through the path of your profession?</label>
          <textarea class="form-control" id="question3" name="a3" rows="3" required><?php echo $a3 ?></textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-12 mb-3 text-start">
          <label for="question4" class="form-label">4. After reaching numerous milestones in your career, what piece of advice can you give to the students who are aspiring to be successful in the path they choose?</label>
          <textarea class="form-control" id="question4" name="a4" rows="3" required><?php echo $a4 ?></textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-12 mb-3 text-start">
          <label for="file" class="form-label">Attach Picture for Featured Alumni:</label>
          <input type="file" name="upload" id="upload"  required accept="image/png, image/gif, image/jpeg" class="form-control"><br>
          <textarea id="file" name="image" style="display:none"></textarea>
        </div>
      </div>

      <div class="d-flex justify-content-start">
        <button type="submit" name="submit" class="btn btn-warning me-2">Save</button>
        <button type="button" class="btn btn-secondary" onclick="window.location='index.php';">Cancel</button>
      </div>
    </form>
    </div>


    <h2 class="fs-4 mb-2 pt-2 px-3" style="color:#752738; margin-top:20px;">Update  Feature Alumni Table</h2>
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
										$username = $row['username'];
										$profile = $row['image'];
											  echo '<tr>';
                        echo '  <td valign="top" style="width:10%"><img src="'.$profile.'" style="width:100px;height:100px"></td>';
                        echo '  <td valign="top" >'.$row['name'].'</td>';
                        echo '  <td valign="top" >'.$row['position'].'</td>';
                        echo '  <td valign="top" >'.$row['company'].'</td>';
                        echo '  <td valign="top" >'.$row['course'].'</td>';
                        echo '  <td valign="top" >'.$row['year'].'</td>';
                        echo '  <td width="20%"><center><a href="update_feature.php?id='.$row['id'].'" class="btn btn-primary">Update</a> <a href="delete_feature.php?id='.$row['id'].'" onclick="return confirm(\'Are you sure you want to delete this record?\')" class="btn btn-danger">Delete</a></td>';
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

<script>
    

    const fileInput = document.getElementById('upload');
    fileInput.addEventListener('change', (e) => {
    // get a reference to the file
    const file = e.target.files[0];
    
    // encode the file using the FileReader API
    const reader = new FileReader();
    reader.onloadend = () => {
    
        // use a regex to remove data url part
        const base64String = reader.result;
            document.getElementById('file').value =reader.result; 
            document.getElementById('img1').src=reader.result; 
        console.log(base64String);
    };
    reader.readAsDataURL(file);});
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
