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
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/yearbook.css" />
</head>

<style>
  #suggestions a {
    display: block;
    padding: 8px;
    cursor: pointer;
    text-decoration: none;
    color: #000;
    overflow: hidden;
  }
  #suggestions a:hover {
    background-color: #f1f1f1;
  }
</style>

<body>
  <?php include_once('./loader/loader.php'); ?>
  <?php include_once('./sidebar/sidebar.php'); ?>
  <?php include_once('./backend/yearbook_sql.php'); ?>
 

  <div id="page-content-wrapper">

  <?php include_once('./navbar/navbar.php'); ?>

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
    <div class="container py-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="primary-text mb-3">Request Your Yearbook</h1>
                    <p class="text-muted">Preserve your memories forever with our beautifully crafted yearbook. Request your copy today!</p>
                </div>
                <div class="col-md-4 text-end">
                    <button type="button" class="btn btn-warning action-button me-2" data-bs-toggle="modal" data-bs-target="#infoModal">
                        <i class="fas fa-info-circle me-2"></i>Loc. Info
                    </button>
                    <button type="button" class="btn btn-dark action-button" data-bs-toggle="modal" data-bs-target="#yearbookModal">
                        <i class="fas fa-book me-2"></i>Request Now
                    </button>
                </div>
            </div>
        </div>
<hr class="mb-4">

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
              <input type="text" class="form-control" id="student_number" name="student_number" value="<?php echo $global_studentnum ?>"readonly>
            </div>
            
            <div class="mb-3">
              <label for="fullname" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $global_name ?>"readonly>
            </div>

            <div class="mb-3">
            <label class="form-label">Select your accurate address here</label>
            <div id="map" style="height: 400px; width: 100%; display: block;"></div>
            </div>

            <div class="mb-3">
              <label for="address" class="form-label">Delivery Address</label>
              <div class="input-group position-relative">
                <input type="text" class="form-control" id="address" name="address" oninput="fetchSuggestions()" placeholder="Start typing address..." required>
                <button type="button" class="btn btn-outline-secondary" onclick="searchAddress()">Search</button>
                <button type="button" class="btn btn-outline-dark" id="use-location">Use My Location</button>
                
                <!-- Custom suggestions dropdown -->
                <div id="suggestions" class="dropdown-menu" style="display: none; position: absolute; top: 100%; left: 0; width: 100%; z-index: 1000;">
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="latitude" class="form-label">Latitude</label>
              <input type="text" class="form-control" id="latitude" name="latitude" required readonly>
            </div>
            
            <div class="mb-3">
              <label for="longitude" class="form-label">Longitude</label>
              <input type="text" class="form-control" id="longitude" name="longitude" required readonly>
            </div>
            
            <div class="mb-3">
              <label for="number" class="form-label">Phone Number</label>
              <div class="input-group">
                <span class="input-group-text">
                  <img src="https://cdn.jsdelivr.net/npm/country-flag-emoji-json@2.0.0/dist/images/PH.svg" alt="PH flag" style="width: 20px; height: 15px; margin-right: 5px;">
                  +63
                </span>
                <input type="text" id="number" name="number" class="form-control"
                    pattern="^9[0-9]{9}$"
                    placeholder="XXXXXXXXXX"
                    maxlength="10" 
                    required autocomplete="off">
              </div>

              <script>
                document.querySelector('form').addEventListener('submit', function(event) {
                  var numberInput = document.getElementById('number');
                  if (!numberInput.value.startsWith('+63')) {
                    numberInput.value = '+63' + numberInput.value;
                  }
                });
              </script>

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

  <!-- Script for leaflet api openstreetmap geolocation -->

  <script>
const map = L.map('map').setView([12.8797, 121.7740], 6);
const regions = [
    'Ilocos Region', 'Cagayan Valley', 'Central Luzon', 'CALABARZON', 'MIMAROPA', 'Bicol Region',
    'Western Visayas', 'Central Visayas', 'Eastern Visayas', 'Zamboanga Peninsula', 
    'Cordillera Administrative Region', 'Negros Island Region', 'Northern Mindanao',
    'Davao Region', 'SOCCSKSARGEN', 'Caraga', 'BARMM', 'NCR', 'CAR'
];

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

const marker = L.marker([12.8797, 121.7740], { draggable: true }).addTo(map);

