<?php include_once('./backend/client.php'); ?>
<?php include_once('./backend/events_admin_sql.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Alumnite</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" type="image/png" sizes="512x512" href="../../assets/img/favicon/logo.png">
  <link rel="stylesheet" type="text/css" href="../css/events.css"/>
</head>

<style>
    @media (max-width: 767px) {
    .admin-text {
        display: none !important;
    }
}
</style>

<body>
<?php include_once('./loader/loader.php'); ?>
  <?php include_once('./sidebar/sidebar.php'); ?>

  <div id="page-content-wrapper">
  <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4 border-bottom" id="top-bar">
      <div class="d-flex align-items-center justify-content-between w-100">
        <div class="d-flex align-items-center">
          <i class="fa fa-bars primary-text fs-4 me-3" id="menu-toggle"  aria-hidden="true"></i>
          <h2 class="fs-4 m-0" style="color:#752738"></h2>
        </div>
        <li class="d-flex align-items-center">
          <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="../images/admin-logo.jpg" alt="Admin Avatar" class="rounded-circle me-2" style="width: 40px; height: 40px;">
          <span class="fs-6 admin-text">Administrator &nbsp;</span></a>
        </li>
      </div>
    </nav>

    <div class="d-flex px-3 py-3 align-items-center" style="margin-bottom: 20px;">
    <img src="../images/admin-logo.jpg" style="width:90px; height:75px; border-radius:50%; margin-right: 15px;">
    <div class="col-md-5">
        <h3 class="text-themecolor" style="font-size: 1.5em; color:#752738 !important; margin-bottom: 5px;">Events Management</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)" style="color:#000 !important;">Home</a></li>
            <li class="breadcrumb-item active">Events Management</li>
        </ol>
    </div>
</div>

    <div class="container my-5">
      <div class="row justify-content-center">
      <h3 class="text-center mb-4" style="color:#752738;">Look for events</h3>
      <div class="row mb-4">

      <!-- Adding new category and new events button -->
  <div class="col-md-12 d-flex justify-content-end">
    <button data-bs-toggle="modal" data-bs-target="#addCategoryModal" class="btn btn-secondary me-3">Add New Category</button>
    
    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#createEventModal">
  Add New Event
</button>
  </div>
</div>

<!-- Pop up modal when clicking the Add Category button -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addCategoryForm" action="add_event_category.php" method="POST">
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="categoryName" name="categoryName" required autocomplete="off">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Category</button>
                </form>
            </div>
        </div>
    </div>
</div>

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
                    <a href="#" class="btn btn-dark px-4 py-2 me-2" data-bs-toggle="modal" data-bs-target="#eventModal-<?php echo $row2['event_id']; ?>"><i class="fas fa-eye"></i></a>
                    <a href="#" class="btn btn-dark px-4 py-2" data-bs-toggle="modal" data-bs-target="#updateStatusModal-<?php echo $row2['event_id']; ?>"><i class="fas fa-cog"></i></a>
                  </div>
                  <div class="d-md-none d-flex justify-content-center">
                  <a href="#" class="btn btn-dark px-4 py-2 mt-2 me-2 open-modal"  data-event-id="<?php echo $event_id; ?>"  data-bs-toggle="modal" data-bs-target="#eventModal"><i class="fa fa-user-plus" aria-hidden="true"></i></a>
                  <a href="delete_event.php?id=<?php echo $row2['event_id']; ?>" onclick="return confirm('Are you sure you want to delete this event?');" class="btn btn-danger px-4 py-2 mt-2"><i class="fa fa-trash" aria-hidden="true"></i></a>
                  </div>
                  <div class="d-none d-md-block text-end d-flex justify-content-end align-items-center">
                      <!-- First Set of Buttons (Eye & Cog) -->
                      <a href="#" class="btn btn-dark px-4 py-2 me-1" data-bs-toggle="modal" data-bs-target="#eventModal-<?php echo $row2['event_id']; ?>"><i class="fas fa-eye"></i></a>
                      <a href="#" class="btn btn-dark px-4 py-2 me-1" data-bs-toggle="modal" data-bs-target="#updateStatusModal-<?php echo $row2['event_id']; ?>"><i class="fas fa-cog"></i></a>
                  </div>
                  <div class="d-none d-md-block text-end d-flex justify-content-end align-items-center mt-1 ">
                      <!-- Second Set of Buttons (User-Plus & Trash) -->
                      <a href="#" class="btn btn-dark px-4 py-2 me-1 open-modal" data-event-id="<?php echo $event_id; ?>" data-bs-toggle="modal" data-bs-target="#eventModal">
    <i class="fa fa-user-plus" aria-hidden="true"></i>
