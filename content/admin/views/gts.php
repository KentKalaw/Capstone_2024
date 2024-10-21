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
  <link rel="icon" type="image/png" sizes="512x512" href="./assets/img/favicon/logo.png">
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

    <div class="d-flex px-3 py-3 align-items-center" style="margin-bottom: 20px;">
    <img src="../images/admin-logo.jpg" style="width:90px; height:75px; border-radius:50%; margin-right: 15px;">
    <div class="col-md-5">
        <h3 class="text-themecolor" style="font-size: 1.5em; color:#752738 !important; margin-bottom: 5px;">Graduate Tracer Survey</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)" style="color:#000 !important;">Home</a></li>
            <li class="breadcrumb-item active">Graduate Tracer Survey</li>
        </ol>
    </div>
</div>


      <div class="table-responsive">
      <div class="col-lg-12 d-flex align-items-stretch" class="card w-100" style="border-radius:10px">
      <div class="card w-100" style="border-radius:10px;padding:10px">
        <table class="table vm no-th-brd pro-of-month" style="border-radius:10px" id="example">
          <thead style="background:#8E8B82;color:#FFF;border-radius:10px">
            <tr>
            <th>Alumni</th>
            <th>Department</th>
            <th>Year Graduated</th>
            <th>Employment Status</th>
            <th>Course</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Company</th>
            <th>Company Address</th>
        <th><center>Action</th> 
            </tr>
          </thead>
          <tbody>
          <?php
									include('../../connect.php');
									$result = $conn->query("SELECT * FROM gts1 ORDER BY ID DESC");
										while($row = $result->fetch_assoc()) {
										$username =$row['username'];
								
									$result1 = $conn->query("SELECT * FROM alumni WHERE username = '$username'");
										while($row1 = $result1->fetch_assoc()) {
											$course =$row1['course'];
											$year =$row1['year'];
											$department =$row1['department'];
										}
											  echo '<tr>';
                                              echo '  <td style="width:10%">'.$row['a1'].'</td>';
                                              echo '  <td>'.$department.'</td>';
                                              echo '  <td>'.$year.'</td>';
                                              echo '  <td>'.$row['a18'].'</td>';
                                              echo '  <td>'.$course.'</td>';
                                              echo '  <td>'.$username.'</td>';
                                              echo '  <td>'.$row['a4'].'</td>';
                                              echo '  <td>'.$row['a21'].'</td>';
                                              echo '  <td>'.$row['a23'].'</td>';
											  echo '  <td width="20%"><center><input type="button" value="View GTS" class="btn btn-primary" onclick="window.location=\'view_gts.php?id='.$row['id'].'\'"></td>';
                                            echo '</tr>';
										  }
									$conn->close();
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


  <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
      <script type="text/javascript" src="https://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.1/js/jquery.dataTables.min.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/1.0.0/css/dataTables.responsive.css">
      <script type="text/javascript" src="https://cdn.datatables.net/responsive/1.0.0/js/dataTables.responsive.js"></script>
	  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
      <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css">
      <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/pdfmake.min.js"></script>
      <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/vfs_fonts.js"></script>

<script>
  $(document).ready(function() {
    $('#example').DataTable({
      responsive: true,
      dom: 'Bfrtip',
      buttons: [
        {
          extend: 'copyHtml5',
          exportOptions: { orthogonal: 'export' }
        },
        {
          extend: 'excelHtml5',
          exportOptions: { orthogonal: 'export' }
        },
        {
          extend: 'pdfHtml5',
          orientation: 'landscape',
          pageSize: 'LETTER'
        }
      ]
    });
  });
</script>
</body>

</html>
