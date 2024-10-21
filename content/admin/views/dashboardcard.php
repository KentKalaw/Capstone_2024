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
          

    <!-- Dashboard Cards -->
    <div class="container-fluid px-4 mt-4">
      <div class="row">
        <!-- Registered Alumni Card -->
        <div class="col-md-3 mb-4">
          <div class="card bg-light shadow h-100 py-2">
            <div class="card-body">
              <div class="text-center">
                <h6 class="card-title" style="color:#752738">Number of Registered Alumni</h6>
                <p class="card-text fs-2" style="color: black;"><?php echo $count1 ?></p>
              </div>
            </div>
          </div>
        </div>

        <!-- Employed Alumni Card -->
        <div class="col-md-3 mb-4">
        <div class="card bg-light shadow h-100 py-2">
            <div class="card-body">
              <div class="text-center">
                <h6 class="card-title"style="color:#752738">Employed Alumni</h6>
                <p class="card-text fs-2" style="color: black;"><?php echo $count4 ?></p>
              </div>
            </div>
          </div>
        </div>

        <!-- Donation Tracking Card -->
        <div class="col-md-3 mb-4">
        <div class="card bg-light shadow h-100 py-2">
            <div class="card-body">
              <div class="text-center">
                <h6 class="card-title"style="color:#752738">Donation Tracking</h6>
                <p class="card-text fs-2" style="color: black;"><?php echo $count2 ?></p>
              </div>
            </div>
          </div>
        </div>

        <!-- Featured Alumni Card -->
        <div class="col-md-3 mb-4">
        <div class="card bg-light shadow h-100 py-2">
            <div class="card-body">
              <div class="text-center">
                <h6 class="card-title"style="color:#752738">Featured Alumni</h6>
                <p class="card-text fs-2" style="color: black;"><?php echo $count5 ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <!-- Events Hosted Card -->
        <div class="col-md-3 mb-4">
        <div class="card bg-light shadow h-100 py-2">
            <div class="card-body">
              <div class="text-center">
                <h6 class="card-title"style="color:#752738">Number of Events</h6>
                <p class="card-text fs-2" style="color: black;"><?php echo $count6 ?></p>
              </div>
            </div>
          </div>
        </div>

        <!-- Yearbook Delivery Request Card -->
        <div class="col-md-3 mb-4">
        <div class="card bg-light shadow h-100 py-2">
            <div class="card-body">
              <div class="text-center">
                <h6 class="card-title"style="color:#752738">Number of Yearbook Delivery Request</h6>
                <p class="card-text fs-2" style="color: black;"><?php echo $count7 ?></p>
              </div>
            </div>
          </div>
        </div>

        <!-- Alumni Card Approval Card -->
        <div class="col-md-3 mb-4">
        <div class="card bg-light shadow h-100 py-2">
            <div class="card-body">
              <div class="text-center">
                <h6 class="card-title"style="color:#752738">Number of Alumni Card Application</h6>
                <p class="card-text fs-2" style="color: black;"><?php echo $count8 ?></p>
              </div>
            </div>
          </div>
        </div>

        <!-- Top Visitors Card -->
        <div class="col-md-3 mb-4">
        <div class="card bg-light shadow h-100 py-2">
            <div class="card-body">
              <div class="text-center">
                <h6 class="card-title"style="color:#752738">Number of Campus Tour Request</h6>
                <p class="card-text fs-2" style="color: black;"><?php echo $count9 ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>  