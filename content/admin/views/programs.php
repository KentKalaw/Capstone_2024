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
  <?php include_once('./backend/programs_admin_sql.php'); ?>

  <div id="page-content-wrapper">

  <?php include_once('./navbar/navbar.php'); ?>

<!-- Breadcrumb below the title -->
<div class="d-flex px-3 py-3 align-items-center" style="margin-bottom: 20px;">
    <img src="../images/admin-logo.jpg" style="width:90px; height:75px; border-radius:50%; margin-right: 15px;">
    <div class="col-md-5">
        <h3 class="text-themecolor" style="font-size: 1.5em; color:#752738 !important; margin-bottom: 5px;">Dashboard</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)" style="color:#000 !important;">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>
</div>

<div class="row mb-4 m-5" style="margin-top: 30px;"> <!-- Added margin-top here -->
    <div class="col-12">
        <h2 class="text-uppercase fw-bold" style="color: #752738; margin-bottom: 20px;">Programs</h2> <!-- Added margin-bottom here -->
        <hr class="mb-4">
    </div>
    <div class="d-flex justify-content-end">
    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#createProgramModal">Add new program</button>
</div>
</div>


    <!-- Programs Cards -->
    <div class="row g-4 mb-5 d-flex justify-content-center">
        <!-- Program Card 1 -->
        <div class="row g-4 mb-5 d-flex justify-content-center">
            <?php while ($program = mysqli_fetch_assoc($programs)) : ?>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="<?php echo htmlspecialchars($program['image']); ?>" style="width: 100%; height: 200px;" class="card-img-top" alt="<?php echo htmlspecialchars($program['title']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($program['title']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($program['subtitle']); ?></p>
                            <div class="d-grid">
                                <a class="btn btn-primary" style="background-color: #752738; border: none;" href='donations.php'>Donate Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
            </div>

      <div class="table-responsive m-3">
      <div class="col-lg-12 d-flex align-items-stretch" class="card w-100" style="border-radius:10px">
      <div class="card w-100" style="border-radius:10px;padding:10px">
        <table class="table vm no-th-brd pro-of-month" style="border-radius:10px" id="example">
          <thead style="background:#8E8B82;color:#FFF;border-radius:10px">
            <tr>
              <th>Donation ID</th>
              <th>Full name</th>
              <th>Email</th>
              <th>Amount</th>
              <th>Number</th>
              <th>Image</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
          <?php
                include('../../connect.php');
                $sql = "SELECT * FROM donations";
                $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()) {
                    $donation_id = $row['id'];
                    $fullname = $row['fullname'];
                    $email = $row['email'];
                    $amount = $row['amount'];
                    $number = $row['contact'];
                    $image = $row['image'];
                    $date = $row['date'];
                            
                        $date = date('F d, Y',strtotime($date));
                        echo '<tr>';
                    echo '<td>'.$donation_id.'</td>';
                    echo '<td>'.$fullname.'</td>';
                    echo '<td>'.$email.'</td>';
                    echo '<td>'.$amount.'</td>';
                    echo '<td>'.$number.'</td>';
                    echo '  <td><a href="view_file_donations.php?id='.$donation_id.'" rel="facebox" target="_blank" class="bg-transparent">View File</a></td>';
                    echo '  <td>'.$date.'</td>';
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

<!-- Modal -->
<div class="modal fade" id="createProgramModal" tabindex="-1" aria-labelledby="createProgramModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createProgramModalLabel">Create New Program</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="create_program.php" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="programTitle" class="form-label">Title:</label>
            <input type="text" class="form-control" id="programTitle" name="title" required>
          </div>
          <div class="mb-3">
            <label for="programSubtitle" class="form-label">Subtitle:</label>
            <input type="text" class="form-control" id="programSubtitle" name="subtitle" required>
          </div>
          <div class="mb-3">
            <label for="programImage" class="form-label">Image:</label>
            <input type="file" class="form-control" id="upload" style=""  accept="image/png, image/gif, image/jpeg">
            <textarea  name="file" id="file" style="display:none"></textarea>
            
        </div>

            <script>
                const fileInput = document.getElementById('upload');
                fileInput.addEventListener('change', (e) => {
                // get a reference to the file
                const file = e.target.files[0];

                // encode the file using the FileReader API
                const reader = new FileReader();
                reader.onloadend = () => {

                    // use a regex to remove data url part
                    const base64String = reader.result;
                        document.getElementById('file').value =reader.result; 
                        document.getElementById('img').src = reader.result; 
                    console.log(base64String);
                };
                reader.readAsDataURL(file);});
            </script>
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-success">Create Program</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </form>
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
			$('#example').DataTable( {
			responsive: true
			} );
			} );
			</script>
</body>

</html>
