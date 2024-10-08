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

  <link rel="stylesheet" href="../css/events.css" />
</head>

<body>
  
  <?php include_once('./sidebar/sidebar.php'); ?>

   <div id="page-content-wrapper">

    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4 border-bottom" id="top-bar">
      <div class="d-flex align-items-center justify-content-between w-100">
        <div class="d-flex align-items-center">
          <i class="fa fa-bars primary-text fs-4 me-3" id="menu-toggle" aria-hidden="true"></i>
          <h2 class="fs-4 m-0" style="color:#752738">Events</h2>
        </div>
        <li class="d-flex align-items-center">
          <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="<?php echo $file ?>" alt="Admin Avatar" class="rounded-circle me-2" style="width: 40px; height: 40px;" onclick="window.location='profile.php'">
            <span class="fs-6 alumni-text" onclick="window.location='profile.php'"><?php echo $fname . ' ' . $lname ?> &nbsp; </span>
          </a>
        </li>
      </div>
    </nav>

    <div class="container my-5">
      <h3 class="text-center mb-4" style="color:#752738;">Look for events</h3>

      <!-- Search and select area -->
      <div class="row justify-content-end align-items-center mb-5">
        <!-- Select in the middle -->
        <div class="col-auto">
            <select class="form-select" aria-label="Default select example">
                <option selected disabled>Status</option>
                <option value="">Scheduled</option>
                <option value="">Ongoing</option>
                <option value="">Completed</option>
            </select>
        </div>

        <div class="col-auto">
            <select class="form-select" aria-label="Default select example">
                <option selected>Select Category</option>
                <option value=""></option>
                <option value=""></option>
                <option value=""></option>
            </select>
        </div>

        <!-- Search input and button on the right -->
        <div class="col-lg-5 col-md-6 col-sm-12 mt-3 mt-md-0">
            <form class="d-flex" action="forums.php" method="GET">
                <input class="form-control me-2" type="search" name="search" placeholder="Search events..." aria-label="Search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </form>
        </div>
      </div>

      

    <!-- Event Cards -->
     <!-- Responsive Event Cards -->
  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    <div class="col">
      <div class="card h-100">
        <img src="https://cdn.pixabay.com/photo/2016/11/23/15/48/audience-1853662_640.jpg" class="card-img-top p-2" alt="Event Image" style="object-fit: fill; height: 200px;">
        <div class="card-body">
          <h5 class="card-title text-muted"><strong>Event Title 1</strong></h5>
          <p class="card-text">Category: Tech Conference</p>
          <p class="card-text">Type: Online</p>
          <p class="card-text">Status: Scheduled</p>
        </div>
        <div class="card-footer text-end">
          <a href="#" class="btn btn-outline-secondary px-4 py-2">View</a>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card h-100">
        <img src="https://cdn.prod.website-files.com/634e7aa49f5b025e1fd9e87b/652039f6d6eec22bc94097d5_Man_Having_Group_Videoconference_On_Laptop.jpeg" class="card-img-top p-2" alt="Event Image" style="object-fit: fill; height: 200px;">
        <div class="card-body">
          <h5 class="card-title text-muted"><strong>Event Title 2</strong></h5>
          <p class="card-text">Category: Tech Conference</p>
          <p class="card-text">Type: Online</p>
          <p class="card-text">Start: September 26, 2024, 10:00 AM</p>
          <p class="card-text">End: September 26, 2024, 4:00 PM</p>
        </div>
        <div class="card-footer text-end">
          <a href="#" class="btn btn-outline-secondary px-4 py-2">View</a>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card h-100">
        <img src="https://cdn.prod.website-files.com/634e7aa49f5b025e1fd9e87b/652039f6d6eec22bc94097d5_Man_Having_Group_Videoconference_On_Laptop.jpeg" class="card-img-top p-2" alt="Event Image" style="object-fit: fill; height: 200px;">
        <div class="card-body">
          <h5 class="card-title text-muted"><strong>Event Title 2</strong></h5>
          <p class="card-text">Category: Tech Conference</p>
          <p class="card-text">Type: Online</p>
          <p class="card-text">Start: September 26, 2024, 10:00 AM</p>
          <p class="card-text">End: September 26, 2024, 4:00 PM</p>
        </div>
        <div class="card-footer text-end">
          <a href="#" class="btn btn-outline-secondary px-4 py-2">View</a>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card h-100">
        <img src="https://cdn.prod.website-files.com/634e7aa49f5b025e1fd9e87b/652039f6d6eec22bc94097d5_Man_Having_Group_Videoconference_On_Laptop.jpeg" class="card-img-top p-2" alt="Event Image" style="object-fit: fill; height: 200px;">
        <div class="card-body">
          <h5 class="card-title text-muted"><strong>Event Title 2</strong></h5>
          <p class="card-text">Category: Tech Conference</p>
          <p class="card-text">Type: Online</p>
          <p class="card-text">Start: September 26, 2024, 10:00 AM</p>
          <p class="card-text">End: September 26, 2024, 4:00 PM</p>
        </div>
        <div class="card-footer text-end">
          <a href="#" class="btn btn-outline-secondary px-4 py-2">View</a>
        </div>
      </div>
    </div>


<!-- <div class="list-group">
   // <?php foreach ($events as $event): ?>
        <div class="d-flex align-items-center bg-white text-secondary flex-wrap mb-3">
            <img src="<?php echo $event['image']; ?>" alt="Event Image" class="p-2" style="width: 200px; height: 150px;">
            <div class="flex-grow-1 p-2">
                <h5 class="mb-0 text-muted"><strong><?php echo $event['title']; ?></strong></h5>
                <p class="mb-1">Category: <?php echo $event['category']; ?></p>
                <p class="mb-1">Type: <?php echo $event['type']; ?></p>
                <p class="mb-1">Start: <?php echo $event['start']; ?></p>
                <p class="mb-1">End: <?php echo $event['end']; ?></p>
            </div>
            <div class="text-end p-2">
                <a href="#" class="btn btn-outline-secondary px-4 py-2">View</a>
            </div>
        </div>
   // <?php endforeach; ?>
</div> -->
                
            


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
