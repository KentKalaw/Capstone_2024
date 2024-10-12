<?php
include('../../auth.php');
include('../../connect.php');

$username = $_SESSION['username'];

// Check user type
$sql1 = "SELECT * FROM users WHERE username = '$username'";
$result1 = $conn->query($sql1);
while($row1 = $result1->fetch_assoc()) {
    $type = $row1['type'];
    if($type != 'admin') {
        echo '<script>window.location="../logout.php";</script>';
    }
}

// Get the event_id from the URL
$event_id = isset($_GET['event_id']) ? intval($_GET['event_id']) : 0;

$event_sql = "SELECT eventName, eventStartDate, eventEndDate FROM events WHERE event_id = $event_id";
$event_result = $conn->query($event_sql);
$event = $event_result->fetch_assoc();

// Fetch volunteer data for the specific event
$volunteer_sql = "SELECT * FROM events_volunteer WHERE event_id = $event_id AND volunteerStatus = 'Approved'";
$volunteer_result = $conn->query($volunteer_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Alumnite</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/admin.css" />
</head>
<body>
<?php include_once('./loader/loader.php'); ?>
<?php include_once('./sidebar/sidebar.php'); ?>

<div id="page-content-wrapper">

<nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4 border-bottom" id="top-bar">
      <div class="d-flex align-items-center justify-content-between w-100">
        <div class="d-flex align-items-center">
          <i class="fa fa-bars primary-text fs-4 me-3" id="menu-toggle"  aria-hidden="true"></i>
          <h2 class="fs-4 m-0" style="color:#752738">Events Volunteer</h2>
        </div>
        <li class="d-flex align-items-center">
          <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="../images/admin-logo.jpg" alt="Admin Avatar" class="rounded-circle me-2" style="width: 40px; height: 40px;">
          <span class="fs-6 admin-text">Administrator &nbsp;</span></a>
        </li>
      </div>
    </nav>

    <h2 class="fs-4 my-5 b-0 pt-4 px-3 text-center" style="color:#752738"><strong>Event Volunteer Table</strong>: <?php echo htmlspecialchars($event['eventName']); ?></h2>

    <div class="container-fluid mt-3">
        <div class="d-flex justify-content-start mb-3 button-group">
            <button class="btn btn-outline-secondary me-2 active" style="box-shadow: none;" onclick="window.location='index.php'">Alumnite</button>
            <button class="btn btn-outline-dark me-2" style="box-shadow: none;" onclick="window.location='view_event_volunteer.php?event_id=<?php echo $event_id; ?>'">Pending Volunteer</button>
            <button class="btn btn-outline-dark me-2" style="box-shadow: none;" onclick="window.location='events.php'">Back to Events</button>
        </div>
</div>


     
        <div class="table-responsive">
            <div class="col-lg-12 d-flex align-items-stretch" class="card w-100" style="border-radius:10px">
                <div class="card w-100" style="border-radius:10px;padding:10px">
                    <table class="table vm no-th-brd pro-of-month" style="border-radius:10px" id="example">
                        <thead style="background:#8E8B82;color:#FFF;border-radius:10px">
                            <tr>
                                <th>Volunteer ID</th>
                                <th>Event ID</th>
                                <th>Alumni ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Volunteer Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Check if there are any results and populate the table
                            if ($volunteer_result->num_rows > 0) {
                                while ($row = $volunteer_result->fetch_assoc()) {
                                    $volunteer_id = $row['volunteer_id'];
                                    echo "<tr>
                                            <td>{$row['volunteer_id']}</td>
                                            <td>{$row['event_id']}</td>
                                            <td>{$row['alumni_id']}</td>
                                            <td>{$row['fname']}</td>
                                            <td>{$row['lname']}</td>
                                            <td>{$row['role']}</td>
                                            <td>{$row['username']}</td>
                                            <td>{$row['volunteerStatus']}</td>
                                        </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6' class='text-center'>No approved volunteer found.</td></tr>";
                            }
                            ?>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");
    toggleButton.onclick = function () {
        el.classList.toggle("toggled");
    };
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.1/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/1.0.0/css/dataTables.responsive.css">
<script type="text/javascript" src="https://cdn.datatables.net/responsive/1.0.0/js/dataTables.responsive.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            responsive: true
        });
    });
</script>
</body>
</html>