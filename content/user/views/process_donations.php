<?php
// Create process_donation.php
include_once('./backend/client.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response = array();
    

        // Get form data
        $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $amount = (int)$_POST['amount'];
        $contact = $_POST['number'];
        $image = $_POST['file']; 
        $date = date('Y-m-d H:i:s');

        // Insert into database
        $sql = "INSERT INTO donations (fullname, email, amount, contact, image, date) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssisss", $fullname, $email, $amount, $contact, $image, $date);
        if ($stmt->execute()) {
            date_default_timezone_set('Asia/Manila');
            $message = 'Alumni has donated' .' '.$amount.' '.'Pesos';
            $date = date('F d, Y h:i A');
            
            // Insert into audit table
            $audit_sql = "INSERT INTO audit (username, action, timestamp) VALUES ('$username', '$message', '$date')";
            $conn->query($audit_sql);
            echo '<script>alert("Thank you for donation! It is highly appreciated."); window.location="ub_wall.php";</script>';
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    
}
exit;
?>

