<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnite - Register</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://unpkg.com/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO4pCxa7D8S1xkI3M7u4d8aI67ak6jeQ7z1JIG93HmoXaU0FLC6zC" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-wEmeIV1mK2SzT1d47G3nUM3yHz3LMwqNJO6UR/7h6xDDV0MELQ2R7Oog9+VxZhK0" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
<link href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.3/css/bootstrap.min.css">
<script src="https://unpkg.com/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO4pCxa7D8S1xkI3M7u4d8aI67ak6jeQ7z1JIG93HmoXaU0FLC6zC" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-wEmeIV1mK2SzT1d47G3nUM3yHz3LMwqNJO6UR/7h6xDDV0MELQ2R7Oog9+VxZhK0" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
            max-width: 150%;
            height: auto;
        }
        .img-fluid {
            height: 100%;
            object-fit: cover;
        }
        .register-link {
            text-align: center;
            margin-top: 1rem; /* Add some spacing if needed */
        }
        .position-relative {
            position: relative;
        }
        .password-toggle {
            cursor: pointer;
            position: absolute;
            right: 15px !important; /* Adjust this value to move the icon left or right */
            top: 50%;
            transform: translateY(-50%);
        }

        .info {
            cursor: pointer;
            padding-bottom: 5px;
            color: maroon;
        }
    
    </style>
