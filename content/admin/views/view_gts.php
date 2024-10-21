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
  <link rel="icon" type="image/png" sizes="512x512" href="../../assets/img/favicon/logo.png">

  <link rel="stylesheet" href="../css/gts.css" />
</head>

<body>
<?php include_once('./loader/loader.php'); ?>
  <?php include_once('./sidebar/sidebar.php'); ?>

  <div id="page-content-wrapper">

  <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4 border-bottom" id="top-bar">
      <div class="d-flex align-items-center justify-content-between w-100">
        <div class="d-flex align-items-center">
          <i class="fa fa-bars primary-text fs-4 me-3" id="menu-toggle"  aria-hidden="true"></i>
          <h2 class="fs-4 m-0" style="color:#752738">Dashboard</h2>
        </div>
        <li class="d-flex align-items-center">
          <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="../images/admin-logo.jpg" alt="Admin Avatar" class="rounded-circle me-2" style="width: 40px; height: 40px;">
          <span class="fs-6 admin-text">Administrator &nbsp;</span></a>
        </li>
      </div>
    </nav>

    <div class="d-flex px-3 py-3 align-items-center" style="margin-bottom: 20px;">
    <img src="../images/admin-logo.jpg" style="width:90px; height:75px; border-radius:50%; margin-right: 15px;">
    <div class="col-md-5">
        <h3 class="text-themecolor" style="font-size: 1.5em; color:#752738 !important; margin-bottom: 5px;">View Graduate Tracer Survey</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)" style="color:#000 !important;">Home</a></li>
            <li class="breadcrumb-item active">View Graduate Tracer Survey</li>
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

<div class="d-flex justify-content-start mb-3 mx-3 button-group">
        <button class="btn btn-outline-secondary me-2 active" style="box-shadow: none;" onclick="window.location='gts.php'">Back to GTS</button>
</div>

<?php include_once('./backend/view_gts_admin_sql.php'); ?>
  
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
        <label class="form-label">8. Degree(s) & Specialization(s)</label>
        <input type="text" name="a8" required class="form-control" value="<?php echo $a8 ?>">
      </div>
      <div class="mb-3">
        <label class="form-label">9. College or University</label>
        <input type="text" name="a9" required class="form-control" value="<?php echo $a9 ?>">
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
        <input type="text" class="form-control" id="a11" name="a11" value="<?php echo $a11 ?>">
      </div>
      <div class="mb-3">
        <label for="a12" class="form-label">12. Professional Examination(s) Passed</label>
        <input type="text" class="form-control" id="a12" name="a12" value="<?php echo $a12 ?>">
      </div>
      <div class="mb-3">
    <label class="form-label">13. Reason(s) for taking the course(s). You may check more than one answer.</label>
      </div>
      <div class="form-check">
      <input type="radio" name="a13" <?php if($a13 == "High grades in the course or subject area(s)related to the course") echo "checked" ?> required value="High grades in the course or subject area(s)related to the course">High grades in the course or subject area(s)related to the course<br>
