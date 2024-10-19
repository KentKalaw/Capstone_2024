<?php include_once('./backend/client.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alumni - Alumnite</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
  <link rel="stylesheet" type="text/css" href="../css/alumni.css" />
</head>

<body>
  <?php include_once('./loader/loader.php'); ?>
  <?php include_once('./sidebar/sidebar.php'); ?>
  <?php include_once('./backend/yearbook_sql.php'); ?>
 

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
        <h3 class="text-themecolor" style="font-size: 1.5em; color:#752738 !important; margin-bottom: 5px;">Yearbook Delivery</h3>
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="javascript:void(0)" style="color:#000 !important;">Home</a></li>
          <li class="breadcrumb-item active">Yearbook Delivery</li>
        </ol>
      </div>
    </div>

    <div class="container mt-5">
    <!-- Centered Button to open the modal -->
    <div class="d-flex justify-content-center">
  <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#infoModal">
      <i class="fas fa-info-circle me-2"></i> Latitude and Longitude Info
  </button>
  <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#yearbookModal">
      <i class="fas fa-book me-2"></i> Request Yearbook Delivery
  </button>
</div>

  <!-- Yearbook Request Modal -->
  <div class="modal fade" id="yearbookModal" tabindex="-1" aria-labelledby="yearbookModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="yearbookModalLabel">Yearbook Delivery Request Form</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="yearbookForm" action="submit_yearbook_request.php" method="POST">
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
              <label for="address" class="form-label">Delivery Address (your accurate delivery address)</label>
              <input type="text" class="form-control" id="address" name="address" required autocomplete="off">
            </div>
            
            <div class="mb-3">
              <label for="latitude" class="form-label">Latitude of your address (latitude of your address e.g: 12.435345)</label>
              <input type="text" class="form-control" id="latitude" name="latitude" required autocomplete="off">
            </div>
            
            <div class="mb-3">
              <label for="longitude" class="form-label">Longitude of your address (longitude of your address e.g: 122.435345)</label>
              <input type="text" class="form-control" id="longitude" name="longitude" required autocomplete="off">
            </div>
            
            <div class="mb-3">
              <label for="number" class="form-label">Phone Number (use +63)</label>
              <input type="text" id="number" name="number" class="form-control"
                      pattern="^\+63[0-9]{10}$" 
                      placeholder="+63XXXXXXXXXX"
                      maxlength="13" 
                      required autocomplete=off>
            </div>
            
            <div class="modal-footer justify-content-center">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  
 

  <!-- Yearbook Request Status Card -->
  <div class="d-flex justify-content-center">
  <div class="card mt-4" style="max-width: 500px;">
    <div class="card-header text-center">
      <h5 class="mb-0">Yearbook Delivery Status</h5>
    </div>
    <div class="card-body">
      <h6 class="card-title">Student Number: <span id="student-number"><?php echo htmlspecialchars($student_number); ?></span></h6>
      <h6 class="card-title">Full name: <span id="full-name"><?php echo htmlspecialchars($fullname); ?></span></h6>
      <h6 class="card-title">Request Status: <span class="badge rounded-pill 
      <?php 
        if ($request_status === 'Pending') {
          echo 'bg-warning text-dark';
        } elseif ($request_status === 'Approved') {
          echo 'bg-success';
        } else {
          echo 'bg-danger';
        }
      ?>">
      <?php echo htmlspecialchars($request_status); ?>
      </span></h6>
      <h6 class="card-title">Delivery Address: <span id="order-id"><?php echo htmlspecialchars($address); ?></span></h6>
      <h6 class="card-title">Order ID: <span id="order-id"><?php echo htmlspecialchars($order_id); ?> (Order ID can be tracked)</span></h6><br>
      <h6 class="card-title">If Request Status is Approved but Order ID is still N/A,<br>it means the admin has yet to create the order.</h6>
    </div>
  </div>
</div>


    <!-- Request Notice -->
    <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">Yearbook Request Notice</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" style="color: #000; font-weight: bold; padding: 30px;">
            When requesting a yearbook, make sure your tuition is fully paid to avoid delays in processing, rejection of your request, or potential issues with the delivery.<br><br>
            Also, make sure you still haven't received one to avoid duplications. <br><br>
            Please settle any outstanding balances to ensure a smooth and timely yearbook distribution. 
            <br><br>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary close" data-bs-dismiss="modal">Confirm</button>
            <button type="button" class="btn btn-danger" onclick="window.location='index.php';">Cancel</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="infoModalLabel">How to get Latitude and Longitude of your delivery address?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          1. Go to <a href="https://www.latlong.net/">https://www.latlong.net/</a> <br> <br>
          2. Type Your Delivery Address. <br> <br>
          3. Adjust the pinpoint to your delivery address location for accuracy. <br> <br>
          4. Copy the Latitude and Longitude given to you. <br> <br>
          5. Paste it in the Yearbook Delivery Form. <br> <br>
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
