<?php
include('../../connect.php');
$id =$_GET['id'];
$sql = "SELECT * FROM donations";
                $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()) {
                    $donation_id = $row['id'];
                    $fullname = $row['fullname'];
                    $email = $row['email'];
                    $amount = $row['amount'];
                    $number = $row['contact'];
                    $image = $row['image'];
                    $date = $row['date'];
                }
?>
<h2>Attachment</h2>
<hr style="width:300px">
<img src="<?php echo $image ?>" style="width:50%;margin-left:470px;">