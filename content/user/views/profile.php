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
  <link rel="stylesheet" type="text/css" href="../css/profiles.css"/>
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
        <h3 class="text-themecolor" style="font-size: 1.5em; color:#752738 !important; margin-bottom: 5px;">Profile</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)" style="color:#000 !important;">Home</a></li>
            <li class="breadcrumb-item active">Profile</li>
        </ol>
    </div>
</div>

<?php include_once('./backend/profile_sql.php'); ?>

<form action="#" method="POST">
                <div class="profile-header text-center mx-2">
                    <div class="profile-picture-container">
                        <img src="<?php echo $file ?>" id="img1" class="profile-picture">
                        <label for="upload" class="edit-picture-btn">
                            <i class="fa-solid fa-camera"></i>
                        </label>
                        <input type="file" name="upload" id="upload" style="display:none" accept="image/png, image/gif, image/jpeg">
                        <textarea id="file" name="file" style="display:none"></textarea>
                    </div>
                    <h4 class="mt-3 mb-1"><?php echo $fname . ' ' . $lname ?></h4>
                    <p class="text-muted"><?php echo $occupation ?></p>
                </div>

                <div class="profile-form mx-2 mb-4">
                    <h5 class="section-title">Personal Information</h5>
                    <div class="form-group-row mb-4">
                        <div class="mb-3">
                            <label for="fname" class="form-label">First Name</label>
                            <input type="text" class="form-control" name="fname" value="<?php echo $fname; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="lname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="lname" value="<?php echo $lname; ?>" required>
                        </div>
                    </div>

                    <div class="form-group-row mb-4">
                        <div class="mb-3">
                            <label for="birthday" class="form-label">Birthday</label>
                            <input type="date" class="form-control" name="birthday" value="<?php echo $birthday; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="occupation" class="form-label">Occupation</label>
                            <input type="text" class="form-control" name="occupation" value="<?php echo $occupation; ?>" required>
                        </div>
                    </div>

                    <h5 class="section-title mt-4">Professional Information</h5>
                    <div class="mb-4">
                        <label for="company" class="form-label">Company</label>
                        <input type="text" class="form-control" name="company" value="<?php echo $company; ?>" required>
                    </div>

                    <h5 class="section-title mt-4">Location</h5>
                    <div class="form-group-row mb-4">
                        <div class="mb-3">
                            <label for="region" class="form-label">Region</label>
                            <select name="region" class="form-select" required onchange="loadProvinces(this.value)">
                                <option><?php echo $region; ?></option>
                                <option>Region I – Ilocos Region</option>
                                <option>Region II – Cagayan Valley</option>
                                <option>Region III – Central Luzon</option>
                                <option>Region IV A – CALABARZON</option>
                                <option>MIMAROPA Region</option>
                                <option>Region V – Bicol Region</option>
                                <option>Region VI – Western Visayas</option>
                                <option>Region VII – Central Visayas</option>
                                <option>Region VIII – Eastern Visayas</option>
                                <option>Region IX – Zamboanga Peninsula</option>
                                <option>Region X – Northern Mindanao</option>
                                <option>Region XI – Davao Region</option>
                                <option>Region XII – SOCCSKSARGEN</option>
                                <option>Region XIII – Caraga</option>
                                <option>NCR – National Capital Region</option>
                                <option>CAR – Cordillera Administrative Region</option>
                                <option>BARMM – Bangsamoro Autonomous Region in Muslim Mindanao</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">Province</label>
                            <select class="form-select" name="city" id="province1" required>
                                <option><?php echo $city; ?></option>
                            </select>
                        </div>
                    </div>

                    <script>
                    function loadProvinces(value) {
                        var region = value;
                        
                        if (region == 'Region I – Ilocos Region') {
                            document.getElementById('province1').innerHTML = '' +
                                '<select placeholder="Province" name="province" id="province">' +
                                '<option selected disabled>Choose province...</option>' +
                                '<option>Ilocos Norte</option>' +
                                '<option>Ilocos Sur</option>' +
                                '<option>La Union</option>' +
                                '<option>Pangasinan</option>' +
                                '</select>';
                        }
                        else if (region == 'Region II – Cagayan Valley') {
                            document.getElementById('province1').innerHTML = '' +
                                '<select placeholder="Province" name="province" id="province">' +
                                '<option selected disabled>Choose province...</option>' +
                                '<option>Batanes</option>' +
                                '<option>Cagayan</option>' +
                                '<option>Isabela</option>' +
                                '<option>Nueva Vizcaya</option>' +
                                '<option>Quirino</option>' +
                                '</select>';
                        }
                        else if (region == 'Region III – Central Luzon') {
                            document.getElementById('province1').innerHTML = '' +
                                '<select placeholder="Province" name="province" id="province">' +
                                '<option selected disabled>Choose province...</option>' +
                                '<option>Aurora</option>' +
                                '<option>Bataan</option>' +
                                '<option>Bulacan</option>' +
                                '<option>Nueva Ecija</option>' +
                                '<option>Pampanga</option>' +
                                '<option>Tarlac</option>' +
                                '<option>Zambales</option>' +
                                '</select>';
                        }
                        else if (region == 'Region IV A – CALABARZON') {
                            document.getElementById('province1').innerHTML = '' +
                                '<select placeholder="Province" name="province" id="province">' +
                                '<option selected disabled>Choose province...</option>' +
                                '<option>Batangas</option>' +
                                '<option>Laguna</option>' +
                                '<option>Quezon</option>' +
                                '<option>Rizal</option>' +
                                '<option>Cavite</option>' +
                                '</select>';
                        }
                        else if (region == 'MIMAROPA Region') {
                            document.getElementById('province1').innerHTML = '' +
                                '<select placeholder="Province" name="province" id="province">' +
                                '<option selected disabled>Choose province...</option>' +
                                '<option>Marinduque</option>' +
                                '<option>Occidental Mindoro</option>' +
                                '<option>Oriental Mindoro</option>' +
                                '<option>Palawan</option>' +
                                '<option>Romblon</option>' +
                                '</select>';
                        }
                        else if (region == 'Region V – Bicol Region') {
                            document.getElementById('province1').innerHTML = '' +
                                '<select placeholder="Province" name="province" id="province">' +
                                '<option selected disabled>Choose province...</option>' +
                                '<option>Albay</option>' +
                                '<option>Camarines Norte</option>' +
                                '<option>Camarines Sur</option>' +
                                '<option>Catanduanes</option>' +
                                '<option>Sorsogon</option>' +
                                '<option>Masbate</option>' +
                                '</select>';
                        }
                        else if (region == 'Region VI – Western Visayas') {
                            document.getElementById('province1').innerHTML = '' +
                                '<select placeholder="Province" name="province" id="province">' +
                                '<option selected disabled>Choose province...</option>' +
                                '<option>Aklan</option>' +
                                '<option>Antique</option>' +
                                '<option>Capiz</option>' +
                                '<option>Iloilo</option>' +
                                '<option>Negros Occidental</option>' +
                                '</select>';
                        }
                        else if (region == 'Region VII – Central Visayas') {
                            document.getElementById('province1').innerHTML = '' +
                                '<select placeholder="Province" name="province" id="province">' +
                                '<option selected disabled>Choose province...</option>' +
                                '<option>Bohol</option>' +
                                '<option>Cebu</option>' +
                                '<option>Negros Oriental</option>' +
                                '<option>Siquijor</option>' +
                                '</select>';
                        }
                        else if (region == 'Region VIII – Eastern Visayas') {
                            document.getElementById('province1').innerHTML = '' +
                                '<select placeholder="Province" name="province" id="province">' +
                                '<option selected disabled>Choose province...</option>' +
                                '<option>Biliran</option>' +
                                '<option>Eastern Samar</option>' +
                                '<option>Leyte</option>' +
                                '<option>Northern Samar</option>' +
                                '<option>Southern Leyte</option>' +
                                '<option>Western Samar</option>' +
                                '</select>';
                        }
                        else if (region == 'Region IX – Zamboanga Peninsula') {
                            document.getElementById('province1').innerHTML = '' +
                                '<select placeholder="Province" name="province" id="province">' +
                                '<option selected disabled>Choose province...</option>' +
                                '<option>Zamboanga del Norte</option>' +
                                '<option>Zamboanga del Sur</option>' +
                                '<option>Zamboanga Sibugay</option>' +
                                '</select>';
                        }
                        else if (region == 'Region X – Northern Mindanao') {
                            document.getElementById('province1').innerHTML = '' +
                                '<select placeholder="Province" name="province" id="province">' +
                                '<option selected disabled>Choose province...</option>' +
                                '<option>Camiguin</option>' +
                                '<option>Misamis Occidental</option>' +
                                '<option>Misamis Oriental</option>' +
                                '<option>Bukidnon</option>' +
                                '<option>Lanao del Norte</option>' +
                                '</select>';
                        }
                        else if (region == 'Region XI – Davao Region') {
                            document.getElementById('province1').innerHTML = '' +
                                '<select placeholder="Province" name="province" id="province">' +
                                '<option selected disabled>Choose province...</option>' +
                                '<option>Davao del Norte</option>' +
                                '<option>Davao del Sur</option>' +
                                '<option>Davao Oriental</option>' +
                                '<option>Davao Occidental</option>' +
                                '<option>Compostela Valley</option>' +
                                '</select>';
                        }
                        else if (region == 'Region XII – SOCCSKSARGEN') {
                            document.getElementById('province1').innerHTML = '' +
                                '<select placeholder="Province" name="province" id="province">' +
                                '<option selected disabled>Choose province...</option>' +
                                '<option>South Cotabato</option>' +
                                '<option>Sultan Kudarat</option>' +
                                '<option>General Santos City</option>' +
                                '<option>Cotabato</option>' +
                                '</select>';
                        }
                        else if (region == 'Region XIII – Caraga') {
                            document.getElementById('province1').innerHTML = '' +
                                '<select placeholder="Province" name="province" id="province">' +
                                '<option selected disabled>Choose province...</option>' +
                                '<option>Agusan del Norte</option>' +
                                '<option>Agusan del Sur</option>' +
                                '<option>Surigao del Norte</option>' +
                                '<option>Surigao del Sur</option>' +
                                '<option>Dinagat Islands</option>' +
                                '</select>';
                        }
                        else if (region == 'NCR – National Capital Region') {
                            document.getElementById('province1').innerHTML = '' +
                                '<select placeholder="Province" name="province" id="province">' +
                                '<option selected disabled>Choose province...</option>' +
                                '<option>Metro Manila</option>' +
                                '</select>';
                        }
                        else if (region == 'CAR – Cordillera Administrative Region') {
                            document.getElementById('province1').innerHTML = '' +
                                '<select placeholder="Province" name="province" id="province">' +
                                '<option selected disabled>Choose province...</option>' +
                                '<option>Abra</option>' +
                                '<option>Apayao</option>' +
                                '<option>Bineng</option>' +
                                '<option>Mountain Province</option>' +
                                '<option>Ifugao</option>' +
                                '<option>Kalinga</option>' +
                                '</select>';
                        }
                        else if (region == 'BARMM – Bangsamoro Autonomous Region in Muslim Mindanao') {
                            document.getElementById('province1').innerHTML = '' +
                                '<select placeholder="Province" name="province" id="province">' +
                                '<option selected disabled>Choose province...</option>' +
                                '<option>Basilan</option>' +
                                '<option>Lanao del Sur</option>' +
                                '<option>Maguindanao</option>' +
                                '<option>Sulu</option>' +
                                '<option>Tawi-Tawi</option>' +
                                '</select>';
                        }
                        else {
                            document.getElementById('province1').innerHTML = '' +
                                '<select placeholder="Province" name="province" id="province">' +
                                '<option selected disabled>Choose province...</option>' +
                                '</select>';
                        }
                    }
                    </script>

                    <input type="hidden" name="program" value="<?php echo $program; ?>">
                    
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3 mt-4">
    <button type="button" onclick="window.location='feature_profile.php';" class="btn btn-warning h-100 d-flex align-items-center justify-content-center" style="max-width: 250px; height: 38px;">
        <i class="fas fa-star me-2"></i>Featured Alumni Form
    </button>
    <div class="d-flex gap-2">
        <button type="button" onclick="window.location='index.php';" class="btn btn-secondary d-flex align-items-center justify-content-center" style="min-width: 100px; height: 38px;">
            Cancel
        </button>
        <button type="submit" name="submit" class="btn btn-primary d-flex align-items-center justify-content-center" style="min-width: 140px; height: 38px;">
            <i class="fas fa-save me-2"></i>Save Changes
        </button>
    </div>
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