// Add geolocation functionality
document.getElementById('use-location').addEventListener('click', function() {
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(function(position) {
            const { latitude, longitude } = position.coords;
            
            // Update map view and marker position
            map.setView([latitude, longitude], 15);
            marker.setLatLng([latitude, longitude]);
            
            // Update form fields
            document.getElementById("latitude").value = latitude.toFixed(6);
            document.getElementById("longitude").value = longitude.toFixed(6);
            
            // Get address for the location
            updateAddress(latitude, longitude);
        }, function(error) {
            // Handle geolocation errors
            let errorMessage = "Error getting your location: ";
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    errorMessage += "Location permission denied.";
                    break;
                case error.POSITION_UNAVAILABLE:
                    errorMessage += "Location information unavailable.";
                    break;
                case error.TIMEOUT:
                    errorMessage += "Location request timed out.";
                    break;
                default:
                    errorMessage += "An unknown error occurred.";
            }
            alert(errorMessage);
        }, {
            enableHighAccuracy: true,
            timeout: 25000,
            maximumAge: 0
        });
    } else {
        alert("Geolocation is not supported by your browser.");
    }
});

function updateAddress(lat, lng) {
    const url = `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json&addressdetails=1`;
    
    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data && data.display_name) {
                const cleanedAddress = removeRegions(data.display_name);
                document.getElementById("address").value = cleanedAddress;
            } else {
                document.getElementById("address").value = "Address not found";
            }
        })
        .catch(error => {
            console.error("Error fetching address:", error);
            document.getElementById("address").value = "Unable to fetch address";
        });
}

// Keep existing marker drag event
marker.on('dragend', function(e) {
    const position = marker.getLatLng();
    document.getElementById("latitude").value = position.lat.toFixed(6);
    document.getElementById("longitude").value = position.lng.toFixed(6);
    updateAddress(position.lat, position.lng);
});

// Keep existing map click event
map.on('click', function(e) {
    const { lat, lng } = e.latlng;
    marker.setLatLng([lat, lng]);
    document.getElementById("latitude").value = lat.toFixed(6);
    document.getElementById("longitude").value = lng.toFixed(6);
    updateAddress(lat, lng);
});

