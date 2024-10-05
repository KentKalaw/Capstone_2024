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
    $birthday = $row1['birthday'];
    $occupation = $row1['occupation'];
    $company = $row1['company'];
    $city = $row1['city'];
    $region = $row1['region'];
    $program = $row1['program'];
    $file = $row1['profile'];
    if ($file == '') {
        $file = '../img/logo.png';
    }
}

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

  <link rel="stylesheet" href="../css/feature_profile.css" />
</head>

<body>

    <?php include_once('./loader/loader.php'); ?>
  
  <?php include_once('./sidebar/sidebar.php'); ?>

  <div id="page-content-wrapper">
    

    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4 border-bottom" id="top-bar">
      <div class="d-flex align-items-center justify-content-between w-100">
        <div class="d-flex align-items-center">
          <i class="fa fa-bars primary-text fs-4 me-3" id="menu-toggle" aria-hidden="true"></i>
          <h2 class="fs-4 m-0" style="color:#752738">Featured Alumni Form</h2>
        </div>
        <li class="d-flex align-items-center">
          <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="<?php echo $file ?>" alt="Admin Avatar" class="rounded-circle me-2" style="width: 40px; height: 40px;">
            <span class="fs-6 alumni-text"><?php echo $fname . ' ' . $lname ?> &nbsp;</span>
          </a>
        </li>
      </div>
    </nav>

    <ol class="breadcrumb col-md-6 d-flex align-items-center" style="margin-left: 25px; margin-top:20px;">
    <li class="breadcrumb-item" style="color:black;">
        <a href="javascript:void(0)">Home</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        Featured Alumni Form
    </li>
</ol>

    <div class="container-fluid p-4 text-center">
            <img src="<?php echo $file ?>" id="img1" class="rounded-circle mb-3" style="width: 150px; height: 150px;">
            <div>
                <form action="#" method="POST">
            </div>

            <?php
				if(isset($_POST['submit'])) {
					include('../connect.php');
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
					$username = $_SESSION['username'];
					mysqli_query($conn,"DELETE FROM profile1 WHERE username = '$username'");
		mysqli_query($conn, "INSERT INTO profile1 (name,position,company,course,year,a1,a2,a3,a4,username,image)VALUES ('$name','$position','$company','$course','$year','$a1','$a2','$a3','$a4','$username','$image')");
					date_default_timezone_set('Asia/Manila');
					$message = 'Alumni updated profile';
					$date = date('F d, Y h:i A');
				$save = $conn->query("INSERT INTO audit (username,action, timestamp)VALUES ('$username','$message','$date')");
		echo '<script>alert("Profile has been updated");window.location="profile.php";</script>';
				}
				
				
					$username = $_SESSION['username'];
				$result = mysqli_query($conn,"SELECT * FROM profile1 WHERE username = '$username'");
				$count = mysqli_num_rows($result);
				if($count>0) {
					while($row = mysqli_fetch_array($result)) {
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
        <input type="file" name="upload" id="upload"  accept="image/png, image/gif, image/jpeg" required class="form-control"><br>
        <textarea id="file" name="image" style="display:none"></textarea>
    </div>
</div>

<div class="d-flex justify-content-end">
    <button type="submit" name="submit" class="btn btn-primary me-2">Save</button>
    <button type="button" class="btn btn-secondary" onclick="window.location='index.php';">Cancel</button>
</div>
               
            </form>
        </div>
    </div>
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
