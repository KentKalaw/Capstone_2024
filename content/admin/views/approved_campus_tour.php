<?php include_once('./backend/client.php'); ?>

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
  <link rel="icon" type="image/png" sizes="512x512" href="../../assets/img/favicon/logo.png">
</head>

<body>
<?php include_once('./loader/loader.php'); ?>
  <?php include_once('./sidebar/sidebar.php'); ?>

  <?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['campus_id']) && isset($_POST['approved_date'])) {
      $campus_id = $_POST['campus_id'];
      $approved_date = $_POST['approved_date'];

      // Format the date to 'F j, Y g:ia' (e.g., October 20, 2024 6:00pm)
      $approved_date = date('F j, Y g:ia', strtotime($approved_date));

      // Update query with the formatted approved_date
      $update_sql = "UPDATE campus_tour SET approved_date = '$approved_date' WHERE id = $campus_id";

      if ($conn->query($update_sql) === TRUE) {
          echo "<script>alert('Campus Tour Approved Date Updated.'); window.location.href='approved_campus_tour.php';</script>";
      } else {
          echo "<script>alert('Campus Tour Approved Date Failed to Update.'); window.location.href='approved_campus_tour.php';</script>";
      }
  }
}


?>

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
        <h3 class="text-themecolor" style="font-size: 1.5em; color:#752738 !important; margin-bottom: 5px;">Campus Tour</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)" style="color:#000 !important;">Home</a></li>
            <li class="breadcrumb-item active">Campus Tour</li>
        </ol>
    </div>
</div>

<h2 class="fs-4 my-5 b-0 pt-4 px-3 text-center" style="color:#752738"><strong>Campus Tour Request Table</strong></h2>

    <!-- Add the Record Table Below -->
    <div class="container-fluid mt-3">
    <div class="d-flex justify-content-start mb-3 button-group">
        <button class="btn btn-outline-secondary me-2 active" style="box-shadow: none;" onclick="window.location='index.php'">Alumnite</button>
        <button class="btn btn-outline-secondary me-2" style="box-shadow: none;" onclick="window.location='view_campus_tour.php'">Pending Campus Tour</button>
      </div>
    

      <div class="table-responsive">
      <div class="col-lg-12 d-flex align-items-stretch" class="card w-100" style="border-radius:10px">
      <div class="card w-100" style="border-radius:10px;padding:10px">
        <table class="table vm no-th-brd pro-of-month" style="border-radius:10px" id="example">
          <thead style="background:#8E8B82;color:#FFF;border-radius:10px">
            <tr>
              <th>ID</th>
              <th>Alumni ID</th>
              <th>Student Number</th>
              <th>Full name</th>
              <th>Email</th>
              <th>Number</th>
              <th>Status</th>
              <th>Special Request</th>
              <th>Approved Date</th>
              <th><center>Action</th>
            </tr>
          </thead>
          <tbody>
          <?php
                include('../../connect.php');
                $sql2 = "SELECT * FROM campus_tour WHERE status = 'Approved'";
                $result2 = $conn->query($sql2);
                while($row2 = $result2->fetch_assoc()) {
                    $campus_id = $row2['id'];
                    $alumni = $row2['alumni_id'];
                    $student_number = $row2['student_number'];
                    $fullname = $row2['fullname'];
                    $email = $row2['email'];
                    $number = $row2['number'];
                    $status = $row2['status'];
                    $special_request = $row2['special_request'];
                    $date = $row2['approved_date'];

                    echo '<tr>';
                    echo '<td>' . $campus_id . '</td>';
                    echo '<td>' . $alumni . '</td>';
                    echo '<td>' . $student_number . '</td>';
                    echo '<td>' . $fullname . '</td>';
                    echo '<td>' . $email . '</td>';
                    echo '<td>' . $number . '</td>';
                    echo '<td>' . $status . '</td>';
                    echo '<td>' . $special_request . '</td>';
                    echo '<td>';
                    if (is_null($date)) {
                        echo '<input type="datetime-local" id="approved_date_' . $campus_id . '" name="approved_date' . $campus_id . '" required class="form-control">';
                    } else {
                        echo date('F j, Y g:ia', strtotime($date));
                    }
                    echo '</td>';
                    echo '<td>';
                    if (is_null($date)) {
                        echo '<form method="post" action="">
                                <input type="hidden" name="campus_id" value="'.$campus_id.'">
                                <input type="hidden" name="approved_date" id="hidden_approved_date_' . $campus_id . '">
                                <button type="submitDate" class="btn btn-primary btn-sm" onclick="setApprovedDate(' . $campus_id . ')">Submit Date</button>
                              </form>';
                    }
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            <!-- Add more rows as necessary -->
          </tbody>
        </table>
      </div>
      </div>
      </div>
    </div>

  </div> <!-- End of page-content-wrapper -->


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function () {
      el.classList.toggle("toggled");
    };
  </script>

<script>
function setApprovedDate(campusId) {
    var dateInput = document.getElementById('approved_date_' + campusId);
    var hiddenInput = document.getElementById('hidden_approved_date_' + campusId);
    hiddenInput.value = dateInput.value;
}
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/facebox/1.3.8/facebox.min.js"></script>
<script>
    $(document).ready(function() {
        $('a[rel*=facebox]').facebox();
    });
</script>


  <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
      <script type="text/javascript" src="https://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.1/js/jquery.dataTables.min.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/1.0.0/css/dataTables.responsive.css">
      <script type="text/javascript" src="https://cdn.datatables.net/responsive/1.0.0/js/dataTables.responsive.js"></script>
	  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script>
			$(document).ready(function() {
			$('#example').DataTable( {
			responsive: true
			} );
			} );
			</script>
</body>

</html>