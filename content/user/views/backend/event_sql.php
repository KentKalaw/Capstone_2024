<?php

$limit = 5;  // Number of events per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;  // Current page number, default is 1
$offset = ($page - 1) * $limit;  // Calculate offset

$total_events_sql = "SELECT COUNT(*) AS total FROM events";
$total_events_result = $conn->query($total_events_sql);
$total_events_row = $total_events_result->fetch_assoc();
$total_events = $total_events_row['total'];

$total_pages = ceil($total_events / $limit);

$status = isset($_GET['status']) ? $_GET['status'] : ''; // Get selected status from dropdown
$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : ''; // Get selected category from dropdown

// Fetch all events from the database
$sql2 = "SELECT events.*, events_category.name AS categoryName 
         FROM events 
         JOIN events_category ON events.category_id = events_category.id 
         WHERE 1=1";

// Filter by event status if it's set
if (isset($_GET['status']) && $_GET['status'] != '') {
  $status = $_GET['status'];
  $sql2 .= " AND events.eventStatus = '$status'";
}

// Filter by category if it's set
if (isset($_GET['category_id']) && $_GET['category_id'] != '') {
  $category_id = $_GET['category_id'];
  $sql2 .= " AND events.category_id = $category_id";
}

// Search
if (isset($_GET['search']) && $_GET['search'] != '') {
  $search = $conn->real_escape_string($_GET['search']);
  $sql2 .= " AND (events.eventName LIKE '%$search%' OR events.eventDetails LIKE '%$search%')";
}

$sql2 .= " ORDER BY eventStartDate DESC LIMIT $limit OFFSET $offset";

$result2 = $conn->query($sql2);

?>