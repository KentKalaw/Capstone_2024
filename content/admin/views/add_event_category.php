<?php
include('../../auth.php');
include('../../connect.php');
$username = $_SESSION['username'];
$sql1 = "SELECT * FROM users WHERE username = '$username'";
$result1 = $conn->query($sql1);
while($row1 = $result1->fetch_assoc()) {
	$type = $row1['type'];
	if($type != 'admin') {
		echo '<script>window.location="../../logout.php";</script>';
	}

}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $categoryName = trim($_POST['categoryName']);

    // Insert the new category into the database
    $sql = "INSERT INTO events_category (name) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $categoryName);

    if ($stmt->execute()) {
        date_default_timezone_set('Asia/Manila');
        $message = 'Administrator added '. $categoryName . ' ' . 'as a event category';
        $date = date('F d, Y h:i A');
        
        // Insert into audit table
        $audit_sql = "INSERT INTO audit (username, action, timestamp) VALUES ('$username', '$message', '$date')";
        $conn->query($audit_sql); // Execute the audit insertion
        // Redirect back to forums page or show success message
        echo '<script>alert("Category has been added."); window.location="events.php";</script>';
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>