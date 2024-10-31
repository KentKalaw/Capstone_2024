<?php
				include('../../connect.php');
					$result1 = $conn->query("SELECT * FROM users WHERE status = 'Approved' AND type = 'alumni'");
					$count1 = $result1->num_rows;
					$result2 = $conn->query("SELECT * FROM donations");
					$count2 = $result2->num_rows;
					$result3 = $conn->query("SELECT * FROM users WHERE type = 'alumni' AND status = 'Approved'");
					$count3 = $result3->num_rows;
					$result4 = $conn->query("SELECT * FROM gts1 WHERE a18 = 'Yes'");
					$count4 = $result4->num_rows;
					$result5 = $conn->query("SELECT * FROM profile1 WHERE status = 'Approved'");
					$count5 = $result5->num_rows;
          $result6 = $conn->query("SELECT * FROM events");
          $count6 = $result6->num_rows;
          $result7 = $conn->query("SELECT * FROM yearbook WHERE request_status IN ('Pending', 'Approved')");
          $count7 = $result7->num_rows;
          $result8 = $conn->query("SELECT * FROM alumni_privilege_card WHERE status IN ('Pending', 'Approved')");
          $count8 = $result8->num_rows;
          $result9 = $conn->query("SELECT * FROM campus_tour WHERE status IN ('Pending', 'Approved')");
          $count9 = $result9->num_rows;
				?>
          
<style>
.dashboard-container {
    padding: 2rem;
    max-width: 1400px;
    margin: 0 auto;
}

.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.dashboard-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
    transition: all 0.2s ease;
    border: 1px solid rgba(117, 39, 56, 0.1);
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

/* Enhanced hover effects */
.dashboard-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(117, 39, 56, 0.15);
    border-color: #752738;
}

/* Click effect */
.dashboard-card:active {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(117, 39, 56, 0.1);
}

/* Ripple effect on hover */
.dashboard-card::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(117, 39, 56, 0.03);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.dashboard-card:hover::after {
    opacity: 1;
}

.card-content {
    text-align: center;
    position: relative;
    z-index: 1;
}

.card-icon {
    width: 48px;
    height: 48px;
    margin: 0 auto 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(117, 39, 56, 0.1);
    border-radius: 50%;
    color: #752738;
    transition: all 0.3s ease;
}

/* Icon animation on hover */
.dashboard-card:hover .card-icon {
    transform: scale(1.1);
    background: rgba(117, 39, 56, 0.2);
}

.card-titles {
    color: #752738;
    font-size: 0.875rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    min-height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: color 0.3s ease;
}

.card-value {
    font-size: 2rem;
    font-weight: 700;
    color: #2d3748;
    margin: 0;
    transition: color 0.3s ease;
}

.dashboard-card:hover .card-value {
    color: #752738;
}

.icon {
    font-size: 1.5rem;
    transition: transform 0.3s ease;
}

/* Arrow indicator for clickability */
.card-arrow {
    position: absolute;
    bottom: 1rem;
    right: 1rem;
    color: #752738;
    opacity: 0;
    transform: translateX(-10px);
    transition: all 0.3s ease;
}

.dashboard-card:hover .card-arrow {
    opacity: 1;
    transform: translateX(0);
}
</style>
    <!-- Dashboard Cards -->
    <div class="dashboard-container">
    <div class="dashboard-grid">
        <!-- Registered Alumni Card -->
        <div class="dashboard-card" onclick="window.location.href=''">
            <div class="card-content">
                <div class="card-icon">
                    <i class="fas fa-users icon"></i>
                </div>
                <h6 class="card-titles">Number of Registered Alumni</h6>
                <p class="card-value"><?php echo $count1 ?></p>
                <i class="fas fa-arrow-right card-arrow"></i>
            </div>
        </div>

        <!-- Employed Alumni Card -->
        <div class="dashboard-card" onclick="window.location.href='gts.php'">
            <div class="card-content">
                <div class="card-icon">
                    <i class="fas fa-briefcase icon"></i>
                </div>
                <h6 class="card-titles">Employed Alumni</h6>
                <p class="card-value"><?php echo $count4 ?></p>
                <i class="fas fa-arrow-right card-arrow"></i>
            </div>
        </div>

        <!-- Donation Tracking Card -->
        <div class="dashboard-card" onclick="window.location.href='programs.php'">
            <div class="card-content">
                <div class="card-icon">
                    <i class="fas fa-gift icon"></i>
                </div>
                <h6 class="card-titles">Donation Tracking</h6>
                <p class="card-value"><?php echo $count2 ?></p>
                <i class="fas fa-arrow-right card-arrow"></i>
            </div>
        </div>

        <!-- Featured Alumni Card -->
        <div class="dashboard-card" onclick="window.location.href='feature_alumni.php'">
            <div class="card-content">
                <div class="card-icon">
                    <i class="fas fa-star icon"></i>
                </div>
                <h6 class="card-titles">Featured Alumni</h6>
                <p class="card-value"><?php echo $count5 ?></p>
                <i class="fas fa-arrow-right card-arrow"></i>
            </div>
        </div>

        <!-- Events Card -->
        <div class="dashboard-card" onclick="window.location.href='events.php'">
            <div class="card-content">
                <div class="card-icon">
                    <i class="fas fa-calendar icon"></i>
                </div>
                <h6 class="card-titles">Number of Events</h6>
                <p class="card-value"><?php echo $count6 ?></p>
                <i class="fas fa-arrow-right card-arrow"></i>
            </div>
        </div>

        <!-- Yearbook Delivery Request Card -->
        <div class="dashboard-card" onclick="window.location.href='view_approved_yearbook.php'">
            <div class="card-content">
                <div class="card-icon">
                    <i class="fas fa-book icon"></i>
                </div>
                <h6 class="card-titles">Number of Yearbook Delivery Request</h6>
                <p class="card-value"><?php echo $count7 ?></p>
                <i class="fas fa-arrow-right card-arrow"></i>
            </div>
        </div>

        <!-- Alumni Card Approval Card -->
        <div class="dashboard-card" onclick="window.location.href='view_alumni_privilege_card.php'">
            <div class="card-content">
                <div class="card-icon">
                    <i class="fas fa-id-card icon"></i>
                </div>
                <h6 class="card-titles">Number of Alumni Card Application</h6>
                <p class="card-value"><?php echo $count8 ?></p>
                <i class="fas fa-arrow-right card-arrow"></i>
            </div>
        </div>

        <!-- Campus Tour Request Card -->
        <div class="dashboard-card" onclick="window.location.href='view_campus_tour.php'">
            <div class="card-content">
                <div class="card-icon">
                    <i class="fas fa-building icon"></i>
                </div>
                <h6 class="card-titles">Number of Campus Tour Request</h6>
                <p class="card-value"><?php echo $count9 ?></p>
                <i class="fas fa-arrow-right card-arrow"></i>
            </div>
        </div>
    </div>
</div>