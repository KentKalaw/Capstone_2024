<?php
				include('../../connect.php');
				if(isset($_POST['submit'])) {
					include('../../connect.php');					
					$username = $_SESSION['username'];
					mysqli_query($conn,"DELETE FROM gts WHERE username = '$username'");
					$a1 = $_POST['a1'];
					$a2 = $_POST['a2'];
					$a3 = $_POST['a3'];
					$a4 = $_POST['a4'];
					$a5 = $_POST['a5'];
					$a6 = $_POST['a6'];
					$a7 = $_POST['a7'];
					$a8 = $_POST['a8'];
					$a9 = $_POST['a9'];
					$a10 = $_POST['a10'];
					$a11 = $_POST['a11'];
					$a12 = $_POST['a12'];
					$a13 = $_POST['a13'];
					$a14 = $_POST['a14'];
					$a15 = $_POST['a15'];
					$a16 = $_POST['a16'];
					$a17 = $_POST['a17'];
					$a18 = $_POST['a18'];
					$a19 = $_POST['a19'];
					$a20 = $_POST['a20'];
					$a21 = $_POST['a21'];
					$a22 = $_POST['a22'];
					$a23 = $_POST['a23'];
					$a24 = $_POST['a24'];
					$a25 = $_POST['a25'];
					$a26 = $_POST['a26'];
					$a27 = $_POST['a27'];
					$a28 = $_POST['a28'];
					$a29 = $_POST['a29'];
					$a30 = $_POST['a30'];
					$username = $_POST['username'];
					$date = date('Y-m-d H:i:s');
					$a = $conn->query("INSERT INTO gts1 (a1,a2,a3,a4,a5,a6,a7,a8,a9,a10,a11,a12,a13,a14,a15,a16,a17,a18,a19,a20,a21,a22,a23,a24,a25,a26,a27,a28,a29,a30,username,date) VALUES ('$a1','$a2','$a3','$a4','$a5','$a6','$a7','$a8','$a9,','$a10','$a11','$a12','$a13','$a14','$a15','$a16','$a17','$a18','$a19','$a20','$a21','$a22','$a23','$a24','$a25','$a26','$a27','$a28','$a29','$a30','$username','$date')");
					
					date_default_timezone_set('Asia/Manila');
					$message = 'Alumni posted Graduate Tracing Survey';
					$date = date('F d, Y h:i A');
				$save = $conn->query("INSERT INTO audit (username,action, timestamp)VALUES ('$username','$message','$date')");
					if($a) {
						echo '<script>alert("Graduate Tracer Survey has been added");window.location="gts.php"</script>';
					} else {
						
					}
				}
				$id = $_GET['id'];
				$result = mysqli_query($conn,"SELECT * FROM gts1 WHERE id = '$id'");
				$count = mysqli_num_rows($result);
				if($count>0) {
					while($row = mysqli_fetch_array($result)) {
					$a1 = $row['a1'];
					$a2 = $row['a2'];
					$a3 = $row['a3'];
					$a4 = $row['a4'];
					$a5 = $row['a5'];
					$a6 = $row['a6'];
					$a7 = $row['a7'];
					$a8 = $row['a8'];
					$a9 = $row['a9'];
					$a10 = $row['a10'];
					$a11 = $row['a11'];
					$a12 = $row['a12'];
					$a13 = $row['a13'];
					$a14 = $row['a14'];
					$a15 = $row['a15'];
					$a16 = $row['a16'];
					$a17 = $row['a17'];
					$a18 = $row['a18'];
					$a19 = $row['a19'];
					$a20 = $row['a20'];
					$a21 = $row['a21'];
					$a22 = $row['a22'];
					$a23 = $row['a23'];
					$a24 = $row['a24'];
					$a25 = $row['a25'];
					$a26 = $row['a26'];
					$a27 = $row['a27'];
					$a28 = $row['a28'];
					$a29 = $row['a29'];
					$a30 = $row['a30'];
					$username = $row['username'];
					$date = $row['date'];
					}
				} else {
						$a1 = "";
					$a2 =  "";
					$a3 =  "";
					$a4 =  "";
					$a5 =  "";
					$a6 =  "";
					$a7 =  "";
					$a8 =  "";
					$a9 =  "";
					$a10 =  "";
					$a11 =  "";
					$a12 =  "";
					$a13 =  "";
					$a14 =  "";
					$a15 =  "";
					$a16 =  "";
					$a17 =  "";
					$a18 =  "";
					$a19 =  "";
					$a20 =  "";
					$a21 =  "";
					$a22 =  "";
					$a23 =  "";
					$a24 =  "";
					$a25 =  "";
					$a26 =  "";
					$a27 =  "";
					$a28 =  "";
					$a29 =  "";
					$a30 =  "";
					
				}
				?>