</head>
<body translate="no">
<?php
  if(isset($_POST['submit'])) {
	  include('./connect.php');
	  $fname = $_POST['fname'];
	  $lname = $_POST['lname'];
	  $username = $_POST['username'];
	  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $birthday = $_POST['birthday'];
	  $year = $_POST['year'];
	  $department = $_POST['department'];
	  $course = $_POST['course'];
	  $file = $_POST['file'];
	  $type = 'alumni';
	  $status = 'Pending';
	  //check user
	  $sq = mysqli_query($conn,"SELECT * FROM users WHERE username = '$username'");
	  $count = mysqli_num_rows($sq);
	  if($count > 0) {
		echo '<script>alert("The alumni account you are trying to register is already on the database. Please wait or check your email for the status of your request.");window.location="index.php"</script>';  
	  } else {
	  $sql = "INSERT INTO alumni (fname, lname, username,birthday,year,department,course,file) VALUES ('$fname', '$lname', '$username', '$birthday', '$year', '$department', '$course', '$file')";
		$conn->query($sql);
	  $sql1 = "INSERT INTO users (username, password, type,status) VALUES ('$username', '$password', '$type', '$status')";
		$conn->query($sql1);
		echo '<script>alert("Alumni account has been created. Please wait until admin notify you for the status of your request.");window.location="index.php"</script>';
	  }

  }
  ?>
    <!-- Registration Form -->
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
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <form action="" method="POST" id="login-form">
                                            <div class="row gy-3">
                                                <div class="col-12 col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="fname" id="first_name" placeholder="First Name" pattern="[a-zA-Z ]+" title="You can only use alphabeth letters" required autocomplete="off">
                                                        <label for="first_name" class="form-label">First Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="lname" id="last_name" placeholder="Last Name" pattern="[a-zA-Z ]+"  title="You can only use alphabeth letters" required autocomplete="off">
                                                        <label for="last_name" class="form-label">Last Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="email" class="form-control" name="username" id="username" placeholder="name@example.com" required autocomplete="off">
                                                        <label for="email" class="form-label">Email</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3 position-relative">
                                                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$" title="Password must be minimum of 8 characters, 1 number and 1 special character" required>
                                                        <label for="password" class="form-label">Password</label>
                                                        <span class="position-absolute top-50 end-0 translate-middle-y password-toggle" id="togglePassword">
                                                            <i class="bi bi-eye"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="date" class="form-control" name="birthday" id="birthday" required>
                                                        <label for="birthday" class="form-label">Birthday</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <select class="form-select" name="year" id="username" required placeholder="username">
                                                            <option selected disabled>Choose year...</option>
                                                            <option>2024-2025</option>
                                                            <option>2023-2024</option>
                                                            <option>2022-2023</option>
                                                            <option>2021-2022</option>
                                                            <option>2020-2021</option>
                                                            <option>2019-2020</option>
                                                            <option>2018-2019</option>
                                                            <option>2017-2018</option>
                                                            <option>2016-2017</option>
                                                            <option>2015-2016</option>
                                                            <option>2014-2015</option>
                                                            <option>2013-2014</option>
                                                        </select>
                                                        <label for="year_graduated" class="form-label">Year Graduated</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <select class="form-select" name="department" id="username" required id="department" onchange="dept(this.value)">
                                                        <option selected disabled>Choose department...</option>
                                                        <option>Senior High School</option>
                                                        <option>College of Allied Medical Sciences</option>
                                                        <option>College of Arts and Sciences</option>
                                                        <option>College of Business, Accountancy, and Hospitality Management</option>
                                                        <option>College of Criminal Justice Education</option>
                                                        <option>College of Education</option>
                                                        <option>College of Engineering</option>
                                                        <option>College of Information and Communications Technology</option>
                                                        <option>College of Nursing and Midwifery</option>
                                                        <option>College of Technical Education</option>
                                                        </select>
                                                        <label for="department" class="form-label">Department</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <select class="form-select" name="course" id="course1" required>
                                                            <option selected disabled>Choose course...</option>
                                                
                                                        </select>
                                                        <label for="course1" class="form-label">Course</label>
                                                    </div>
                                                </div>
                                                    <div class="col-12">
                                        <!-- Trigger element for popover -->
                                        <div class="info" data-bs-toggle="popover" data-bs-container="body" data-bs-placement="left" data-bs-content="Use suggested documents like Diploma, Transcript of Records (TOR), Alumni Card, Certificate of Graduate.">
                                            File Upload <i class="bi bi-info-circle"></i>
                                        </div>
                                        <input type="file" placeholder="File Upload" name="file1" id="upload" required placeholder="username"/>
                                        <textarea id="file" name="file" style="display:none"></textarea>
                                    </div>
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button class="btn btn-dark btn-lg" type="submit" name="submit" id="submit1">Register</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="register-link d-flex justify-content-center mt-5">
                                                    <p class="px-1">Already have an account?</p> <a href="login.php" class="link-danger text-decoration-none">Log in</a>
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
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
})
    </script>

    <script>
				function dept(value) {
					var department1 = value;
				//	alert(value);
					if(department1 == 'College of Allied Medical Sciences') {
						document.getElementById('course1').innerHTML = ''+
						'<select placeholder="Course" name="course" id="course"  placeholder="username"/>'+
						'<option selected disabled>Choose course...</option>'+
						'<option>Bachelor of Science in Occupational Therapy</option>'+
						'<option>Bachelor of Science in Physical Therapy</option>'+
						'<option>Bachelor of Science in Respiratory Therapy</option>'+
						'</select>';
					}	
					if(department1 == 'College of Arts and Sciences') {
						document.getElementById('course1').innerHTML = ''+
						'<select placeholder="Course" name="course" id="course"  placeholder="username"/>'+
						'<option selected disabled>Choose course...</option>'+
						'<option>Bachelor in Human Services</option>'+
						'<option>Bachelor of Arts in Communication</option>'+
						'<option>Bachelor of Science in Legal Management</option>'+
						'<option>Bachelor of Arts in Political Science</option>'+
						'<option>Bachelor of Arts in Psychology</option>'+
						'<option>Bachelor of Multimedia Arts</option>'+
						'</select>';
					}	
					if(department1 == 'College of Business, Accountancy, and Hospitality Management') {
						document.getElementById('course1').innerHTML = ''+
						'<select placeholder="Course" name="course" id="course"  placeholder="username"/>'+
                        '<option selected disabled>Choose course...</option>'+
						'<option>Bachelor of Science in Accountancy</option>'+
						'<option>Bachelor of Science in Business Administration major in Business Administration</option>'+
						'<option>Bachelor of Science in Business Administration major in Financial Management</option>'+
						'<option>Bachelor of Science in Business Administration major in Human Resource Development Management</option>'+
						'<option>Bachelor of Science in in Business Administration major in Marketing Management</option>'+
						'<option>Bachelor of Science in Entrepreneurship</option>'+
						'<option>Bachelor of Science in Tourism Management</option>'+
						'<option>Bachelor of Science in Management Accounting</option>'+
						'<option>Bachelor of Science in International Hospitality Management</option>'+
						'<option>Bachelor of Science in International Hospitality Management with Specialization in Cruiseline Operation</option>'+
						'</select>';
					}	
					if(department1 == 'Bachelor of Science in Accountancy') {
						document.getElementById('course1').innerHTML = ''+
						'<select placeholder="Course" name="course" id="course"  placeholder="username"/>'+
                        '<option selected disabled>Choose course...</option>'+
						'<option>Bachelor of Science in Business Administration major in Business Administration</option>'+
						'<option>Bachelor of Science in Business Administration major in Financial Management</option>'+
						'<option>Bachelor of Science in Business Administration major in Human Resource Development Management</option>'+
						'<option>Bachelor of Science in in Business Administration major in Marketing Management</option>'+
						'<option>Bachelor of Science in Entrepreneurship</option>'+
						'<option>Bachelor of Science in Tourism Management</option>'+
						'<option>Bachelor of Science in Management Accounting</option>'+
						'<option>Bachelor of Science in International Hospitality Management</option>'+
						'<option>Bachelor of Science in International Hospitality Management with Specialization in Cruiseline Operation</option>'+
						'</select>';
					}	
					if(department1 == 'College of Criminal Justice Education') {
						document.getElementById('course1').innerHTML = ''+
						'<select placeholder="Course" name="course" id="course"  placeholder="username"/>'+
                        '<option selected disabled>Choose course...</option>'+
						'<option>Bachelor of Science in Criminology</option>'+
						'</select>';
					}	
					if(department1 == 'College of Education') {
						document.getElementById('course1').innerHTML = ''+
						'<select placeholder="Course" name="course" id="course"  placeholder="username"/>'+
                        '<option selected disabled>Choose course...</option>'+
						'<option>Bachelor of Culture and Arts Education</option>'+
						'<option>Bachelor of Early Childhood Education</option>'+
						'<option>Bachelor of Elementary Education</option>'+
						'<option>Bachelor of Physical Education</option>'+
						'<option>Bachelor of Secondary Education</option>'+
						'<option>Bachelor of Special Needs Education</option>'+
						'<option>Certificate in Teaching Program</option>'+
						'<option>Post Baccalaureate Diploma in Alternative Learning System</option>'+
						'</select>';
					}	
					if(department1 == 'College of Engineering') {
						document.getElementById('course1').innerHTML = ''+
						'<select placeholder="Course" name="course" id="course"  placeholder="username"/>'+
                        '<option selected disabled>Choose course...</option>'+
						'<option>Bachelor of Science in Civil Engineering</option>'+
						'<option>Bachelor of Science in Computer Engineering</option>'+
						'<option>Bachelor of Science in Electrical Engineering</option>'+
						'<option>Bachelor of Science in Electronics Engineering</option>'+
						'<option>Bachelor of Science in Industrial Engineering</option>'+
						'<option>Bachelor of Science in Mechanical Engineering</option>'+
						'</select>';
					}	
					if(department1 == 'College of Information and Communications Technology') {
						document.getElementById('course1').innerHTML = ''+
						'<select placeholder="Course" name="course" id="course"  placeholder="username"/>'+
                        '<option selected disabled>Choose course...</option>'+
						'<option>Associate in Computer Technology</option>'+
						'<option>Bachelor of Library and Information Science</option>'+
						'<option>Bachelor of Science in Computer Science</option>'+
						'<option>Bachelor of Science in Information Systems</option>'+
						'<option>Bachelor of Science in Information Technology</option>'+
						'</select>';
					}	
					if(department1 == 'College of Nursing and Midwifery') {
						document.getElementById('course1').innerHTML = ''+
						'<select placeholder="Course" name="course" id="course"  placeholder="username"/>'+
                        '<option selected disabled>Choose course...</option>'+
						'<option>Bachelor of Science in Nursing</option>'+
						'<option>Caregiving (Newborn To Preschooler)</option>'+
						'<option>Health Care Services NC II</option>'+
						'</select>';
					}	
					if(department1 == 'College of Technical Education') {
						document.getElementById('course1').innerHTML = ''+
						'<select placeholder="Course" name="course" id="course"  placeholder="username"/>'+
                        '<option selected disabled>Choose course...</option>'+
						'<option>Automotive Technology</option>'+
						'<option>Drafting/CAD Technology</option>'+
						'<option>Electrical and Instrumentation Technology</option>'+
						'<option>Industrial Automation Technology</option>'+
						'<option>Instrumentation and Control Technology</option>'+
						'</select>';
					}	
					if(department1 == 'Senior High School') {
						document.getElementById('course1').innerHTML = ''+
						'<select placeholder="Course" name="course" id="course"  placeholder="username"/>'+
                        '<option selected disabled>Choose course...</option>'+
						'<option>ABM</option>'+
						'<option>HUMSS</option>'+
						'<option>STEM - E</option>'+
						'<option>STEM - AH</option>'+
						'<option>GAS</option>'+
						'<option>TVL</option>'+
						'<option>Arts and Design</option>'+
						'</select>';
					}	
				}
    
