<?php
				include('../../connect.php');
					$result1 = $conn->query("SELECT * FROM login WHERE status = 'Approved' AND type = 'alumni'");
					$count1 = $result1->num_rows;
					$result2 = $conn->query("SELECT * FROM program");
					$count2 = $result2->num_rows;
					$result3 = $conn->query("SELECT * FROM login WHERE type = 'alumni' AND status = 'Approved'");
					$count3 = $result3->num_rows;
					$result4 = $conn->query("SELECT * FROM gts WHERE q2 = 'Yes'");
					$count4 = $result4->num_rows;
					$result5 = $conn->query("SELECT * FROM profile1 WHERE status = 'Approved'");
					$count5 = $result5->num_rows;
          $results6 = $conn->query("SELECT * FROM events");
          $count6 = $results6->num_rows;
				?>

    <!-- Dashboard Cards -->
    <div class="container-fluid px-4 mt-4">
      <div class="row">
        <!-- Registered Alumni Card -->
        <div class="col-md-3 mb-4">
          <div class="card text-secondary bg-light shadow h-100 py-2">
            <div class="card-body">
              <div class="text-center">
                <h6 class="card-title">Number of Registered Alumni</h6>
                <p class="card-text fs-2" style="color: black;"><?php echo $count1 ?></p>
              </div>
            </div>
          </div>
        </div>

        <!-- Employed Alumni Card -->
        <div class="col-md-3 mb-4">
          <div class="card text-secondary bg-light shadow h-100 py-2">
            <div class="card-body">
              <div class="text-center">
                <h6 class="card-title">Employed Alumni</h6>
                <p class="card-text fs-2" style="color: black;"><?php echo $count4 ?></p>
              </div>
            </div>
          </div>
        </div>

        <!-- Donation Tracking Card -->
        <div class="col-md-3 mb-4">
          <div class="card text-secondary bg-light shadow h-100 py-2">
            <div class="card-body">
              <div class="text-center">
                <h6 class="card-title">Donation Tracking</h6>
                <p class="card-text fs-2" style="color: black;"><?php echo $count2 ?></p>
              </div>
            </div>
          </div>
        </div>

        <!-- Featured Alumni Card -->
        <div class="col-md-3 mb-4">
          <div class="card text-secondary bg-light shadow h-100 py-2">
            <div class="card-body">
              <div class="text-center">
                <h6 class="card-title">Featured Alumni</h6>
                <p class="card-text fs-2" style="color: black;"><?php echo $count5 ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <!-- Events Hosted Card -->
        <div class="col-md-3 mb-4">
          <div class="card text-secondary bg-light shadow h-100 py-2">
            <div class="card-body">
              <div class="text-center">
                <h6 class="card-title">Number of Events</h6>
                <p class="card-text fs-2" style="color: black;"><?php echo $count6 ?></p>
              </div>
            </div>
          </div>
        </div>

        <!-- Yearbook Delivery Approval Card -->
        <div class="col-md-3 mb-4">
          <div class="card text-secondary bg-light shadow h-100 py-2">
            <div class="card-body">
              <div class="text-center">
                <h6 class="card-title">Number of Yearbook Delivery Approval</h6>
                <p class="card-text fs-2" style="color: black;">100</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Alumni Card Approval Card -->
        <div class="col-md-3 mb-4">
          <div class="card text-secondary bg-light shadow h-100 py-2">
            <div class="card-body">
              <div class="text-center">
                <h6 class="card-title">Number of Alumni Card Approval</h6>
                <p class="card-text fs-2" style="color: black;">8</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Top Visitors Card -->
        <div class="col-md-3 mb-4">
          <div class="card text-secondary bg-light shadow h-100 py-2">
            <div class="card-body">
              <div class="text-center">
                <h6 class="card-title">Number of Top Visitors</h6>
                <p class="card-text fs-2" style="color: black;">450</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>  