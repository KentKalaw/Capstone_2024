<?php
include('../../auth.php');
include('../../connect.php');

$sql1 = "SELECT * FROM alumni WHERE username = '$username'";
$result1 = $conn->query($sql1);
while($row1 = $result1->fetch_assoc()) {
    $fname = $row1['fname'];
    $lname = $row1['lname'];
    $occupation = $row1['occupation'];
    $company = $row1['company'];
    $city = $row1['city'];
    $region = $row1['region'];
    $program = $row1['program'];
    $file = $row1['profile'];
    if ($file == '') {
        $file = '../images/ub-logo.png';
    }

$r = mysqli_query($conn, "SELECT * FROM audit WHERE username = '$username' AND action = 'Alumni account logged in'");
$c = mysqli_num_rows($r);
}

$category_result = mysqli_query($conn, "SELECT * FROM threads_categories");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $category_id = intval($_POST['category']); // Get selected category
    $username = $_SESSION['username'];

    // Get the author (alumni) details from the database
    $result = mysqli_query($conn, "SELECT id FROM alumni WHERE username = '$username'");
    $alumni = mysqli_fetch_assoc($result);
    $author_id = $alumni['id'];

    // Insert the new thread into the database with a category
    $sql = "INSERT INTO threads (title, content, author_id, category_id) 
            VALUES ('$title', '$content', '$author_id', '$category_id')";
    if (mysqli_query($conn, $sql)) {
        date_default_timezone_set('Asia/Manila');
        $message = 'Alumni posted a thread';
        $date = date('F d, Y h:i A');
        
        // Insert into audit table
        $audit_sql = "INSERT INTO audit (username, action, timestamp) VALUES ('$username', '$message', '$date')";
        $conn->query($audit_sql); // Execute the audit insertion
        
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
  <title>Create a new Thread - Alumnite</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

  <link rel="stylesheet" href="../css/forums.css" />
</head>

<body>
  
  <?php include_once('./sidebar/sidebar.php'); ?>

 <div id="page-content-wrapper">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
