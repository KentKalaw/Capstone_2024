<?php

$token = $_GET['token'];

$token_hash = hash('sha256', $token);

require 'connect.php';

$sql = "SELECT * FROM users
        WHERE reset_token_hash = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$users = $result->fetch_assoc();

if ($users === null) {
   die("Invalid token");
}

if (strtotime($users['reset_token_expires_at']) <= time()) {
    die("Token expired");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>

<h1>Reset Password</h1>

<form action="process_reset_password.php" method="post">
    <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

    <input type="password" name="password" placeholder="New Password">

    <input type="password" name="confirm_password" placeholder="Confirm Password">
    
    <button type="submit">Reset Password</button>
    
</body>
</html>