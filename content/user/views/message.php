<?php include_once('./backend/client.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alumni - Alumnite</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
  <link rel="icon" type="image/png" sizes="512x512" href="../../assets/img/favicon/logo.png">
  <link rel="stylesheet" type="text/css" href="../css/messages.css"/>
</head>

<body>
<?php include_once('./loader/loader.php'); ?>
<?php include_once('./sidebar/sidebar.php'); ?>

<div id="page-content-wrapper">

<?php include_once('./navbar/navbar.php'); ?>

  <div class="d-flex px-3 py-3 align-items-center mb-4">
    <img src="<?php echo $file ?>" class="rounded-circle me-3" style="width:90px; height:75px;">
    <div>
      <h3 class="text-themecolor" style="font-size: 1.5em; color:#752738 !important;">Messages</h3>
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="javascript:void(0)" style="color:#000 !important;">Home</a></li>
        <li class="breadcrumb-item active">Messages</li>
      </ol>
    </div>
  </div>

  <div class="container-fluid py-4">
    <h3 class="text-center mb-4" style="color:#752738;">Messages</h3>

    <div class="row mb-3">
    <div class="col-md-4 mx-auto">
        <div class="input-group">
            <input type="text" id="searchAlumni" class="form-control" autocomplete="off" placeholder="Search alumni by name...">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
        </div>
    </div>
</div>
    
    <!-- Alumni List -->
    <div id="alumniList" class="row bg-light m-1 p-4 rounded" style="height:300px; overflow-x:auto;">
    <table class="table" id="alumniTable">
        <tr class="alumni-row">
            <?php
            include('../../connect.php');
            $result = mysqli_query($conn, "SELECT * FROM users WHERE type = 'alumni' AND status = 'Approved' ORDER BY ID DESC");
            while ($row = mysqli_fetch_array($result)) {
                $username = $row['username'];
                $result1 = mysqli_query($conn, "SELECT * FROM alumni WHERE username = '$username'");
                while ($row1 = mysqli_fetch_array($result1)) {
                    $profile = $row1['profile'] ?: '../images/ub-logo.png';
                    $name = $row1['fname'] . ' ' . $row1['lname'];
                }
                
                echo '<td class="alumni-item" data-name="' . strtolower($name) . '">';
                echo '<div class="text-center" style="width:100px;height:20px;margin:10px;float:left;font-weight:bold;cursor:pointer" onclick="window.location=\'view_message.php?id=' . $username . '\'">';
                echo '<img src="' . $profile . '" class="img-fluid rounded-circle border border-danger" style="width:100px;height:100px;">';
                echo '<div>' . $name . '</div>';
                echo '</div>';
                echo '</td>';
            }
            ?>
        </tr>
    </table>
</div>

<!-- Message Table -->
<div class="row mt-4">
  <div class="col-12">
    <div class="card border-0 shadow-sm">
      <div class="card-header bg-white border-0 py-3">
        <h5 class="mb-0 text-secondary" style="font-weight: 500;">Recent Messages</h5>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-borderless align-middle d-none d-md-table mb-0">
            <thead>
              <tr style="border-bottom: 2px solid #f0f0f0;">
                <th class="ps-4" style="width: 40%; color: #6c757d; font-weight: 500; font-size: 0.95rem;">Alumni</th>
                <th style="width: 30%; color: #6c757d; font-weight: 500; font-size: 0.95rem;">Last Message</th>
                <th class="text-end pe-4" style="width: 30%; color: #6c757d; font-weight: 500; font-size: 0.95rem;">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include('../../connect.php');
              $username = $_SESSION['username'];

              // Pagination logic
              $items_per_page = 6;
              $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
              $offset = ($page - 1) * $items_per_page;

              // Get total number of messages
              $total_query = "SELECT COUNT(DISTINCT IF(user1 = '$username', user2, user1)) as total 
                              FROM message 
                              WHERE user1 = '$username' OR user2 = '$username'";
              $total_result = $conn->query($total_query);
              $total_rows = $total_result->fetch_assoc()['total'];
              $total_pages = ceil($total_rows / $items_per_page);

              // Get messages list
              $sql = "SELECT m.*, a.fname, a.lname, a.profile 
                      FROM message m 
                      LEFT JOIN alumni a ON (
                          CASE WHEN m.user1 = '$username' THEN m.user2 ELSE m.user1 END = a.username
                      )
                      WHERE m.id IN (
                          SELECT MAX(id) 
                          FROM message 
                          WHERE user1 = '$username' OR user2 = '$username'
                          GROUP BY IF(user1 = '$username', user2, user1)
                      )
                      ORDER BY m.date DESC
                      LIMIT $items_per_page OFFSET $offset";

              $result = $conn->query($sql);
              
              while ($row = $result->fetch_assoc()) {
                $user1 = $row['user1'];
                $name = $row['fname'] . ' ' . $row['lname'];
                $profile = $row['profile'] ?: '../images/ub-logo.png';
                $date = date('F d, Y h:i A', strtotime($row['date']));
                $timeAgo = time_elapsed_string($row['date']);
                
                echo '<tr class="hover-row" style="border-bottom: 1px solid #f0f0f0;">';
                echo '<td class="ps-4">
                        <div class="d-flex align-items-center">
                          <img src="' . $profile . '" class="rounded-circle me-3" style="width: 45px; height: 45px; object-fit: cover;">
                          <div style="font-weight: 500; color: #2c3e50;">' . $name . '</div>
                        </div>
                      </td>';
                echo '<td class="text-muted">' . $timeAgo . '</td>';
                echo '<td class="text-end pe-4">
                        <button class="btn btn-outline-primary btn-sm rounded-pill px-4" 
                                onclick="window.location=\'view_message.php?id=' . $user1 . '\'">
                          <i class="fas fa-comment-alt me-2"></i>View Chat
                        </button>
                      </td>';
                echo '</tr>';
              }
              ?>
            </tbody>
          </table>

          <?php
                if ($total_pages > 1) {
                    echo '<div class="d-flex justify-content-center justify-content-md-end align-items-center py-4">
                            <nav aria-label="Message pagination">
                                <ul class="pagination pagination-sm mb-0">';
                    
                    // Previous button
                    $prev_disabled = ($page <= 1) ? 'disabled' : '';
                    echo '<li class="page-item ' . $prev_disabled . '">
                            <a class="page-link" href="?page=' . ($page - 1) . '" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                          </li>';
                    
                    // Page numbers
                    for ($i = 1; $i <= $total_pages; $i++) {
                        $active = ($i == $page) ? 'active' : '';
                        echo '<li class="page-item ' . $active . '">
                                <a class="page-link" href="?page=' . $i . '">' . $i . '</a>
                              </li>';
                    }
                    
                    // Next button
                    $next_disabled = ($page >= $total_pages) ? 'disabled' : '';
                    echo '<li class="page-item ' . $next_disabled . '">
                            <a class="page-link" href="?page=' . ($page + 1) . '" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                          </li>
                        </ul>
                      </nav>
                    </div>';
                }

                echo '</div></div>';
                ?>

          <div class="d-md-none">
            <?php
            $result = $conn->query($sql);
            
            while ($row = $result->fetch_assoc()) {
              $user1 = $row['user1'];
              $name = $row['fname'] . ' ' . $row['lname'];
              $profile = $row['profile'] ?: '../images/ub-logo.png';
              $timeAgo = time_elapsed_string($row['date']);
              
              echo '<div class="mobile-message-item p-3 border-bottom" onclick="window.location=\'view_message.php?id=' . $user1 . '\'">';
              echo '  <div class="d-flex justify-content-between align-items-center">';
              echo '    <div class="d-flex align-items-center">';
              echo '      <img src="' . $profile . '" class="rounded-circle me-3" style="width: 40px; height: 40px; object-fit: cover;">';
              echo '      <div>';
              echo '        <div class="fw-500 text-dark">' . $name . '</div>';
              echo '        <small class="text-muted">' . $timeAgo . '</small>';
              echo '      </div>';
              echo '    </div>';
              echo '    <i class="fas fa-chevron-right text-muted"></i>';
              echo '  </div>';
              echo '</div>';
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<?php
function time_elapsed_string($datetime) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    if ($diff->d == 0) {
        if ($diff->h == 0) {
            if ($diff->i == 0) {
                return "Just now";
            }
            return $diff->i . "m ago";
        }
        return $diff->h . "h ago";
    }
    if ($diff->d == 1) {
        return "Yesterday";
    }
    if ($diff->d < 7) {
        return $diff->d . "d ago";
    }
    if ($diff->d < 30) {
        return floor($diff->d/7) . "w ago";
    }
    return date('M d', strtotime($datetime));
}
?>

    <?php
    // Update message status
    $username = $_SESSION['username'];
    mysqli_query($conn, "UPDATE message SET status = '1' WHERE user2 = '$username'");
    ?>
  </div>

</div> <!-- End of page-content-wrapper -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  var el = document.getElementById("wrapper");
  var toggleButton = document.getElementById("menu-toggle");

  toggleButton.onclick = function() {
    el.classList.toggle("toggled");
  };
</script>

<script>
document.getElementById('searchAlumni').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const alumniItems = document.getElementsByClassName('alumni-item');
    const alumniRow = document.querySelector('.alumni-row');
    let visibleCount = 0;
    
    // Count visible items and handle display
    Array.from(alumniItems).forEach(item => {
        const name = item.getAttribute('data-name');
        if (name.includes(searchTerm)) {
            item.style.display = '';
            visibleCount++;
        } else {
            item.style.display = 'none';
        }
    });
    
    // Apply left alignment when searching
    if (searchTerm) {
        alumniRow.style.display = 'flex';
        alumniRow.style.justifyContent = 'flex-start';
    } else {
        alumniRow.style.display = 'table-row';
        alumniRow.style.flexWrap = '';
        alumniRow.style.justifyContent = '';
    }
});
</script>

<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/facebox/1.3.8/facebox.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/facebox/1.3.8/facebox.min.js"></script>

</body>

</html>