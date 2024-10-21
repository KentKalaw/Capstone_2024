<?php include_once('./backend/client.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alumni - Alumnite</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="icon" type="image/png" sizes="512x512" href="./assets/img/favicon/logo.png">

  <link rel="stylesheet" type="text/css" href="../css/gts.css"/>
</head>

<body>
<?php include_once('./loader/loader.php'); ?>
  <?php include_once('./sidebar/sidebar.php'); ?>

  <div id="page-content-wrapper">

  <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4 border-bottom" id="top-bar">
      <div class="d-flex align-items-center justify-content-between w-100">
        <div class="d-flex align-items-center">
          <i class="fa fa-bars primary-text fs-4 me-3" id="menu-toggle" aria-hidden="true"></i>
          <h2 class="fs-4 m-0" style="color:#752738"></h2>
        </div>
        <li class="d-flex align-items-center">
          <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="<?php echo $file ?>" alt="Admin Avatar" class="rounded-circle me-2" style="width: 40px; height: 40px;" onclick="window.location='profile.php'">
            <span class="fs-6 alumni-text" onclick="window.location='profile.php'"><?php echo $fname . ' ' . $lname ?> &nbsp; </span>
          </a>
        </li>
      </div>
    </nav>

    <div class="d-flex px-3 py-3 align-items-center" style="margin-bottom: 20px;">
    <img src="<?php echo $file ?>" style="width:90px; height:75px; border-radius:50%; margin-right: 15px;">
    <div class="col-md-5">
        <h3 class="text-themecolor" style="font-size: 1.5em; color:#752738 !important; margin-bottom: 5px;">Graduate Tracer Survey</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)" style="color:#000 !important;">Home</a></li>
            <li class="breadcrumb-item active">Graduate Tracer Survey</li>
        </ol>
    </div>
</div>

    <div class="container my-5">
    <h3 class="text-center mb-4" style="color:#752738;">Graduate Tracer Survey</h3>
    </div>
    <div class="p-4 bg-white rounded-5 mb-4">
  <p class="mb-0">
    Please complete this GTS questionnaire as accurately & frankly as possible. Your answer will be used for research purposes in order to assess graduate employability and eventually, improve course offerings of your alma mater & other universities/colleges in the Philippines. Your answers to this survey will be treated with strictest confidentiality.
  </p>
</div>

<?php include_once('./backend/gts_sql.php'); ?>
  
  <div class="container mt-5 mb-5">
  <ul class="nav nav-pills nav-tabs" id="myForm" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="general-info-tab" data-bs-toggle="tab" href="#one" role="tab" aria-controls="one" aria-selected="true">A. GENERAL INFORMATION</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="education-background-tab" data-bs-toggle="tab" href="#two" role="tab" aria-controls="two" aria-selected="false">B. EDUCATIONAL BACKGROUND</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="tertiary-qualifications-tab" data-bs-toggle="tab" href="#three" role="tab" aria-controls="three" aria-selected="false">C. OTHER TERTIARY LEVEL QUALIFICATION / ADVANCE STUDIES</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="employment-data-tab" data-bs-toggle="tab" href="#four" role="tab" aria-controls="four" aria-selected="false">D. EMPLOYMENT DATA</a>
  </li>
</ul>
            </div>

