<?php
// Pagination Logic
$limit = 5; // Number of threads to display per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page
$offset = ($page - 1) * $limit; // Offset for SQL query

// Get the category ID from the URL
$category_id = isset($_GET['category']) ? intval($_GET['category']) : 0;

// Capture the search input
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// Base query for counting total threads
$total_threads_query = "SELECT COUNT(DISTINCT t.id) AS total 
                        FROM forums t
                        JOIN alumni a ON t.author_id = a.id
                        JOIN forum_category c ON t.category_id = c.id";

// Base query for fetching threads
$query = "SELECT t.id, t.title, t.created_at, a.fname, a.lname, a.profile, c.name AS category_name,
          COUNT(r.id) AS reply_count
          FROM forums t
          JOIN alumni a ON t.author_id = a.id
          JOIN forum_category c ON t.category_id = c.id
          LEFT JOIN forum_replies r ON t.id = r.thread_id";

$conditions = [];

if ($category_id > 0) {
    $conditions[] = "t.category_id = $category_id";
}

if (!empty($search)) {
    $conditions[] = "(t.title LIKE '%$search%' OR a.fname LIKE '%$search%' OR a.lname LIKE '%$search%')";
}

if (count($conditions) > 0) {
    $where_clause = " WHERE " . implode(' AND ', $conditions);
    $total_threads_query .= $where_clause;
    $query .= $where_clause;
}

// Execute total threads query
$total_threads_result = mysqli_query($conn, $total_threads_query);
$total_threads_row = mysqli_fetch_assoc($total_threads_result);
$total_threads = $total_threads_row['total'];

// Calculate total number of pages
$total_pages = ceil($total_threads / $limit);

// Complete the main query
$query .= " GROUP BY t.id
            ORDER BY t.created_at DESC 
            LIMIT $limit OFFSET $offset";

// Execute main query
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>