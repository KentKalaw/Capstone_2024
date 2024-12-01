<?php include_once('./backend/client.php'); 

$eventsQuery = "SELECT event_id, eventName FROM events ORDER BY eventStartDate DESC";
$eventsResult = $conn->query($eventsQuery);
$events = $eventsResult->fetch_all(MYSQLI_ASSOC);

$currentMonth = isset($_GET['month']) ? $_GET['month'] : date('m');
$currentYear = isset($_GET['year']) ? $_GET['year'] : date('Y');

$monthName = date('F', mktime(0, 0, 0, $currentMonth, 1, $currentYear));

// Query to get distinct years and months from the data
$distinctDatesSQL = "SELECT DISTINCT 
                      YEAR(STR_TO_DATE(timestamp, '%M %d, %Y %h:%i %p')) as year,
                      MONTH(STR_TO_DATE(timestamp, '%M %d, %Y %h:%i %p')) as month
                    FROM top_online_visitor
                    ORDER BY year DESC, month DESC";
$distinctDatesResult = $conn->query($distinctDatesSQL);



$result1 = $conn->query("SELECT * FROM users WHERE status = 'Approved' AND type = 'alumni'");
$count1 = $result1->num_rows;

$result2 = $conn->query("SELECT * FROM events WHERE eventStatus IN ('Scheduled', 'Ongoing')");
$count2 = $result2->num_rows;

$result3 = $conn->query("SELECT COUNT(DISTINCT id) as total_logins FROM top_online_visitor WHERE DATE(STR_TO_DATE(timestamp, '%M %d, %Y %h:%i %p')) = CURDATE()");
$count3 = $result3->fetch_assoc()['total_logins'];


        $result4 = $conn->query("SELECT COUNT(DISTINCT ep.alumni_id) AS active_participants_count FROM events_participation ep WHERE ep.participationStatus = 'Approved'");
        $row = $result4->fetch_assoc();
        $activeParticipantsCount = $row['active_participants_count'];

        $result5 = $conn->query("SELECT COUNT(DISTINCT ev.alumni_id) AS active_volunteers_count FROM events_volunteer ev WHERE ev.volunteerStatus = 'Approved'");
        $row = $result5->fetch_assoc();
        $activeVolunteersCount = $row['active_volunteers_count'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Alumnite</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/admin.css"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" type="image/png" sizes="512x512" href="../../assets/img/favicon/logo.png">
    <style>
        .card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
            border: none;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .stats-card {
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .chart-container {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }
        
        .breadcrumb {
            background: transparent;
        }
        
        .stats-number {
            font-size: 2rem;
            font-weight: 600;
            color: #752738;
        }
        
        .stats-label {
            color: #666;
            font-size: 0.9rem;
        }
        
        .section-title {
            color: #752738;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #f0f0f0;
        }
        
        #eventSelect {
            border-radius: 10px;
            border: 1px solid #e0e0e0;
            padding: 0.5rem;
            width: 100%;
            max-width: 300px;
            margin: 0 auto 2rem;
        }
        #monthYearSelect {
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    padding: 0.5rem;
    background-color: white;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

#monthYearSelect:hover {
    border-color: #752738;
    box-shadow: 0 2px 8px rgba(117, 39, 56, 0.1);
}

#monthYearSelect:focus {
    outline: none;
    border-color: #752738;
    box-shadow: 0 2px 8px rgba(117, 39, 56, 0.2);
}
    </style>
</head>

