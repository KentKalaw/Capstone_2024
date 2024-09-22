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

  <link rel="stylesheet" href="../css/alumni_card.scss" />
</head>

<body>
  
  <?php include_once('./sidebar/sidebar.php'); ?>

  <div id="page-content-wrapper">

    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4 border-bottom" id="top-bar">
      <div class="d-flex align-items-center justify-content-between w-100">
        <div class="d-flex align-items-center">
          <i class="fa fa-bars primary-text fs-4 me-3" id="menu-toggle" aria-hidden="true"></i>
          <h2 class="fs-4 m-0" style="color:#752738">Alumni Card</h2>
        </div>
        <li class="d-flex align-items-center">
          <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="<?php echo $file ?>" alt="Admin Avatar" class="rounded-circle me-2" style="width: 40px; height: 40px;" onclick="window.location='profile.php'">
            <span class="fs-6 alumni-text" onclick="window.location='profile.php'"><?php echo $fname . ' ' . $lname ?> &nbsp; </span>
          </a>
        </li>
      </div>
    </nav>
<div class="not-container my-5">
      <h3 class="text-center mb-4" style="color:#752738; font-weight: bold;">Alumni Privilege Card Preview</h3>
<div>

    <div class="container my-5" ontouchstart="this.classList.toggle('hover');">
  <div class="card">  
    <div class="card_front" alt="Alumni front page">
      <h1 class="card-symbol"></h1>
    </div>

    <div class="card_back" alt="Alumni back page">
      <h1 class="card-symbol"></h1>
      <div class="card-text">
      </div>
    </div>    

  </div>
</div>

<div class="not-container my-5">
      <h3 class="text-center mb-4" style="color:#752738; font-weight: bold;">Sponsors</h3>
      <div class="not-container">
        <div class="row text-center">
            <div class="col-6 col-md-4 col-lg-3 mb-4">
                <img src="../images/jollibee.svg" alt="Sponsor 1" class="img-fluid" style="width: 100px; height: 100px" />
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-4">
                <img src="../images/chowking.png" alt="Sponsor 2" class="img-fluid" style="width: 100px; height: 100px" />
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-4">
                <img src="../images/sentinels.png" alt="Sponsor 3" class="img-fluid" style="width: 100px; height: 100px" />
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-4">
                <img src="../images/100_thieves.svg" alt="Sponsor 4" class="img-fluid" style="width: 100px; height: 100px" />
            </div>
            
            <!-- Add more sponsors later HA-->
        </div>
    </div>
<div>




  </div> <!-- End of page-content-wrapper -->

  <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg"> <!-- Add modal-lg class here -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Alumni Privilege Card Terms and Conditions</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="color: #000; font-weight: 500; padding: 30px; max-height: 400px; overflow-y: auto;">
        The Alumni Privilege Card is a fee-based and a fundraising program offered by the Student Affairs and External Programs Office of the University of Batangas. It does not merely serve as an identification of alumni but provides cardholders certain benefits such as discounts, freebies, and perks offered by participating merchant establishments within Batangas province.
        <br><br>
        By purchasing this Card, submitting information, and using this Card you agreed to be bound by this policy.
        <br><br>
        1. Eligibility <br>
        Students who are graduates of any 2 year and 4 year courses in the University will automatically be entitled to an Alumni Privilege Card. 
        <br><br>
        2. Card Purchase <br>
        Only one card is allowed per graduate. Graduates cannot apply for cards on behalf of other graduates except for valid reasons and upon written authorization of the graduate to the applicant. They must present their school ID upon claiming the Alumni Privilege Card to verify that they bear the same student number, course and year graduated. SAEP does not permit the sharing of the Card, student numbers or discounts with any other alumni. The Alumni Privilege Card is only for the exclusive use of the cardholder himself. If SAEP believes that the Card is being used in any of these ways, it reserves its right to cancel Cardholder’s rights immediately. If you believe someone made an unauthorized use thereof, please contact SAEP at (043) 723-1446 local 117. In case the Alumni Privilege Card was not claimed on the scheduled dates of distribution, the graduate may claim the same on any dates thereafter, provided he/she will undergo clearance procedure.
        <br><br>
        3. Card Use <br>
        Your card is your lifetime identification as an alumnus / alumna of the University of Batangas. Carry your card at all times. NO ACTIVATION is needed to access complete savings, benefits and services. Once you receive the card, it’s ready for use. The Card is NON-TRANSFERABLE and may only be used by the person whose name is printed or whose photo appears on the Card. The card will bear your permanent student number (e.g. 200410737C) which will also serve as your lifetime alumni number. It will also serve as a pass without a need for securing Visitor’s Pass whenever an alumnus/alumna will visit the UB campuses.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary close" data-bs-dismiss="modal">Confirm</button>
        <button type="button" class="btn btn-danger" onclick="window.location='index.php';">Cancel</button>
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



