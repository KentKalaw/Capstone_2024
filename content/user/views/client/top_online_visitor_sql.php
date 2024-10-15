<?php
$r = mysqli_query($conn, "SELECT * FROM top_online_visitor WHERE username = '$username' AND action = 'Alumni account logged in'");
$c = mysqli_num_rows($r);

date_default_timezone_set('Asia/Manila');

$loginResult = mysqli_query($conn, "
    SELECT a.fname, a.lname, COUNT(t.username) AS login_count
    FROM top_online_visitor t
    JOIN alumni a ON t.username = a.username
    WHERE t.action = 'Alumni account logged in'
      AND STR_TO_DATE(t.timestamp, '%M %d, %Y %h:%i %p') >= CURDATE()  -- Start at 12:00 AM
      AND STR_TO_DATE(t.timestamp, '%M %d, %Y %h:%i %p') <= CURDATE() + INTERVAL 1 DAY - INTERVAL 1 SECOND  -- End at 11:59 PM
    GROUP BY t.username
    HAVING login_count >= 3  -- Require a minimum of 5 logins
    ORDER BY login_count DESC
    LIMIT 3
");

?>