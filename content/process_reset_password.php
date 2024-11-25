<?php
$token = $_POST['token'];

// Hash the token for verification
$token_hash = hash('sha256', $token);

require 'connect.php'; // Assuming this initializes the $conn variable for database connection

// Validate the reset token
$sql = "SELECT * FROM users WHERE reset_token_hash = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token_hash);
$stmt->execute();
$result = $stmt->get_result();
$users = $result->fetch_assoc();

if ($users === null) {
    die("<script>alert('Invalid token'); window.location.href = 'login.php';</script>");
}

// Check if the token has expired
if (strtotime($users['reset_token_expires_at']) <= time()) {
    die("<script>alert('Token expired'); window.location.href = 'login.php';</script>");
}

// Validate the new password
if (strlen($_POST["password"]) < 8) {
    die("<script>alert('Password must be at least 8 characters'); window.history.back();</script>");
}

if (!preg_match("/[a-z]/i", $_POST["password"])) {
    die("<script>alert('Password must contain at least one letter'); window.history.back();</script>");
}

if (!preg_match("/[0-9]/", $_POST["password"])) {
    die("<script>alert('Password must contain at least one number'); window.history.back();</script>");
}

if ($_POST["password"] !== $_POST["confirm_password"]) {
    die("<script>alert('Passwords must match'); window.history.back();</script>");
}

// Hash the new password
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

// Update the user's password and reset token
$sql = "UPDATE users
        SET password = ?,
            reset_token_hash = NULL,
            reset_token_expires_at = NULL
        WHERE id = ?";
$stmt = $conn->prepare($sql); // Use $conn instead of $mysqli
$stmt->bind_param("si", $password_hash, $users["id"]); // Use "i" for an integer ID
$stmt->execute();

// Redirect to login with an alert
echo "<script>alert('Password updated successfully! You can now login.'); window.location.href = 'login.php';</script>";
?>