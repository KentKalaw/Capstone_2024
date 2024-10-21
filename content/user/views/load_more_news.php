<?php
include_once('./backend/client.php'); 
include_once('./backend/ub_wall_sql.php'); 

$offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
$limit = 4; 

$query = "SELECT * FROM ub_wall ORDER BY postDate DESC LIMIT $limit OFFSET $offset";
$newsResult = getNewsUpdates($conn, $offset, $limit);



if ($newsResult && mysqli_num_rows($newsResult) > 0) {
    while ($news = mysqli_fetch_assoc($newsResult)) {
        ?>
        <div class="col-md-6">
            <div class="card mb-3 shadow-sm">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="<?php echo htmlspecialchars($news['postImage']); ?>" class="img-fluid rounded-start h-100 w-100" alt="<?php echo htmlspecialchars($news['postTitle']); ?>">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($news['postTitle']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($news['postSubTitle']); ?></p>
                            <p class="card-text"><small class="text-muted">Posted <?php echo timeAgo($news['postDate']); ?></small></p>
                            <a href="news_detail.php?id=<?php echo $news['id']; ?>" class="btn btn-sm" style="background-color: #752738; color: white;">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    echo '';
}
