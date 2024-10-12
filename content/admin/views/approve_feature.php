<?php
include('../../connect.php');
$id = $_GET['id'];
mysqli_query($conn,"UPDATE profile1 SET status = 'Approved' WHERE id = '$id'");
?>
<script>
alert("Featured alumni request has been approved");
window.location='feature_alumni.php';
</script>