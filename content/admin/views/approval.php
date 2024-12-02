<?php include_once('./backend/client.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Alumnite</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="../css/approval.css"/>
  <link rel="icon" type="image/png" sizes="512x512" href="../../assets/img/favicon/logo.png">
   <!-- Facebox -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/facebox/1.3.8/facebox.min.css" media="screen" rel="stylesheet" type="text/css"/>

</head>

<body>
  
  <?php include_once('./sidebar/sidebar.php'); ?>
  <?php include_once('./loader/loader.php'); ?>

  <div id="page-content-wrapper">

  <?php include_once('./navbar/navbar.php'); ?>

    <?php include_once('./dashboardcard.php'); ?>
                            <!-- Dashboard Cards End -->
                        
                            
                            <?php
                                        include('../../connect.php');
                                            $result1aa = $conn->query("SELECT * FROM users WHERE status = 'Pending'");
                                            $count1aa = $result1aa->num_rows;
                                        ?>

                            <h2 class="fs-4 my-5 b-0 pt-4 px-3" style="color:#752738">Record Table</h2>

                            <!-- Add the Record Table Below -->
                            <div class="container-fluid mt-3">
                            <div class="d-flex justify-content-start mb-3 button-group">
                                <button class="btn btn-outline-secondary me-2" style="box-shadow: none;" onclick="window.location='index.php'">Alumnite</button>
                                <button class="btn btn-outline-secondary me-2" style="box-shadow: none;" onclick="window.location='gts.php'">GTS Reports</button>
                                <button class="btn btn-outline-secondary me-2" style="box-shadow: none;" onclick="window.location='programs.php'">Initiative Program</button>
                                <button class="btn btn-outline-secondary me-2 active" style="box-shadow: none;" onclick="window.location='approval.php'">For Approval [<?php echo $count1aa ?>]</button>
                                <select name="department" id="username" required id="department" class="form-select form-select-lg" onchange="go(this.value)" style="width: 100%; max-width: 400px; font-size:1rem; outline=none;">
                                <option value="" disabled selected>Select Department</option>
                                    <option>Senior High School</option>
                                                    <option>College of Allied Medical Sciences</option>
                        <option>College of Arts and Sciences</option>
                        <option>College of Business, Accountancy, and Hospitality Management</option>
                        <option>College of Criminal Justice Education</option>
                        <option>College of Education</option>
                        <option>College of Engineering</option>
                        <option>College of Information and Communications Technology</option>
                        <option>College of Nursing and Midwifery</option>
                        <option>College of Technical Education</option>
                                                </select>
                            </div>

                            <script>
							function go(val) {
								window.location='view_students.php?dept='+val;
							}
						</script>

                            

                            <div class="table-responsive">
                            <div class="col-lg-12 d-flex align-items-stretch" class="card w-100" style="border-radius:10px">
                            <div class="card w-100" style="border-radius:10px;padding:10px">
                                <table class="table vm no-th-brd pro-of-month" style="border-radius:10px" id="example">
                                <thead style="background:#8E8B82;color:#FFF;border-radius:10px">
                                    <tr>
                                    <th>Register ID</th>
                                    <th>Date Registered</th>
                                    <th>Name</th>
                                    <th>Batch Year</th>
                                    <th>Proof</th>
                                    <th>Course</th>
                                    <th><center>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                include('../../connect.php');
                                $sql = "SELECT * FROM users WHERE status = 'Pending' AND type = 'alumni'";
                                $result = $conn->query($sql);
                                    while($row = $result->fetch_assoc()) {
                                    $username =$row['username'];
                                $sql1 = "SELECT * FROM alumni WHERE username = '$username'";
                                $result1 = $conn->query($sql1);
                                while($row1 = $result1->fetch_assoc()) {
                                    $id =$row1['id'];
                                    $ub_id  = sprintf("%04d", $id);
                                    $fname =$row1['fname'];
                                    $lname =$row1['lname'];
                                    $year =$row1['year'];
                                    $department =$row1['department'];
                                    $course =$row1['course'];
                                    $file =$row1['file'];
                                    $date =$row1['date'];
                                }
                $date = date('F d, Y',strtotime($date));
                echo '<tr>';
            echo '<td>'.$ub_id.'</td>';
            echo '<td>'.$date.'</td>';
            echo '<td>'.$fname.' '.$lname.'</td>';
            echo '<td>'.$year.'</td>';
            echo '  <td><a href="view_file.php?id='.$id.'" rel="facebox" target="_blank" class="bg-transparent">View File</a></td>';
            echo '  <td>'.$course.'</td>';
            echo '<td><center><input type="button" value="Approve" class="btn btn-primary" onclick="window.location=\'approve.php?id='.$row['id'].'&email='.$username.' \'">&nbsp;<input type="button" value="Decline" class="btn btn-danger" onclick="window.location=\'decline.php?id='.$row['id'].'&email='.$username.'&fname='.$fname.'&lname='.$lname.'\'"></td>';
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function () {
      el.classList.toggle("toggled");
    };
  </script>
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/facebox/1.3.8/facebox.min.css" />
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.facebox/1.4.1/jquery.facebox.min.js"></script>
<script>
    jQuery(document).ready(function($) {
  $('a[rel*=facebox]').facebox()
})
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
        $('#example').DataTable({
            responsive: true,
            order: [[0, 'desc']]
        });
    });
</script>

</html>
