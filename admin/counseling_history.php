<?php

include_once '../PHP/all.inc.php';


if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
}

if (isset($_POST['viewhistory'])) {
    $_SESSION['viewhistory'] = $_POST['viewhistory'];
 }
 
 $client =  $_SESSION['viewhistory'];
 
 if ($client === NULL) {
     header('Location: records.php');
 }
 
 
 $stu = getStudentDetailByID($client);
 $res = getAdminDetails($currentUser);

 
 
 $sql = "SELECT * FROM counseling_cases LEFT JOIN counseling_services ON counseling_cases.counselingApproach = counseling_services.service_id INNER JOIN student ON counseling_cases.student_id = student.student_id WHERE student.id = '$client'";


 $query = mysqli_query($db, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="icon" type="image/x-icon" href="https://ispsc.edu.ph/images/misc/favicon.ico" />

	<title>Counseling History | Guidance Counseling Management System</title>

	<link href="<?= BASE_URL ?>/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/15ebd7db73.js" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

	<!-- CSS -->
	<link rel="stylesheet" href="<?= BASE_URL ?>/vendor/alertify/css/alertify.min.css"/>

</head>

<body>
	<div class="wrapper">


        <?php include_once '../includes/header.inc.php'; ?>
	

		<main class="content">
				<div class="container-fluid p-0">

                 
					<h1 class="h3 mb-3">Counselling History of <strong><?= $stu['firstname']; ?></strong></h1>

    
                        <div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
                        <div class="card flex-fill w-100">
								<div class="card-body d-flex">
                                    <div class="col-md-12 mb-0">
                                        <h2><?= $stu['firstname'] . ' ' . $stu['lastname'] ?></h2>
                                        <p><?= $stu['student_id'] ?></p>
                                        <p><?= $stu['course'] . ' ' . $stu['year'] . '-' . $stu['section'] ?></p>
                                    </div>
                                </div>
                        </div>
                        </div>

                        <div class="row">
                        <?php
                  while($row = mysqli_fetch_assoc($query)):
                //    echo json_encode($row);
                   ?>

                        <div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
                            <div class="card flex-fill w-100">
                                <div class="card-body">
                                    <div class="row">

                                    <h1>Case # <?= $row['case_id'] ?></h1>


                                     <div class="col-12 mb-3">
                                        <label for="caseBackground">Background of the Case: </label>
                                        <div name="backgroundCase" class="text-justify" id="caseBackground" cols="30" rows="5"><?= $row['backgroundCase'] ?></div>
                                     </div>
 

                                     <div class="col-12 mb-3">
                                        <label for="caseBackground">Counseling Approach: </label>
                                        <p><?= $row['service_name'] ?></p>
                                            </div>
 

                                     <div class="col-12 mb-3">
                                        <label for="caseBackground">Counseling Goals: </label>
                                        <div name="counselingGoals"  id="caseBackground" cols="30" rows="5"><?= $row['counselingGoal'] ?></div>
                                     </div>
 

                                     <div class="col-12 mb-3">
                                        <label for="caseBackground">Comment: </label>
                                        <div name="comment"  id="caseBackground" cols="30" rows="5"><?= $row['comment'] ?></div>
                                     </div>
 

                                     <div class="col-12 mb-3">
                                        <label for="caseBackground">Recommendation: </label>
                                        <div name="recommendation"  id="caseBackground" cols="30" rows="5"><?= $row['recommendation'] ?></div>
                                     </div>


 
                                        </div>

                                </div>
                            </div>
                        </div>

                        <?php endwhile; ?>


                    </div>

				</div>
			</main>

            <?php include_once '../includes/footer.inc.php'; ?>
		</div>
	</div>

	<script src="<?= BASE_URL ?>/js/app.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<!-- JavaScript -->
	<script src="<?= BASE_URL ?>/vendor/alertify/alertify.min.js"></script>

    <script>
    if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
                </script>

</body>

</html>