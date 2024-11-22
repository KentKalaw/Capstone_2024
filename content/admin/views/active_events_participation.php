<?php include_once('./backend/client.php'); ?>
<?php include_once('./backend/active_participant_sql.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Active Event Participation</title>
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
                                <th>Rank</th>
                                <th>Name</th>
                                <th>No. of Event Participated</th>
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
                            <td>{$name}</center></td>
                            <td>{$count}</center></td>
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

<!-- jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- DataTables Core -->
<script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<!-- DataTables Buttons -->
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

<!-- PDF and Excel Export Plugins -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<!-- DataTables Responsive -->
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">


<script>
    // Convert logo to Base64 before initializing DataTable
    let base64Logo = '';
    function getBase64Logo(url) {
        return new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();
            xhr.onload = function () {
                const reader = new FileReader();
                reader.onloadend = function () {
                    resolve(reader.result);
                };
                reader.readAsDataURL(xhr.response);
            };
            xhr.onerror = reject;
            xhr.open('GET', url);
            xhr.responseType = 'blob';
            xhr.send();
        });
    }

    $(document).ready(async function () {
        // Preload the logo
        try {
            base64Logo = await getBase64Logo('../images/ub-logo.png');
        } catch (error) {
            console.error('Failed to load logo image:', error);
        }

        // Initialize DataTable
        $('#example').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copyHtml5',
                    className: 'btn btn-primary',
                    text: '<i class="fas fa-copy"></i> Copy',
                    exportOptions: {
                    columns: [0,1,2]
                    }
                },
                {
                    extend: 'excelHtml5',
                    className: 'btn btn-success',
                    text: '<i class="fas fa-file-excel"></i> Excel',
                    title: 'Active Event Participation Report - ' + new Date().toLocaleDateString(),
                    exportOptions: {
                    columns: [0,1,2]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    className: 'btn btn-danger',
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    title: 'Active Event Participation Report',
                    orientation: 'landscape',
                    pageSize: 'LETTER',
                    exportOptions: {
                    columns: [0,1,2]
                    },
                    customize: function (doc) {

                        doc.content[doc.content.length-1].table.widths = 
                        ['33%', '33%', '34%'];
                        
                        doc.content.unshift({
                            columns: [
                                {
                                    image: base64Logo,
                                    width: 60,
                                    margin: [-5, -8, 10, 10]
                                },
                                {
                                    text: [
                                            { 
                                                text: 'Alumnite\n', 
                                                fontSize: 18, 
                                                bold: true, 
                                                alignment: 'left', 
                                                margin: [40, 10, 0, 0]  
                                            }, 
                                            { 
                                                text: 'Active Event Participation Report', 
                                                fontSize: 18, 
                                                alignment: 'left', 
                                                margin: [40, 5, 0, 0] 
                                            }
                                        ]
                                }
                            ],
                            
                        });

                         
                         const pageWidth = doc.internal?.pageSize?.width || 595.28; 
                         const pageHeight = doc.internal?.pageSize?.height || 841.89; 

                         console.log('Page width:', pageWidth); 

                         doc.content.splice(1, 0, {
                            canvas: [{
                                type: 'line',
                                x1: 40,
                                y1: 0,
                                x2: pageWidth - 40,
                                y2: 0,
                                lineWidth: 0.5,
                                lineColor: '#d3d3d3'
                            }],
                            margin: [0, 0, 0, 20]
                        });
                        // Table Header Styling
                        doc.styles.tableHeader = {
                            fillColor: '#752738',
                            color: '#ffffff',
                            bold: true,
                            fontSize: 12,
                            alignment: 'center'
                        };

                        
                        if (doc.content[2]?.table) {
                            const tableBody = doc.content[2].table.body;
                            console.log('Table Body:', tableBody);
                            
                            tableBody.forEach((row, index) => {
                                if (index > 0 && index % 2 === 0) {
                                    row.forEach(cell => {
                                        if (!cell.fillColor) {
                                            console.error('Missing fill color for cell at index', index);
                                        }
                                        cell.fillColor = '#f9f9f9';
                                    });
                                }
                            });
                        }

                        // footer
                        doc.footer = function (currentPage, pageCount) {
                            return {
                                columns: [
                                    {
                                        text: [
                                            { text: 'Generated by Alumnite\n', fontSize: 9, bold: true, color: '#666666' },
                                            { text: '© 2024-2025 All Rights Reserved', fontSize: 8, color: '#999999' }
                                        ],
                                        alignment: 'left',
                                        margin: [40, 10, 0, 0]
                                    },
                                    {
                                        stack: [
                                        {
                                            text: `Page ${currentPage} of ${pageCount}`,
                                            alignment: 'right',
                                            fontSize: 8,
                                            color: '#666666',
                                            margin: [0, 10, 40, 0]
                                        },
                                        {
                                            text: new Date().toLocaleDateString(),
                                            alignment: 'right',
                                            fontSize: 8,
                                            color: '#666666',
                                            margin: [0, 0, 40, 0]
                                        }
                                    ],
                                    
                                    }
                                ],
                            };
                        };

                        
                        doc.styles.tableHeader = {
                            fillColor: '#752738',
                            color: '#ffffff',
                            bold: true,
                            fontSize: 12,
                            alignment: 'center'
                        };

                        
                        if (doc.content[2]?.table) {
                            const tableBody = doc.content[2].table.body;
                            tableBody.forEach((row, index) => {
                                if (index > 0 && index % 2 === 0) {
                                    row.forEach(cell => {
                                        cell.fillColor = '#f9f9f9';
                                    });
                                }
                            });
                        }
                    },
                }
            ]
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