<input type="radio" name="a13"  <?php if($a13 == "Good grades in high school") echo "checked" ?>  value="Good grades in high school" >Good grades in high school<br>
<input type="radio" name="a13"  <?php if($a13 == "Influence of parents or relatives") echo "checked" ?>  value="Influence of parents or relatives" >Influence of parents or relatives<br>
<input type="radio" name="a13"  <?php if($a13 == "Peer Influence") echo "checked" ?>  value="Peer Influence" >Peer Influence<br>
<input type="radio" name="a13"  <?php if($a13 == "Inspired by a role model") echo "checked" ?>  value="Inspired by a role model" >Inspired by a role model<br>
<input type="radio" name="a13"  <?php if($a13 == "Strong passion for the profession") echo "checked" ?>  value="Strong passion for the profession" >Strong passion for the profession<br>
<input type="radio" name="a13"  <?php if($a13 == "Prospect for immediate employment") echo "checked" ?>  value="Prospect for immediate employment" >Prospect for immediate employment<br>
<input type="radio" name="a13"  <?php if($a13 == "Status or prestige of the profession") echo "checked" ?>  value="Status or prestige of the profession" >Status or prestige of the profession<br>
<input type="radio" name="a13"  <?php if($a13 == "Availability of course offering in chosen institution") echo "checked" ?>  value="Availability of course offering in chosen institution" >Availability of course offering in chosen institution<br>
<input type="radio" name="a13" <?php if($a13 == "Prospect of career advancement") echo "checked" ?>  value="Prospect of career advancement" >Prospect of career advancement<br>
<input type="radio" name="a13"  <?php if($a13 == "Affordable for the family") echo "checked" ?>  value="Affordable for the family" >Affordable for the family<br>
<input type="radio" name="a13"  <?php if($a13 == "Prospect of attractive compensation") echo "checked" ?>  value="Prospect of attractive compensation" >Prospect of attractive compensation<br>
<input type="radio" name="a13"  <?php if($a13 == "Opportunity for employment abroad") echo "checked" ?>  value="Opportunity for employment abroad" >Opportunity for employment abroad<br>
<input type="radio" name="a13"  <?php if($a13 == "No particular choice or no better idea") echo "checked" ?>  value="No particular choice or no better idea" >No particular choice or no better idea<br>
		<!-- end two -->
		<script>
			function a13(val) {
				alert(val);
				var a13a = "<?php echo $a13 ?>";
			if(val == a13a) {
				this.checked = true;
			}
			}
		</script>
    </div>
    <!-- end -->

    </div>
    <div class="tab-pane fade" id="three" role="tabpanel" aria-labelledby="tertiary-qualifications-tab">
      <!-- Other Tertiary Level Qualification Content Here -->
      <div class="mb-3">
        <label class="form-label">14. Do you possess other tertiary level qualification/advance studies?</label><br>
            </div>
        <div class="form-check">
        <input type="radio" name="a14" value="Yes" required  <?php if($a14 == "Yes") echo "checked" ?> >
            <label class="form-check-label">Yes</label>
        </div>
        <div class="form-check">
            <input type="radio" name="a14" value="No"  <?php if($a14 == "No") echo "checked" ?> >
            <label class="form-check-label">No</label>
        </div>
        <div class="mb-3">
        <label class="form-label">15. If yes, fill up the following: Name of Training Institution/College/University</label>
        <input type="text" class="form-control" id="a15" name="a15" required value="<?php echo $a15 ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">16. Year Graduated for Advance Studies</label>
        <input type="text" class="form-control" id="a16" name="a16" required value="<?php echo $a16 ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">17. What made you pursue advance studies?</label>
    </div>
        <div class="form-check">
        <input type="radio" name="a17" value="For promotion" required <?php if($a17 == "For promotion") echo "checked" ?> >
            <label class="form-check-label">For promotion</label>
        </div>
        <div class="form-check">
        <input type="radio" name="a17" value="For professional development" required <?php if($a17 == "For professional development") echo "checked" ?> >
            <label class="form-check-label">For professional development</label>
        </div>
        <div class="form-check">
        <input type="radio" name="a17" value="Others" required <?php if($a17 == "Others") echo "checked" ?> >
            <label class="form-check-label">Others</label>
        </div>
        <div class="form-check">
        <input type="radio" name="a17" value="N/A" required <?php if($a17 == "N/A") echo "checked" ?> >
            <label class="form-check-label">N/A</label>
        </div>
        <!-- end -->

    </div>
    <div class="tab-pane fade" id="four" role="tabpanel" aria-labelledby="employment-data-tab">
      <!-- Employment Data Content Here -->
      <div class="mb-3">
      <label class="form-label">18. Are you currently employed?</label><br>
    </div>
      <div class="form-check">
      <input type="radio" name="a18" value="Yes" required <?php if($a18 == "Yes") echo "checked" ?> >
        <label class="form-check-label">Yes</label>
      </div>
      <div class="form-check">
      <input type="radio" name="a18" value="No"  <?php if($a18 == "No") echo "checked" ?> >
        <label class="form-check-label">No</label><br>
      </div>

      <div class="mb-3">
        <label class="form-label">19. Present Employment Status</label><br>
        <input type="radio" name="a19" value="Regular or Permanent" required  <?php if($a19 == "Regular or Permanent") echo "checked" ?> >Regular or Permanent<br>
        <input type="radio" name="a19" value="Temporary" required <?php if($a19 == "Temporary") echo "checked" ?> >Temporary<br>
        <input type="radio" name="a19" value="Casual" required <?php if($a19 == "Casual") echo "checked" ?> >Casual<br>
        <input type="radio" name="a19" value="Contractual" required> <?php if($a19 == "Contractual") echo "checked" ?> Contractual<br>
        <input type="radio" name="a19" value="Self-employed" required <?php if($a19 == "Self-employed") echo "checked" ?> >Self-employed<br>
    </div>
    <div class="mb-3">
      <label class="form-label">20. Present occupation (Ex. Grade School Teacher, Electrical Engineer, Self-employed)</label>
      <input type="text" name="a20" id="a20" class="form-control" value="<?php echo $a20; ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">21. Name of Company and Address</label>
      <input type="text" name="a21" id="a21" class="form-control" value="<?php echo $a21; ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">22. Major line of business of the company you are presently employed in.</label>
      <input type="ntext" name="a22" id="a22" class="form-control" value="<?php echo $a22; ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">23. Place of work</label>
      <input type="text" name="a23" id="a23" class="form-control" value="<?php echo $a23; ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">24. Is this your first job after college?</label>
            </div>
      <div class="form-check">
      <input type="radio" name="a24" value="Yes"  <?php if($a24 == "Yes") echo "checked" ?> >
        <label class="form-check-label">Yes</label>
      </div>
      <div class="form-check">
      <input type="radio" name="a24" value="No"  <?php if($a24 == "No") echo "checked" ?> >
        <label class="form-check-label">No</label><br>
      </div>

      <div class="mb-3">
    <label class="form-label">25. What are your reason(s) for staying on the job? You may check more than one answer.</label>
    </div>

    <div class="form-check">
    <input type="radio" name="a25" value="Salaries and benefits"  <?php if($a25 == "Salaries and benefits") echo "checked" ?> >
        <label class="form-check-label">Salaries and benefits</label>
    </div>
    
    <div class="form-check">
    <input type="radio" name="a25" value="Career challenge"  <?php if($a25 == "Career challenge") echo "checked" ?> >
        <label class="form-check-label">Career challenge</label>
    </div>
    
    <div class="form-check">
    <input type="radio" name="a25" value="Related to special skill"  <?php if($a25 == "Related to special skill") echo "checked" ?> >
        <label class="form-check-label">Related to special skill</label>
    </div>
    
    <div class="form-check">
    <input type="radio" name="a25" value="Related to course or program of study"  <?php if($a25 == "Related to course or program of study") echo "checked" ?> >
        <label class="form-check-label">Related to course or program of study</label>
    </div>
    
    <div class="form-check">
    <input type="radio" name="a25" value="Proximity to residence"  <?php if($a25 == "Proximity to residence") echo "checked" ?> >
        <label class="form-check-label">Proximity to residence</label>
    </div>
    
    <div class="form-check">
    <input type="radio" name="a25" value="Peer influence"  <?php if($a25 == "Peer influence") echo "checked" ?> >
        <label class="form-check-label">Peer influence</label>
    </div>
    
    <div class="form-check">
    <input type="radio" name="a25" value="Family influence"  <?php if($a25 == "Family influence") echo "checked" ?> >
        <label class="form-check-label">Family influence</label>
    </div>

    <div class="mb-3">
    <label class="form-label">26. What were your reason(s) for changing job? You may check more than one answer.</label>
    </div>

    <div class="form-check">
    <input type="radio" name="a26" value="Salaries and benefits"  <?php if($a26 == "Salaries and benefits") echo "checked" ?> >
        <label class="form-check-label">Salaries and benefits</label>
    </div>
    
    <div class="form-check">
    <input type="radio" name="a26" value="Career challenge"  <?php if($a26 == "Career challenge") echo "checked" ?> >
        <label class="form-check-label">Career challenge</label>
    </div>
    
    <div class="form-check">
    <input type="radio" name="a26" value="Related to special skills"  <?php if($a26 == "Related to special skill") echo "checked" ?> >
        <label class="form-check-label">Related to special skills</label>
    </div>
    
    <div class="form-check">
    <input type="radio" name="a26" value="Proximity to residence"  <?php if($a26 == "Proximity to residence") echo "checked" ?> >
        <label class="form-check-label">Proximity to residence</label>
    </div>

    <div class="mb-3">
    <label class="form-label">27. What were your reasons for accepting the job? You may check more than one answer.</label>
   </div>
    
    <div class="form-check">
    <input type="radio" name="a27" value="Salaries and benefits"  <?php if($a27 == "Salaries and benefits") echo "checked" ?> >
        <label class="form-check-label">Salaries and benefits</label>
    </div>
    
    <div class="form-check">
    <input type="radio" name="a27" value="Career challenge"  <?php if($a27 == "Career challenge") echo "checked" ?> >
        <label class="form-check-label">Career challenge</label>
    </div>
    
    <div class="form-check">
    <input type="radio" name="a27" value="Related to special skills"  <?php if($a27 == "Related to special skills") echo "checked" ?> >
        <label class="form-check-label">Related to special skills</label>
    </div>
    
    <div class="form-check">
    <input type="radio" name="a27" value="Proximity to residence"  <?php if($a27 == ">Proximity to residence") echo "checked" ?> >
        <label class="form-check-label">Proximity to residence</label>
    </div>

    <div class="mb-3">
    <label class="form-label">28. How did you find your first job?</label>
            </div>
    
    <div class="form-check">
    <input type="radio" name="a28" value="Response to an advertisement"  <?php if($a28 == "Response to an advertisement") echo "checked" ?> >
        <label class="form-check-label">Response to an advertisement</label>
    </div>
    
    <div class="form-check">
        <input type="radio" name="a28" value="As walk-in applicant"  <?php if($a28 == "As walk-in applicant") echo "checked" ?> >
        <label class="form-check-label">As walk-in applicant</label>
    </div>
    
    <div class="form-check">
    <input type="radio" name="a28" value="Recommended by someone"  <?php if($a28 == "Recommended by someone") echo "checked" ?> >
        <label class="form-check-label">Recommended by someone</label>
    </div>
    
    <div class="form-check">
        <input type="radio" name="a28" value="Information from friends"  <?php if($a28 == "") echo "checked" ?> >
        <label class="form-check-label">Information from friends</label>
    </div>
    
    <div class="form-check">
    <input type="radio" name="a28" value="Arranged by school’s job placement officer"  <?php if($a28 == "Arranged by school’s job placement officer") echo "checked" ?>   >
        <label class="form-check-label">Arranged by school’s job placement officer</label>
    </div>
    
    <div class="form-check">
    <input type="radio" name="a28" value="Family business"<?php if($a28 == "Family business") echo "checked" ?>  <?php if($a28 == "") echo "checked" ?> >
        <label class="form-check-label">Family business</label>
    </div>
    
    <div class="form-check">
    <input type="radio" name="a28" value="Job Fair or Public Employment Service"  <?php if($a28 == "Job Fair or Public Employment Service") echo "checked" ?>  <?php if($a28 == "") echo "checked" ?> >
        <label class="form-check-label">Job Fair or Public Employment Service</label>
    </div>
    
    <div class="form-check">
    <input type="radio" name="a28" value="Job Fair or Public Employment Service Office (PESO)"  <?php if($a28 == "Job Fair or Public Employment Service Office (PESO)") echo "checked" ?> >
        <label class="form-check-label">Job Fair or Public Employment Service Office (PESO)</label>
    </div>

    <div class="mb-3">
    <label class="form-label">29. How long did it take you to land your first job?</label>
            </div>
    
    <div class="form-check">
    <input type="radio" name="a29" value="Less than a month"  <?php if($a29 == "Less than a month") echo "checked" ?> >
        <label class="form-check-label">Less than a month</label>
    </div>
    
    <div class="form-check">
    <input type="radio" name="a29" value="1 to 6 months"  <?php if($a29 == "1 to 6 months") echo "checked" ?> >
        <label class="form-check-label">1 to 6 months</label>
    </div>
    
    <div class="form-check">
    <input type="radio" name="a29" value="7 to 11 months"  <?php if($a29 == "7 to 11 months") echo "checked" ?> >
        <label class="form-check-label">7 to 11 months</label>
    </div>
    
    <div class="form-check">
    <input type="radio" name="a29" value="1 year to less than 2 years"  <?php if($a29 == "1 year to less than 2 years") echo "checked" ?> >
        <label class="form-check-label">1 year to less than 2 years</label>
    </div>
    
    <div class="form-check">
    <input type="radio" name="a29" value="2 years to less than 3 years"  <?php if($a29 == "2 years to less than 3 years") echo "checked" ?> >
        <label class="form-check-label">2 years to less than 3 years</label>
    </div>
    
    <div class="form-check">
    <input type="radio" name="a29" value="3 years to less than 4 years"  <?php if($a29 == "3 years to less than 4 years") echo "checked" ?> >
        <label class="form-check-label">3 years to less than 4 years</label>
    </div>

    <div class="mb-3">
    <label class="form-label">30. How many jobs did you have after graduation? (including your present job, if currently employed)</label>
    <input type="text" name="a30" required class="form-control" id="a30" value="<?php echo $a30 ?>">
</div>
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
