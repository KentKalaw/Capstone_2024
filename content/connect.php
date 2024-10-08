<?php
$servername = "localhost";
$username = "u329692502_ublink";
$password = "0G:qvWC:v";
$dbname = "u329692502_ublink";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
date_default_timezone_set('Asia/Manila');

?>