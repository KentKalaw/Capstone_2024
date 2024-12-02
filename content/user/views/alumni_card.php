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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
  <link rel="icon" type="image/png" sizes="512x512" href="../../assets/img/favicon/logo.png">
  <link rel="stylesheet" type="text/css" href="../css/alumni_card.scss"/>
</head>

<body>
<?php include_once('./loader/loader.php'); ?>
  <?php include_once('./sidebar/sidebar.php'); ?>
  <?php include_once('./backend/alumni_card_sql.php'); ?>

  <div id="page-content-wrapper">

  <?php include_once('./navbar/navbar.php'); ?>

    <div class="d-flex px-3 py-3 align-items-center" style="margin-bottom: 20px;">
    <img src="<?php echo $file ?>" style="width:80px; height:65px; border-radius:50%; margin-right: 15px;">
    <div class="col-md-5">
        <h3 class="text-themecolor" style="font-size: 1.2em; color:#752738 !important; margin-bottom: 5px;">Alumni Privilege Card</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)" style="color:#000 !important;">Home</a></li>
            <li class="breadcrumb-item active">Alumni Privilege Card</li>
        </ol>
    </div>
</div>

<div class="not-container mt-5 mx-5">
    <div class="not-container py-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="primary-text mb-3">Request Your Alumni Privilege Card</h1>
                <p class="text-muted">Enjoy exclusive benefits and privileges with our Alumni Privilege Card. Request your card today!</p>
            </div>
            <div class="col-md-4 text-end">
                <button type="button" class="btn btn-warning action-button me-2 mb-2 mb-md-0" data-bs-toggle="modal" data-bs-target="#howToUseModal">
                    <i class="fas fa-info-circle me-2"></i> How to Use APC
                </button>
                <button type="button" class="btn btn-dark action-button" data-bs-toggle="modal" data-bs-target="#applicationFormModal">
                    <i class="fas fa-file-alt me-2"></i> APC Application
                </button>
            </div>
        </div>
    </div>
    <hr class="mb-4">
</div>

<div class="not-container m-5 mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h5 class="card-title mb-0" style="color: #752738;">
                <i class="fas fa-clock me-2"></i>APC Request Information
            </h5>
        </div>
        <div class="card-body">
        <div class="mb-4 d-flex justify-content-center">
        <?php if (!empty($idphoto) && strpos($idphoto, 'data:image') === 0): ?>
            <?php if ($status === 'Pending'): ?>
    <div style="width: 200px; height: 200px; border: 2px solid #752738; border-radius: 4px; position: relative;">
        <img src="<?php echo $idphoto ?>" 
             alt="2x2 ID Photo" 
             style="width: 100%; 
                    height: 100%; 
                    object-fit: cover; 
                    object-position: center;">
        <div style="position: absolute; bottom: 0; left: 0; right: 0; background: rgba(0,0,0,0.5); color: white; text-align: center; padding: 5px;">
            <button type="button" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#changePhotoModal">
                <i class="fas fa-edit me-1"></i>Change Photo
            </button>
        </div>
    </div>
    <?php else: ?>
    <div style="width: 200px; height: 200px; border: 2px solid #752738; border-radius: 4px; overflow: hidden;">
        <img src="<?php echo $idphoto ?>" 
             alt="2x2 ID Photo" 
             style="width: 100%; 
                    height: 100%; 
                    object-fit: cover; 
                    object-position: center;">
    </div>
    <?php endif; ?>
<?php else: ?>
    <div style="width: 200px; 
                height: 200px; 
                border: 2px solid #752738; 
                border-radius: 4px; 
                display: flex; 
                align-items: center; 
                justify-content: center; 
                background-color: #f8f9fa;">
        <i class="fas fa-user fa-4x" style="color: #752738;"></i>
    </div>
