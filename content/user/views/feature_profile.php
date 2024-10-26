<?php include_once('./backend/client.php'); ?>

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
  <link rel="stylesheet" type="text/css" href="../css/feature_profile.css"/>
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
            <img src="<?php echo $file ?>" alt="Admin Avatar" class="rounded-circle me-2" style="width: 40px; height: 40px;">
            <span class="fs-6 alumni-text"><?php echo $fname . ' ' . $lname ?> &nbsp;</span>
          </a>
        </li>
      </div>
    </nav>

    <div class="d-flex px-3 py-3 align-items-center" style="margin-bottom: 20px;">
    <img src="<?php echo $file ?>" style="width:90px; height:75px; border-radius:50%; margin-right: 15px;">
    <div class="col-md-5">
        <h3 class="text-themecolor" style="font-size: 1.5em; color:#752738 !important; margin-bottom: 5px;">Feature Alumni Form</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)" style="color:#000 !important;">Home</a></li>
            <li class="breadcrumb-item active">Feature Alumni Form</li>
        </ol>
    </div>
</div>

            <?php
				if(isset($_POST['submit'])) {
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
					$message = 'Alumni submitted a feature alumni';
					$date = date('F d, Y h:i A');
				$save = $conn->query("INSERT INTO audit (username,action, timestamp)VALUES ('$username','$message','$date')");
		echo '<script>alert("Alumni has submitted a feature alumni.");window.location="profile.php";</script>';
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
                
                
                <form action="#" method="POST">
                <div class="profile-header text-center mx-2">
                    <img src="../../assets/img/favicon/logo.png" id="img1" class="profile-picture">
                    <div class="file-upload mb-3">
                        <input type="file" name="upload" id="upload" accept="image/png, image/gif, image/jpeg" style="display: none">
                        <label for="upload" class="mb-0">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p class="mb-0">Click to upload your featured photo</p>
                            <span class="text-muted small">PNG, JPG or GIF files are allowed</span>
                        </label>
                        <textarea id="file" name="image" style="display:none"></textarea>
                    </div>
                </div>

                <div class="form-container mx-2">
                    <h5 class="section-title">Personal Information</h5>
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Position</label>
                            <input type="text" class="form-control" name="position" value="<?php echo $position; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Company</label>
                            <input type="text" class="form-control" name="company" value="<?php echo $company; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Course</label>
                            <input type="text" class="form-control" name="course" value="<?php echo $course; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Year Graduated</label>
                            <input type="text" class="form-control" name="year" value="<?php echo $year ?>" required>
                        </div>
                    </div>

                    <h5 class="section-title mt-5">Alumni Questions</h5>
                    <div class="question-card">
                        <label class="question-label">1. How did you come by choosing University of Batangas?</label>
                        <textarea class="form-control" name="a1" required><?php echo $a1 ?></textarea>
                    </div>

                    <div class="question-card">
                        <label class="question-label">2. What do you think is the greatest contribution UB has imparted to your holistic growth?</label>
                        <textarea class="form-control" name="a2" required><?php echo $a2 ?></textarea>
                    </div>

                    <div class="question-card">
                        <label class="question-label">3. How did your overall experience in UB take part in your self-formation as you strive through the path of your profession?</label>
                        <textarea class="form-control" name="a3" required><?php echo $a3 ?></textarea>
                    </div>

                    <div class="question-card">
                        <label class="question-label">4. After reaching numerous milestones in your career, what piece of advice can you give to the students who are aspiring to be successful in the path they choose?</label>
                        <textarea class="form-control" name="a4" required><?php echo $a4 ?></textarea>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn btn-secondary me-2" onclick="window.location='index.php';">Cancel</button>
                        <button type="submit" name="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Submit Feature Form
                        </button>
                    </div>
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
