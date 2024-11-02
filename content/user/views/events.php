<?php include_once('./backend/client.php'); ?>
<?php include_once('./backend/event_sql.php'); ?>

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
  <link rel="stylesheet" type="text/css" href="../css/event.css"/>
</head>

<body>
<?php include_once('./loader/loader.php'); ?>
  <?php include_once('./sidebar/sidebar.php'); ?>


  <div id="page-content-wrapper">
    
  <?php include_once('./navbar/navbar.php'); ?>

    <div class="d-flex px-3 py-3 align-items-center" style="margin-bottom: 20px;">
    <img src="<?php echo $file ?>" style="width:90px; height:75px; border-radius:50%; margin-right: 15px;">
    <div class="col-md-5">
        <h3 class="text-themecolor" style="font-size: 1.5em; color:#752738 !important; margin-bottom: 5px;">Events</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)" style="color:#000 !important;">Home</a></li>
            <li class="breadcrumb-item active">Events</li>
        </ol>
    </div>
</div>

    <div class="container my-5">
      <div class="row justify-content-center">
      <h3 class="text-center mb-4" style="color:#752738;">Look for events</h3>
      <hr class="mb-4">

      <!-- Search and select area -->
      <div class="row justify-content-end align-items-center mb-5">
        <!-- Select in the middle -->
        <div class="col-auto">
        <form action="events.php" method="GET">
        <select class="form-select" name="status" onchange="this.form.submit()">
            <option value="" <?php if (!isset($_GET['status']) || $_GET['status'] == '') echo 'selected'; ?>>All</option>
            <option value="Scheduled" <?php if (isset($_GET['status']) && $_GET['status'] == 'Scheduled') echo 'selected'; ?>>Scheduled</option>
            <option value="Ongoing" <?php if (isset($_GET['status']) && $_GET['status'] == 'Ongoing') echo 'selected'; ?>>Ongoing</option>
            <option value="Completed" <?php if (isset($_GET['status']) && $_GET['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
        </select>
        </div>

        <div class="col-auto">
        <select class="form-select" name="category_id" onchange="this.form.submit()">
            <option value="" <?php if (!isset($_GET['category_id']) || $_GET['category_id'] == '') echo 'selected'; ?>>All</option>
            <?php
            $categories_sql = "SELECT id, name FROM events_category";
            $categories_result = $conn->query($categories_sql);
            while ($category = $categories_result->fetch_assoc()) {
                $selected = (isset($_GET['category_id']) && $_GET['category_id'] == $category['id']) ? 'selected' : '';
                echo '<option value="' . $category['id'] . '" ' . $selected . '>' . $category['name'] . '</option>';
            }
    ?>
</select>
          </form>
        </div>

        <!-- Search input and button on the right -->
        <div class="col-lg-5 col-md-6 col-sm-12 mt-3 mt-md-0">
                  <form class="d-flex" action="events.php" method="GET">
            <input class="form-control me-2" type="search" name="search" placeholder="Search events..." aria-label="Search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
          </form>
        </div>
        </div>
      </div>

      

        <!-- Event Cards (Dynamic Content) -->
        <div class="row justify-content-center">
        <?php if ($result2->num_rows === 0) {
    echo '<p class="text-center text-muted">There are no events in this category yet.</p>';
} else { ?>
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
                    <p class="card-text mb-1">
                    <strong style="color: black;">Status: </strong>
                    <span class="badge rounded-pill 
                      <?php 
                        if ($row2['eventStatus'] === 'Scheduled') {
                          echo 'bg-warning text-dark'; // Orange for scheduled
                        } elseif ($row2['eventStatus'] === 'Ongoing') {
                          echo 'bg-success'; // Green for ongoing
                        } else {
                          echo 'bg-danger'; // Red for any other status
                        }
                      ?>">
                      <?php echo $row2['eventStatus']; ?>
                    </span>
                      </p>
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
                <p class="modal-text mb-1">
  <strong style="color: black;">Status: </strong>
  <span class="badge rounded-pill 
    <?php 
      if ($row2['eventStatus'] === 'Scheduled') {
        echo 'bg-warning text-dark';
      } elseif ($row2['eventStatus'] === 'Ongoing') {
        echo 'bg-success';
      } else {
        echo 'bg-danger';
      }
    ?>">
    <?php echo $row2['eventStatus']; ?>
  </span>
</p>

<p class="modal-text mb-1">
  <strong style="color: black;">Participation Status: </strong>
  <span class="badge rounded-pill 
    <?php 
      if ($participation_status === 'Pending') {
        echo 'bg-warning text-dark'; // Orange for pending
      } elseif ($participation_status === 'Approved') {
        echo 'bg-success'; // Green for approved
      } elseif ($participation_status === 'Declined') {
        echo 'bg-danger'; // Red for declined
      } else {
        echo 'bg-secondary'; // Dark grey for any other status
      }
    ?>">
    <?php echo $participation_status; ?>
  </span>
</p>

<p class="modal-text mb-1">
  <strong style="color: black;">Volunteer Status: </strong>
  <span class="badge rounded-pill 
    <?php 
      if ($volunteer_status === 'Pending') {
        echo 'bg-warning text-dark'; // Orange for pending
      } elseif ($volunteer_status === 'Approved') {
        echo 'bg-success'; // Green for approved
      } elseif ($volunteer_status === 'Declined') {
        echo 'bg-danger'; // Red for declined
      } else {
        echo 'bg-secondary'; // Dark grey for any other status
      }
    ?>">
    <?php echo $volunteer_status; ?>
  </span>
</p>
                     <!-- Participate Form -->
        <?php if ($row2['eventStatus'] !== 'Completed'): ?>
          <?php if ($participation_status !== 'Declined' && $participation_status !== 'Pending' && $participation_status !== 'Approved'): ?>
        <div class="row">
          <div class="col-12 text-start">
          <form method="POST" action="submit_participation.php" onsubmit="return confirmSubmission('participation')">
    <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
    <input type="hidden" name="alumni_id" value="<?php echo $alumni_id; ?>">
    <input type="hidden" name="fname" value="<?php echo $fname; ?>">
    <input type="hidden" name="lname" value="<?php echo $lname; ?>">
    <div class="mb-2">
        <button type="submit" name="participate" class="btn btn-dark w-100">Participate</button>
    </div>
</form>
          </div>
        </div>
        <?php endif; ?>
        <!-- Volunteer Form -->
        <?php if ($volunteer_status !== 'Declined' && $volunteer_status !== 'Pending' && $volunteer_status !== 'Approved'): ?>
        <div class="row">
    <div class="col-12 text-start">
        <form method="POST" action="submit_volunteer.php" onsubmit="return confirmVolunteerSubmission()">
            <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
            <input type="hidden" name="alumni_id" value="<?php echo $alumni_id; ?>">
            <input type="hidden" name="fname" value="<?php echo $fname; ?>">
            <input type="hidden" name="lname" value="<?php echo $lname; ?>">
            
            <!-- Role Selection -->
            <div class="mb-3">
                <label for="role" class="form-label"><strong>Select Volunteer Role (Select only if you wish to volunteer):</strong></label>
                <select name="role" id="role" class="form-select" required>
                    <option selected disabled>Choose your role</option>
                    <option value="Guest Speaker">Guest Speaker</option>
                    <option value="Beneficiary">Beneficiary</option>
                    <option value="Host">Host</option>
                    <!-- Add more roles as needed -->
                </select>
            </div>
            
            <div>
                <button type="submit" name="volunteer" class="btn btn-warning w-100">Submit Volunteer Request</button>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>
<?php endif; ?>

        

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php endwhile; ?>
          <?php
}
?>
        </div>
        <?php if ($total_events > 0): ?>
<nav aria-label="Event page navigation" class="mt-2">
  <ul class="pagination justify-content-center">
    <!-- Previous Button -->
    <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
      <a class="page-link" href="?page=<?php echo $page - 1; ?>&status=<?php echo urlencode($status); ?>&category_id=<?php echo urlencode($category_id); ?>&search=<?php echo urlencode(isset($_GET['search']) ? $_GET['search'] : ''); ?>" tabindex="-1" aria-disabled="true">Previous</a>
    </li>

    <!-- Page Numbers -->
    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
      <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
        <a class="page-link" href="?page=<?php echo $i; ?>&status=<?php echo urlencode($status); ?>&category_id=<?php echo urlencode($category_id); ?>&search=<?php echo urlencode(isset($_GET['search']) ? $_GET['search'] : ''); ?>"><?php echo $i; ?></a>
      </li>
    <?php endfor; ?>

    <!-- Next Button -->
    <li class="page-item <?php if ($page >= $total_pages) echo 'disabled'; ?>">
      <a class="page-link" href="?page=<?php echo $page + 1; ?>&status=<?php echo urlencode($status); ?>&category_id=<?php echo urlencode($category_id); ?>&search=<?php echo urlencode(isset($_GET['search']) ? $_GET['search'] : ''); ?>">Next</a>
    </li>
  </ul>
</nav>
<?php endif; ?>
      </div>
    </div>
  </div>

  <script>
    function confirmSubmission(type) {
        return confirm("Are you sure you want to submit your " + type + " request?");
    }
</script>

<script>
function confirmVolunteerSubmission() {
    const selectedRole = document.getElementById("role").value;
    if (selectedRole) {
        return confirm("Are you sure you want to volunteer?");
    } else {
        alert("Please select a role before submitting.");
        return false;
    }
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