<?php endif; ?>
</div>

            <div class="row g-3">
                <!-- Left Column -->
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <h6 class="text-muted mb-1">Name:</h6>
                        <p class="fw-bold mb-3"><?php echo htmlspecialchars($fullname); ?></p>
                    </div>
                    <div class="mb-3">
                        <h6 class="text-muted mb-1">Student Number:</h6>
                        <p class="fw-bold mb-3"><?php echo htmlspecialchars($student_number); ?></p>
                    </div>
                    <div class="mb-3">
                        <h6 class="text-muted mb-1">Department:</h6>
                        <p class="fw-bold mb-3"><?php echo htmlspecialchars($department); ?></p>
                    </div>
                    <div class="mb-3">
                        <h6 class="text-muted mb-1">Year Graduated:</h6>
                        <p class="fw-bold mb-3"><?php echo htmlspecialchars($year_graduated); ?></p>
                    </div>
                </div>
                <!-- Right Column -->
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <h6 class="text-muted mb-1">Course:</h6>
                        <p class="fw-bold mb-3"><?php echo htmlspecialchars($course); ?></p>
                    </div>
                    <div class="mb-3">
                      <?php $formattedDate = date('F j, Y g:ia', strtotime($date)); ?>
                        <h6 class="text-muted mb-1">Request Date:</h6>
                        <p class="fw-bold mb-3"><?php echo htmlspecialchars($formattedDate); ?></p>
                    </div>
                    <div class="mb-3">
                        <h6 class="text-muted mb-1">Request Status:</h6>
                        <span class="badge rounded-pill px-3 py-2 <?php 
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="changePhotoModal" tabindex="-1" aria-labelledby="changePhotoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePhotoModalLabel">Change Profile Photo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="changePhotoForm" method="POST" action="update_alumni_photo.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="newPhotoUpload" class="form-label">Upload New Photo</label>
                        <input type="file" class="form-control" id="newPhotoUpload" name="newPhoto" accept="image/png, image/jpeg, image/jpg" required>
                        <div class="form-text">Please upload a 2x2 ID photo (PNG or JPEG)</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Photo Preview</label>
                        <div class="photo-preview-container" style="width: 200px; height: 200px; border: 1px solid #ddd;">
                            <img id="photoPreview" src="" alt="Photo Preview" style="max-width: 100%; max-height: 100%; display: none;">
                            <div id="previewPlaceholder" class="text-center text-muted" style="line-height: 200px;">
                                Preview will appear here
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="alumni_id" value="<?php echo isset($alumni_id) ? $alumni_id : ''; ?>">
                    <input type="hidden" id="croppedPhotoData" name="croppedPhoto">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="cropAndSaveButton" disabled>Crop and Save</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const newPhotoUpload = document.getElementById('newPhotoUpload');
    const photoPreview = document.getElementById('photoPreview');
    const previewPlaceholder = document.getElementById('previewPlaceholder');
    const cropAndSaveButton = document.getElementById('cropAndSaveButton');
    let cropper;

    newPhotoUpload.addEventListener('change', function(e) {
        const file = e.target.files[0];
        const reader = new FileReader();

        reader.onload = function(event) {
            // Clear previous cropper if exists
            if (cropper) {
                cropper.destroy();
            }

            // Show preview
            photoPreview.src = event.target.result;
            photoPreview.style.display = 'block';
            previewPlaceholder.style.display = 'none';

            // Initialize Cropper.js
            cropper = new Cropper(photoPreview, {
                aspectRatio: 1, // 1:1 square crop
                viewMode: 1,
                minCropBoxWidth: 200,
                minCropBoxHeight: 200,
                ready: function() {
                    cropAndSaveButton.disabled = false;
                }
            });
        };

        reader.readAsDataURL(file);
    });

    cropAndSaveButton.addEventListener('click', function() {
        if (cropper) {
            // Get the cropped image data
            const croppedCanvas = cropper.getCroppedCanvas({
                width: 600,
                height: 600
            });

            // Convert to base64
            const croppedPhotoData = croppedCanvas.toDataURL('image/jpeg');
            
            // Set the hidden input value
            document.getElementById('croppedPhotoData').value = croppedPhotoData;

            // Submit the form
            document.getElementById('changePhotoForm').submit();
        }
    });
});
</script>

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

<!-- Sponsors Tab -->

