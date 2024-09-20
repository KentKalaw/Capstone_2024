<?php
include('../../connect.php');
$id =$_GET['id'];
$sql1 = "SELECT * FROM alumni WHERE id = '$id'";
$result1 = $conn->query($sql1);
while($row1 = $result1->fetch_assoc()) {
	$id =$row1['id'];
	$ub_id  = sprintf("%04d", $id);
	$fname =$row1['fname'];
	$lname =$row1['lname'];
	$year =$row1['year'];
	$department =$row1['department'];
	$course =$row1['course'];
	$file =$row1['file'];
	$date =$row1['date'];
}
?>
<h2>Attachment</h2>
<hr style="width:500px">
<img src="<?php echo $file ?>" style="width:100%">