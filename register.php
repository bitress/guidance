<?php 

    include_once 'PHP/all.inc.php';





if (isset($_SESSION['student'])) {

	header('Location: '. BASE_URL);

}


if (isset($_POST['register'])) {

    #STUDENT INFO
    $student_id = $_POST['student_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $year = $_POST['year'];
    $section = $_POST['section'];
    $course = $_POST['course'];
    $password = $_POST['password'];
	$email = $_POST['email'];
	$contact_number = $_POST['contact_number'];
	$address = $_POST['address'];
    $academic_year = $_POST['academic_year'];
    $semester = $_POST['semester'];
    $encrypted_password = md5($password);
    $age = $_POST['age'];
    $birthplace = $_POST['placeofbirth'];
	$birthdate = $_POST['birth_month'] . '-' . $_POST['birth_day']. '-'. $_POST['birth_year'];
    $civilstatus = $_POST['civilstatus'];
    $religion = $_POST['religion'];
    $citizenship = $_POST['citizenship'];

    #FAMILY
    $f_name = $_POST['f_name'];
    $f_birthdate = $_POST['fbirth_month'] . '-'. $_POST['fbirth_day'] . '-'. $_POST['fbirth_year'];
    $f_address = $_POST['Faddress'];
    $f_contact_number = $_POST['Fcontact_number'];
    $f_education = $_POST['fHighesEducationAttained'];
    $f_businessaddress = $_POST['Fbaddress'];
    
    $m_name = $_POST['m_name'];
    $m_birthdate = $_POST['mbirth_month'] . '-'. $_POST['mbirth_day'] . '-'. $_POST['mbirth_year'];
    $m_address = $_POST['Maddress'];
    $m_contact_number = $_POST['Mcontact_number'];
    $m_education = $_POST['mHighesEducationAttained'];
    $m_businessaddress = $_POST['Mbaddress'];

    $elem_school = $_POST['elem_school'];
    $elem_address = $_POST['elem_address'];
    $elem_grad = $_POST['elem_grad'];
    $elem_award = $_POST['elem_award'];

    $high_school = $_POST['high_school'];
    $high_address = $_POST['high_address'];
    $high_grad = $_POST['high_grad'];
    $high_award = $_POST['high_award'];

    $vocational_school = $_POST['vocational_school'];
    $vocational_address = $_POST['vocational_address'];
    $vocational_grad = $_POST['vocational_grad'];
    $vocational_award = $_POST['vocational_award'];
    
    $college_school = $_POST['college_school'];
    $college_address = $_POST['college_address'];
    $college_grad = $_POST['college_grad'];
    $college_award = $_POST['college_award'];

    $award_title = $_POST['award_title'];
    $award_date = $_POST['awardMonth'] . '-'. $_POST['awardDay'] . '-' . $_POST['awardYear'];

    $work_company = $_POST['work_company'];
    $work_address = $_POST['work_address'];
    $work_assign = $_POST['work_assign'];
    $work_duration = $_POST['work_duration'];
    $work_award = $_POST['work_award'];

    $school_org = $_POST['school_org'];
    $school_pos = $_POST['school_pos'];
    $school_date = $_POST['school_date'];

    $seminar_title = $_POST['seminar_title'];
    $seminar_venue = $_POST['seminar_venue'];
    $seminar_date = $_POST['seminar_date'];

    $special_skill = $_POST['special_skill'];
    $job_preference = $_POST['job_preference'];


    $sql = "INSERT INTO `student`
	(`student_id`,
	 `firstname`,
	 `lastname`,
	 `gender`,
	 `email`,
	 `contact_number`,
	 `address`,
	 `course`,
	 `year`,
	 `section`,
	 `password`,
	 `academic_year`,
	 `semester`,
	 `age`,
	 `birthdate`,
	 `placeofbirth`,
	 `civilstatus`,
	 `religion`,
	 `citizenship`,
	 `f_name`,
	 `f_birthdate`,
	 `f_address`,
	 `f_contact_number`,
	 `f_education`,
	 `f_businessaddress`,
	 `m_name`,
	 `m_birthdate`,
	 `m_address`,
	 `m_contact_number`,
	 `m_education`,
	 `m_businessaddress`,
	 `elem_school`,
	 `elem_address`,
	 `elem_grad`,
	 `elem_award`,
	 `high_school`,
	 `high_address`,
	 `high_grad`,
	 `high_award`,
	 `vocational_school`,
	 `vocational_address`,
	 `vocational_grad`,
	 `vocational_award`,
	 `college_school`,
	 `college_address`,
	 `college_grad`,
	 `college_award`,
	 `award_title`,
	 `award_date`,
	 `work_company`,
	 `work_address`,
	 `work_assign`,
	 `work_duration`,
	 `work_award`,
	 `school_org`,
	 `school_pos`,
	 `school_date`,
	 `seminar_title`,
	 `seminar_venue`,
	 `seminar_date`,
	 `special_skill`,
	 `job_preference`)
VALUES      ('$student_id',
	 '$firstname',
	 '$lastname',
	 '$gender',
	 '$email',
	 '$contact_number',
	 '$address',
	 '$course',
	 '$year',
	 '$section',
	 '$encrypted_password',
	 '$academic_year',
	 '$semester',
	 '$age',
	 '$birthdate',
	 '$birthplace',
	 '$civilstatus',
	 '$religion',
	 '$citizenship',
	 '$f_name',
	 '$f_birthdate',
	 '$f_address',
	 '$f_contact_number',
	 '$f_education',
	 '$f_businessaddress',
	 '$m_name',
	 '$m_birthdate',
	 '$m_address',
	 '$m_contact_number',
	 '$m_education',
	 '$m_businessaddress',
	 '$elem_school',
	 '$elem_address',
	 '$elem_grad',
	 '$elem_award',
	 '$high_school',
	 '$high_address',
	 '$high_grad',
	 '$high_award',
	 '$vocational_school',
	 '$vocational_address',
	 '$vocational_grad',
	 '$vocational_award',
	 '$college_school',
	 '$college_address',
	 '$college_grad',
	 '$college_award',
	 '$award_title',
     '$award_date',
	 '$work_company',
	 '$work_address',
	 '$work_assign',
	 '$work_duration',
	 '$work_award',
	 '$school_org',
	 '$school_pos',
	 '$school_date',
	 '$seminar_title',
	 '$seminar_venue',
	 '$seminar_date',
	 '$special_skill',
	 '$job_preference')";

    if (mysqli_query($db, $sql)) {

        $success = 'Register Success! Click <a href="login.php">here</a> to login.';

    } else {
		echo mysqli_error($db);
	}

}


?>

<!DOCTYPE html>

<html lang="en">



<head>

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">

	<meta name="author" content="AdminKit">

	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">



	<link rel="preconnect" href="https://fonts.gstatic.com">

	<link rel="icon" type="image/x-icon" href="https://ispsc.edu.ph/images/misc/favicon.ico" />



	<title>Sign Up | Guidance Counseling Management System</title>



	<link href="css/app.css" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

</head>



<body>

	<main class="d-flex w-100">

		<div class="container d-flex flex-column">

			<div class="row vh-100">
			    
			    			<div style="margin-top: 150px !important;" class="col-md-4 col-sm-2 col-lg-6 h-100 mx-auto d-table mt-4 d-none d-lg-block">
				 
			<div class="d-table-cell align-middle ">
				<h1 class="text-center mt-4 h1">Mission & Vision</h1>
				<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-12">
		<img src="https://www.ispsctagudin.info/logo.gif" class="img-fluid">  
				</div>

				<div class="col-lg-8 col-md-8 col-sm-12">
					<h3>Vision</h3>
					<p> A vibrant and nurturing Polytechnic Service College for transforming lives and communities.   		</p>	
					<h3>Mission</h3>
					<p> To improve the lives of people and communities through quality instruction, innovations, productivity initiatives, environment and industry-feasible technologies, resource mobilization and transformation outreach programs and services.  </p>
				</div>	
				</div>
			</div>
			</div>
			

				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">

					<div class="d-table-cell align-middle">



						<div class="text-center mt-4">

							<h1 class="h2">Guidance Counseling Management System</h1>

                            <p class="lead">Welcome</p>

						</div>



						<div class="card">

							<div class="card-body">

								<div class="m-sm-4">

                                    <?php if (isset($success)): ?>

                                       <center><p class="text-success"><?= $success; ?></p></center>

                                        <?php endif; ?>

									<form method="post" action="register.php">
										<div class="mb-3">

											<label class="form-label">First Name</label>

											<input class="form-control form-control-lg" type="text" name="firstname" placeholder="Enter your first name" />

										</div>

										<div class="mb-3">

											<label class="form-label">Last Name</label>

											<input class="form-control form-control-lg" type="text" name="lastname" placeholder="Enter your last name" />

										</div>

										<div class="mb-3">

										<label for="course">Course</label>

									<select name="course" id="course" class="form-control">
									<option selected disabled>Select Course</option>
										<option value="BSED">Bachelor of Secondary Education</option>

										<option value="BEEd">Bachelor of Elementary Education</option>

										<option value="BPEd">Bachelor of Physical Education</option>

										<option value="BSBA">Bachelor of Science in Business Administration</option>

										<option value="BSMath">Bachelor of Science in Mathematics</option>

										<option value="BSEL">Bachelor of Arts in English Language</option>

										<option value="BAP">Bachelor of Arts in Psychology</option>

										<option value="B.Soc.">Bachelor of Arts in Social Science</option>

										<option value="BSEntrep">Bachelor of Science in Entrepreneurship</option>

										<option value="BSIT">Bachelor of Science in Information Technology</option>

									</select>

										</div>

										<div class="mb-3">
											<label for="form-label">Academic Year</label>
											<select name="academic_year" class="form-control" id="academic_year">
											<option selected disabled>Academic Year</option>

												<?php 
												
												$date2=date('Y', strtotime('+1 Years'));
												for($i=date('Y'); $i<$date2+5;$i++){
													echo '<option value="">'.$i.'-'.($i+1).'</option>';
												}
												
												?>
											</select>
										</div>

										<div class="mb-3">
											<label for="form-label">Semester</label>
											<select class="form-control" name="semester" id="semester">
											<option selected disabled>Select Semester</option>
											<option value="First">First</option>
											<option value="Second">Second</option>
											</select>
										</div>

										<div class="mb-3">

											<label class="form-label">Year</label>

											<select class="form-control" id="add_year" name="year">
											<option selected disabled>Select Year</option>
											<option value="I">I</option>

											<option value="II">II</option>

											<option value="III">III</option>

											<option value="IV">IV</option>

										</select>
										</div>

									

										<div class="mb-3">

											<label class="form-label">Section</label>

										    <select class="form-control" id="add_section" name="section">
											<option selected disabled>Select Section</option>
                          			      <option value="A">A</option>
										<option value="B">B</option>
										<option value="C">C</option>
										<option value="D">D</option>
										<option value="F">F</option>

                            </select>
										</div>

									

										<div class="mb-3">

									<label class="form-label">Password</label>

									<input class="form-control form-control-lg" type="password" name="password" placeholder="Create your password" />

									</div>

										<h2 class="text-center">Personal Information</h2>

										<div class="mb-3">

											<label class="form-label">Student ID</label>

											<input class="form-control form-control-lg" type="text" name="student_id" placeholder="Enter your ID Number" />

											</div>

										<div class="mb-3">

											<label class="form-label">Age</label>

											<input class="form-control form-control-lg" type="number" name="age" placeholder="Enter your Age" />

											</div>

											<div class="row">
                                       <label for="birthday">Date of Birth</label>
                                       <div class="mb-3 col-md-4">
                                          <select name="birth_month" id="birthmonth" class="form-control">
                                             <?php for( $m=1; $m<=12; ++$m ): $month_label = date('F', mktime(0, 0, 0, $m, 1)); $current = date('n');?>
                                             <option value="<?= $m; ?>"><?php echo $month_label; ?></option>
                                             <?php endfor; ?>
                                          </select>
                                       </div>
                                       <div class="mb-3 col-md-4">
                                          <select name="birth_day" id="birthday" class="form-control">
                                             <?php 
                                                for( $j=1; $j<=31; $j++ ): ?>
                                             <option value="<?= $j; ?>"><?= $j; ?></option>
                                             <?php endfor;?>
                                          </select>
                                       </div>
                                       <div class="mb-3 col-md-4">
                                          <select name="birth_year" id="birthyear" class="form-control">
                                             <?php $year = 2004; $min = $year - 60;$max = $year;for( $i=$max; $i>=$min; $i-- ):?>
                                             <option value="<?= $i; ?>"><?= $i; ?></option>
                                             <?php endfor; ?>
                                          </select>
                                       </div>
                                    </div>

									<div class="mb-3">

							<label class="form-label">Place of Birth</label>

							<input class="form-control form-control-lg" type="text" name="placeofbirth" placeholder="Ex. Town, Province" />

							</div>


									<div class="mb-3">

									<label class="form-label">Gender</label>

									<select class="form-control form-control-lg" name="gender" id="gender">
									<option selected disabled>Select Gender</option>
										<option value="Male">Male</option>
										<option value="Female">Female</option>

									</select>

									</div>

									<div class="mb-3">

									<label class="form-label">Civil Status</label>

									<select class="form-control form-control-lg" name="civilstatus" id="gender">
									<option selected disabled>Select Gender</option>
										<option value="Single">Single</option>
										<option value="Married">Married</option>
										<option value="Widowed">Widowed</option>
										<option value="Separated">Separated</option>

									</select>

									</div>

									
									<div class="mb-3">

									<label class="form-label">Religion</label>

									<input class="form-control form-control-lg" type="text" name="religion" placeholder="Enter your Religion" />

									</div>

									<div class="mb-3">

									<label class="form-label">Citizenship</label>

									<input class="form-control form-control-lg" type="text" name="citizenship" placeholder="Enter your Citizenship" />

									</div>

									<div class="mb-3">

									<label class="form-label">Email</label>

									<input class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email" />

									</div>

									<div class="mb-3">

									<label class="form-label">Contact Number</label>

									<input class="form-control form-control-lg" type="number" name="contact_number" placeholder="Enter your contact number" />

									</div>

									<div class="mb-3">

									<label class="form-label">Permanent Address</label>

									<input class="form-control form-control-lg" type="text" name="address" placeholder="Ex. Barangay, Town, Province" />

									</div>

									<h2 class="text-center">Family Background</h2>

									<div class="mb-3">
									<label for="form-label">Father's Name</label>
									<input class="form-control form-control-lg" type="text" name="f_name" placeholder="Ex. Firstname, Middlename, Lastname" />
									</div>

									<div class="row">
										 <label for="birthday">Date of Birth</label>
                                       <div class="mb-3 col-md-4">
                                          <select name="fbirth_month" id="Fbirthmonth" class="form-control">
                                             <?php for( $m=1; $m<=12; ++$m ): $month_label = date('F', mktime(0, 0, 0, $m, 1)); $current = date('n');?>
                                             <option value="<?= $m; ?>"><?php echo $month_label; ?></option>
                                             <?php endfor; ?>
                                          </select>
                                       </div>
                                       <div class="mb-3 col-md-4">
                                          <select name="fbirth_day" id="Fbirthday" class="form-control">
                                             <?php 
                                                for( $j=1; $j<=31; $j++ ): ?>
                                             <option value="<?= $j; ?>"><?= $j; ?></option>
                                             <?php endfor;?>
                                          </select>
                                       </div>
                                       <div class="mb-3 col-md-4">
                                          <select name="fbirth_year" id="Fbirthyear" class="form-control">
                                             <?php $year = 2004; $min = $year - 60;$max = $year;for( $i=$max; $i>=$min; $i-- ):?>
                                             <option value="<?= $i; ?>"><?= $i; ?></option>
                                             <?php endfor; ?>
                                          </select>
                                       </div>
                                    </div>
									

									<div class="mb-3">
									<label class="form-label">Current Address</label>
									<input class="form-control form-control-lg" type="text" name="Faddress" placeholder="Ex. Barangay, Town, Province" />
									</div>

									<div class="mb-3">
									<label class="form-label">Contact Number</label>
									<input class="form-control form-control-lg" type="number" name="Fcontact_number" placeholder="Enter your Father's number" />
									</div>

									<div class="mb-3">
									<label class="form-label">Highest Education Attained</label>
									<input class="form-control form-control-lg" type="text" name="fHighesEducationAttained" placeholder="Enter your Father's number" />
									</div>

									<div class="mb-3">
									<label class="form-label">Business Address</label>
									<input class="form-control form-control-lg" type="text" name="Fbaddress" placeholder="Ex. Barangay, Town, Province" />
									</div>

									<hr>

									<div class="mb-3">
									<label for="form-label">Mother's Name</label>
									<input class="form-control form-control-lg" type="text" name="m_name" placeholder="Ex. Firstname, Middlename, Lastname" />
									</div>

									<div class="row">
										 <label for="birthday">Date of Birth</label>
                                       <div class="mb-3 col-md-4">
                                          <select name="mbirth_month" id="birthmonth" class="form-control">
                                             <?php for( $m=1; $m<=12; ++$m ): $month_label = date('F', mktime(0, 0, 0, $m, 1)); $current = date('n');?>
                                             <option value="<?= $m; ?>"><?php echo $month_label; ?></option>
                                             <?php endfor; ?>
                                          </select>
                                       </div>
                                       <div class="mb-3 col-md-4">
                                          <select name="mbirth_day" id="birthday" class="form-control">
                                             <?php 
                                                for( $j=1; $j<=31; $j++ ): ?>
                                             <option value="<?= $j; ?>"><?= $j; ?></option>
                                             <?php endfor;?>
                                          </select>
                                       </div>
                                       <div class="mb-3 col-md-4">
                                          <select name="mbirth_year" id="birthyear" class="form-control">
                                             <?php $year = 2004; $min = $year - 60;$max = $year;for( $i=$max; $i>=$min; $i-- ):?>
                                             <option value="<?= $i; ?>"><?= $i; ?></option>
                                             <?php endfor; ?>
                                          </select>
                                       </div>
                                    </div>
							

									<div class="mb-3">
									<label class="form-label">Current Address</label>
									<input class="form-control form-control-lg" type="text" name="Maddress" placeholder="Ex. Barangay, Town, Province" />
									</div>

									<div class="mb-3">
									<label class="form-label">Contact Number</label>
									<input class="form-control form-control-lg" type="number" name="Mcontact_number" placeholder="Enter your Father's number" />
									</div>

									<div class="mb-3">
									<label class="form-label">Highest Education Attained</label>
									<input class="form-control form-control-lg" type="text" name="mHighesEducationAttained" placeholder="Enter your Father's number" />
									</div>

									<div class="mb-3">
									<label class="form-label">Business Address</label>
									<input class="form-control form-control-lg" type="text" name="Mbaddress" placeholder="Ex. Barangay, Town, Province" />
									</div>

									<hr>

									<h2 class="text-center">Educational Background</h2>

									<div class="mb-3">
										<label for="form-label">Name of School (Elementary)</label>
										<input class="form-control form-control-lg" type="text" name="elem_school" placeholder="Ex. Tagudin Central School" />
									</div>

									<div class="mb-3">
									<label class="form-label">School Address</label>
									<input class="form-control form-control-lg" type="text" name="elem_address" placeholder="Ex. Barangay, Town, Province" />
									</div>

									<div class="mb-3">
									<label class="form-label">Year Graduated</label>
									<input class="form-control form-control-lg" type="number" name="elem_grad" placeholder="Ex. 2012" />
									</div>

									<div class="mb-3">
									<label class="form-label">Award/s Received</label>
									<input class="form-control form-control-lg" type="text" name="elem_award"  />
									</div>

									<hr>

									<div class="mb-3">
										<label for="form-label">Name of School (High School)</label>
										<input class="form-control form-control-lg" type="text" name="high_school" placeholder="Ex. Tagudin National High School" />
									</div>

									<div class="mb-3">
									<label class="form-label">School Address</label>
									<input class="form-control form-control-lg" type="text" name="high_address" placeholder="Ex. Barangay, Town, Province" />
									</div>

									<div class="mb-3">
									<label class="form-label">Year Graduated</label>
									<input class="form-control form-control-lg" type="number" name="high_grad" placeholder="Ex. 2015" />
									</div>

									<div class="mb-3">
									<label class="form-label">Award/s Received</label>
									<input class="form-control form-control-lg" type="text" name="high_award"  />
									</div>
									<hr>

									<div class="mb-3">
										<label for="form-label">Name of Vocational School</label>
										<input class="form-control form-control-lg" type="text" name="vocational_school" placeholder="Ex. Name of school" />
									</div>

									<div class="mb-3">
									<label class="form-label">School Address</label>
									<input class="form-control form-control-lg" type="text" name="vocational_address" placeholder="Ex. Barangay, Town, Province" />
									</div>

									<div class="mb-3">
									<label class="form-label">Year Graduated</label>
									<input class="form-control form-control-lg" type="number" name="vocational_grad" placeholder="Ex. 2015" />
									</div>

									<div class="mb-3">
									<label class="form-label">Award/s Received</label>
									<input class="form-control form-control-lg" type="text" name="vocational_award"  />
									</div>
									<hr>

									<div class="mb-3">
										<label for="form-label">Name of College School</label>
										<input class="form-control form-control-lg" type="text" name="college_school" placeholder="Ex. Ilocos Sur Polythecnic State College" />
									</div>

									<div class="mb-3">
									<label class="form-label">School Address</label>
									<input class="form-control form-control-lg" type="text" name="college_address" placeholder="Ex. Barangay, Town, Province" />
									</div>

									<div class="mb-3">
									<label class="form-label">Year Graduated</label>
									<input class="form-control form-control-lg" type="number" name="college_grad" placeholder="Ex. 2015" />
									</div>

									<div class="mb-3">
									<label class="form-label">Award/s Received</label>
									<input class="form-control form-control-lg" type="text" name="college_award"  />
									</div>

									<hr>

									<h2 class="text-center">Awards/Certificates Received</h2>

									<div class="mb-3">
									<label class="form-label">Title of Award/Certificate Received</label>
									<input class="form-control form-control-lg" type="text" name="award_title"  />
									</div>
                                      
									<div class="row">
										 <label for="birthday">Date Received</label>
                                       <div class="mb-3 col-md-4">
                                          <select name="awardMonth" id="birthmonth" class="form-control">
                                             <?php for( $m=1; $m<=12; ++$m ): $month_label = date('F', mktime(0, 0, 0, $m, 1)); $current = date('n');?>
                                             <option value="<?= $m; ?>"><?php echo $month_label; ?></option>
                                             <?php endfor; ?>
                                          </select>
                                       </div>
                                       <div class="mb-3 col-md-4">
                                          <select name="awardDay" id="birthday" class="form-control">
                                             <?php 
                                                for( $j=1; $j<=31; $j++ ): ?>
                                             <option value="<?= $j; ?>"><?= $j; ?></option>
                                             <?php endfor;?>
                                          </select>
                                       </div>
                                       <div class="mb-3 col-md-4">
                                          <select name="awardYear" id="birthyear" class="form-control">
                                             <?php $year = 2004; $min = $year - 60;$max = $year;for( $i=$max; $i>=$min; $i-- ):?>
                                             <option value="<?= $i; ?>"><?= $i; ?></option>
                                             <?php endfor; ?>
                                          </select>
                                       </div>
                                    </div>

									<hr>

									<h2 class="text-center">Work Experience</h2>

									<div class="mb-3">
									<label class="form-label">Company/Agency</label>
									<input class="form-control form-control-lg" type="text" name="work_company" placeholder="Name of Company or Agency." />
									</div>
                                      

									<div class="mb-3">
									<label class="form-label">Address</label>
									<input class="form-control form-control-lg" type="text" name="work_address"  />
									</div>
                                      
									<div class="mb-3">
									<label class="form-label">Work Assignment</label>
									<input class="form-control form-control-lg" type="text" name="work_assign"  />
									</div>
                                      
									<div class="mb-3">
									<label class="form-label">Duration</label>
									<input class="form-control form-control-lg" type="text" name="work_duration"  />
									</div>
                                      
									<div class="mb-3">
									<label class="form-label">Title of Award/Certificate Received</label>
									<input class="form-control form-control-lg" type="text" name="work_award"  />
									</div>
                                

									<hr>

									
									<h2 class="text-center">School Community Involvement</h2>

									<div class="mb-3">
									<label class="form-label">Name of Organisation</label>
									<input class="form-control form-control-lg" type="text" name="school_org" />
									</div>
                                      

									<div class="mb-3">
									<label class="form-label">Position</label>
									<input class="form-control form-control-lg" type="text" name="school_pos" />
									</div>

									
									<div class="mb-3">
									<label class="form-label">Inclusive Date (e.g. 2020-2021)</label>
									<input class="form-control form-control-lg" type="text" name="school_date" />
									</div>

									<hr>

									
									<h2 class="text-center">Seminar and Training Atteded</h2>

									<div class="mb-3">
									<label class="form-label">Title of Training or Seminar</label>
									<input class="form-control form-control-lg" type="text" name="seminar_title" />
									</div>

									<div class="mb-3">
									<label class="form-label">Venue</label>
									<input class="form-control form-control-lg" type="text" name="seminar_venue" />
									</div>

									<div class="mb-3">
									<label class="form-label">Date</label>
									<input class="form-control form-control-lg" type="text" name="seminar_date" />
									</div>

									<hr>

									
									<h2 class="text-center">Special Skills</h2>

									<div class="mb-3">
									<label class="form-label">A Special Skill of Yours</label>
									<input class="form-control form-control-lg" type="text" name="special_skill" placeholder="E.g: Driving/Event Organizing, Planning Skill, Analytical/Conceptual Skill, Communication Skill" />
									</div>

									<hr>

									<h2 class="text-center">Job Preference</h2>

									<div class="mb-3">
									<label class="form-label">Job Preference</label>
									<input class="form-control form-control-lg" type="text" name="job_preference" placeholder="E.g:  Managerial, management, trainee" />
									</div>

									
                                      

										<div class="text-center mt-3">

											<!-- <a href="index.html" class="btn btn-lg btn-primary">Sign up</a> -->

											<button type="submit" name="register" class="btn btn-lg btn-primary">Submit</button>

										</div>

									</form>

								</div>

							</div>

						</div>



					</div>

				</div>

			</div>

		</div>

	</main>



	<script src="js/app.js"></script>



</body>



</html>