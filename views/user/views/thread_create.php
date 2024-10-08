<?php
include('../../auth.php');
include('../../connect.php');

$sql1 = "SELECT * FROM alumni WHERE username = '$username'";
$result1 = $conn->query($sql1);
while($row1 = $result1->fetch_assoc()) {
    $fname = $row1['fname'];
    $lname = $row1['lname'];
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

$category_result = mysqli_query($conn, "SELECT * FROM threads_categories");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $category_id = intval($_POST['category']); // Get selected category
    $username = $_SESSION['username'];

    // Get the author (alumni) details from the database
    $result = mysqli_query($conn, "SELECT id FROM alumni WHERE username = '$username'");
    $alumni = mysqli_fetch_assoc($result);
    $author_id = $alumni['id'];

    // Insert the new thread into the database with a category
    $sql = "INSERT INTO threads (title, content, author_id, category_id) 
            VALUES ('$title', '$content', '$author_id', '$category_id')";
    if (mysqli_query($conn, $sql)) {
        date_default_timezone_set('Asia/Manila');
        $message = 'Alumni posted a thread';
        $date = date('F d, Y h:i A');
        
        // Insert into audit table
        $audit_sql = "INSERT INTO audit (username, action, timestamp) VALUES ('$username', '$message', '$date')";
        $conn->query($audit_sql); // Execute the audit insertion
        
        echo '<script>alert("Forum Thread has been created."); window.location="forums.php";</script>';
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

