<?php include_once('./client/client.php'); 

$eventsQuery = "SELECT event_id, eventName FROM events ORDER BY eventStartDate DESC";
$eventsResult = $conn->query($eventsQuery);
$events = $eventsResult->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Alumnite</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="../css/admin.css"/>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

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

<!-- Breadcrumb below the title -->
<div class="d-flex px-3 py-3 align-items-center" style="margin-bottom: 20px;">
    <img src="../images/admin-logo.jpg" style="width:90px; height:75px; border-radius:50%; margin-right: 15px;">
    <div class="col-md-5">
        <h3 class="text-themecolor" style="font-size: 1.5em; color:#752738 !important; margin-bottom: 5px;">System Analytics</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)" style="color:#000 !important;">Home</a></li>
            <li class="breadcrumb-item active">System Analytics</li>
        </ol>
    </div>
</div>

<div class="container-fluid mt-5 px-3">
    <div class="row justify-content-center">
    <h2 class="fs-4 mb-4 text-center" style="color:#752738;">System Analytics</h2>
        <div class="col-md-11">
            <canvas id="loginChart" class="shadow" width="500" height="300" style="background-color: #fff;"></canvas>
        </div>
    </div>
</div>

<?php include_once('./client/login_analytics.php'); ?>

<div class="container-fluid mt-5 px-3">
    <div class="row justify-content-center">
        <h2 class="fs-4 mb-4 text-center" style="color:#752738;">Events Analytics</h2>
        <div class="col-md-6 text-center">
            <select id="eventSelect" class="form-select mb-4 mx-auto" style="max-width: 300px;">
                <option value="">Select an event</option>
                <?php foreach ($events as $event): ?>
                    <option value="<?php echo htmlspecialchars($event['event_id']); ?>">
                        <?php echo htmlspecialchars($event['eventName']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <div class="chart-container mx-auto mb-5" style="position: relative; height:40vh; width:80%; max-width:400px; background-color: #f8f9fa; border-radius: 10px; padding: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <canvas id="eventParticipationChart"></canvas>
            </div>
        </div>
    </div>
</div>

<?php include_once('./client/events_analytics.php'); ?>

  </div> <!-- End of page-content-wrapper -->


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function () {
      el.classList.toggle("toggled");
    };
  </script>

</body>

</html>
