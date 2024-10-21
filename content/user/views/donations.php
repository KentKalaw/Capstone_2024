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
  <link rel="icon" type="image/png" sizes="512x512" href="./assets/img/favicon/logo.png">
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
        <h3 class="text-themecolor" style="font-size: 1.5em; color:#752738 !important; margin-bottom: 5px;">Donations</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)" style="color:#000 !important;">Home</a></li>
            <li class="breadcrumb-item active">Donations</li>
        </ol>
    </div>
</div>
    
    <!-- START HERE -->
    <div class="container my-5">
     <!-- Header Section -->
     <div class="text-center mb-5">
                <h2 class="text-uppercase fw-bold" style="color: #752738;">Donate Now</h2>
                <p class="lead">Your contribution helps make a difference</p>
                <hr class="w-25 mx-auto">
            </div>

            <!-- Donation Content -->
            <div class="row justify-content-center g-4">
                <!-- Donation Form -->
                <div class="col-md-6">
                    <div class="bg-white p-4 rounded-3 shadow-sm">
                        <h5 class="mb-4" style="color: #752738;">Donation Details</h5>

                        <form enctype="multipart/form-data" method="POST" action="process_donations.php">
                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="fullname" value="<?php echo $fname . ' ' . $lname ?>" required autocomplete="off">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control" name="email" value="<?php echo $username?>" required autocomplete="off">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Donation Amount (₱)</label>
                                <input type="number" class="form-control" name="amount" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Contact Number</label>
                                <input type="tel" class="form-control" name="number" placeholder="09XXXXXXXXX" pattern="^09\d{9}$" required autocomplete="off">
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Upload Proof of Payment</label><br>
                                <input type="file" class="form-control" id="upload" style=""  accept="image/png, image/gif, image/jpeg">
                                <textarea  name="file" id="file" style="display:none"></textarea>
                                <div class="form-text">Please upload a screenshot of your GCash donation payment</div>
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
                                            document.getElementById('img').src = reader.result; 
                                        console.log(base64String);
                                    };
                                    reader.readAsDataURL(file);});
                                </script>


                            <div class="d-grid">
                                <button type="submit" class="btn btn-lg" style="background-color: #752738; color: white;">
                                    Submit Donation
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- QR Code Section -->
                <div class="col-md-5">
                    <div class="bg-white p-4 rounded-3 shadow-sm">
                        <h5 class="text-center mb-4" style="color: #752738;">Scan to Donate via GCash</h5>
                        
                        <div class="text-center mb-4">
                            <img src="../images/gcash-scan.png" alt="GCash QR Code" class="img-fluid mb-3 w-100">
                        </div>

                        <div class="text-start">
                            <h6 class="mb-3" style="color: #752738;">How to Donate:</h6>
                            <ol class="list-group list-group-numbered mb-4">
                                <li class="list-group-item">Open your GCash app</li>
                                <li class="list-group-item">Scan the QR code above</li>
                                <li class="list-group-item">Enter your donation amount</li>
                                <li class="list-group-item">Complete the payment</li>
                                <li class="list-group-item">Take a screenshot of the payment confirmation</li>
                                <li class="list-group-item">Upload the screenshot in the form</li>
                            </ol>
                        </div>

                        <div class="alert alert-info" role="alert">
                            <h6 class="alert-heading mb-2">GCash Account Details:</h6>
                            <p class="mb-0">Account Name: SAEP Admin Name</p>
                            <p class="mb-0">GCash Number: 09XX-XXX-XXXX</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="successModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center p-4">
                <i class="fas fa-check-circle text-success fa-3x mb-3"></i>
                <h4>Thank You for Your Donation!</h4>
                <p>Redirecting you back...</p>
            </div>
        </div>
    </div>
</div>



    
  </div> <!-- End of container -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function() {
      el.classList.toggle("toggled");
    };
  </script>
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<script>
document.getElementById('donationForm').addEventListener('submit', function(e) {
    e.preventDefault();
    // Add your form validation and submission logic here
    
    // Show success modal
    var successModal = new bootstrap.Modal(document.getElementById('successModal'));
    successModal.show();
});
</script>
</body>

</html>