<div class="container mt-5 mb-5">
    <form method="post" action="">
      <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="one" role="tabpanel" aria-labelledby="general-info-tab">
      <!-- General Information Content Here -->
      <div class="mb-3">
        <label for="a1" class="form-label">1. Full Name (Last Name, First Name, Middle Name) Make sure to use capital letters.</label>
        <input type="text" class="form-control" id="a1" name="a1" required value="<?php echo $a1 ?>">
      </div>
      <div class="mb-3">
        <label for="a2" class="form-label">2. Permanent Address</label>
        <input type="text" class="form-control" id="a2" name="a2" required value="<?php echo $a2 ?>">
      </div>
      <div class="mb-3">
        <label for="a3" class="form-label">3. Email Address</label>
        <input type="email" class="form-control" id="a3" name="a3" required value="<?php echo $a3 ?>">
      </div>
      <div class="mb-3">
        <label for="a4" class="form-label">4. Contact Number(s)</label>
        <input type="tel" class="form-control" id="a4" name="a4" required value="<?php echo $a4 ?>">
      </div>
      <div class="mb-3">
        <label for="a5" class="form-label">5. Civil Status</label>
        <select class="form-select" id="a5" name="a5" required>
          <option selected><?php echo $a5 ?></option>
          <option value="Single">Single</option>
          <option value="Married">Married</option>
          <option value="Separated">Separated</option>
          <option value="Single Parent">Single Parent</option>
          <option value="Widow/Widower">Widow/Widower</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="a6" class="form-label">6. Sex</label>
        <select class="form-select" id="a6" name="a6" required>
          <option selected><?php echo $a6 ?></option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="a7" class="form-label">7. Birthday</label>
        <input type="date" class="form-control" id="a7" name="a7" required value="<?php echo $a7 ?>">
      </div>
      <!-- end -->
    </div>

    <div class="tab-pane fade" id="two" role="tabpanel" aria-labelledby="education-background-tab">
      <!-- Educational Background Content Here -->
      <div class="mb-3">
        <label for="a8" class="form-label">8. Degree(s) & Specialization(s)</label>
        <select class="form-select" id="a8" name="a8" required>
        <option><?php echo $a8 ?></option>
        <option>Juris Doctor</option>
        <option>Doctor of Philosophy in Business Management</option>
        <option>Doctor of Philosophy in Education major in English</option>
        <option>Doctor of Philosophy in Education major in Educational Management</option>
        <option>Doctor of Philosophy in Education major in Filipino</option>
        <option>Doctor of Philosophy in Education major in Math</option>
        <option>Doctor of Philosophy in Public Administration</option>
        <option>Doctor of Philosophy in Psychology</option>
        <option>Master of Arts in Education major in Educational administration</option>
        <option>Master of Arts in Education major in English</option>
        <option>Master of Arts in Education major in Social Studies</option>
        <option>Master of Arts in Education major in Filipino</option>
        <option>Master in Business Management major in Business Administration</option>
        <option>Master in Business Management major in Human Resource Management</option>
        <option>Master in Public Administration</option>
        <option>Master of Science in Mathematics</option>
        <option>Master in Early Childhood Education</option>
        <option>Master in Physical Education and Sports Science</option>
        <option>Master of Arts in Psychology</option>
        <option>Master of Arts in Clinical Psychology</option>
        <option>Master in Information System</option>
        <option>Master of Arts in Guidance and Counseling</option>
        <option>Master of Engineering Management w/Specialization in Construction & Project Management</option>
        <option>Master in Public Safety Admin & Law Enforcement Leadership</option>
        <option>Bachelor of Science in Electronics Engineering</option>
        <option>Bachelor of Science in Civil Engineering</option>
        <option>Bachelor of Science in Computer Engineering</option>
        <option>Bachelor of Science in Electrical Engineering</option>
        <option>Bachelor of Science in Industrial Engineering</option>
        <option>Bachelor of Science in Mechanical Engineering</option>
        <option>Bachelor of Science in Occupational Therapy</option>
        <option>Bachelor of Science in Respiratory Therapy</option>
        <option>Bachelor of Science in Physical Therapy</option>
        <option>Bachelor of Arts in Communication</option>
        <option>Bachelor of Arts in Political Sciences</option>
        <option>Bachelor of Arts in Psychology</option>
        <option>Bachelor of Science in Legal Management</option>
        <option>Bachelor of Multimedia Arts</option>
        <option>Bachelor in Human Services</option>
        <option>Bachelor of Science on Office Administration</option>
        <option>Bachelor of Science in Accountancy</option>
        <option>Bachelor of Science in Business Administration major in Business Administration</option>
        <option>Bachelor of Science in Business Administration major in Financial Management</option>
        <option>Bachelor of Science in Business Administration major in Human Resource Development Management</option>
        <option>Bachelor of Science in in Business Administration major in Marketing Management</option>
        <option>Bachelor of Science in Internal Auditing</option>
        <option>Bachelor of Science in Business Administration Specialization in Business Analysis Track</option>
        <option>Bachelor of Science in Management Accounting</option>
        <option>Bachelor of Science in Entrepreneurship</option>
        <option>Bachelor of Science in Real Estate Management</option>
        <option>Bachelor of Science in Criminology</option>
        <option>Bachelor of Elementary Education</option>
        <option>Bachelor of Secondary Education (English)</option>
        <option>Bachelor of Secondary Education (Filipino)</option>
        <option>Bachelor of Secondary Education (Mathematics)</option>
        <option>Bachelor of Secondary Education (Social Studies)</option>
        <option>Bachelor of Secondary Education (Science)</option>
        <option>Bachelor of Special Needs Education</option>
        <option>Bachelor of Culture and Arts Education</option>
        <option>Bachelor of Physical Education</option>
        <option>Bachelor of Early Childhood Education</option>
        <option>Associate in Computer Technology (Interactive Graphic Media Design)</option>
        <option>Associate in Computer Technology (IT Service Management)</option>
        <option>Bachelor of Library and Information Science</option>
        <option>Bachelor of Science in Computer Science</option>
        <option>Bachelor of Science in Information System</option>
        <option>Bachelor of Science in International Hospitality Management (Ladderized)</option>
        <option>Bachelor of Science in Tourism Management (Ladderized)</option>
        <option>Bachelor of Science in Travel Management</option>
        <option>Bachelor of Science in International Hospitality Management with Specialization in Cruiseline Operation</option>
        <option>Automotive Technology</option>
        <option>Drafting/ CAD Technology</option>
        <option>Electrical and Instrumentation Technology</option>
        <option>Instrumentation and Control Technology</option>
        <option>Industrial Automation Technology</option>
        <option>Bachelor of Science in Computer Engineering (ETEEAP)</option>
        <option>Bachelor of Science in Electrical Engineering (ETEEAP)</option>
        <option>Bachelor of Science in Industrial Engineering (ETEEAP)</option>
        <option>Bachelor of Arts in Psychology (ETEEAP)</option>
        <option>Bachelor of Arts in Political Science (ETEEAP)</option>
        <option>Bachelor of Elementary Education (ETEEAP)</option>
        <option>Bachelor of Secondary Education (ETEEAP)</option>
        <option>Bachelor of Science in in Business Administration (ETEEAP)</option>
        <option>Bachelor of Library and Information Science (ETEEAP)</option>
        <option>Bachelor of Science in Computer Science (ETEEAP)</option>
        <option>Bachelor of Science in International Hospitality Management (ETEEAP)</option>
        <option>Bachelor of Science on Office Administration (ETEEAP)</option>
        <option>Bachelor of Science in Nursing</option>
        <option>Health Care Services</option>
        <option>Bachelor of Science in Psychology</option>
    </select>
      </div>
      <div class="mb-3">
        <label for="a9" class="form-label">9. College or University</label>
        <select class="form-select" id="a9" name="a9" required>
          <option selected><?php echo $a9 ?></option>
          <option value="University of Batangas - Batangas Campus">University of Batangas - Batangas Campus</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="a10" class="form-label">10. Year Graduated</label>
        <select class="form-select" id="a10" name="a10" required>
          <option selected><?php echo $a10 ?></option>
          <option value="A.Y 2017-2018">A.Y 2017-2018</option>
          <option value="A.Y 2018-2019">A.Y 2018-2019</option>
          <option value="A.Y 2019-2020">A.Y 2019-2020</option>
          <option value="A.Y 2020-2021">A.Y 2020-2021</option>
          <option value="A.Y 2021-2022">A.Y 2021-2022</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="a11" class="form-label">11. Honor(s) or Award(s) Received</label>
        <input type="text" class="form-control" id="a11" name="a11" required value="<?php echo $a11 ?>">
      </div>
      <div class="mb-3">
        <label for="a12" class="form-label">12. Professional Examination(s) Passed</label>
        <input type="text" class="form-control" id="a12" name="a12" required value="<?php echo $a12 ?>">
      </div>
      <div class="mb-3">
    <label for="a13" class="form-label">13. Reason(s) for taking the course(s). You may check more than one answer.</label>
      </div>
      <div class="form-check">
        <input type="checkbox" name="a13" value="Good grades in high school" class="form-check-input" id="goodGrades" required>
        <label class="form-check-label" for="goodGrades">Good grades in high school</label>
    </div>
    
    <div class="form-check">
        <input type="checkbox" name="a13" value="Influence of parents or relatives" class="form-check-input" id="influenceParents">
        <label class="form-check-label" for="influenceParents">Influence of parents or relatives</label>
    </div>
    
    <div class="form-check">
        <input type="checkbox" name="a13" value="Peer Influence" class="form-check-input" id="peerInfluence">
        <label class="form-check-label" for="peerInfluence">Peer Influence</label>
    </div>
    
    <div class="form-check">
        <input type="checkbox" name="a13" value="Inspired by a role model" class="form-check-input" id="roleModel">
        <label class="form-check-label" for="roleModel">Inspired by a role model</label>
    </div>
    
    <div class="form-check">
        <input type="checkbox" name="a13" value="Strong passion for the profession" class="form-check-input" id="strongPassion">
        <label class="form-check-label" for="strongPassion">Strong passion for the profession</label>
    </div>
    
    <div class="form-check">
        <input type="checkbox" name="a13" value="Prospect for immediate employment" class="form-check-input" id="immediateEmployment">
        <label class="form-check-label" for="immediateEmployment">Prospect for immediate employment</label>
    </div>
    
    <div class="form-check">
        <input type="checkbox" name="a13" value="Status or prestige of the profession" class="form-check-input" id="statusPrestige">
        <label class="form-check-label" for="statusPrestige">Status or prestige of the profession</label>
    </div>
    
    <div class="form-check">
        <input type="checkbox" name="a13" value="Availability of course offering in chosen institution" class="form-check-input" id="courseAvailability">
        <label class="form-check-label" for="courseAvailability">Availability of course offering in chosen institution</label>
    </div>
    
    <div class="form-check">
        <input type="checkbox" name="a13" value="Prospect of career advancement" class="form-check-input" id="careerAdvancement">
        <label class="form-check-label" for="careerAdvancement">Prospect of career advancement</label>
    </div>
    
    <div class="form-check">
        <input type="checkbox" name="a13" value="Affordable for the family" class="form-check-input" id="affordableFamily">
        <label class="form-check-label" for="affordableFamily">Affordable for the family</label>
    </div>
    
    <div class="form-check">
        <input type="checkbox" name="a13" value="Prospect of attractive compensation" class="form-check-input" id="attractiveCompensation">
        <label class="form-check-label" for="attractiveCompensation">Prospect of attractive compensation</label>
    </div>
    
    <div class="form-check">
        <input type="checkbox" name="a13" value="Opportunity for employment abroad" class="form-check-input" id="employmentAbroad">
        <label class="form-check-label" for="employmentAbroad">Opportunity for employment abroad</label>
    </div>
    
    <div class="form-check">
        <input type="checkbox" name="a13" value="No particular choice or no better idea" class="form-check-input" id="noParticularChoice">
        <label class="form-check-label" for="noParticularChoice">No particular choice or no better idea</label>
    </div>
    <!-- end -->

    </div>
    <div class="tab-pane fade" id="three" role="tabpanel" aria-labelledby="tertiary-qualifications-tab">
      <!-- Other Tertiary Level Qualification Content Here -->
      <div class="mb-3">
        <label for="a14" class="form-label">14. Do you possess other tertiary level qualification/advance studies?</label><br>
            </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="a14" id="a14Yes" value="Yes" required>
            <label class="form-check-label" for="a14Yes">Yes</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="a14" id="a14No" value="No">
            <label class="form-check-label" for="a14No">No</label>
        </div>
        <div class="mb-3">
        <label for="a15" class="form-label">15. If yes, fill up the following: Name of Training Institution/College/University</label>
        <input type="text" class="form-control" id="a15" name="a15" required value="<?php echo $a15 ?>">
    </div>
    <div class="mb-3">
        <label for="a16" class="form-label">16. Year Graduated for Advance Studies</label>
        <input type="text" class="form-control" id="a16" name="a16" required value="<?php echo $a16 ?>">
    </div>
    <div class="mb-3">
        <label for="a17" class="form-label">17. What made you pursue advance studies?</label>
    </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="a17" id="promotion" value="For promotion" required>
            <label class="form-check-label" for="promotion">For promotion</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="a17" id="professionalDevelopment" value="For professional development" required>
            <label class="form-check-label" for="professionalDevelopment">For professional development</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="a17" id="others" value="Others" required>
            <label class="form-check-label" for="others">Others</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="a17" id="na" value="N/A" required>
            <label class="form-check-label" for="na">N/A</label>
        </div>
        <!-- end -->

    </div>
    <div class="tab-pane fade" id="four" role="tabpanel" aria-labelledby="employment-data-tab">
      <!-- Employment Data Content Here -->
      <div class="mb-3">
      <label for="a18" class="form-label">18. Are you currently employed?</label><br>
    </div>
      <div class="form-check">
        <input type="radio" id="employedYes" name="a18" value="Yes" class="form-check-input" required>
        <label class="form-check-label" for="employedYes">Yes</label>
      </div>
      <div class="form-check">
        <input type="radio" id="employedNo" name="a18" value="No" class="form-check-input">
        <label class="form-check-label" for="employedNo">No</label>
      </div>

      <div class="mb-3">
      <label for="a19" class="form-label">19. Present Employment Status</label>
      <select name="a19" id="a19" class="form-select">
        <option value=""><?php echo $a19; ?></option>
        <option value="Regular/Permanent">Regular/Permanent</option>
        <option value="Contractual">Contractual</option>
        <option value="Self-employed">Self-employed</option>
        <option value="Part-time">Part-time</option>
        <option value="Others">Others</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="a20" class="form-label">20. Present occupation (Ex. Grade School Teacher, Electrical Engineer, Self-employed)</label>
      <input type="text" name="a20" id="a20" class="form-control" value="<?php echo $a20; ?>" required>
    </div>

    <div class="mb-3">
      <label for="a21" class="form-label">21. Name of Company and Address</label>
      <input type="text" name="a21" id="a21" class="form-control" value="<?php echo $a21; ?>" required>
    </div>

    <div class="mb-3">
      <label for="a22" class="form-label">22. Major line of business of the company you are presently employed in.</label>
      <input type="ntext" name="a22" id="a22" class="form-control" value="<?php echo $a22; ?>" required>
    </div>

    <div class="mb-3">
      <label for="a22" class="form-label">23. Place of work</label>
      <input type="text" name="a23" id="a23" class="form-control" value="<?php echo $a23; ?>" required>
    </div>

    <div class="mb-3">
      <label for="a24" class="form-label">24. Is this your first job after college?</label><br>
            </div>
      <div class="form-check">
        <input type="radio" id="jobRelatedYes" name="a24" value="Yes" class="form-check-input" required>
        <label class="form-check-label" for="jobRelatedYes">Yes</label>
      </div>
      <div class="form-check">
        <input type="radio" id="jobRelatedNo" name="a24" value="No" class="form-check-input">
        <label class="form-check-label" for="jobRelatedNo">No</label>
      </div>

      <div class="mb-3">
    <label for="a25" class="form-label">25. What are your reason(s) for staying on the job? You may check more than one answer.</label>
    </div>

    <div class="form-check">
        <input type="checkbox" name="a25" value="Salaries and benefits" class="form-check-input" id="salariesBenefits">
        <label class="form-check-label" for="salariesBenefits">Salaries and benefits</label>
    </div>
    
    <div class="form-check">
        <input type="checkbox" name="a25" value="Career challenge" class="form-check-input" id="careerChallenge">
        <label class="form-check-label" for="careerChallenge">Career challenge</label>
    </div>
    
    <div class="form-check">
        <input type="checkbox" name="a25" value="Related to special skill" class="form-check-input" id="relatedSpecialSkill">
        <label class="form-check-label" for="relatedSpecialSkill">Related to special skill</label>
    </div>
    
    <div class="form-check">
        <input type="checkbox" name="a25" value="Related to course or program of study" class="form-check-input" id="relatedCourse">
        <label class="form-check-label" for="relatedCourse">Related to course or program of study</label>
    </div>
    
    <div class="form-check">
        <input type="checkbox" name="a25" value="Proximity to residence" class="form-check-input" id="proximityResidence">
        <label class="form-check-label" for="proximityResidence">Proximity to residence</label>
    </div>
    
    <div class="form-check">
        <input type="checkbox" name="a25" value="Peer influence" class="form-check-input" id="peerInfluence">
        <label class="form-check-label" for="peerInfluence">Peer influence</label>
    </div>
    
    <div class="form-check">
        <input type="checkbox" name="a25" value="Family influence" class="form-check-input" id="familyInfluence">
        <label class="form-check-label" for="familyInfluence">Family influence</label>
    </div>

    <div class="mb-3">
    <label for="a26" class="form-label">26. What were your reason(s) for changing job? You may check more than one answer.</label>
    </div>

    <div class="form-check">
        <input type="checkbox" name="a26" value="Salaries and benefits" class="form-check-input" id="salariesBenefits">
        <label class="form-check-label" for="salariesBenefits">Salaries and benefits</label>
    </div>
    
    <div class="form-check">
        <input type="checkbox" name="a26" value="Career challenge" class="form-check-input" id="careerChallenge">
        <label class="form-check-label" for="careerChallenge">Career challenge</label>
    </div>
    
    <div class="form-check">
        <input type="checkbox" name="a26" value="Related to special skills" class="form-check-input" id="relatedSpecialSkills">
        <label class="form-check-label" for="relatedSpecialSkills">Related to special skills</label>
    </div>
    
    <div class="form-check">
        <input type="checkbox" name="a26" value="Proximity to residence" class="form-check-input" id="proximityResidence">
        <label class="form-check-label" for="proximityResidence">Proximity to residence</label>
    </div>

    <div class="mb-3">
    <label for="a27" class="form-label">27. What were your reasons for accepting the job? You may check more than one answer.</label>
   </div>
    
    <div class="form-check">
        <input type="checkbox" name="a27" value="Salaries and benefits" class="form-check-input" id="salariesBenefits">
        <label class="form-check-label" for="salariesBenefits">Salaries and benefits</label>
    </div>
    
    <div class="form-check">
        <input type="checkbox" name="a27" value="Career challenge" class="form-check-input" id="careerChallenge">
        <label class="form-check-label" for="careerChallenge">Career challenge</label>
    </div>
    
    <div class="form-check">
        <input type="checkbox" name="a27" value="Related to special skills" class="form-check-input" id="relatedSpecialSkills">
        <label class="form-check-label" for="relatedSpecialSkills">Related to special skills</label>
    </div>
    
    <div class="form-check">
        <input type="checkbox" name="a27" value="Proximity to residence" class="form-check-input" id="proximityResidence">
        <label class="form-check-label" for="proximityResidence">Proximity to residence</label>
    </div>

    <div class="mb-3">
    <label for="a28" class="form-label">28. How did you find your first job?</label>
            </div>
    
    <div class="form-check">
        <input type="radio" name="a28" value="Response to an advertisement" class="form-check-input" id="responseAdvertisement">
        <label class="form-check-label" for="responseAdvertisement">Response to an advertisement</label>
    </div>
    
    <div class="form-check">
        <input type="radio" name="a28" value="As walk-in applicant" class="form-check-input" id="walkInApplicant">
        <label class="form-check-label" for="walkInApplicant">As walk-in applicant</label>
    </div>
    
    <div class="form-check">
        <input type="radio" name="a28" value="Recommended by someone" class="form-check-input" id="recommendedBySomeone">
        <label class="form-check-label" for="recommendedBySomeone">Recommended by someone</label>
    </div>
    
    <div class="form-check">
        <input type="radio" name="a28" value="Information from friends" class="form-check-input" id="infoFromFriends">
        <label class="form-check-label" for="infoFromFriends">Information from friends</label>
    </div>
    
    <div class="form-check">
        <input type="radio" name="a28" value="Arranged by school’s job placement officer" class="form-check-input" id="arrangedByOfficer">
        <label class="form-check-label" for="arrangedByOfficer">Arranged by school’s job placement officer</label>
    </div>
    
    <div class="form-check">
        <input type="radio" name="a28" value="Family business" class="form-check-input" id="familyBusiness">
        <label class="form-check-label" for="familyBusiness">Family business</label>
    </div>
    
    <div class="form-check">
        <input type="radio" name="a28" value="Job Fair or Public Employment Service" class="form-check-input" id="jobFairPESO">
        <label class="form-check-label" for="jobFairPESO">Job Fair or Public Employment Service</label>
    </div>
    
    <div class="form-check">
        <input type="radio" name="a28" value="Job Fair or Public Employment Service Office (PESO)" class="form-check-input" id="jobFairPESOOffice">
        <label class="form-check-label" for="jobFairPESOOffice">Job Fair or Public Employment Service Office (PESO)</label>
    </div>

    <div class="mb-3">
    <label for="a29" class="form-label">29. How long did it take you to land your first job?</label>
            </div>
    
    <div class="form-check">
        <input type="radio" name="a29" value="Less than a month" class="form-check-input" id="lessThanAMonth">
        <label class="form-check-label" for="lessThanAMonth">Less than a month</label>
    </div>
    
    <div class="form-check">
        <input type="radio" name="a29" value="1 to 6 months" class="form-check-input" id="oneToSixMonths">
        <label class="form-check-label" for="oneToSixMonths">1 to 6 months</label>
    </div>
    
    <div class="form-check">
        <input type="radio" name="a29" value="7 to 11 months" class="form-check-input" id="sevenToElevenMonths">
        <label class="form-check-label" for="sevenToElevenMonths">7 to 11 months</label>
    </div>
    
    <div class="form-check">
        <input type="radio" name="a29" value="1 year to less than 2 years" class="form-check-input" id="oneToTwoYears">
        <label class="form-check-label" for="oneToTwoYears">1 year to less than 2 years</label>
    </div>
    
    <div class="form-check">
        <input type="radio" name="a29" value="2 years to less than 3 years" class="form-check-input" id="twoToThreeYears">
        <label class="form-check-label" for="twoToThreeYears">2 years to less than 3 years</label>
    </div>
    
    <div class="form-check">
        <input type="radio" name="a29" value="3 years to less than 4 years" class="form-check-input" id="threeToFourYears">
        <label class="form-check-label" for="threeToFourYears">3 years to less than 4 years</label>
    </div>

    <div class="mb-3">
    <label for="a30" class="form-label">30. How many jobs did you have after graduation? (including your present job, if currently employed)</label>
    <input type="text" name="a30" required class="form-control" id="a30" value="<?php echo $a30 ?>">
</div>

<input type="submit" name="submit" value="Submit" class="btn btn-primary" style="background:#800000">
      


    </div>

      <!-- ending -->
        </div>
    </form>   
</div>

<!-- The Modal -->
<div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Personal Data Protection Notice</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="color: #000; font-weight: bold; padding: 30px;">
        This Personal Data Protection Notice prepared in accordance with the Data Privacy Act 2012, sets out our personal information protection practices that are put in place to protect the personal information of individuals whom we deal with.
        <br><br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary close" data-bs-dismiss="modal">Confirm</button>
        <button type="button" class="btn btn-danger" onclick="window.location='index.php';">Cancel</button>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    var myModal = new bootstrap.Modal(document.getElementById('myModal'));
    myModal.show();
  });
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('#myForm a').on('click', function (e) {
      e.preventDefault();
      $(this).tab('show');
    });
  });

  var el = document.getElementById("wrapper");
  var toggleButton = document.getElementById("menu-toggle");

  toggleButton.onclick = function() {
    el.classList.toggle("toggled");
  };
</script>
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
</body>

</html>
