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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/philippine-location-json-for-geer@latest/philippine-location.json"></script>
  <link rel="stylesheet" type="text/css" href="../css/profiles.css"/>
</head>

<body>
<?php include_once('./loader/loader.php'); ?>
  <?php include_once('./sidebar/sidebar.php'); ?>

  <div id="page-content-wrapper">
    

  <?php include_once('./navbar/navbar.php'); ?>

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
                    <p class="text-muted mb-1"><?php echo $username ?></p>
                    <p class="text-muted mt-1"><?php echo $occupation ?></p>
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
                            <label for="studentnumber" class="form-label">Student Number</label>
                            <input type="text" class="form-control" name="studentnumber" value="<?php echo $studentnumber; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="occupation" class="form-label">Occupation</label>
                            <select id="occupation" name="occupation" class="form-select" required> 
                                <optgroup label="Current occupation">
                                <option><?php echo $occupation?></option>
                                <?php include_once('profile_job.php'); ?>
                            </select>
                            </div>

                        <!-- here -->
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
                            <select name="region" id="region" class="form-select" required onchange="loadProvinces(this.value)">
                                <option><?php echo $region; ?></option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="province" class="form-label">Province</label>
                            <select name="province" id="province" class="form-select" required onchange="loadCities(this.value)">
                                <option><?php echo $province; ?></option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <select name="city" id="city" class="form-select" required>
                                <option><?php echo $city; ?></option>
                            </select>
                        </div>
                    </div>

                    <script>
    // Load Regions
    async function loadRegions() {
        try {
            const response = await fetch('https://psgc.gitlab.io/api/regions/');
            const regions = await response.json();

            const regionSelect = document.getElementById('region');
            regionSelect.innerHTML = '<option><?php echo $region ? $region : "Select a Region"; ?></option>';
            
            regions.forEach(region => {
                const option = document.createElement('option');
                option.value = region.code;
                option.dataset.name = region.name; // Store full name
                option.textContent = region.name;
                regionSelect.appendChild(option);
            });
        } catch (error) {
            console.error('Error loading regions:', error);
        }
    }

    // Load Provinces by Region Code
    async function loadProvinces(regionCode) {
        try {
            const response = await fetch(`https://psgc.gitlab.io/api/regions/${regionCode}/provinces/`);
            const provinces = await response.json();

            const provinceSelect = document.getElementById('province');
            provinceSelect.innerHTML = '<option><?php echo $province ? $province : "Select a Province"; ?></option>';
            
            provinces.forEach(province => {
                const option = document.createElement('option');
                option.value = province.code;
                option.dataset.name = province.name; // Store full name
                option.textContent = province.name;
                provinceSelect.appendChild(option);
            });
        } catch (error) {
            console.error('Error loading provinces:', error);
        }
    }

    // Load Cities by Province Code
    async function loadCities(provinceCode) {
        try {
            const response = await fetch(`https://psgc.gitlab.io/api/provinces/${provinceCode}/cities-municipalities/`);
            const cities = await response.json();

            const citySelect = document.getElementById('city');
            citySelect.innerHTML = '<option><?php echo $city ? $city : "Select a City"; ?></option>';

            cities.forEach(city => {
                const option = document.createElement('option');
                option.value = city.code;
                option.dataset.name = city.name; // Store full name
                option.textContent = city.name;
                citySelect.appendChild(option);
            });
        } catch (error) {
            console.error('Error loading cities:', error);
        }
    }

    // Modified form submission to capture names
        document.querySelector('form').addEventListener('submit', function(e) {
        const regionSelect = document.getElementById('region');
        const provinceSelect = document.getElementById('province');
        const citySelect = document.getElementById('city');

        // Capture the selected names
        const regionName = regionSelect.options[regionSelect.selectedIndex].dataset.name || regionSelect.value;
        const provinceName = provinceSelect.options[provinceSelect.selectedIndex].dataset.name || provinceSelect.value;
        const cityName = citySelect.options[citySelect.selectedIndex].dataset.name || citySelect.value;

        // Create hidden inputs to send names
        const regionNameInput = document.createElement('input');
        regionNameInput.type = 'hidden';
        regionNameInput.name = 'region_name';
        regionNameInput.value = regionName;
        this.appendChild(regionNameInput);

        const provinceNameInput = document.createElement('input');
        provinceNameInput.type = 'hidden';
        provinceNameInput.name = 'province_name';
        provinceNameInput.value = provinceName;
        this.appendChild(provinceNameInput);

        const cityNameInput = document.createElement('input');
        cityNameInput.type = 'hidden';
        cityNameInput.name = 'city_name';
        cityNameInput.value = cityName;
        this.appendChild(cityNameInput);
    });

    // Initialize Regions on Page Load
    document.addEventListener('DOMContentLoaded', loadRegions);
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

<script>
    $(document).ready(function() {
        $('#occupation').select2({
            placeholder: "Select or search an occupation"
        });
    });

    console.log(typeof jQuery); // Should output "function"
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/facebox/1.3.8/facebox.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/facebox/1.3.8/facebox.min.js"></script>

</body>

</html>
