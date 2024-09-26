<?php
include('../../auth.php');
include('../../connect.php');
$username = $_SESSION['username'];

// Fetch logged-in user details
$sql1 = "SELECT * FROM alumni WHERE username = '$username'";
$result1 = $conn->query($sql1);
while($row1 = $result1->fetch_assoc()) {
    $alumni_id = $row1['id'];
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

// Fetch all events from the database
$sql2 = "SELECT events.*, events_category.name AS categoryName 
         FROM events 
         JOIN events_category ON events.category_id = events_category.id 
         ORDER BY eventStartDate DESC";

$result2 = $conn->query($sql2);

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
      <div class="row justify-content-center">
      <h3 class="text-center mb-4" style="color:#752738;">Look for events</h3>

      <!-- Search and select area -->
      <div class="row justify-content-end align-items-center mb-5">
        <!-- Select in the middle -->
        <div class="col-auto">
            <select class="form-select" aria-label="Default select example">
                <option selected disabled>Select Status</option>
                <option value="">All</option>
                <option value="">Scheduled</option>
                <option value="">Ongoing</option>
                <option value="">Completed</option>
            </select>
        </div>

        <div class="col-auto">
        <select class="form-select" name="category_id">
                <option selected disabled>Select Category</option>
                <?php
                $categories_sql = "SELECT id, name FROM events_category";
                $categories_result = $conn->query($categories_sql);
                while ($category = $categories_result->fetch_assoc()) {
                    echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
                }
                ?>
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
      </div>

      

        <!-- Event Cards (Dynamic Content) -->
        <div class="row justify-content-center">
          <?php while($row2 = $result2->fetch_assoc()): 
            $event_id = $row2['event_id'];
            $participation_sql = "SELECT participationStatus FROM events_participation WHERE event_id = $event_id AND alumni_id = $alumni_id";
            $participation_result = $conn->query($participation_sql);
            $participation_status = ($participation_result->num_rows > 0) ? $participation_result->fetch_assoc()['participationStatus'] : 'Not participating';

            $volunteer_sql = "SELECT volunteerStatus FROM events_volunteer WHERE event_id = $event_id AND alumni_id = $alumni_id";
            $volunteer_result = $conn->query($volunteer_sql);
            $volunteer_status = ($volunteer_result->num_rows > 0) ? $volunteer_result->fetch_assoc()['volunteerStatus'] : 'Not volunteering';
            ?>
          <div class="col-md-12 mb-3">
            <div class="card event-card border-0 shadow-sm h-100" style="transition: transform 0.5s;">
              <div class="row g-0">
                <div class="col-md-3 col-12">
                  <img src="<?php echo $row2['eventImage'] ?>" class="img-fluid rounded-start p-2 w-100" alt="Event Image" style="height: 200px;">
                </div>
                <div class="col-md-7 col-12">
                  <div class="card-body">
                    <h5 class="card-title text-muted"><strong><?php echo $row2['eventName']; ?></strong></h5>
                    <p class="card-subtitle mb-1"><strong>Description: </strong><?php echo $row2['eventDetails']; ?></p>
                    <p class="card-text mb-1"><strong>Category: </strong><?php echo $row2['categoryName']; ?></p>
                    <p class="card-text mb-1"><strong>Date: </strong><?php echo date('F j, Y, g:i A', strtotime($row2['eventStartDate'])); ?></p>
                    <p class="card-text mb-1"><strong>Type: </strong><?php echo $row2['eventType']; ?></p>
                    <p class="card-text mb-1" style="color: <?php echo ($row2['eventStatus'] === 'Scheduled') ? 'orange' : (($row2['eventStatus'] === 'Ongoing') ? 'green' : 'red'); ?>"><strong style="color: black;">Status: </strong><?php echo $row2['eventStatus']; ?></p>
                  </div>
                </div>
                <div class="col-md-2 col-12 align-self-center p-2">
                  <div class="d-md-none d-flex justify-content-center">
                    <a href="#" class="btn btn-secondary px-4 py-2" data-bs-toggle="modal" data-bs-target="#eventModal-<?php echo $row2['event_id']; ?>">View</a>
                  </div>
                  <div class="d-none d-md-block text-end">
                    <a href="#" class="btn btn-secondary px-4 py-2 me-4" data-bs-toggle="modal" data-bs-target="#eventModal-<?php echo $row2['event_id']; ?>">View</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal for each event -->
          <div class="modal fade" id="eventModal-<?php echo $row2['event_id']; ?>" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="eventModalLabel">Event Details</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <br>
                <div class="modal-body">
                <h3 class="modal-title"><strong><?php echo $row2['eventName']; ?></strong></h3><br>
                <p class="modal-subtitle mb-1" style="text-align: justify;"><?php echo $row2['eventDetails']; ?></p><br>
                <p class="modal-text mb-1"><strong>Category: </strong><?php echo $row2['categoryName']; ?></p>
                <p class="modal-text mb-1"><strong>Start Date: </strong><?php echo date('F j, Y, g:i A', strtotime($row2['eventStartDate'])); ?></p>
                <p class="modal-text mb-1"><strong>End Date: </strong><?php echo date('F j, Y, g:i A', strtotime($row2['eventEndDate'])); ?></p>
                <p class="modal-text mb-1"><strong>Type: </strong><?php echo $row2['eventType']; ?></p>
                <p class="modal-text mb-1" style="color: <?php echo ($row2['eventStatus'] === 'Scheduled') ? 'orange' : (($row2['eventStatus'] === 'Ongoing') ? 'green' : 'red'); ?>"><strong style="color: black;">Status: </strong><?php echo $row2['eventStatus']; ?></p>
                <p class="modal-text mb-1" style="color: <?php echo ($participation_status === 'Pending') ? 'orange' : (($participation_status === 'Approved') ? 'green' : (($participation_status === 'Declined') ? 'red' : 'darkgrey')); ?>"><strong style="color: black;">Participation Status: </strong><?php echo $participation_status; ?></p>
                <p class="modal-text mb-1" style="color: <?php echo ($volunteer_status === 'Pending') ? 'orange' : (($volunteer_status === 'Approved') ? 'green' : (($volunteer_status === 'Declined') ? 'red' : 'darkgrey')); ?>"><strong style="color: black;">Volunteer Status: </strong><?php echo $volunteer_status; ?></p>
                <br>
                     <!-- Participate Form -->
        <div class="row">
          <div class="col-12 text-start">
          <form method="POST" action="submit_participation.php" onsubmit="return confirmSubmission('participation')">
    <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
    <input type="hidden" name="alumni_id" value="<?php echo $alumni_id; ?>">
    <div class="mb-2">
        <button type="submit" name="participate" class="btn btn-dark w-100">Participate</button>
    </div>
</form>
          </div>
        </div>

        <!-- Volunteer Form -->
        <div class="row">
          <div class="col-12 text-start">
          <form method="POST" action="submit_volunteer.php" onsubmit="return confirmSubmission('volunteer')">
              <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
              <input type="hidden" name="alumni_id" value="<?php echo $alumni_id; ?>">
              <div>
                  <button type="submit" name="volunteer" class="btn btn-warning w-100">Volunteer as Guest</button>
              </div>
          </form>
          </div>
        </div>

        

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php endwhile; ?>
        </div>
      </div>
    </div>
  </div>

  <script>
    function confirmSubmission(type) {
        return confirm("Are you sure you want to submit your " + type + " request?");
    }
</script>

<script>
      var el = document.getElementById("wrapper");
      var toggleButton = document.getElementById("menu-toggle");

      toggleButton.onclick = function() {
        el.classList.toggle("toggled");
      };
    </script>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>