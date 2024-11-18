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
  <link rel="stylesheet" type="text/css" href="../css/view_message.css"/>
</head>

<body>
  
  <?php include_once('./sidebar/sidebar.php'); ?>

  <div id="page-content-wrapper">

  <?php include_once('./navbar/navbar.php'); ?>

    <?php
        $idc = $_GET['id'];
        $sql1 = "SELECT * FROM users WHERE username = '$idc'";
        $result1 = $conn->query($sql1);
        while($row1 = $result1->fetch_assoc()) {
            $username1  = $row1['username'];
            $result1 = mysqli_query($conn,"SELECT * FROM alumni WHERE username = '$username1'");
            while($row1=mysqli_fetch_array($result1)) {
                $file1 = $row1['profile'] ?: '../images/ub-logo.png';
                $name1 = $row1['fname'].' '.$row1['lname'];
            }
        }
        ?>

        <div class="back-button-div">
        <button onclick="window.location.href='message.php'" class="back-button">
                    <i class="fas fa-chevron-left"></i>
                </button>
        </div>

        <!-- Chat Container -->
        <div class="chat-container">
            <!-- Chat Header -->
            <div class="chat-header">
           
                <div class="d-flex align-items-center">
                    <img src="<?php echo $file1 ?>" alt="<?php echo $name1 ?>" class="me-3">
                    <div>
                        <h5 class="mb-0"><?php echo $name1 ?></h5>
                        <small class="text-muted">Alumni</small>
                    </div>
                </div>
            </div>

            <!-- Messages Area -->
            <div id="discussion">
                <!-- Messages will be loaded here -->
            </div>

            <!-- Chat Input Area -->
            <div class="chat-input-container">
                <form id="messageForm">
                    <div class="attachment-section">
                        <input type="file" id="input" class="form-control" accept="image/png, image/gif, image/jpeg">
                        <textarea id="file" style="display:none"></textarea>
                    </div>
                    <div class="chat-input-wrapper">
                        <textarea 
                            class="form-control" 
                            id="message" 
                            placeholder="Write a message..."
                            rows="1"
                        ></textarea>
                        <button type="button" class="btn-send" onclick="send_message()">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // File handling
        const fileInput = document.querySelector('input[type="file"]');
        fileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            const reader = new FileReader();
            reader.onloadend = () => {
                document.getElementById('file').value = reader.result;
            };
            if (file) {
                reader.readAsDataURL(file);
            }
        });

        // Auto-resize textarea
        const messageInput = document.getElementById('message');
        messageInput.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });

        // Send message
        function send_message() {
            var message = document.getElementById('message').value.trim();
            if (!message && !document.getElementById('file').value) return;
            
            var user = '<?php echo $_GET["id"] ?>';
            var file = document.getElementById('file').value;
            
            $.ajax({
                url: 'sendmessage.php',
                type: 'post',
                data: {
                    message: message,
                    user: user,
                    file: file
                },
                success: function(data) {
                    document.getElementById('message').value = '';
                    document.getElementById('file').value = '';
                    document.getElementById('input').value = '';
                    messageInput.style.height = 'auto';
                    loadMessages();
                }
            });
        }

        // Enter key handling
        messageInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                send_message();
            }
        });

        // Load messages
        function loadMessages() {
            const discussion = document.getElementById('discussion');
            const isNearBottom = discussion.scrollHeight - discussion.scrollTop <= discussion.clientHeight + 100;

            $('#discussion').load('chats.php?id=<?php echo $_GET["id"] ?>', function() {
                if (isNearBottom) {
                    discussion.scrollTop = discussion.scrollHeight;
                }
            });
        }

        // Initial load and refresh
        loadMessages();
        var auto_refresh = setInterval(loadMessages, 1000);

        // Sidebar toggle
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");
        toggleButton.onclick = function() {
            el.classList.toggle("toggled");
        };
    </script>
</body>
</html>
