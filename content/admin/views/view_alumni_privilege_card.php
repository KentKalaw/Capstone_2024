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
        <h3 class="text-themecolor" style="font-size: 1.5em; color:#752738 !important; margin-bottom: 5px;">Alumni Privilege Card</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)" style="color:#000 !important;">Home</a></li>
            <li class="breadcrumb-item active">Alumni Privilege Card</li>
        </ol>
    </div>
</div>

<h2 class="fs-4 my-5 b-0 pt-4 px-3 text-center" style="color:#752738"><strong>Alumni Privilege Card Request Table</strong></h2>

    <!-- Add the Record Table Below -->
    <div class="container-fluid mt-3">
    <div class="d-flex justify-content-start mb-3 button-group">
        <button class="btn btn-outline-secondary me-2 active" style="box-shadow: none;" onclick="window.location='index.php'">Alumnite</button>
        <button class="btn btn-outline-secondary me-2" style="box-shadow: none;" onclick="window.location='approved_alumni_privilege_card.php'">Approved Alumni Privilege Card</button>
      </div>
    

      <div class="table-responsive">
      <div class="col-lg-12 d-flex align-items-stretch" class="card w-100" style="border-radius:10px">
      <div class="card w-100" style="border-radius:10px;padding:10px">
        <table class="table vm no-th-brd pro-of-month" style="border-radius:10px" id="example">
          <thead style="background:#8E8B82;color:#FFF;border-radius:10px">
            <tr>
              <th>ID</th>
              <th>Alumni ID</th>
              <th>Full name</th>
              <th>Student Number</th>
              <th>Department</th>
              <th>Course</th>
              <th>Year Graduated</th>
              <th>Date</th>
              <th>Status</th>
              <th><center>Action</th>
            </tr>
          </thead>
          <tbody>
          <?php
                include('../../connect.php');
                $sql2 = "SELECT * FROM alumni_privilege_card WHERE status = 'Pending'";
                $result2 = $conn->query($sql2);
                while($row2 = $result2->fetch_assoc()) {
                    $card_id = $row2['id'];
                    $alumni = $row2['alumni_id'];
                    $fullname = $row2['fullname'];
                    $student_number= $row2['student_number'];
                    $department = $row2['department'];
                    $course = $row2['course'];
                    $year_graduated = $row2['year_graduated'];
                    $date = $row2['date'];
                    $status = $row2['status'];
                    $date = date('F j, Y g:ia',strtotime($date));
                    echo '<tr>';
                    echo '<td>'.$card_id.'</td>';
                    echo '<td>'.$alumni.'</td>';
                    echo '<td>'.$fullname.'</td>';
                    echo '<td>'.$student_number.'</td>';
                    echo '<td>'.$department.'</td>';
                    echo '<td>'.$course.'</td>';
                    echo '<td>'.$year_graduated.'</td>';
                    echo '<td>'.$date.'</td>';
                    echo '<td>'.$status.'</td>';
                    echo '<td><center>
                    <form action="update_alumni_privilege_card.php" method="post" style="display:inline;">
                        <input type="hidden" name="card_id" value="'.$card_id.'">
                        <button type="submit" name="action" value="Approve" class="btn btn-success btn-sm">Approve</button>
                    </form>
                    <form action="update_alumni_privilege_card.php" method="post" style="display:inline;">
                        <input type="hidden" name="card_id" value="'.$card_id.'">
                        <button type="submit" name="action" value="Decline" class="btn btn-danger btn-sm">Decline</button>
                    </form>
                    </td>';
                    echo '</tr>';
                }
                
                ?>
            </tr>
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
