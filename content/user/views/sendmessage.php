<?php
session_start();
include('../../connect.php');
$username = $_SESSION['username'];
$message = $_POST['message'];
$file = $_POST['file'];
$user2= $_POST['user'];

$date = date('Y-m-d H:i');
$sql = "INSERT INTO message (user1, user2, message,file,date)
VALUES ('$username', '$user2', '$message','$file','$date')";

if ($conn->query($sql) === TRUE) {
  //echo 'Sent';
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>