<!-- <div class="not-container my-5">
      <h3 class="text-center mb-4" style="color:#752738; font-weight: bold;">Sponsors</h3>
      <div class="not-container">
        <div class="row text-center d-flex justify-content-center">
            <div class="col-6 col-md-4 col-lg-3 mb-4">
                <img src="../images/jollibee.svg" alt="Sponsor 1" class="img-fluid" style="width: 100px; height: 100px" />
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-4">
                <img src="../images/chowking.png" alt="Sponsor 2" class="img-fluid" style="width: 100px; height: 100px" />
            </div>
           
            
           
        </div>
    </div>
<div> -->



<div class="not-container my-5">
    <h3 class="text-center mb-4" style="color:#752738; font-weight: bold;">Alumni Card Benefits</h3>
    <div class="not-container">
        <div class="row text-center d-flex justify-content-center">
            <div class="col-6 col-md-4 col-lg-3 mb-4">
                <img src="../images/jollibee.svg" alt="Sponsor 1" class="img-fluid" style="width: 100px; height: 100px" />
                <p class="mt-2" style="color: #752738;">&#8226; 5% Discount Benefits</p>
                <p class="mt-1" style="color: #752738;">&#8226; More Benefits</p>
                <p class="mt-1" style="color: #752738;">&#8226; More Benefits</p>
                <p class="mt-1" style="color: #752738;">&#8226; More Benefits</p>
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-4">
                <img src="../images/chowking.png" alt="Sponsor 2" class="img-fluid" style="width: 100px; height: 100px" />
                <p class="mt-2" style="color: #752738;">&#8226; 5% Discount on orders</p>
                <p class="mt-1" style="color: #752738;">&#8226; More Benefits</p>
                <p class="mt-1" style="color: #752738;">&#8226; More Benefits</p>
                <p class="mt-1" style="color: #752738;">&#8226; More Benefits</p>
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-4">
                <img src="../images/sentinels.png" alt="Sponsor 3" class="img-fluid" style="width: 100px; height: 100px" />
                <p class="mt-2" style="color: #752738;">&#8226; 8% Discount Benefits</p>
                <p class="mt-1" style="color: #752738;">&#8226; More Benefits</p>
                <p class="mt-1" style="color: #752738;">&#8226; More Benefits</p>
                <p class="mt-1" style="color: #752738;">&#8226; More Benefits</p>
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-4">
                <img src="../images/100_thieves.svg" alt="Sponsor 4" class="img-fluid" style="width: 100px; height: 100px" />
                <p class="mt-2" style="color: #752738;">&#8226; 10% Discount Benefits</p>
                <p class="mt-1" style="color: #752738;">&#8226; More Benefits</p>
                <p class="mt-1" style="color: #752738;">&#8226; More Benefits</p>
                <p class="mt-1" style="color: #752738;">&#8226; More Benefits</p>
            </div>
            <!-- Add more benefits later HA -->
        </div>
    </div>
</div>


