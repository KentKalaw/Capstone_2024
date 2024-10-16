<?php
				if(isset($_POST['submit'])) {
					include('../../connect.php');
					$lname =$_POST['lname'];
					$fname =$_POST['fname'];
          			$birthday =$_POST['birthday'] && !empty($birthday) ? $birthday : '0000-00-00';
					$occupation =$_POST['occupation'];
					$company =$_POST['company'];
					$region = $_POST['region'];
					$city =$_POST['city'];
					$program =$_POST['program'];
					$file =$_POST['file'];
					$username = $_SESSION['username'];
		$conn->query("UPDATE alumni SET fname = '$fname' WHERE username = '$username'");
		$conn->query("UPDATE alumni SET lname = '$lname' WHERE username = '$username'");
    $conn->query("UPDATE alumni SET birthday = '$birthday' WHERE username = '$username'");
		$conn->query("UPDATE alumni SET occupation = '$occupation' WHERE username = '$username'");
		$conn->query("UPDATE alumni SET company = '$company' WHERE username = '$username'");
		$conn->query("UPDATE alumni SET city = '$city' WHERE username = '$username'");
		$conn->query("UPDATE alumni SET region = '$region' WHERE username = '$username'");
		$conn->query("UPDATE alumni SET program = '$program' WHERE username = '$username'");
		if($file == '') {
			
		} else {
			$conn->query("UPDATE alumni SET profile = '$file' WHERE username = '$username'");
		}
		
					date_default_timezone_set('Asia/Manila');
					$message = 'Alumni updated profile';
					$date = date('F d, Y h:i A');
				$save = $conn->query("INSERT INTO audit (username,action, timestamp)VALUES ('$username','$message','$date')");
		echo '<script>alert("Profile has been updated");window.location="profile.php";</script>';
				}
				?>