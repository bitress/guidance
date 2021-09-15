<?php
include_once '../PHP/all.inc.php';

if (!isset($_SESSION['admin'])) {

    header('Location: login.php');

}



if (isset($_GET['id'])) {

   $_SESSION['student___id'] = $_GET['id'];

}

if (isset($_GET['case'])) {

    $_SESSION['case_id'] = $_GET['case']; 

} else {

    $_SESSION['case_id'] = null;

}


if (isset($_POST['student___id'])) {

   $_SESSION['student___id'] = $_POST['student___id'];

}

$client =  $_SESSION['student___id'];
$case__ = $_SESSION['case_id'];



if ($client === NULL) {

    header('Location: records.php');

}





$stu = getStudentDetailByID($client);

$res = getAdminDetails($currentUser);


if (isset($_POST['case_id'])) {

    $_SESSION['case_id'] = $_POST['case_id']; 

} else {

    $_SESSION['case_id'] = null;

}



$query = "SELECT * FROM `counseling_cases` WHERE `case_id` = '$case__'";

$stmt = mysqli_query($db, $query);

$councel = mysqli_fetch_array($stmt);

?>

<!DOCTYPE html>

<html lang="en">



<head>

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



	<link rel="preconnect" href="https://fonts.gstatic.com">

    <link rel="icon" type="image/x-icon" href="https://ispsc.edu.ph/images/misc/favicon.ico" />

	<title>Start Counseling | Guidance Counseling Management System</title>



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



                    <?php if (isset($success)):?>

                        <div class="alert alert-success" role="alert">

                        <?= $success; ?>

                        </div>

                        <?php endif; ?>



					<h1 class="h3 mb-3">Counselling, <strong><?= $stu['firstname']; ?></strong></h1>



                        <div class="row">

                        <div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">

                        <div class="card flex-fill w-100">

								<div class="card-body d-flex">

                                    <div class="col-md-8 mb-0">

                                        <h2><?= $stu['firstname'] . ' ' . $stu['lastname'] ?></h2>

                                        <p><?= $stu['student_id'] ?></p>

                                        <p><?= $stu['course'] . ' ' . $stu['year'] . '-' . $stu['section'] ?></p>

                                        <p> <?= (empty($councel['status'])) ? '' : 'Status: '. $councel['status'] ; ?></p>

                                    </div>



                                    <div class="col-md-4">

                                        <h3>Recent Counselling</h3>

                                        <?php

                                        $sql = "SELECT * FROM counseling_cases LEFT JOIN counseling_services ON counseling_cases.counselingApproach = counseling_services.service_id INNER JOIN student ON counseling_cases.student_id = student.student_id WHERE student.id = '$client' ORDER BY datetime_made LIMIT 1";

                                        $query = mysqli_query($db, $sql);

                                        $consel = mysqli_fetch_assoc($query);



                                            if (!empty($consel)):

                                         ?>

                                         <p class="mb-0 fw-bold">Case Background: &nbsp;</p>

                                         <?= $consel['backgroundCase']; ?>



                                         <?php else: ?>



                                            <p>No Recent Counseling</p>



                                            <?php endif; ?>

                                    </div>

                                </div>

                        </div>

                        </div>



                        <div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">

                            <div class="card flex-fill w-100">

                                <div class="card-body">

                                    <div class="row">



                                    

                                            <input type="hidden" id="student_id___" value="<?= $stu['student_id'] ?>">

                                            <input type="hidden" id="case__id" value="<?= $case__; ?>">

                                     <div class="col-12 mb-3">

                                        <label for="caseBackground">Case Background: </label>

                                        <textarea name="backgroundCase" class="form-control" id="caseBackground" cols="30" rows="5"><?= (empty($councel['backgroundCase'])) ? '' : $councel['backgroundCase'] ; ?></textarea>

                                     </div>

 



                                     <!-- <div class="col-12 mb-3">

                                        <label for="caseBackground">Counseling Approach: </label>

                                            <select name="approach" class="form-control" id="approach">

                                                <?php 

                                                   $query = mysqli_query($db, "SELECT * FROM `counseling_services`");

                                                   while($row = mysqli_fetch_array($query)):

                                                ?>

                                                <option value="<?= $row['service_id'] ?>"><?= $row['service_name'] ?></option>

                                                <?php endwhile; ?>



                                            </select>

                                        </div> -->

 



                                     <div class="col-12 mb-3">

                                        <label for="caseBackground">Counseling Goals: </label>

                                        <textarea name="counselingGoals" class="form-control" id="counselingGoals" cols="30" rows="5"><?= (empty($councel['counselingGoal'])) ? '' : $councel['counselingGoal'] ; ?></textarea>

                                     </div>

 



                                     <div class="col-12 mb-3">

                                        <label for="caseBackground">Comment: </label>

                                        <textarea name="comment" class="form-control" id="comment" cols="30" rows="5"><?= (empty($councel['comment'])) ? '' : $councel['comment'] ; ?></textarea>

                                     </div>

 



                                     <div class="col-12 mb-3">

                                        <label for="caseBackground">Recommendation: </label>

                                        <textarea name="recommendation" class="form-control" id="recommendation" cols="30" rows="5"><?= (empty($councel['recommendation'])) ? '' : $councel['recommendation'] ; ?></textarea>

                                     </div>


                                        <?php

                                        if (!isset($case__)):

                                        ?>

                                     <button type="submit" id="startSubmit" name="startSubmit" class="btn btn-primary btn-block">Submit</button>

                                        <?php else: ?>

                                     <button type="submit" id="startUpdate" name="startUpdate" class="btn btn-success btn-block">Submit</button>



                                            <?php endif; ?>





                                

 

                                        </div>

                                </div>

                            </div>

                        </div>





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

    // CKEDITOR.replace( 'caseBackground' );

    // CKEDITOR.replace( 'counselingGoals' );

    // CKEDITOR.replace( 'comment' );

    // CKEDITOR.replace( 'recommendation' );

    if ( window.history.replaceState ) {

  window.history.replaceState( null, null, window.location.href );

}





