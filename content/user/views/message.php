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
  <link rel="stylesheet" type="text/css" href="../css/messages.css"/>
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
          <img src="<?php echo $file ?>" alt="Admin Avatar" class="rounded-circle me-2" style="width: 40px; height: 40px;" onclick="window.location='profile.php'">
          <span class="fs-6 alumni-text" onclick="window.location='profile.php'"><?php echo $fname . ' ' . $lname ?> &nbsp; </span>
        </a>
      </li>
    </div>
  </nav>

  <div class="d-flex px-3 py-3 align-items-center mb-4">
    <img src="<?php echo $file ?>" class="rounded-circle me-3" style="width:90px; height:75px;">
    <div>
      <h3 class="text-themecolor" style="font-size: 1.5em; color:#752738 !important;">Messages</h3>
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="javascript:void(0)" style="color:#000 !important;">Home</a></li>
        <li class="breadcrumb-item active">Messages</li>
      </ol>
    </div>
  </div>

  <div class="container-fluid py-4">
    <h3 class="text-center mb-4" style="color:#752738;">Messages</h3>
    
    <!-- Alumni List -->
    <div class="row bg-light m-1 p-4 rounded" style="height:270px; overflow-x:auto;">
      <table class="table">
        <tr>
          <?php
          include('../../connect.php');
          $result = mysqli_query($conn, "SELECT * FROM users WHERE type = 'alumni' AND status = 'Approved' ORDER BY ID DESC");
          while ($row = mysqli_fetch_array($result)) {
            $username = $row['username'];
            $result1 = mysqli_query($conn, "SELECT * FROM alumni WHERE username = '$username'");
            while ($row1 = mysqli_fetch_array($result1)) {
              $profile = $row1['profile'] ?: '../images/ub-logo.png';
              $name = $row1['fname'] . ' ' . $row1['lname'];
            }
            
            echo '<td>';
            echo '<div class="text-center" style="width:100px;height:20px;margin:10px;float:left;font-weight:bold;cursor:pointer" onclick="window.location=\'view_message.php?id=' . $username . '\'">';
            echo '<img src="' . $profile . '" class="img-fluid rounded-circle border border-danger" style="width:100px;height:100px;">';
            echo '<div>' . $name . '</div>';
            echo '</div>';
            echo '</td>';
          }
          ?>
        </tr>
      </table>
    </div>

    <!-- Message Table -->
    <div class="row mt-4">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead class="bg-secondary text-white">
                  <tr>
                    <th>Alumni</th>
                    <th>Date and Time</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include('../../connect.php');
                  $username = $_SESSION['username'];
                  $sql = "SELECT * FROM message WHERE user2 = '$username' OR user1 = '$username' GROUP BY user1 ORDER BY ID DESC";
                  $result = $conn->query($sql);
                  while ($row = $result->fetch_assoc()) {
                    $user1 = $row['user1'];
                    $date = date('F d, Y h:i A', strtotime($row['date']));
                    
                    $result1 = $conn->query("SELECT * FROM alumni WHERE username = '$user1'");
                    while ($row1 = $result1->fetch_assoc()) {
                      $name = $row1['fname'] . ' ' . $row1['lname'];
                    }
                    echo '<tr>';
                    echo '<td>' . $name . '</td>';
                    echo '<td>' . $date . '</td>';
                    echo '<td class="text-center"><button class="btn btn-primary" onclick="window.location=\'view_message.php?id=' . $user1 . '\'">View Message</button></td>';
                    echo '</tr>';
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php
    // Update message status
    $username = $_SESSION['username'];
    mysqli_query($conn, "UPDATE message SET status = '1' WHERE user2 = '$username'");
    ?>
  </div>

</div> <!-- End of page-content-wrapper -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
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