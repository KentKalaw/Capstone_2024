<?php include_once('./backend/client.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alumni - Alumnite</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="../css/users.css"/>
</head>

<body>
  
  <?php include_once('./sidebar/sidebar.php'); ?>

  <div id="page-content-wrapper">

  <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4 border-bottom" id="top-bar">
      <div class="d-flex align-items-center justify-content-between w-100">
        <div class="d-flex align-items-center">
          <i class="fa fa-bars primary-text fs-4 me-3" id="menu-toggle" aria-hidden="true"></i>
          <h2 class="fs-4 m-0" style="color:#752738"></h2>
        </div>
        <li class="d-flex align-items-center">
          <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="<?php echo $file ?>" alt="Admin Avatar" class="rounded-circle me-2" style="width: 40px; height: 40px;" onclick="window.location='profile.php'">
            <span class="fs-6 alumni-text" onclick="window.location='profile.php'"><?php echo $fname . ' ' . $lname ?> &nbsp; </span>
          </a>
        </li>
      </div>
    </nav>

    <?php
				$idc = $_GET['id'];
				
$sql1 = "SELECT * FROM users WHERE username = '$idc'";
$result1 = $conn->query($sql1);
while($row1 = $result1->fetch_assoc()) {
	$username1  = $row1['username'];
	$result1 = mysqli_query($conn,"SELECT * FROM alumni WHERE username = '$username1'");
	while($row1=mysqli_fetch_array($result1)) {
		$file1 =$row1['profile'];
		if($file1 == '') {
			$file1 = '../images/ub-logo.png';
		}
		$name1 =$row1['fname'].' '.$row1['lname'];
	}
}

				?>

<div class="container-fluid py-4">
    <!-- Page Title and Profile Section -->
    <div class="row align-items-center mb-4 bg-transparent p-3 rounded">
        <div class="col-md-1 text-center">
            <img src="<?php echo $file1?>" class="rounded-circle img-fluid" style="width: 110px; height: 100px;" alt="Profile Picture">
        </div>
        <div class="col-md-10">
            <h3 class="text-dark"><?php echo $name1; ?></h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Messages</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Message Discussion Section -->
 <div class="row bg-light p-4 rounded-5 mx-3 shadow" style="height: 600px; border-radius:8px;">

        <div class="col-12 d-flex flex-column" style="height: 100%;">
            <!-- Make discussion scrollable -->
            <div id="discussion" class="flex-grow-1 overflow-auto mb-3" style="padding-left: 15px;">
                <!-- Messages will be dynamically loaded here -->
            </div>
            
            <!-- Message form stays at the bottom -->
            <div class="bg-white p-3 rounded shadow-sm">
                <form id="messageForm" class="row g-3">
                    <!-- Message text area and send button in the same row -->
                    <div class="col-12 d-flex">
                        <div class="flex-grow-1 me-2">
                            <textarea class="form-control" id="message" placeholder="Enter your message here"></textarea>
                        </div>
                        <div class="">
                            <button type="button" class="btn btn-primary" id="submit" onclick="send_message()">Send</button>
                        </div>
                    </div>
                    <!-- File upload input below the message and button -->
                    <div class="col-12 mt-3">
                        <label for="input" class="form-label">Attachment:</label>
                        <input type="file" id="input" class="form-control" accept="image/png, image/gif, image/jpeg">
                        <textarea id="file" style="display:none"></textarea>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
  const fileInput = document.querySelector('input');

    // Listen for the change event so we can capture the file
    fileInput.addEventListener('change', (e) => {
        // Get a reference to the file
        const file = e.target.files[0];

        // Encode the file using the FileReader API
        const reader = new FileReader();
        reader.onloadend = () => {
            console.log(reader.result);
			document.getElementById('file').value = reader.result;
            // Logs data:<type>;base64,wL2dvYWwgbW9yZ...
        };
        reader.readAsDataURL(file);
    });
	
	function send_message() {
		var message = document.getElementById('message').value;
		var user = '<?php echo $_GET["id"] ?>';
		var file = document.getElementById('file').value;
		 		// AJAX - Delete Event
				    	$.ajax({
							url: 'sendmessage.php',
							type: 'post',
							data: {
								message: message,
								user: user,
								file: file
								},
							async: false,
							   success:function(data){
				   document.getElementById('message').value = '';
				   document.getElementById('file').value = '';
document.getElementById('discussion').scrollHeight;
							}
						}); 
	}
	
	
var auto_refresh1 = setInterval(
function ()
{
//$('#bet').load('bet.php');
//$('#load').load('start.php');


$('#discussion').load('chats.php?id=<?php echo $_GET["id"] ?>'); 
document.getElementById('discussion').scrollIntoView(false);

var objDiv = document.getElementById("discussion");
objDiv.scrollTop = objDiv.scrollHeight;
console.log("Added");
}, 100); // refresh every 10000 milliseconds
</script>


  </div> <!-- End of page-content-wrapper -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function() {
      el.classList.toggle("toggled");
    };
  </script>
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/facebox/1.3.8/facebox.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/facebox/1.3.8/facebox.min.js"></script>

</body>

</html>
