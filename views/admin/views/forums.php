<?php
include('../../auth.php');
include('../../connect.php');
$username = $_SESSION['username'];
$sql1 = "SELECT * FROM login WHERE username = '$username'";
$result1 = $conn->query($sql1);
while($row1 = $result1->fetch_assoc()) {
	$type = $row1['type'];
	if($type != 'admin') {
		echo '<script>window.location="../logout.php";</script>';
	}

}

// Pagination Logic
$limit = 5; // Number of threads to display per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page
$offset = ($page - 1) * $limit; // Offset for SQL query

$category_id = isset($_GET['category']) ? intval($_GET['category']) : 0;

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

$total_threads_query = "SELECT COUNT(*) AS total FROM threads";
if ($category_id > 0) {
    $total_threads_query .= " WHERE category_id = $category_id"; // Filter by category
}


// Fetch total number of threads
$total_threads_result = mysqli_query($conn, $total_threads_query);
$total_threads_row = mysqli_fetch_assoc($total_threads_result);
$total_threads = $total_threads_row['total'];

// Calculate total number of pages
$total_pages = ceil($total_threads / $limit);

// Fetch threads for the current page with limit and offset
$query = "SELECT t.id, t.title, t.created_at, a.fname, a.lname, a.profile, c.name AS category_name 
          FROM threads t
          JOIN alumni a ON t.author_id = a.id
          JOIN threads_categories c ON t.category_id = c.id";

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


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Alumnite</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
  <link rel="stylesheet" href="../css/forums.css" />
</head>

<style>
  @media (max-width: 767px) {
    .admin-text {
        display: none !important;
    }
  }
</style>

<body>

  <?php include_once('./sidebar/sidebar.php'); ?>

  <div id="page-content-wrapper">

  <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4 border-bottom" id="top-bar">
      <div class="d-flex align-items-center justify-content-between w-100">
        <div class="d-flex align-items-center">
          <i class="fa fa-bars primary-text fs-4 me-3" id="menu-toggle"  aria-hidden="true"></i>
          <h2 class="fs-4 m-0" style="color:#752738">Dashboard</h2>
        </div>
        <li class="d-flex align-items-center">
          <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="../images/admin-logo.jpg" alt="Admin Avatar" class="rounded-circle me-2" style="width: 40px; height: 40px;">
          <span class="fs-6 admin-text">Administrator &nbsp;</span></a>
        </li>
      </div>
    </nav>

    <div class="container my-5">
    <h3 class="text-center mb-4" style="color:#752738;">Forums</h3>

      <!-- Create Thread Button -->
      <div class="d-flex flex-column flex-md-row justify-content-between mb-4">
    <h3 class="mb-0">Threads</h3>
    <div>
        <button class="btn btn-secondary mb-2 mb-md-0 me-md-2" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add Category</button>
        <a href="thread_create.php" class="btn btn-secondary">Create New Thread</a>
    </div>
</div>

<!-- Search function -->
<form class="d-flex mb-4" action="forums.php" method="GET">
    <input class="form-control me-2" type="search" name="search" placeholder="Search threads..." aria-label="Search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
    <button class="btn btn-outline-secondary" type="submit">Search</button>
</form>

    <!-- Display categories as filters -->

    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addCategoryForm" action="add_category.php" method="POST">
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="categoryName" name="categoryName" required autocomplete="off">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Category</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="mb-4">
        <ul class="nav nav-pills flex-wrap">
          <li class="nav-item">
            <a class="nav-link <?php if($category_id == 0) echo 'active'; ?>" href="forums.php">All</a>
          </li>
          <?php 
          $categories_result = mysqli_query($conn, "SELECT * FROM threads_categories");
          while ($category = mysqli_fetch_assoc($categories_result)): 
          ?>
            <li class="nav-item">
              <a class="nav-link <?php if($category_id == $category['id']) echo 'active'; ?>" 
                 href="forums.php?category=<?php echo $category['id']; ?>">
                 <?php echo $category['name']; ?>
              </a>
            </li>
          <?php endwhile; ?>
        </ul>
      </div>

<!-- List threads -->
<div class="list-group">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($thread = mysqli_fetch_assoc($result)): ?>
              <a href="thread_details.php?id=<?php echo $thread['id']; ?>" class="list-group-item list-group-item-action" style="background-color:white;">
                <div class="d-flex align-items-center text-secondary">
                  <img src="<?php echo $thread['profile'] ? : '../images/ub-logo.png'; ?>" alt="Profile Picture" class="rounded-circle me-3" style="width: 50px; height: 50px;">
                  <div class="flex-grow-1">
                    <h5 class="mb-0"><?php echo $thread['title']; ?></h5>
                    <p class="mb-0 text-muted">Posted by <?php echo $thread['fname'] . ' ' . $thread['lname']; ?> in <?php echo $thread['category_name']; ?></p>
                  </div>
                </div>
                <small class="text-muted ms-auto"><?php echo date('F d, Y', strtotime($thread['created_at'])); ?></small>
              </a>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center text-muted">There are no threads in this category yet.</p>
        <?php endif; ?>
      </div>


   <!-- Pagination Links -->
   <?php if ($total_threads > 0): ?>
        <nav aria-label="Page navigation example" class="mt-4">
          <ul class="pagination justify-content-center pagination-maroon">
            <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
              <a class="page-link" href="<?php if($page > 1){ echo "?page=" . ($page - 1) . ($category_id > 0 ? "&category=$category_id" : ""); } else { echo '#'; } ?>">Previous</a>
            </li>
            
            <?php for($i = 1; $i <= $total_pages; $i++): ?>
              <li class="page-item <?php if($i == $page){ echo 'active'; } ?>">
                <a class="page-link" href="?page=<?php echo $i; echo $category_id > 0 ? "&category=$category_id" : ""; ?>"><?php echo $i; ?></a>
              </li>
            <?php endfor; ?>

            <li class="page-item <?php if($page >= $total_pages){ echo 'disabled'; } ?>">
              <a class="page-link" href="<?php if($page < $total_pages){ echo "?page=" . ($page + 1) . ($category_id > 0 ? "&category=$category_id" : ""); } else { echo '#'; } ?>">Next</a>
            </li>
          </ul>
        </nav>
      <?php endif; ?>
  </div> <!-- End of page-content-wrapper -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function() {
      el.classList.toggle("toggled");
    };
  </script>
  <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/facebox/1.3.8/facebox.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/facebox/1.3.8/facebox.min.js"></script>

</body>

</html>
