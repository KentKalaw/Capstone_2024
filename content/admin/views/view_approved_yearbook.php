
<?php include_once('./backend/client.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Alumnite</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="icon" type="image/png" sizes="512x512" href="./assets/img/favicon/logo.png">
    <link rel="stylesheet" type="text/css" href="../css/admin.css"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>

    <?php include_once('./loader/loader.php'); ?>
    <?php include_once('./sidebar/sidebar.php'); ?>

    <div id="page-content-wrapper">
    <?php include_once('./navbar/navbar.php'); ?>

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

        <h2 class="fs-4 my-5 b-0 pt-4 px-3 text-center" style="color:#752738"><strong>Yearbook Delivery</strong></h2>

        <div class="container-fluid mt-3">
            <div class="d-flex justify-content-start mb-3 button-group">
                <button class="btn btn-outline-secondary me-2 active" style="box-shadow: none;" onclick="window.location='index.php'">Alumnite</button>
                <button class="btn btn-outline-secondary me-2" style="box-shadow: none;" onclick="window.location='yearbook.php'">Pending Yearbook Request</button>
            </div>

            <div class="table-responsive">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100" style="border-radius:10px;padding:10px">
                        <table class="table vm no-th-brd pro-of-month" style="border-radius:10px" id="example">
                            <thead style="background:#8E8B82;color:#FFF;border-radius:10px">
                                <tr>
                                    <th>Yearbook ID</th>
                                    <th>Alumni ID</th>
                                    <th>Student Number</th>
                                    <th>Full name</th>
                                    <th>Address</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Number</th>
                                    <th>Status</th>
                                    <th>Order ID</th>
                                    <th>Action</th>
                                    <th>Remarks</th>
                                    <th>Add Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql2 = "SELECT * FROM yearbook WHERE request_status = 'Approved' ORDER BY id DESC";
                                $result2 = $conn->query($sql2);
                                while($row2 = $result2->fetch_assoc()) {
                                    $yearbook_id = $row2['id'];
                                    $alumni = $row2['alumni_id'];
                                    $student_number= $row2['student_number'];
                                    $fullname = $row2['fullname'];
                                    $address = $row2['address'];
                                    $latitude = $row2['latitude'];
                                    $longitude = $row2['longitude'];
                                    $number = $row2['number'];
                                    $requestStatus = $row2['request_status'];
                                    $order_id = $row2['order_id'];
                                    echo '<tr>';
                                    echo '<td>'.$yearbook_id.'</td>';
                                    echo '<td>'.$alumni.'</td>';
                                    echo '<td>'.$student_number.'</td>';
                                    echo '<td>'.$fullname.'</td>';
                                    echo '<td>'.$address.'</td>';
                                    echo '<td>'.$latitude.'</td>';
                                    echo '<td>'.$longitude.'</td>';
                                    echo '<td>'.$number.'</td>';
                                    echo '<td>'.$requestStatus.'</td>';
                                    echo '<td>'.$order_id.'</td>';
                                    echo '<td>';
                                    if (is_null($row2['order_id'])) {
                                        echo '<form method="post" action="order_yearbook.php" style="display:inline;">
                                            <input type="hidden" name="yearbook_id" value="'.$yearbook_id.'">
                                            <button type="submit" name="create_order" class="btn btn-warning btn-sm">Create Order</button>
                                        </form>';
                                    } else {
                                        echo 'Order Created';
                                    }
                                    echo '</td>';
                                    echo '<td class="remarks-display">'.$row2['remarks'].'</td>';
                                    echo '<td>';
                                    echo '<form method="post" action="update_remarks.php" style="display:inline;">
                                        <input type="hidden" name="yearbook_id" value="'.$yearbook_id.'">
                                        <select name="remarks" class="form-select form-select-sm remarks-select">
                                            <option value="Not yet processed"'.($row2['remarks'] == 'Not yet processed' ? ' selected' : '').'>Not yet processed</option>
                                            <option value="Assigning Driver"'.($row2['remarks'] == 'Assigning Driver' ? ' selected' : '').'>Assigning Driver</option>
                                            <option value="Delivering"'.($row2['remarks'] == 'Delivering' ? ' selected' : '').'>Delivering</option>
                                            <option value="Delivered"'.($row2['remarks'] == 'Delivered' ? ' selected' : '').'>Delivered</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary btn-sm mt-1">Update</button>
                                    </form>';
                                    echo '</td>';
                                    
                                    echo '</form>';
                                    echo '</td>';
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.1/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/1.0.0/css/dataTables.responsive.css">
<script type="text/javascript" src="https://cdn.datatables.net/responsive/1.0.0/js/dataTables.responsive.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <!-- Select2 for enhanced dropdowns -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
$(document).ready(function() {
    
    var table = $('#example').DataTable({
        responsive: true,
        order: [[0, 'desc']],
        columnDefs: [
            {
                targets: 11, 
                type: 'text',
                searchable: true
            }
        ]
    });

    $('#example thead tr').clone(true).appendTo('#example thead');
    $('#example thead tr:eq(1) th').each(function(i) {
        if (i === 11) {
            $(this).html('<select class="form-control remarks-filter"><option value="">All Remarks</option><option value="Not yet processed">Not yet processed</option><option value="Assigning Driver">Assigning Driver</option><option value="Delivering">Delivering</option><option value="Delivered">Delivered</option></select>');
            
            $('.remarks-filter').on('change', function() {
                table
                    .column(11)
                    .search(this.value)
                    .draw();
            });
        } else {
            $(this).empty();
        }
    });
});
</script>
    <script>
        // Menu toggle
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");
        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };

   

      
    </script>
</body>
</html>