function removeRegions(address) {
    let cleanedAddress = address;
    regions.forEach(region => {
        const regex = new RegExp(`,?\\s*${region}`, 'gi');
        cleanedAddress = cleanedAddress.replace(regex, '');
    });
    return cleanedAddress;
}

  function fetchSuggestions() {
    const address = document.getElementById("address").value;
    const suggestionsContainer = document.getElementById("suggestions");

    // Hide suggestions if input is less than 3 characters
    if (address.length < 3) {
      suggestionsContainer.style.display = "none";
      return;
    }

    const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}&addressdetails=1&limit=5`;

    fetch(url)
      .then(response => response.json())
      .then(data => {
        suggestionsContainer.innerHTML = ""; // Clear previous suggestions

        if (data.length > 0) {
          data.forEach(place => {
            const suggestionItem = document.createElement("a");
            suggestionItem.className = "dropdown-item";
            suggestionItem.textContent = removeRegions(place.display_name);
            const cleanedPlace = {
                        ...place,
                        display_name: removeRegions(place.display_name)
                    };
                    suggestionItem.onclick = () => selectSuggestion(cleanedPlace);
                    suggestionsContainer.appendChild(suggestionItem);
                });
          suggestionsContainer.style.display = "block"; // Show suggestions dropdown
        } else {
          suggestionsContainer.style.display = "none"; // Hide if no results
        }
      })
      .catch(error => console.error("Error fetching suggestions:", error));
  }

  function selectSuggestion(place) {
    const { display_name, lat, lon } = place;

    // Set the selected address in the input
    document.getElementById("address").value = display_name;

    // Set the latitude and longitude fields
    document.getElementById("latitude").value = parseFloat(lat).toFixed(6);
    document.getElementById("longitude").value = parseFloat(lon).toFixed(6);

    // Update the map and marker position
    map.setView([lat, lon], 15);
    marker.setLatLng([lat, lon]);

    // Hide the suggestions dropdown
    document.getElementById("suggestions").style.display = "none";
  }

  // Search function to update map and marker based on selected address
  function searchAddress() {
    const address = document.getElementById("address").value;
    const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}&limit=1`;

    fetch(url)
      .then(response => response.json())
      .then(data => {
        if (data.length > 0) {
          const cleanedResult = {
                    ...data[0],
                    display_name: removeRegions(data[0].display_name)
                };
                selectSuggestion(cleanedResult);
        } else {
          alert("Address not found. Please enter a different address.");
        }
      })
      .catch(error => {
        console.error("Error fetching coordinates:", error);
        alert("An error occurred while searching for the address.");
      });
  }

  // Hide suggestions if clicked outside
  document.addEventListener("click", function(event) {
    if (!document.getElementById("address").contains(event.target)) {
      document.getElementById("suggestions").style.display = "none";
    }
  });

  document.getElementById('yearbookModal').addEventListener('shown.bs.modal', function () {
                  map.invalidateSize();
              });
            </script>
  
 

  <!-- Yearbook Request Status Card -->
  <div class="container mb-5">
            <div class="status-card card border-0">
                <div class="card-header text-white text-center py-3" style="background-color: #6B1500">
                    <h4 class="mb-0">Your Yearbook Request Status</h4>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-3">Student Details</h6>
                            <p><strong>Student Number:</strong> <span id="student-number"><?php echo htmlspecialchars($student_number); ?></span></p>
                            <p><strong>Full Name:</strong> <span id="full-name"><?php echo htmlspecialchars($fullname); ?></span></p>
                            <p><strong>Delivery Address:</strong> <span id="order-id"><?php echo htmlspecialchars($address); ?></span></p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-3">Request Information</h6>
                            <p><strong>Request Status:</strong> 
                                <span class="badge rounded-pill <?php 
                                    if ($request_status === 'Pending') {
                                        echo 'bg-warning text-dark';
                                    } elseif ($request_status === 'Approved') {
                                        echo 'bg-success';
                                    } else {
                                        echo 'bg-danger';
                                    }
                                ?>">
                                    <?php echo htmlspecialchars($request_status); ?>
                                </span>
                                
                                <?php if ($request_status === 'Pending'): ?>
                                  <button class="btn btn-danger btn-sm ms-md-2" onclick="confirmCancel(<?php echo $alumni_id; ?>)">
                                      <i class="fas fa-times-circle me-1"></i>Cancel
                                  </button>

                            <?php endif; ?>
                                
                            </p>
                            <p><strong>Order ID:</strong> <span id="order-id"><?php echo htmlspecialchars($order_id); ?></span></p>
                            <?php if ($request_status === 'Approved' && ($order_id === 'N/A')): ?>
                                <div class="alert alert-info mt-3">
                                    <i class="fas fa-info-circle me-2"></i>Your request has been approved. The admin will generate your order ID soon.
                                </div>
                            <?php endif; ?>
                            <p><strong>Remarks:</strong> <span id="remarks"><?php echo htmlspecialchars($remarks); ?></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mb-5">
            <h4 class="primary-text mb-4">How to Request Your Yearbook</h4>
            <div class="steps-container">
                <div class="step-item">
                    <h5><i class="fas fa-check-circle me-2 text-success"></i>Check Your Eligibility</h5>
                    <p class="text-muted mb-0">Ensure your tuition is fully paid/no balance and you haven't received a yearbook yet.</p>
                </div>
                <div class="step-item">
                    <h5><i class="fas fa-map-marker-alt me-2 text-danger"></i>Get Your Location's Accurate Coordinates</h5>
                    <p class="text-muted mb-0"> Select your accurate delivery address on the map to get your precise delivery coordinates.</p>
                </div>
                <div class="step-item">
                    <h5><i class="fas fa-paper-plane me-2 text-primary"></i>Submit Your Request</h5>
                    <p class="text-muted mb-0">Fill out the request form with your details and delivery information.</p>
                </div>
                <div class="step-item">
                    <h5><i class="fas fa-clock me-2 text-warning"></i>Track Your Request</h5>
                    <p class="text-muted mb-0">Use your Order ID to track the status of your yearbook delivery.</p>
                </div>
            </div>
        </div>
        <div id="spacing"> </div>
<style>
  #spacing {
    height: 10px;
  }
</style>


    <!-- Request Notice -->
    <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">Yearbook Request  Privacy Notice</h5>
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

    <!-- Location Guide Modal -->
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="infoModalLabel">How to get your accurate delivery address?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          1. Select your accurate address by using the map embed in the form.</a> <br> <br>
          2. Click within the map using the marker to pinpoint location.<br> <br>
          3. It will automatically give you the latitude and longitude of your address. <br> <br>
          4. It will also automatically give you the address name in the address field. <br> <br>
          5. If the address is not accurate, you can manually input the address in the address field. <br> <br>
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
    function confirmCancel(alumniId) {
        if (confirm('Are you sure you want to cancel your yearbook request?')) {
            window.location.href = 'cancel_yearbook.php?alumni_id=' + alumniId;
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
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/facebox/1.3.8/facebox.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/facebox/1.3.8/facebox.min.js"></script>

</body>

</html>
