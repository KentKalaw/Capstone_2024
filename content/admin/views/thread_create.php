<?php include_once('./backend/client.php'); ?>

<?php

$category_result = mysqli_query($conn, "SELECT * FROM forum_category");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $category_id = intval($_POST['category']); // Get selected category

    // Handle posting based on user type
    if ($type == 'admin') {
        // If the user is an admin, insert using admin's login info
        $result = mysqli_query($conn, "SELECT id FROM users WHERE username = '$username'");
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
    $sql = "INSERT INTO forums (title, content, author_id, category_id, author_type) 
            VALUES ('$title', '$content', '$author_id', '$category_id', '$author_type')";
    
    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Forums Thread has been created."); window.location="forums.php";</script>';
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

