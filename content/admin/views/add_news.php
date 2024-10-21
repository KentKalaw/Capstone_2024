<?php

include_once('./backend/client.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $postTitle = mysqli_real_escape_string($conn, $_POST['postTitle']);
    $postSubTitle = mysqli_real_escape_string($conn, $_POST['postSubTitle']);
    $postContent = str_replace(['\r', '\n'], ["\r", "\n"], $_POST['postContent']);
    $postContent = mysqli_real_escape_string($conn, $postContent);
    $postImage = $_POST['file']; 
    $date = date('Y-m-d H:i:s');

    // Insert into database
    $sql = "INSERT INTO ub_wall (postTitle, postSubTitle, postContent, postImage, postDate) 
            VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    
    // Check if $stmt is false (i.e., the query failed to prepare)
    if ($stmt === false) {
        die('Error in SQL query: ' . $conn->error); // Output the SQL error
    }

    // Bind parameters and execute
    $stmt->bind_param("sssss", $postTitle, $postSubTitle, $postContent, $postImage, $date);
    
    if ($stmt->execute()) {
        date_default_timezone_set('Asia/Manila');
        $message = 'Admin has created a news.';
        $date = date('F d, Y h:i A');

        // Insert into audit table
        $audit_sql = "INSERT INTO audit (username, action, timestamp) VALUES ('$username', '$message', '$date')";
        $conn->query($audit_sql);
        echo '<script>alert("UB Wall News and Update Created."); window.location="ub_wall.php";</script>';
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
exit;
?>

