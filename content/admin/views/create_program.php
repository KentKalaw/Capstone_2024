<?php

include_once('./backend/client.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Get form data
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $subtitle = mysqli_real_escape_string($conn, $_POST['subtitle']);
        $image = $_POST['file']; 
        $date = date('Y-m-d H:i:s');

        // Insert into database
        $sql = "INSERT INTO programs (title, subtitle, image, created_at) 
                VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        $stmt->bind_param("ssss", $title, $subtitle, $image, $date);
        if ($stmt->execute()) {
            date_default_timezone_set('Asia/Manila');
            $message = 'Admin has created a program.';
            $date = date('F d, Y h:i A');
            
            // Insert into audit table
            $audit_sql = "INSERT INTO audit (username, action, timestamp) VALUES ('$username', '$message', '$date')";
            $conn->query($audit_sql);
            echo '<script>alert("Initiative Program Created."); window.location="programs.php";</script>';
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    
}
exit;
?>