const fileInput = document.getElementById('upload');
fileInput.addEventListener('change', (e) => {
// get a reference to the file
const file = e.target.files[0];

// encode the file using the FileReader API
const reader = new FileReader();
reader.onloadend = () => {

    // use a regex to remove data url part
    const base64String = reader.result;
        document.getElementById('file').value=reader.result; 
    console.log(base64String);
};
reader.readAsDataURL(file);});
				</script>

<style>
.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  padding: 12px 16px;
  z-index: 1;
}

.dropdown:hover .dropdown-content {
  display: block;
}

</style>

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

<script>
// document.querySelector() is used to select an element from the document using its ID
let captchaText = document.querySelector('#captcha');
var ctx = captchaText.getContext("2d");
ctx.font = "50px Roboto";
ctx.fillStyle = "#08e5ff";

let userText = document.querySelector('#textBox');
let submitButton = document.querySelector('#submitButton');
let output = document.querySelector('#output');
let refreshButton = document.querySelector('#refreshButton');

// alphaNums contains the characters with which you want to create the CAPTCHA
let alphaNums = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
let emptyArr = [];
// This loop generates a random string of 7 characters using alphaNums
// Further this string is displayed as a CAPTCHA
for (let i = 1; i <= 7; i++) {
    emptyArr.push(alphaNums[Math.floor(Math.random() * alphaNums.length)]);
}
var c = emptyArr.join('');
ctx.fillText(emptyArr.join(''),captchaText.width/4, captchaText.height/2);

