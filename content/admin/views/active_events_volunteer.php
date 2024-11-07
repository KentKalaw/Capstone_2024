<?php include_once('./backend/client.php'); ?>

<?php
$volunteer_sql = "SELECT * FROM events_volunteer WHERE volunteerStatus = 'Approved' ORDER BY volunteerStatus DESC";
$volunteer_result = $conn->query($volunteer_sql);

$volunteer_counts = array();

// Process volunteer data
while ($row = $volunteer_result->fetch_assoc()) {
    $email = $row['username'];
    $name = $row['fname'] . ' ' . $row['lname'];
    if (array_key_exists($name, $volunteer_counts)) {
        $volunteer_counts[$name]++;
    } else {
        $volunteer_counts[$name] = 1;
    }
    $participant_emails[$name] = $email;
}
arsort($volunteer_counts);
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
        <h3 class="text-themecolor" style="font-size: 1.5em; color:#752738 !important; margin-bottom: 5px;">Active Event Volunteer</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)" style="color:#000 !important;">Home</a></li>
            <li class="breadcrumb-item active">Active Event Volunteer</li>
        </ol>
    </div>
</div>

    <h2 class="fs-4 my-5 b-0 pt-4 px-3 text-center" style="color:#752738">Active Volunteer Table</h2>

    <div class="container-fluid mt-3">
        <div class="d-flex justify-content-start mb-3 button-group">
            <button class="btn btn-outline-dark me-2 active" style="box-shadow: none;" onclick="window.location='index.php'">Alumnite</button>
            <button class="btn btn-outline-dark me-2" style="box-shadow: none;" onclick="window.location='active_events_participation.php'">Active Participation Table</button>
            <button class="btn btn-outline-dark me-2" style="box-shadow: none;" onclick="window.location='events.php'">Back to Events</button>
        </div>
</div>


     
        <div class="table-responsive">
            <div class="col-lg-12 d-flex align-items-stretch" class="card w-100" style="border-radius:10px">
                <div class="card w-100" style="border-radius:10px;padding:10px">
                    <table class="table vm no-th-brd pro-of-month" style="border-radius:10px" id="example">
                        <thead style="background:#8E8B82;color:#FFF;border-radius:10px">
                            <tr>
                                <th>No.</th>
                                <th><center>Name</th>
                                <th><center>No. of Volunteers</th>
                                <th><center>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php
                                $i = 1;
                                foreach ($volunteer_counts as $name => $count) {
                                    echo "<tr data-email='" . $participant_emails[$name] . "'>
                                            <td>{$i}</td>
                                            <td><center>{$name}</td>
                                            <td><center>{$count}</td>
                                            <td><center>
                                                <button type='button' class='btn btn-secondary open-email-modal' data-bs-toggle='modal' data-bs-target='#emailModal'>Send Email</button>
                                                </td>
                                        </tr>";
                                    if ($i++ >= 15) break;
                                }
                                ?>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Email Modal -->
<div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="emailModalLabel">Send Email</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="emailForm">
                    <div class="mb-3">
                        <label for="recipient" class="col-form-label">Recipient:</label>
                        <input type="email" class="form-control" id="recipient" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="col-form-label">Subject:</label>
                        <input type="text" class="form-control" id="subject" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="col-form-label">Message:</label>
                        <textarea class="form-control" id="message" rows="3" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="sendEmail">Send Email</button>
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

        $('.open-email-modal').click(function() {
        var email = $(this).closest('tr').data('email');
        $('#recipient').val(email);
    });
    });
</script>
</body>
</html>