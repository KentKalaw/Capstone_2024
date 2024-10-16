<?php
include('../../auth.php');
include('../../connect.php');
$username = $_SESSION['username'];

// Fetch logged-in user details
$sql1 = "SELECT * FROM alumni WHERE username = '$username'";
$result1 = $conn->query($sql1);
while($row1 = $result1->fetch_assoc()) {
    $alumni_id = $row1['id'];
    $fname = $row1['fname'];
    $lname = $row1['lname'];
    $birthday = $row1['birthday'];
    $occupation = $row1['occupation'];
    $company = $row1['company'];
    $city = $row1['city'];
    $region = $row1['region'];
    $program = $row1['program'];
    $file = $row1['profile'];
    if ($file == '') {
        $file = '../images/ub-logo.png';
    }
}

?>