// This event listener is stimulated whenever the user press the "Enter" button
// "Correct!" or "Incorrect, please try again" message is
// displayed after validating the input text with CAPTCHA

// This event listener is stimulated whenever the user clicks the "Submit" button
// "Correct!" or "Incorrect, please try again" message is
// displayed after validating the input text with CAPTCHA
function abc() {
    if (userText.value === c) {
        output.classList.add("correctCaptcha");
       // output.innerHTML = "Correct!";
		//	alert('correct');
			document.getElementById('login-form').submit();
    } else {
        output.classList.add("incorrectCaptcha");
        output.innerHTML = "Incorrect, please try again";
		//recap
		 userText.value = "";
    let refreshArr = [];
    for (let j = 1; j <= 7; j++) {
        refreshArr.push(alphaNums[Math.floor(Math.random() * alphaNums.length)]);
    }
    ctx.clearRect(0, 0, captchaText.width, captchaText.height);
    c = refreshArr.join('');
    ctx.fillText(refreshArr.join(''),captchaText.width/4, captchaText.height/2);
    //output.innerHTML = "";
		//end
		return false;
    }
}
// This event listener is stimulated whenever the user press the "Refresh" button
// A new random CAPTCHA is generated and displayed after the user clicks the "Refresh" button
refreshButton.addEventListener('click', function() {
    userText.value = "";
    let refreshArr = [];
    for (let j = 1; j <= 7; j++) {
        refreshArr.push(alphaNums[Math.floor(Math.random() * alphaNums.length)]);
    }
    ctx.clearRect(0, 0, captchaText.width, captchaText.height);
    c = refreshArr.join('');
    ctx.fillText(refreshArr.join(''),captchaText.width/4, captchaText.height/2);
    output.innerHTML = "";
});
</script>

</body>
</html>
