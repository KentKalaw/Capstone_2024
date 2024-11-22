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

        $('#example').DataTable({
            responsive: true,
            order: [[0, 'desc']],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copyHtml5',
                    className: 'btn btn-primary',
                    text: '<i class="fas fa-copy"></i> Copy',
                    title: 'Graduate Tracer Survey Report',
                    exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8]
                    }
                },
                {
                    extend: 'excelHtml5',
                    className: 'btn btn-success',
                    text: '<i class="fas fa-file-excel"></i> Excel',
                    title: 'Graduate Tracer Survey Report',
                    exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8] 
                    }
                },
                {
                    extend: 'pdfHtml5',
                    className: 'btn btn-danger',
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    title: 'Graduate Tracer Survey Report',
                    orientation: 'landscape',
                    pageSize: 'LETTER',
                    exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8]
                    },
                    customize: function (doc) {

                       // Set smaller font size for table content
                    doc.defaultStyle.fontSize = 8;
                    
                    // Adjust column widths
                    doc.content[doc.content.length-1].table.widths = 
                        ['10%', '10%', '10%', '10%', '10%', '12%', '10%', '13%', '15%'];
                        
                        doc.content.unshift({
                            columns: [
                                {
                                    image: base64Logo,
                                    width: 60,
                                    margin: [-5, 0, 10, 10]
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
                                                text: 'Graduate Tracer Survey Report\n', 
                                                fontSize: 15, 
                                                alignment: 'left', 
                                                margin: [40, 5, 0, 0] 
                                            },
                                            { 
                                                text: new Date().toLocaleDateString(), 
                                                fontSize: 10, 
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
                                lineWidth: 0.8,
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
        });
    
</script>
</body>

</html>
