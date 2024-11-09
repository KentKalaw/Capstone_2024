<?php include_once('./backend/client.php'); ?>
<?php include_once('./backend/active_participant_sql.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Alumnite</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="../css/active_participant.css"/>
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
        <h3 class="text-themecolor" style="font-size: 1.5em; color:#752738 !important; margin-bottom: 5px;">Active Event Participation</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)" style="color:#000 !important;">Home</a></li>
            <li class="breadcrumb-item active">Active Event Participation</li>
        </ol>
    </div>
</div>

    <h2 class="fs-4 my-5 b-0 pt-4 px-3 text-center" style="color:#752738">Active Participation Table</h2>

    <div class="container-fluid mt-3">
        <div class="d-flex justify-content-start mb-3 button-group">
            <button class="btn btn-outline-dark me-2 active" style="box-shadow: none;" onclick="window.location='index.php'">Alumnite</button>
            <button class="btn btn-outline-dark me-2" style="box-shadow: none;" onclick="window.location='active_events_volunteer.php'">Active Volunteers Table</button>
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
                                <th><center>No. of Event Participated</th>
                                <th><center>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                    $i = 1;
                    foreach ($participants as $participant) {
                        $name = htmlspecialchars($participant['name']);
                        $count = htmlspecialchars($participant['participation_count']);
                        $alumni_id = htmlspecialchars($participant['alumni_id']);
                        echo "<tr>
                            <td>{$i}</td>
                            <td><center>{$name}</center></td>
                            <td><center>{$count}</center></td>
                            <td><center>
                                <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#eventsModal{$alumni_id}'>
                                    View Events
                                </button>
                                <button type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#emailModal{$alumni_id}'>
                                    Send Email
                                </button>
                            </center></td>
                        </tr>";
                        $i++;
                    }
                    ?>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

 <!-- Modals for events and email for each participant -->
 <?php foreach ($participants as $participant): ?>
            <!-- Events Modal -->
            <div class="modal fade" id="eventsModal<?php echo $participant['alumni_id']; ?>" tabindex="-1" aria-labelledby="eventsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Event Participated History of <?php echo htmlspecialchars($participant['name']); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body event-modal-body">
                <div class="events-container">
                    <?php foreach ($participant['events'] as $event): ?>
                        <div class="event-item">
                            <div class="event-thumbnail">
                                <img src="<?php echo htmlspecialchars($event['eventImage']); ?>" alt="Event Image">
                            </div>
                            <div class="event-content">
                                <h6 class="event-title"><?php echo htmlspecialchars($event['eventName']); ?></h6>
                                <p class="event-description"><?php echo htmlspecialchars($event['eventDetails']); ?></p>
                                <span class="event-start-date">Start: <?php echo date("F j, Y g:i A", strtotime($event['eventStartDate'])); ?></span>
                                <span class="event-end-date">End: <?php echo date("F j, Y g:i A", strtotime($event['eventEndDate'])); ?></span>
                                <span class="event-end-date">Request Date: <?php echo date("F j, Y g:i A", strtotime($event['submissionDate'])); ?></span>
                                <span class="event-status" data-status="<?php echo htmlspecialchars($event['eventStatus']); ?>">
                                    <?php echo htmlspecialchars($event['eventStatus']); ?>
                                </span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
            <!-- Email Modal -->
            <div class="modal fade" id="emailModal<?php echo $participant['alumni_id']; ?>" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="emailModalLabel">Send Email to <?php echo htmlspecialchars($participant['name']); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="recipient_email" class="col-form-label">Recipient:</label>
                                    <input type="email" class="form-control" name="recipient_email" value="<?php echo htmlspecialchars($participant['username']); ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="subject" class="col-form-label">Subject:</label>
                                    <input type="text" class="form-control" name="subject" required>
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="col-form-label">Message:</label>
                                    <textarea class="form-control" name="message" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Send Email</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
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

           // Handle email modal
    $('.open-email-modal').click(function() {
        var email = $(this).data('email');
        $('#recipient').val(email);
    });

    });
</script>
</body>
</html>