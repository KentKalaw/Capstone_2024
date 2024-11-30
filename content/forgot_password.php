<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnite - Forgot Password</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://unpkg.com/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/png" sizes="512x512" href="./assets/img/favicon/logo.png">
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            background-color: #EBDFD7;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        section {
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            width: 100%;
        }
        .card {
            max-width: 100%;
            height: auto;
        }
        .img-fluid {
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <section class="p-3 p-md-4 p-xl-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xxl-11">
                    <div class="card border-light-subtle shadow-sm">
                        <div class="row g-0">
                            <div class="col-12 col-md-6">
                                <img class="img-fluid rounded-start" loading="lazy" src="assets/img/hero/main.jpg" alt="Forgot Password">
                            </div>
                            <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                                <div class="col-12 col-lg-11 col-xl-10">
                                    <div class="card-body p-3 p-md-4 p-xl-5">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-5">
                                                    <div class="text-center mb-4">
                                                        <a href="">
                                                            <img src="assets/img/branding/header.png" alt="UB Logo" width="175" height="57">
                                                        </a>
                                                    </div>
                                                    <h5 class="text-center">Reset Your Password</h5>
                                                    <p class="text-center text-muted">Enter your email to receive a reset link.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="emailStage">
                                            <form method="POST" action="send_password_reset.php">
                                                <div class="row gy-3">
                                                    <div class="col-12">
                                                        <div class="form-floating mb-3">
                                                            <input type="email" class="form-control" name="email" id="resetEmail" placeholder="name@example.com" required>
                                                            <label for="resetEmail" class="form-label">Email Address</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="d-grid">
                                                            <button class="btn btn-dark btn-lg" type="submit">Send Email</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        
                                        
                                        <div class="row mt-3">
                                            <div class="col-12 text-center">
                                                <a href="login.php" class="link-danger text-decoration-none">Back to Login</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

   
</body>
</html>