<!-- Modal for How to Use APC -->
<div class="modal fade" id="howToUseModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">How to use your card in stores or other merchant partners?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="color: #000; font-weight: 500; padding: 30px; max-height: 400px; overflow-y: auto;">
            You must present your card before making any purchase / order at any participating merchant partners. Failure to present the card would not entitle the holder any discounts, freebies and perks offered by the merchant. A merchant has the right to deny a discount if you do not present your card before payment. In case of any doubt as to the identity of the alumni by the merchant partner representative, the latter reserves the right to request for an additional Identification card such as school ID and the like to verify that you are a rightful Cardholder. The Card shall not be used as a form of payment. For each transaction you will make, you will be asked to sign on the Information / Log sheet. For food chains and restaurants, discounts, freebies and perks would only be applied for food purchases made for personal consumption of the Cardholder himself. Freebies and perks of the store or restaurants are always subject to availability and may be limited especially during peak periods.<br><br>
            4. Cancellation / Revocation<br>
            Any use of the Alumni Privilege Card in a manner that violates the rules and regulations of the participating merchant partners is prohibited by this Agreement and is a ground for the cancellation or revocation of the Alumni Privilege Card. SAEP reserves the right to revoke Cardholder’s rights in the event of such violation. <br><br>
            5. Lost Cards <br>
            No refunds. In case of lost cards, the Alumni Office must be notified immediately. The Cardholder should apply for a replacement of the Card upon filling out the “ALUMNI PRIVILEGE CARD REPLACEMENT FORM” at the SAEP office. A replacement fee of Php 300.00 will be charged in case of a lost or stolen card. Any form of reproduction of copies of this Card is strictly prohibited.<br><br>
            6. Merchant Disputes <br>
            SAEP is not responsible if a sponsor changes its discount due to new ownership or acquisition of the merchant establishments. If you have a dispute with a sponsor merchant, UB SAEP will take commercially reasonable efforts to solve the dispute on your behalf. You may report disputes with sponsor merchants by contacting UB SAEP. Reports must be submitted in written form with the following information: merchant name, merchant address, date of purchase, discount denied and purchase information. Attach any proof of purchase (e.g. receipt).<br><br>
            7. Changes to Offers and Partners <br>
            Any changes of offers and freebies granted by the merchant partners should be notified to the SAEP for cardholder’s advisory. Failure of the merchant partner’s notifications to the UB SAEP, will hold the merchant partner liable to provide the discount, freebies and perks indicated in the pamphlets.<br><br>
            8. Privacy Policy <br>
            Any information submitted by the cardholder to the Alumni Office pertaining to all information contained in the Alumni Card will be treated with utmost confidentiality. <br><br>
            9. Disclaimer <br>
            University of Batangas Student Affairs and External Programs Office and participating merchant partners are separate and independent entities. SAEP is not liable for any products or services, provided by the merchant partners, beyond the satisfaction of the customers / cardholders. SAEP takes no part in the profit sharing of the establishments for the use of the Alumni Privilege Card.<br><br><br>
            SAEP IS NOT LIABLE FOR ANY PRODUCTS OR SERVICES PROVIDED BY OR THROUGH ANY SPONSOR OF THE PRIVILEGE CARD, OR FOR ANY ERROR, OMISSION OR INACCURACY IN ADVERTISING MATERIAL OR FOR ANY LIABILITY RESULTING DIRECTLY OR INDIRECTLY FROM A PRODUCT OR SERVICE PROVIDED BY ANY SPONSOR OR OTHER THIRD PARTY IN CONNECTION WITH THE DISCOUNT PROGRAM.<br>
          </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Application Form -->
<div class="modal fade" id="applicationFormModal" tabindex="-1" aria-labelledby="applicationFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="applicationFormModalLabel">APC Application Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Here you can include the application form or any information related to it.</p>

                <form method="post" action="submit_alumni_card_request.php">
                <input type="hidden" name="alumni_id" value="<?php echo isset($alumni_id) ? $alumni_id : ''; ?>">
                    <!-- Example fields -->
                    <div class="mb-3">
                    <label class="form-label">Upload 2x2 ID Photo (Optional)<br><small class="text-muted">This photo will be displayed on your Alumni Privilege Card (Optional)</small></label>
                        <div class="photo-upload-container">
                            <div class="photo-preview-box">
                                <img id="preview-image" src="" alt="Preview">
                                <div class="placeholder">
                                    <i class="fas fa-camera"></i>
                                    <p>Preview will appear here</p>
                                </div>
                            </div>
                            <div class="photo-input-container">
                                <label for="upload" class="photo-input-label">
                                    <i class="fas fa-upload"></i> Choose Photo
                                </label>
                                <input type="file" name="upload" id="upload" accept="image/png, image/gif, image/jpeg">
                                <textarea id="file" name="file" style="display:none"></textarea>
                            </div>
                            <p class="guidelines">Recommended: 2x2 ID photo format</p>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="fullname" value="<?php echo $global_name ?>"readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Student Number</label>
                        <input type="text" class="form-control" name="student_number" value="<?php echo $global_studentnum ?>"readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Department</label>
                        <input type="text" class="form-control" name="department" value="<?php echo $global_department ?>"readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Course</label>
                        <input type="text" class="form-control" name="course" value="<?php echo $global_course ?>"readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Year Graduated</label>
                        <input type="text" class="form-control" name="year_graduated" value="<?php echo $global_year ?>"readonly>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
