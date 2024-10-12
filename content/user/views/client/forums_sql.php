<?php
// Pagination Logic
$limit = 5; // Number of threads to display per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page
$offset = ($page - 1) * $limit; // Offset for SQL query

// Get the category ID from the URL
$category_id = isset($_GET['category']) ? intval($_GET['category']) : 0;

// Capture the search input
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// Count total threads for pagination
$total_threads_query = "SELECT COUNT(*) AS total FROM forums";
if ($category_id > 0) {
    $total_threads_query .= " WHERE category_id = $category_id"; // Filter by category
}
$total_threads_result = mysqli_query($conn, $total_threads_query);
$total_threads_row = mysqli_fetch_assoc($total_threads_result);
$total_threads = $total_threads_row['total'];

// Calculate total number of pages
$total_pages = ceil($total_threads / $limit);

// Fetch threads for the current page with limit and offset
$query = "SELECT t.id, t.title, t.created_at, a.fname, a.lname, a.profile, c.name AS category_name 
          FROM forums t
          JOIN alumni a ON t.author_id = a.id
          JOIN forum_category c ON t.category_id = c.id";

$conditions = [];

if ($category_id > 0) {
    $conditions[] = "t.category_id = $category_id";// Filter by category
}

if (!empty($search)) {
  $conditions[] = "(t.title LIKE '%$search%' OR a.fname LIKE '%$search%' OR a.lname LIKE '%$search%')";
}

if (count($conditions) > 0) {
  $query .= " WHERE " . implode(' AND ', $conditions);
}

$query .= " ORDER BY t.created_at DESC LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $query);
?>