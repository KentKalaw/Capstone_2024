<?php
function getNewsUpdates($conn, $offset = 0, $limit = 4) {
    $query = "SELECT * FROM ub_wall ORDER BY postDate DESC LIMIT ?, ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $offset, $limit);
    $stmt->execute();
    return $stmt->get_result();
}

function getNewsDetails($conn, $news_id) {
  $query = "SELECT * FROM ub_wall WHERE id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $news_id);
  $stmt->execute();
  $result = $stmt->get_result();
  return $result->fetch_assoc();
}

?>

<?php

function timeAgo($date) {
    $timestamp = strtotime($date);
    $strTime = array("second", "minute", "hour", "day", "month", "year");
    $length = array("60","60","24","30","12","10");

    $currentTime = time();
    if($currentTime >= $timestamp) {
        $diff = time()- $timestamp;
        for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
            $diff = $diff / $length[$i];
        }
        $diff = round($diff);
        return $diff . " " . $strTime[$i] . "s ago";
    }
}
?>