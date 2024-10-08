<!-- Modal for Creating Event -->
<?php 
include('../../connect.php');
?>

<?php
				if(isset($_POST['submit'])) {
					include('../../connect.php');
					$eventImage =$_POST['file'];
                    $eventName =mysqli_real_escape_string($conn,$_POST['eventName']);
					$eventDetails =mysqli_real_escape_string($conn,$_POST['eventDetails']);
					$eventType =mysqli_real_escape_string($conn,$_POST['eventType']);
                    $eventStatus =$_POST['eventStatus'];
                    $eventStartDate = $_POST['eventStartDate'];
                    $eventEndDate =$_POST['eventEndDate'];
                    $category_id =$_POST['category_id'];

                $sql = "INSERT INTO events (eventImage, eventName, eventDetails, eventType, eventStatus, eventStartDate, eventEndDate, category_id) VALUES ('$eventImage','$eventName','$eventDetails','$eventType','$eventStatus','$eventStartDate','$eventEndDate','$category_id')";
                $conn->query($sql);
                date_default_timezone_set('Asia/Manila');
                $message = 'Administrator added an events page.';
                $date = date('F d, Y h:i A');
            $save = $conn->query("INSERT INTO audit (username,action, timestamp)VALUES ('admin','$message','$date')");
            echo '<script>alert("Events Page has been added"); window.location="events.php";</script>';
            exit();
            }
            ?>

<div class="modal fade" id="createEventModal" tabindex="-1" aria-labelledby="createEventModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createEventModalLabel">Create New Event</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Event Form -->
        <form method="POST" action="">
          
          <!-- Event Image -->
          <div class="mb-3">
            <label for="upload" class="form-label">Event Image</label>
            <img src="../images/question_mark.jpg" style="width:30%; height: 30%;" id="img">
            <input type="file" id="upload" style=""  accept="image/png, image/gif, image/jpeg">
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

          <!-- Event Name -->
          <div class="mb-3">
            <label for="eventName" class="form-label">Event Name</label>
            <input type="text" class="form-control" id="eventName" name="eventName" placeholder="Enter event name" required>
          </div>

          <!-- Event Details -->
          <div class="mb-3">
            <label for="eventDetails" class="form-label">Event Details</label>
            <textarea class="form-control" id="eventDetails" name="eventDetails" rows="4" placeholder="Enter event details" required></textarea>
          </div>

          <!-- Event Type -->
          <div class="mb-3">
            <label for="eventType" class="form-label">Event Type</label>
            <select class="form-control" id="eventType" name="eventType" required>
              <option value="">Select Event Type</option>
              <option value="On-site">On-site</option>
              <option value="Online">Online</option>
            </select>
          </div>

          <!-- Event Status -->
          <div class="mb-3">
            <label for="eventStatus" class="form-label">Event Status</label>
            <select class="form-control" id="eventStatus" name="eventStatus" required>
              <option value="">Select Event Status</option>
              <option value="Scheduled">Scheduled</option>
              <option value="Ongoing">Ongoing</option>
            </select>
          </div>

          <!-- Event Start Date -->
          <div class="mb-3">
            <label for="eventStartDate" class="form-label">Start Date</label>
            <input type="datetime-local" class="form-control" id="eventStartDate" name="eventStartDate" required>
          </div>

          <!-- Event End Date -->
          <div class="mb-3">
            <label for="eventEndDate" class="form-label">End Date</label>
            <input type="datetime-local" class="form-control" id="eventEndDate" name="eventEndDate" required>
          </div>

          <!-- Event Category -->
          <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-control" id="category_id" name="category_id" required>
              <option value="">Select Event Category</option>
              <!-- Populate categories from the database -->
               <?php 
                $category_result = mysqli_query($conn,"SELECT * FROM events_category");
                ?>
              <?php while ($category = mysqli_fetch_assoc($category_result)): ?>
                <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
              <?php endwhile; ?>
            </select>
          </div>

          <!-- Submit Button -->
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-success" name="submit">Create Event</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>