<body>
    <?php include_once('./loader/loader.php'); ?>
    <?php include_once('./sidebar/sidebar.php'); ?>

    <div id="page-content-wrapper">
        <?php include_once('./navbar/navbar.php'); ?>

        <!-- Header Section -->
        <div class="d-flex px-4 py-4 align-items-center">
            <img src="../images/admin-logo.jpg" style="width:70px; height:70px; border-radius:50%; margin-right: 15px;">
            <div>
                <h3 class="mb-1" style="color:#752738; font-size: 1.7rem;">System Analytics</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0)" style="color:#666;">Home</a></li>
                        <li class="breadcrumb-item active" style="color:#752738;">System Analytics</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="container-fluid px-4">
            <div class="row">
                <div class="col-md-3">
                    <div class="card stats-card">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-sign-in-alt fa-2x me-3" style="color: #752738;"></i>
                            <div>
                                <div class="stats-number"><?php echo $count3 ?></div>
                                <div class="stats-label">Today's Logins</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stats-card">
                        <div class="d-flex align-items-center">
                        <i class="fas fa-calendar-alt fa-2x me-3" style="color: #752738;"></i>
                            <div>
                                <div class="stats-number"><?php echo $count2 ?></div>
                                <div class="stats-label">Active Events</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stats-card">
                        <div class="d-flex align-items-center">
                        <i class="fas fa-user-check fa-2x me-3" style="color: #752738;"></i>
                            <div>
                                <div class="stats-number"><?php echo $activeParticipantsCount ?></div>
                                <div class="stats-label">Active Event Participants</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stats-card">
                        <div class="d-flex align-items-center">
                        <i class="fas fa-user-check fa-2x me-3" style="color: #752738;"></i>
                            <div>
                                <div class="stats-number"><?php echo $activeVolunteersCount ?></div>
                                <div class="stats-label">Active Event Volunteers</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Login Analytics Chart -->
            <div class="row mt-4">
                <div class="col-12">
                    <h4 class="section-title">Login Activity</h4>
                    <div class="chart-container">
                        <!-- Add Month/Year Selector Dropdown -->
                            <div class="container-fluid px-4">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div class="d-flex align-items-center">
                                                <label for="monthYearSelect" class="me-2 text-muted">Filter by:</label>
                                                <select id="monthYearSelect" class="form-select" style="width: 200px;">
                                                    <?php while ($date = $distinctDatesResult->fetch_assoc()): ?>
                                                        <?php 
                                                            $monthName = date('F', mktime(0, 0, 0, $date['month'], 1));
                                                            $selected = ($date['month'] == $currentMonth && $date['year'] == $currentYear) ? 'selected' : '';
                                                        ?>
                                                        <option value="<?php echo $date['month'] . '-' . $date['year']; ?>" <?php echo $selected; ?>>
                                                            <?php echo $monthName . ' ' . $date['year']; ?>
                                                        </option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="chart-container" style="position: relative; height: 400px; width: 100%;">
                            <canvas id="loginChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Events Analytics -->
            <div class="row mt-4">
    <div class="col-12">
        <h4 class="section-title">Events Analytics</h4>
        <div class="text-center mb-4">
            <select id="eventSelect" class="form-select" style="max-width: 300px; margin: 0 auto;">
                <option value="">Select an event</option>
                <?php foreach ($events as $event): ?>
                    <option value="<?php echo htmlspecialchars($event['event_id']); ?>">
                        <?php echo htmlspecialchars($event['eventName']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="row">
            <!-- Participation Chart -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-4">Event Participation and Volunteer Count</h5>
                        <div class="chart-container" style="position: relative; height: 300px;">
                            <canvas id="eventParticipationChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Batch Distribution Chart -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-4">Batch Distribution</h5>
                        <div class="chart-container" style="position: relative; height: 300px;">
                            <canvas id="batchDistributionChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



                        <!-- Active Events Participants Analytics -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <h4 class="section-title">Active Events Participants Analytics</h4>
                                <div class="chart-container">
                                    <div class="d-flex justify-content-center" style="position: relative; height: 400px; width: 100%;">
                                        <canvas id="participantsChart" style="width: 300px; height: auto;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Active Events Volunteer Analytics -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <h4 class="section-title">Active Events Volunteer Analytics</h4>
                                <div class="chart-container">
                                    <div class="d-flex justify-content-center" style="position: relative; height: 400px; width: 100%;">
                                        <canvas id="volunteersChart" style="width: 300px; height: auto;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

        </div> 
    </div>

    <?php include_once('./backend/login_analytics.php'); ?>
    <?php include_once('./backend/events_analytics.php'); ?>
    <?php include_once('./backend/active_event_participation_sql.php'); ?>
    <?php include_once('./backend/active_event_volunteer_sql.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>

    
</body>
</html>