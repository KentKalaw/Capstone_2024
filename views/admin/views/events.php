<?php
include('../../auth.php');
include('../../connect.php');
$username = $_SESSION['username'];
$sql1 = "SELECT * FROM login WHERE username = '$username'";
$result1 = $conn->query($sql1);
while($row1 = $result1->fetch_assoc()) {
	$type = $row1['type'];
	if($type != 'admin') {
		echo '<script>window.location="../logout.php";</script>';
	}

}

$limit = 5;  // Number of events per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;  // Current page number, default is 1
$offset = ($page - 1) * $limit;  // Calculate offset

$total_events_sql = "SELECT COUNT(*) AS total FROM events";
$total_events_result = $conn->query($total_events_sql);
$total_events_row = $total_events_result->fetch_assoc();
$total_events = $total_events_row['total'];

$total_pages = ceil($total_events / $limit);

$status = isset($_GET['status']) ? $_GET['status'] : ''; // Get selected status from dropdown
$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : ''; // Get selected category from dropdown

// Fetch all events from the database
$sql2 = "SELECT events.*, events_category.name AS categoryName 
         FROM events 
         JOIN events_category ON events.category_id = events_category.id 
         WHERE 1=1";

// Filter by event status if it's set
if (isset($_GET['status']) && $_GET['status'] != '') {
  $status = $_GET['status'];
  $sql2 .= " AND events.eventStatus = '$status'";
}

// Filter by category if it's set
if (isset($_GET['category_id']) && $_GET['category_id'] != '') {
  $category_id = $_GET['category_id'];
  $sql2 .= " AND events.category_id = $category_id";
}

// Search
if (isset($_GET['search']) && $_GET['search'] != '') {
  $search = $conn->real_escape_string($_GET['search']);
  $sql2 .= " AND (events.eventName LIKE '%$search%' OR events.eventDetails LIKE '%$search%')";
}

$sql2 .= " ORDER BY eventStartDate DESC LIMIT $limit OFFSET $offset";

$result2 = $conn->query($sql2);

?>

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
  <link rel="stylesheet" href="../css/events.css" />
</head>

<style>
    @media (max-width: 767px) {
    .admin-text {
        display: none !important;
    }
}
</style>

<body>
  <?php include_once('./sidebar/sidebar.php'); ?>

  <div id="page-content-wrapper">
  <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4 border-bottom" id="top-bar">
      <div class="d-flex align-items-center justify-content-between w-100">
        <div class="d-flex align-items-center">
          <i class="fa fa-bars primary-text fs-4 me-3" id="menu-toggle"  aria-hidden="true"></i>
          <h2 class="fs-4 m-0" style="color:#752738">Events Management</h2>
        </div>
        <li class="d-flex align-items-center">
          <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="../images/admin-logo.jpg" alt="Admin Avatar" class="rounded-circle me-2" style="width: 40px; height: 40px;">
          <span class="fs-6 admin-text">Administrator &nbsp;</span></a>
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
                    <p class="card-text mb-1" style="color: <?php echo ($row2['eventStatus'] === 'Scheduled') ? 'orange' : (($row2['eventStatus'] === 'Ongoing') ? 'green' : 'red'); ?>"><strong style="color: black;">Status: </strong><?php echo $row2['eventStatus']; ?></p>
                    
                  </div>
                </div>
                <div class="col-md-2 col-12 align-self-center p-2">
                  <div class="d-md-none d-flex justify-content-center">
                    <a href="#" class="btn btn-dark px-4 py-2 me-2" data-bs-toggle="modal" data-bs-target="#eventModal-<?php echo $row2['event_id']; ?>"><i class="fas fa-eye"></i></a>
                    <a href="#" class="btn btn-dark px-4 py-2" data-bs-toggle="modal" data-bs-target="#eventModal-<?php echo $row2['event_id']; ?>"><i class="fas fa-cog"></i></a>
                  </div>
                  <div class="d-md-none d-flex justify-content-center">
                  <a href="#" class="btn btn-warning px-4 py-2 mt-2" data-bs-toggle="modal" data-bs-target="#updateStatusModal-<?php echo $row2['event_id']; ?>"><i class="fa fa-user-plus" aria-hidden="true"></i></a>
                  </div>
                  <div class="d-none d-md-block text-end">
                    <a href="#" class="btn btn-dark px-4 py-2 me-1" data-bs-toggle="modal" data-bs-target="#eventModal-<?php echo $row2['event_id']; ?>"><i class="fas fa-eye"></i></a>
                    <a href="#" class="btn btn-dark px-4 py-2 me-1" data-bs-toggle="modal" data-bs-target="#updateStatusModal-<?php echo $row2['event_id']; ?>"><i class="fas fa-cog"></i></a>
                  </div>
                  <div class="d-none d-md-block text-center">
                  <a href="#" class="btn btn-warning px-4 py-2 ms-5 mt-2" data-bs-toggle="modal" data-bs-target="#participantsModal-<?php echo $row2['event_id']; ?>"><i class="fa fa-user-plus" aria-hidden="true"></i></a>
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
                <p class="card-text mb-1"><strong>Number of approved participants: </strong></p>
                <p class="card-text mb-1"><strong>Event Volunteers: </strong>No</p>
                <br>
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

       

<!-- Modal for updating event status -->

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