$(document).ready(function () {

    $('#startSubmit').on('click', function (){

        var id = $('#student_id___').val(); //Student ID

        var backgroundCase = $('#caseBackground').val();

        var counselingGoals = $('#counselingGoals').val();

        var comment = $('#comment').val();

        var recommendation = $('#recommendation').val();

        var approach = $('#approach option:selected').val();



        $.ajax({

            type: 'POST',

            url: '<?= BASE_URL ?>/actions/addCounseling.php',

            data: {

                student_id: id,

                backgroundCase: backgroundCase,

                counselingGoals: counselingGoals,

                comment: comment,

                recommendation: recommendation,

                approach: approach

            },

            success: function (){

                setTimeout(function () {

                    alert("Counsel success!");

                    location.reload(true);

                }, 5000);

            }

        });





    });



});

$(document).ready(function () {

    $('#startUpdate').on('click', function (){

        var id = $('#student_id___').val(); //Student ID

        var case_id = $('#case__id').val(); //Case ID

        var backgroundCase = $('#caseBackground').val();

        var counselingGoals = $('#counselingGoals').val();

        var comment = $('#comment').val();

        var recommendation = $('#recommendation').val();

        var approach = $('#approach option:selected').val();



        $.ajax({

            type: 'POST',

            url: '<?= BASE_URL ?>/actions/updateCounseling.php',

            data: {

                student_id: id,

                backgroundCase: backgroundCase,

                counselingGoals: counselingGoals,

                comment: comment,

                recommendation: recommendation,

                // approach: approach,

                case_id: case_id

            },

            success: function (){

                setTimeout(function () {

                    alert("Counsel success!");

                    location.reload(true);

                }, 5000);

            }

        });





    });



});

                </script>



</body>



</html>