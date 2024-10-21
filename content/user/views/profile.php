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

    <div class="container-fluid p-4 text-center">
            <img src="<?php echo $file ?>" id="img1" class="rounded-circle mb-3" style="width: 150px; height: 150px;">
            <div>
                <label for="upload" class="btn btn-light">
                    <i class="fa-solid fa-pen-to-square" style="font-size: 20px;"></i> Edit Profile Picture
                </label>
                <form action="#" method="POST">
                <input type="file" name="upload" id="upload" style="display:none" accept="image/png, image/gif, image/jpeg">
                <textarea id="file" name="file" style="display:none"></textarea>
            </div>

            <?php include_once('./backend/profile_sql.php'); ?>
                
                
                <div class="mb-3 text-start">
                    <label for="fname" class="form-label">First Name</label>
                    <input type="text" class="form-control" name="fname" value="<?php echo $fname; ?>" required>
                </div>
                <div class="mb-3 text-start">
                    <label for="lname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="lname" value="<?php echo $lname; ?>" required>
                </div>
                <div class="mb-3 text-start">
                    <label for="birthday" class="form-label">Birthday</label>
                    <input type="date" class="form-control" name="birthday" value="<?php echo $birthday; ?>" required>
                </div>
                <div class="mb-3 text-start">
                    <label for="occupation" class="form-label">Occupation</label>
                    <input type="text" class="form-control" name="occupation" value="<?php echo $occupation; ?>" required>
                </div>
                <div class="mb-3 text-start">
                    <label for="company" class="form-label">Company</label>
                    <input type="text" class="form-control" name="company" value="<?php echo $company; ?>" required>
                </div>
                <div class="mb-3 text-start">
                    <label for="region" class="form-label">Region</label>
                    <select name="region" class="form-select" required>
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
                <div class="mb-3 text-start">
                    <label for="city" class="form-label">Province</label>
                    <input type="text" class="form-control" name="city" value="<?php echo $city; ?>" required>
                </div>
                <input type="hidden" name="program" value="<?php echo $program; ?>">
                <div class="d-flex justify-content-end">
    <button type="submit" name="submit" class="btn btn-primary me-2">Save</button>
    <button type="button" class="btn btn-secondary" onclick="window.location='index.php';">Cancel</button>
</div>

</form>
            </form>
        
  
    
    <div class="d-flex justify-content-end">
    <button type="button" class="btn btn-warning mt-2" onclick="window.location='feature_profile.php';">Featured Alumni Form</button>
      </div>

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
