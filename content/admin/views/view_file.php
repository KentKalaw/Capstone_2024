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
<img src="<?php echo $file ?>" style="width:100%; height:700px;">

<style>
	#facebox {
  position: fixed;
  top: 50% !important;
  left: 50% !important;
  transform: translate(-50%, -50%) !important;
  max-width: 80% !important;
  width: auto !important;
  height: auto !important;
  padding: 20px !important;
  background-color: #fff !important;
  border: 1px solid #ccc !important;
  border-radius: 5px !important;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.3) !important;
  z-index: 9999 !important;
}

#facebox .popup {
  position: relative !important;
}

#facebox .content {
  display: block !important;
  padding: 0 !important;
}

#facebox .close {
  position: absolute !important;
  top: 10px !important;
  right: 10px !important;
  width: 20px !important;
  height: 20px !important;
  font-size: 24px !important;
  font-weight: bold !important;
  color: #333 !important;
  text-decoration: none !important;
  cursor: pointer !important;
}

#facebox .close:before {
  content: "×" !important;
  display: block !important;
  text-align: center !important;
  line-height: 20px !important;
}

#facebox .close img {
  display: none !important;
}
</style>