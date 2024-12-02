<?php include_once('./backend/client.php'); ?>
<?php include_once('./backend/forums_admin_sql.php'); ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Alumnite</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
  <link rel="stylesheet" type="text/css" href="../css/forums.css"/>
  <link rel="icon" type="image/png" sizes="512x512" href="../../assets/img/favicon/logo.png">
</head>

<style>
  @media (max-width: 767px) {
    .admin-text {
        display: none !important;
    }
  }
</style>

<body>
<?php include_once('./loader/loader.php'); ?>
  <?php include_once('./sidebar/sidebar.php'); ?>

  <div id="page-content-wrapper">

  <?php include_once('./navbar/navbar.php'); ?>

    <div class="d-flex px-3 py-3 align-items-center" style="margin-bottom: 20px;">
    <img src="../images/admin-logo.jpg" style="width:90px; height:75px; border-radius:50%; margin-right: 15px;">
    <div class="col-md-5">
        <h3 class="text-themecolor" style="font-size: 1.5em; color:#752738 !important; margin-bottom: 5px;">Forums Thread</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)" style="color:#000 !important;">Home</a></li>
            <li class="breadcrumb-item active">Forums</li>
        </ol>
    </div>
</div>

    <div class="container my-5">
    <h3 class="text-center mb-4" style="color:#752738;">Forums</h3>

      <!-- Create Thread Button -->
      <div class="d-flex flex-column flex-md-row justify-content-between mb-4">
    <h3 class="mb-0">Threads</h3>
    <div>
        <button class="btn btn-secondary mb-2 mb-md-0 me-md-2" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add Category</button>
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#createThreadModal">
        Create New Thread
        </button>
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
                <form id="addCategoryForm" action="add_forum_category.php" method="POST">
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
          $categories_result = mysqli_query($conn, "SELECT * FROM forum_category");
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
            <div class="list-group-item list-group-item-action" style="background-color:white; position: relative;">
                <a href="thread_details.php?id=<?php echo $thread['id']; ?>" class="text-decoration-none">
                    <div class="d-flex align-items-center text-secondary">
                        <img src="<?php echo $thread['profile'] ? : '../images/ub-logo.png'; ?>" alt="Profile Picture" class="rounded-circle me-3" style="width: 50px; height: 50px;">
                        <div class="flex-grow-1">
                            <h5 class="mb-0"><?php echo $thread['title']; ?></h5>
                            <p class="mb-0 text-muted">Posted by <?php echo $thread['fname'] . ' ' . $thread['lname']; ?> in <?php echo $thread['category_name']; ?></p>
                        </div>
                    </div>
                    <small class="text-muted ms-auto" style="margin-left: 65px !important;">
    <?php echo date('F d, Y', strtotime($thread['created_at'])); ?> 
    • <span class="badge bg-secondary ms-2"><?php echo $thread['reply_count']; ?> replies</span>
</small>
                </a>
                <!-- Delete Button -->
                <a href="delete_thread.php?id=<?php echo $thread['id']; ?>" 
                   class="btn btn-link text-danger" 
                   style="position: absolute; top: 10px; right: 10px;" 
                   onclick="return confirm('Are you sure you want to delete this thread?');">
                   <i class="fa fa-trash-alt"></i>
                </a>
            </div>
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


<?php $category_result = mysqli_query($conn, "SELECT * FROM forum_category"); ?>
      <!-- Modal -->
<div class="modal fade" id="createThreadModal" tabindex="-1" aria-labelledby="createThreadModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createThreadModalLabel">Create New Thread</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Create Thread Form -->
        <form method="POST" action="thread_create.php">
          <div class="mb-3">
            <label for="title" class="form-label">Thread Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter thread title" required>
          </div>

          <div class="mb-3">
            <label for="content" class="form-label">Thread Content</label>
            <textarea class="form-control" id="content" name="content" rows="6" placeholder="Enter thread content" required></textarea>
          </div>

          <!-- Category Selection -->
          <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-control" id="category" name="category" required>
              <option value="">Select Category</option>
              <?php while ($category = mysqli_fetch_assoc($category_result)): ?>
                <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
              <?php endwhile; ?>
            </select>
          </div>

          <div class="d-grid gap-2">
            <button type="submit" name="threadcreate" class="btn btn-warning">Create Thread</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


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