</a>
</a>
                      <a href="delete_event.php?id=<?php echo $row2['event_id']; ?>" onclick="return confirm('Are you sure you want to delete this event?');" class="btn btn-danger px-4 py-2 me-1"><i class="fa fa-trash" aria-hidden="true"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Pop up modal for Participation and Volunteer Table button -->
  <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="eventModalLabel">Select an Action</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Select which table you want to view:</p>
        <div class="d-grid gap-2">
          <!-- Events Participation Button -->
          <button id="participationBtn" class="btn btn-primary">View Events Participation Table</button>
          <!-- Events Volunteer Button -->
          <button id="volunteerBtn" class="btn btn-secondary">View Events Volunteer Table</button>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
  $total_approved_sql = "SELECT COUNT(*) AS approved_count FROM events_participation WHERE event_id = $event_id AND participationStatus = 'approved'";
  $total_approved_result = $conn->query($total_approved_sql);
  $total_approved_row = $total_approved_result->fetch_assoc();
  $total_approved = $total_approved_row['approved_count'];
?>

<?php
  $total_pending_sql = "SELECT COUNT(*) AS pending_count FROM events_participation WHERE event_id = $event_id AND participationStatus = 'pending'";
  $total_pending_result = $conn->query($total_pending_sql);
  $total_pending_row = $total_pending_result->fetch_assoc();
  $total_pending = $total_pending_row['pending_count'];
?>
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
              <strong>Number of Pending participants: </strong><span class="badge rounded-pill bg-dark card-text mb-1"><?php echo $total_pending; ?> </span>
              <br>
              <strong>Number of Approved participants: </strong><span class="badge rounded-pill bg-dark card-text mb-1"><?php echo $total_approved; ?> </span>
              
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="updateStatusModal-<?php echo $row2['event_id']; ?>" tabindex="-1" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateStatusModalLabel">Update Event Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="events_update.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="event_id" value="<?php echo $row2['event_id']; ?>">
                    <!-- Event Name -->
                    <div class="mb-3">
                        <label for="eventName" class="form-label">Event Name</label>
                        <input type="text" class="form-control" name="eventName" id="eventName" value="<?php echo htmlspecialchars($row2['eventName']); ?>" required>
                    </div>

                    <!-- Event Details -->
                    <div class="mb-3">
                        <label for="eventDetails" class="form-label">Event Details</label>
                        <textarea class="form-control" name="eventDetails" id="eventDetails" rows="3" required><?php echo htmlspecialchars($row2['eventDetails']); ?></textarea>
                    </div>

                    <!-- Event Start Date -->
                    <div class="mb-3">
                        <label for="eventStartDate" class="form-label">Start Date</label>
                        <input type="datetime-local" class="form-control" name="eventStartDate" id="eventStartDate" value="<?php echo $row2['eventStartDate']; ?>" required>
                    </div>

                    <!-- Event End Date -->
                    <div class="mb-3">
                        <label for="eventEndDate" class="form-label">End Date</label>
                        <input type="datetime-local" class="form-control" name="eventEndDate" id="eventEndDate" value="<?php echo $row2['eventEndDate']; ?>" required>
                    </div>

                    <!-- Event Type -->
                    <div class="mb-3">
                        <label for="eventType" class="form-label">Event Type</label>
                        <select class="form-select" name="eventType" id="eventType" required>
                            <option value="On-site" <?php echo ($row2['eventType'] === 'On-site') ? 'selected' : ''; ?>>On-site</option>
                            <option value="Online" <?php echo ($row2['eventType'] === 'Online') ? 'selected' : ''; ?>>Online</option>
                        </select>
                    </div>

                    <!-- Status Selection -->
                    <div class="mb-3">
                        <label for="eventStatus" class="form-label">Select Status</label>
                        <select class="form-select" name="eventStatus" id="eventStatus" required>
                            <option value="Scheduled" <?php echo ($row2['eventStatus'] === 'Scheduled') ? 'selected' : ''; ?>>Scheduled</option>
                            <option value="Ongoing" <?php echo ($row2['eventStatus'] === 'Ongoing') ? 'selected' : ''; ?>>Ongoing</option>
                            <option value="Completed" <?php echo ($row2['eventStatus'] === 'Completed') ? 'selected' : ''; ?>>Completed</option>
                        </select>
                    </div>
                    
                    <button type="submit" name="submit" class="btn btn-primary">Update Status</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php endwhile; ?>
<?php
}
?>
  </div>

  <!-- include for pop up modal in adding events -->
<?php include_once('add_event.php'); ?>      


<!-- Pagination of events (the previous and next button with numbers) -->
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


  <!-- script for participation table and volunteer table pop up modal -->
  <script>
    let eventId; // To store the event ID

    // Attach event listener to all buttons with the "open-modal" class
    document.querySelectorAll('.open-modal').forEach(button => {
        button.addEventListener('click', function() {
            // Get the event_id from the data attribute of the clicked button
            eventId = this.getAttribute('data-event-id');
        });
    });

    // Redirect to the participation table PHP page with the correct event_id
    document.getElementById('participationBtn').addEventListener('click', function() {
        window.location.href = 'view_event_participation.php?event_id=' + eventId;
    });

    // Redirect to the volunteer table PHP page with the correct event_id
    document.getElementById('volunteerBtn').addEventListener('click', function() {
        window.location.href = 'view_event_volunteer.php?event_id=' + eventId;
    });
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