<?php
include('../../auth.php');
include('../../connect.php');
$username = $_SESSION['username'];

// Check user type
$sql1 = "SELECT * FROM login WHERE username = '$username'";
$result1 = $conn->query($sql1);
while($row1 = $result1->fetch_assoc()) {
	$type = $row1['type'];
	if($type != 'admin') {
		echo '<script>window.location="../logout.php";</script>';
	}
}

$category_result = mysqli_query($conn, "SELECT * FROM threads_categories");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $category_id = intval($_POST['category']); // Get selected category

    // Handle posting based on user type
    if ($type == 'admin') {
        // If the user is an admin, insert using admin's login info
        $result = mysqli_query($conn, "SELECT id FROM login WHERE username = '$username'");
        $admin = mysqli_fetch_assoc($result);
        $author_id = $admin['id'];
        $author_type = 'admin'; // Mark author type as admin
    } else {
        // If the user is an alumni, use alumni's details
        $result = mysqli_query($conn, "SELECT id FROM alumni WHERE username = '$username'");
        $alumni = mysqli_fetch_assoc($result);
        $author_id = $alumni['id'];
        $author_type = 'alumni'; // Mark author type as alumni
    }

    // Insert the new thread into the database with the category and author type
    $sql = "INSERT INTO threads (title, content, author_id, category_id, author_type) 
            VALUES ('$title', '$content', '$author_id', '$category_id', '$author_type')";
    
    if (mysqli_query($conn, $sql)) {
        header('Location: forums.php'); // Redirect to forum page after successful creation
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Alumnite</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

  <link rel="stylesheet" href="../css/forums.css" />
</head>

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
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col-sm-10">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h3 class="text-center mb-4">Create New Thread</h3>
                            <!-- Create Thread Form -->
                            <form method="POST" action="">
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
                                    <button type="submit" class="btn btn-primary">Create Thread</button>
                                    <a href="forums.php" class="btn btn-secondary">Back to Forum</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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