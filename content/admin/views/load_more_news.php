<?php
include_once('./backend/client.php'); 
include_once('./backend/ub_wall_admin_sql.php'); 

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
                            <img src="<?php echo htmlspecialchars($news['postImage']); ?>" class="img-fluid rounded-start" alt="<?php echo htmlspecialchars($news['postTitle']); ?>">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($news['postTitle']); ?></h5>
                                <p class="card-subtitle mb-2"><?php echo htmlspecialchars($news['postSubTitle']); ?></p>
                                <p class="card-text"><small class="text-muted">Posted <?php echo timeAgo($news['postDate']); ?></small></p>
                                <div class="d-flex justify-content-between">
                                <a href="news_detail.php?id=<?php echo $news['id']; ?>" class="btn btn-sm" style="background-color: #752738; color: white;">Read More</a>
                                <div class="">
                                <a href="" 
                                class="btn btn-link text-secondary" 
                                data-bs-toggle="modal" data-bs-target="#updateModal-<?php echo $news['id']; ?>">
                                <i class="fas fa-cog"></i>

                                <a href="delete_news.php?id=<?php echo $news['id']; ?>" 
                                class="btn btn-link text-danger" 
                                style="" 
                                onclick="return confirm('Are you sure you want to delete this news?');">
                                <i class="fa fa-trash-alt"></i>
                                </a>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="updateModal-<?php echo $news['id'];?>" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="news_update.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="news_id" value="<?php echo $news['id']; ?>">
                    <!-- News Title -->
                    <div class="mb-3">
                        <label for="postTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" name="postTitle" id="postTitle" value="<?php echo htmlspecialchars($news['postTitle']); ?>" required>
                    </div>

                    <!-- News SubTitle -->
                    <div class="mb-3">
                        <label for="postSubTitle" class="form-label">SubTitle</label>
                        <textarea class="form-control" name="postSubTitle" id="postSubTitle" rows="2" required><?php echo htmlspecialchars($news['postSubTitle']); ?></textarea>
                    </div>

                    <!-- News Content -->
                    <div class="mb-3">
                        <label for="postContent" class="form-label">Content</label>
                        <textarea class="form-control" name="postContent" id="postContent" rows="8" required><?php echo htmlspecialchars($news['postContent']); ?></textarea>
                    </div>
                    
                    <button type="submit" name="submit" class="btn btn-primary">Update News</button>
                </form>
            </div>
        </div>
    </div>
</div>
        <?php
    }
} else {
    echo '';
}
