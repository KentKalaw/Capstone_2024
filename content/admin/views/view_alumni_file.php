<?php
include('../../connect.php');
$alumni_id = $_GET['id'];
$sql = "SELECT * FROM alumni_privilege_card WHERE id = '$alumni_id'";
    $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
        $alumni_id = $row['id'];
        $image = $row['file'];
    }
?>
<h2>Attachment</h2>
<hr style="width:600px">
<img src="<?php echo $image ?>" style="width:100%; height:600px;">

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