<?php include_once('./backend/client.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alumni - Alumnite</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
  <link rel="icon" type="image/png" sizes="512x512" href="../../assets/img/favicon/logo.png">
  <link rel="stylesheet" type="text/css" href="../css/yearbook.css" />
</head>

<body>
  <?php include_once('./loader/loader.php'); ?>
  <?php include_once('./sidebar/sidebar.php'); ?>
  <?php include_once('./backend/campus_tour_sql.php'); ?>
 

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
        <h3 class="text-themecolor" style="font-size: 1.5em; color:#752738 !important; margin-bottom: 5px;">Campus Tour Request</h3>
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="javascript:void(0)" style="color:#000 !important;">Home</a></li>
          <li class="breadcrumb-item active">Campus Tour Request</li>
        </ol>
      </div>
    </div>

    <div class="container mt-5">
      <div class="container py-4">
        <div class="row align-items-center">
          <div class="col-md-8">
            <h1 class="primary-text mb-3">Request a Campus Tour</h1>
            <p class="text-muted">Revisit your alma mater and relive your college memories. Request a campus tour today!</p>
          </div>
          <div class="col-md-4 text-end">
            <button type="button" class="btn btn-warning action-button me-2" data-bs-toggle="modal" data-bs-target="#infoModal">
              <i class="fas fa-info-circle me-2"></i>Tour Info
            </button>
            <button type="button" class="btn btn-dark action-button" data-bs-toggle="modal" data-bs-target="#tourModal">
              <i class="fas fa-map-marked-alt me-2"></i>Request Tour
            </button>
          </div>
        </div>
      </div>
      <hr class="mb-4">
      
      <div class="container my-5">
  <h2 class="text-center mb-4">Highlights of Our Campus Tour</h2>
  <div class="row">
    <div class="col-md-4 mb-3">
      <div class="card h-100">
        <img src="../images/UB-ML.webp" class="card-img-top img-fluid" alt="Historic Buildings">
        <div class="card-body">
          <h5 class="card-title">University of Batangas Millenium Campus</h5>
          <p class="card-text">Explore the architectural marvels that have shaped our campus for generations.</p>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card h-100">
        <img src="https://ub.edu.ph/ublc/wp-content/uploads/2023/08/UBBC-scaled.jpg" class="card-img-top img-fluid" alt="State-of-the-Art Facilities">
        <div class="card-body">
          <h5 class="card-title">University of Batangas Main Campus</h5>
          <p class="card-text">Discover our cutting-edge laboratories and modern learning spaces.</p>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card h-100">
        <img src="https://ub.edu.ph/ublc/wp-content/uploads/2023/08/UB-GRADE-SCHOOL-scaled.jpg" class="card-img-top img-fluid" alt="Campus Life">
        <div class="card-body">
          <h5 class="card-title">University of Batangas Grade School Campus</h5>
          <p class="card-text">Revisit the vibrant spaces where students gather, study, and create memories.</p>
        </div>
      </div>
    </div>
  </div>
</div>


      <hr class="mb-4">
  
  <!-- Campus Tour Request Status Card -->
  <div class="container mb-5">
  <div class="status-card card border-0">
    <div class="card-header text-white text-center py-3" style="background-color: #6B1500">
      <h4 class="mb-0">Your Campus Tour Request Status</h4>
    </div>
    <div class="card-body p-4">
      <div class="row">
        <div class="col-md-6">
          <h6 class="text-muted mb-3">Alumni Details</h6>
          <p><strong>Student Number:</strong> <span id="student-number"><?php echo htmlspecialchars($student_number); ?></span></p>
          <p><strong>Full Name:</strong> <span id="full-name"><?php echo htmlspecialchars($fullname); ?></span></p>
          <p><strong>Email:</strong> <span id="email"><?php echo htmlspecialchars($email); ?></span></p>
        </div>
        <div class="col-md-6">
          <h6 class="text-muted mb-3">Request Information</h6>
          <p><strong>Request Status:</strong> 
            <span class="badge rounded-pill <?php 
              if ($status === 'Pending') {
                echo 'bg-warning text-dark';
              } elseif ($status === 'Approved') {
                echo 'bg-success';
              } else {
                echo 'bg-danger';
              }
            ?>">
              <?php echo htmlspecialchars($status); ?>
            </span>
          </p>
          <p><strong>Date Range:</strong> <span><?php echo htmlspecialchars($fromDate).' '.'-'.' '.htmlspecialchars($toDate); ?></span></p>
          <p><strong>Approved Date for Tour:</strong> <span id="approved-date"><?php echo htmlspecialchars($approved_date); ?></span></p>
            <?php if ($status === 'Approved' && ($approved_date === 'N/A')): ?>
                <div class="alert alert-info mt-3">
                    <i class="fas fa-info-circle me-2"></i>Your request has been approved. The admin will give you the approved date soon..
                </div>
            <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

      <div class="container mb-5">
        <h4 class="primary-text mb-4">How to Request a Campus Tour</h4>
        <div class="steps-container">
          <div class="step-item">
            <h5><i class="fas fa-user-graduate me-2 text-success"></i>Verify Your Alumni Status</h5>
            <p class="text-muted mb-0">Ensure you're a registered alumnus of our institution.</p>
          </div>
          <div class="step-item">
            <h5><i class="fas fa-paper-plane me-2 text-info"></i>Submit Your Request</h5>
            <p class="text-muted mb-0">Fill out the request form with your details and tour preferences.</p>
          </div>
          <div class="step-item">
            <h5><i class="fas fa-clock me-2 text-warning"></i>Await Approval</h5>
            <p class="text-muted mb-0">Our admin team will review your request and get back to you with confirmation.</p>
          </div>
          <div class="step-item">
            <h5><i class="fas fa-calendar-alt me-2 text-primary"></i>Wait for your approved date.</h5>
            <p class="text-muted mb-0">A date will be selected that is best for you and your group.</p>
          </div>
        </div>
      </div>

    <!-- Location Guide Modal -->
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="infoModalLabel">Campus Tour Information</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <h6>What to Expect:</h6>
              <ul>
                <li>Guided tour of the campus, including notable buildings and landmarks</li>
                <li>Visit to your former department and classrooms</li>
                <li>Information about recent developments and future plans for the university</li>
                <li>Opportunity to meet with current students and faculty members</li>
              </ul>
              <br>
              <h6>Tour Duration:</h6>
              <p>Approximately 2 hours</p>
              <br>
              <h6>Available Days:</h6>
              <p>Monday to Friday, 9:00 AM to 3:00 PM</p>
              <br>
              <h6>Group Size:</h6>
              <p>We can accommodate groups of up to 20 people. For larger groups, please contact us directly.</p>
              <br>
              <h6>Special Accommodations:</h6>
              <p>If you require any special accommodations, please mention them in the "Special Requests" field when submitting your request.</p>
              <br>
            </div>
          </div>
        </div>
      </div>

      <?php $requestDate = date('F j, Y g:i A'); ?>

      <div class="modal fade" id="tourModal" tabindex="-1" aria-labelledby="tourModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="tourModalLabel">Campus Tour Request Form</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="tourForm" action="submit_tour_request.php" method="POST">
                <input type="hidden" name="alumni_id" value="<?php echo isset($alumni_id) ? $alumni_id : ''; ?>">
                
                <div class="mb-3">
                  <label for="student_number" class="form-label">Student Number</label>
                  <input type="text" class="form-control" id="student_number" name="student_number" required autocomplete="off">
                </div>
                
                <div class="mb-3">
                  <label for="fullname" class="form-label">Full Name</label>
                  <input type="text" class="form-control" id="fullname" name="fullname" required autocomplete="off">
                </div>
                
                <div class="mb-3">
                  <label for="email" class="form-label">Email Address</label>
                  <input type="email" class="form-control" id="email" name="email" required autocomplete="off">
                </div>
                
                <div class="mb-3">
                  <label for="number" class="form-label">Phone Number (use +63)</label>
                  <input type="text" id="number" name="number" class="form-control"
                         pattern="^\+63[0-9]{10}$" 
                         placeholder="+63XXXXXXXXXX"
                         maxlength="13" 
                         required autocomplete="off">
                </div>

                <div class="mb-3">
                  <label for="fromDate" class="form-label">From</label>
                  <input type="datetime-local" class="form-control" id="fromDate" name="fromDate" min="<?php echo $requestDate ?>" onchange="ac()" autocomplete="off">
                </div>

                <div class="mb-3">
                  <label for="toDate" class="form-label">To</label>
                  <input type="datetime-local" class="form-control" id="toDate" name="toDate" min="<?php echo $requestDate ?>" autocomplete="off">
                </div>

                <script>
						    function ac() {
						        var start_date = document.getElementById('fromDate').value;
						        document.getElementById('toDate').min = start_date;
						      }
						    </script>
                
                <div class="mb-3">
                  <label for="special_requests" class="form-label">Special Requests or Comments</label>
                  <textarea class="form-control" id="special_requests" name="special_request" rows="3"></textarea>
                </div>
                
                <div class="modal-footer justify-content-center">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Submit Request</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  
 


    <script>
      document.addEventListener("DOMContentLoaded", function() {
        var myModal = new bootstrap.Modal(document.getElementById('myModal'));
        myModal.show();
      });
    </script>

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