const fileInput = document.getElementById('upload');
const previewImage = document.getElementById('preview-image');
const placeholder = document.querySelector('.placeholder');

fileInput.addEventListener('change', (e) => {
  const file = e.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onloadend = () => {
      previewImage.src = reader.result;
      previewImage.style.display = 'block';
      previewImage.style.width = '100%';
      previewImage.style.height = '100%';
      placeholder.style.display = 'none';
      document.getElementById('file').value = reader.result;
    };
    reader.readAsDataURL(file);
  }
});
</script>


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

<script>
				function dept(value) {
					var department1 = value;
				//	alert(value);
					if(department1 == 'College of Allied Medical Sciences') {
						document.getElementById('course1').innerHTML = ''+
						'<select placeholder="Course" name="course" id="course"  placeholder="username"/>'+
						'<option selected disabled>Choose course...</option>'+
						'<option>Bachelor of Science in Occupational Therapy</option>'+
						'<option>Bachelor of Science in Physical Therapy</option>'+
						'<option>Bachelor of Science in Respiratory Therapy</option>'+
						'</select>';
					}	
					if(department1 == 'College of Arts and Sciences') {
						document.getElementById('course1').innerHTML = ''+
						'<select placeholder="Course" name="course" id="course"  placeholder="username"/>'+
						'<option selected disabled>Choose course...</option>'+
						'<option>Bachelor in Human Services</option>'+
						'<option>Bachelor of Arts in Communication</option>'+
						'<option>Bachelor of Science in Legal Management</option>'+
						'<option>Bachelor of Arts in Political Science</option>'+
						'<option>Bachelor of Arts in Psychology</option>'+
						'<option>Bachelor of Multimedia Arts</option>'+
						'</select>';
					}	
					if(department1 == 'College of Business, Accountancy, and Hospitality Management') {
						document.getElementById('course1').innerHTML = ''+
						'<select placeholder="Course" name="course" id="course"  placeholder="username"/>'+
                        '<option selected disabled>Choose course...</option>'+
						'<option>Bachelor of Science in Accountancy</option>'+
						'<option>Bachelor of Science in Business Administration major in Business Administration</option>'+
						'<option>Bachelor of Science in Business Administration major in Financial Management</option>'+
						'<option>Bachelor of Science in Business Administration major in Human Resource Development Management</option>'+
						'<option>Bachelor of Science in in Business Administration major in Marketing Management</option>'+
						'<option>Bachelor of Science in Entrepreneurship</option>'+
						'<option>Bachelor of Science in Tourism Management</option>'+
						'<option>Bachelor of Science in Management Accounting</option>'+
						'<option>Bachelor of Science in International Hospitality Management</option>'+
						'<option>Bachelor of Science in International Hospitality Management with Specialization in Cruiseline Operation</option>'+
						'</select>';
					}	
					if(department1 == 'Bachelor of Science in Accountancy') {
						document.getElementById('course1').innerHTML = ''+
						'<select placeholder="Course" name="course" id="course"  placeholder="username"/>'+
                        '<option selected disabled>Choose course...</option>'+
						'<option>Bachelor of Science in Business Administration major in Business Administration</option>'+
						'<option>Bachelor of Science in Business Administration major in Financial Management</option>'+
						'<option>Bachelor of Science in Business Administration major in Human Resource Development Management</option>'+
						'<option>Bachelor of Science in in Business Administration major in Marketing Management</option>'+
						'<option>Bachelor of Science in Entrepreneurship</option>'+
						'<option>Bachelor of Science in Tourism Management</option>'+
						'<option>Bachelor of Science in Management Accounting</option>'+
						'<option>Bachelor of Science in International Hospitality Management</option>'+
						'<option>Bachelor of Science in International Hospitality Management with Specialization in Cruiseline Operation</option>'+
						'</select>';
					}	
					if(department1 == 'College of Criminal Justice Education') {
						document.getElementById('course1').innerHTML = ''+
						'<select placeholder="Course" name="course" id="course"  placeholder="username"/>'+
                        '<option selected disabled>Choose course...</option>'+
						'<option>Bachelor of Science in Criminology</option>'+
						'</select>';
					}	
					if(department1 == 'College of Education') {
						document.getElementById('course1').innerHTML = ''+
						'<select placeholder="Course" name="course" id="course"  placeholder="username"/>'+
                        '<option selected disabled>Choose course...</option>'+
						'<option>Bachelor of Culture and Arts Education</option>'+
						'<option>Bachelor of Early Childhood Education</option>'+
						'<option>Bachelor of Elementary Education</option>'+
						'<option>Bachelor of Physical Education</option>'+
						'<option>Bachelor of Secondary Education</option>'+
						'<option>Bachelor of Special Needs Education</option>'+
						'<option>Certificate in Teaching Program</option>'+
						'<option>Post Baccalaureate Diploma in Alternative Learning System</option>'+
						'</select>';
					}	
					if(department1 == 'College of Engineering') {
						document.getElementById('course1').innerHTML = ''+
						'<select placeholder="Course" name="course" id="course"  placeholder="username"/>'+
                        '<option selected disabled>Choose course...</option>'+
						'<option>Bachelor of Science in Civil Engineering</option>'+
						'<option>Bachelor of Science in Computer Engineering</option>'+
						'<option>Bachelor of Science in Electrical Engineering</option>'+
						'<option>Bachelor of Science in Electronics Engineering</option>'+
						'<option>Bachelor of Science in Industrial Engineering</option>'+
						'<option>Bachelor of Science in Mechanical Engineering</option>'+
						'</select>';
					}	
					if(department1 == 'College of Information and Communications Technology') {
						document.getElementById('course1').innerHTML = ''+
						'<select placeholder="Course" name="course" id="course"  placeholder="username"/>'+
                        '<option selected disabled>Choose course...</option>'+
						'<option>Associate in Computer Technology</option>'+
						'<option>Bachelor of Library and Information Science</option>'+
						'<option>Bachelor of Science in Computer Science</option>'+
						'<option>Bachelor of Science in Information Systems</option>'+
						'<option>Bachelor of Science in Information Technology</option>'+
						'</select>';
					}	
					if(department1 == 'College of Nursing and Midwifery') {
						document.getElementById('course1').innerHTML = ''+
						'<select placeholder="Course" name="course" id="course"  placeholder="username"/>'+
                        '<option selected disabled>Choose course...</option>'+
						'<option>Bachelor of Science in Nursing</option>'+
						'<option>Caregiving (Newborn To Preschooler)</option>'+
						'<option>Health Care Services NC II</option>'+
						'</select>';
					}	
					if(department1 == 'College of Technical Education') {
						document.getElementById('course1').innerHTML = ''+
						'<select placeholder="Course" name="course" id="course"  placeholder="username"/>'+
                        '<option selected disabled>Choose course...</option>'+
						'<option>Automotive Technology</option>'+
						'<option>Drafting/CAD Technology</option>'+
						'<option>Electrical and Instrumentation Technology</option>'+
						'<option>Industrial Automation Technology</option>'+
						'<option>Instrumentation and Control Technology</option>'+
						'</select>';
					}	
					if(department1 == 'Senior High School') {
						document.getElementById('course1').innerHTML = ''+
						'<select placeholder="Course" name="course" id="course"  placeholder="username"/>'+
                        '<option selected disabled>Choose course...</option>'+
						'<option>ABM</option>'+
						'<option>HUMSS</option>'+
						'<option>STEM - E</option>'+
						'<option>STEM - AH</option>'+
						'<option>GAS</option>'+
						'<option>TVL</option>'+
						'<option>Arts and Design</option>'+
						'</select>';
					}	
				}

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

<script>
    document.addEventListener("DOMContentLoaded", function() {
  var containers = document.querySelectorAll('.container');
  containers.forEach(function(container) {
    container.addEventListener('click', function() {
      this.classList.toggle('hover');
    });
  });
});

</script>
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/facebox/1.3.8/facebox.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/facebox/1.3.8/facebox.min.js"></script>

</body>

</html>
