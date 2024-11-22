<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnite - Login</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://unpkg.com/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO4pCxa7D8S1xkI3M7u4d8aI67ak6jeQ7z1JIG93HmoXaU0FLC6zC" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-wEmeIV1mK2SzT1d47G3nUM3yHz3LMwqNJO6UR/7h6xDDV0MELQ2R7Oog9+VxZhK0" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/png" sizes="512x512" href="./assets/img/favicon/logo.png">
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            background-color: #EBDFD7; /* Background color behind the card */
            display: flex;
            align-items: center;
            justify-content: center;
        }
        section {
            width: 100%;
            height: 100vh; /* Full viewport height */
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
        .register-link {
            text-align: center;
            margin-top: 1rem;
        }
        .position-relative {
            position: relative;
        }
        .password-toggle {
            cursor: pointer;
            position: absolute;
            right: 15px !important;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>
</head>
<body>
    <!-- Login 8 - Bootstrap Brain Component -->
    <section class="p-3 p-md-4 p-xl-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xxl-11">
                    <div class="card border-light-subtle shadow-sm">
                        <div class="row g-0">
                            <div class="col-12 col-md-6">
                                <img class="img-fluid rounded-start" loading="lazy" src="assets/img/hero/main.jpg" alt="Welcome back you've been missed!">
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
                                                    <h5 class="text-center">Now stay connected with your Alma Mater!</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="login-validation.php" method="POST" id="login-form">
                                            <div class="row gy-3">
                                                <div class="col-12">
                                                    <div class="form-floating mb-3 position-relative">
                                                        <input type="text" class="form-control" name="username" id="username" placeholder="name@example.com" required autocomplete="off">
                                                        <label for="text" class="form-label">Email</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3 position-relative">
                                                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                                                        <label for="password" class="form-label">Password</label>
                                                        <span class="position-absolute top-50 end-0 translate-middle-y password-toggle" id="togglePassword">
                                                            <i class="bi bi-eye"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button class="btn btn-dark btn-lg" type="submit" name="submit" id="submit1">Log in</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between align-items-center mt-5">
                                                    <a href="register.php" class="link-danger text-decoration-none">Register Now</a>
                                                    <a href="forgot_password.php" class="link-danger text-decoration-none">Forgot Password?</a>
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
        </div>
    </section>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const passwordToggleIcon = this.querySelector('i');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordToggleIcon.classList.remove('bi-eye');
                passwordToggleIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordToggleIcon.classList.remove('bi-eye-slash');
                passwordToggleIcon.classList.add('bi-eye');
            }
        });
    </script>

<script src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-2c7831bb44f98c1391d6a4ffda0e1fd302503391ca806e7fcc7b9b87197aec26.js"></script>

  
<script id="rendered-js" >
var ac = "<?php echo $_GET['type']; ?>";
if(ac == 'Student') {
    document.getElementById('username').placeholder='Email';
} else {
    document.getElementById('username').placeholder='Email';
}
</script>
<script>
var d = "<?php echo $_SESSION['tries'] ?>";
//alert(d);
if(d >= 3) {
    document.getElementById("username").disabled= true;
    document.getElementById("password").disabled= true;
    document.getElementById("textBox").disabled= true;
    document.getElementById("submit1").disabled= true;
    document.getElementById('warning').innerHTML = "Login attempts exeed maximum tries. Please wait 5 minutes and try again";
}
</script>

</body>
</html>
