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
  <link rel="icon" type="image/png" sizes="512x512" href="../../assets/img/favicon/logo.png">
</head>

<body>
<?php include_once('./loader/loader.php'); ?>
  <?php include_once('./sidebar/sidebar.php'); ?>

  <div id="page-content-wrapper">

  <?php include_once('./navbar/navbar.php'); ?>

    <div class="d-flex px-3 py-3 align-items-center" style="margin-bottom: 20px;">
    <img src="../images/admin-logo.jpg" style="width:90px; height:75px; border-radius:50%; margin-right: 15px;">
    <div class="col-md-5">
        <h3 class="text-themecolor" style="font-size: 1.5em; color:#752738 !important; margin-bottom: 5px;">System Logs Table</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)" style="color:#000 !important;">Home</a></li>
            <li class="breadcrumb-item active">System Logs</li>
        </ol>
    </div>
</div>

    <!-- System Logs Table Record -->
    <div class="container-fluid mt-3">
    <div class="d-flex justify-content-start mb-3 button-group">
        <button class="btn btn-outline-secondary me-2" style="box-shadow: none;" onclick="window.location='index.php'">Alumnite</button>
        <button class="btn btn-outline-secondary me-2 active" style="box-shadow: none;" onclick="window.location='system_logs.php'">System Logs</button>
        <button class="btn btn-outline-secondary me-2" style="box-shadow: none;" onclick="window.location='top_online_visitor.php'">Top Online Visitors</button>
      </div>
    
      <div class="table-responsive">
      <div class="col-lg-12 d-flex align-items-stretch" class="card w-100" style="border-radius:10px">
      <div class="card w-100" style="border-radius:10px;padding:10px">
        <table class="table vm no-th-brd pro-of-month" style="border-radius:10px" id="example">
          <thead style="background:#8E8B82;color:#FFF;border-radius:10px">
            <tr>
              <th>System Logs ID</th>
              <th>Name</th>
              <th>Timestamp</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          <?php
									include('../../connect.php');
									
									$result = $conn->query("SELECT * FROM audit ORDER BY id DESC");
										while($row = $result->fetch_assoc()) {
										$username =$row['username'];
										if($username == 'admin') {
											$name= 'Administrator';
										} else {
											$sql1 = "SELECT * FROM alumni WHERE username = '$username'";
											$result1 = $conn->query($sql1);
											while($row1 = $result1->fetch_assoc()) {
										$name = $row1['fname'].' '.$row1['lname'].'';
										
										} }
                  echo '<tr>';
              echo '<td>'.$row['id'].'</td>';
              echo '<td>'.$name.'</td>';
              echo '<td>'.$row['timestamp'].'</td>';
              echo '<td>'.$row['action'].'</td>';
              echo '</tr>';
            }
            $conn->close();
            ?>
            </tr>
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
