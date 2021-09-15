<?php

include_once '../PHP/all.inc.php';







    $backgroundCase = $_POST['backgroundCase'];

    // $approach = $_POST['approach'];

    $counselingGoals = $_POST['counselingGoals'];

    $comment = $_POST['comment'];

    $recommendation = $_POST['recommendation'];

    $backgroundCase = $_POST['backgroundCase'];

    $student_id = $_POST['student_id'];

    $case_id = $_POST['case_id'];

    

    $sql = "UPDATE `counseling_cases` SET `backgroundCase`='$backgroundCase',`counselingApproach`='1',`counselingGoal`='$counselingGoals',`comment`='$comment',`recommendation`='$recommendation', `status` = NULL WHERE `student_id` = '$student_id'";

    if (mysqli_query($db, $sql)) {



        $sql = "UPDATE `admin_notif` SET `status` = '1' WHERE `case_id` = '$case_id'";

        if (mysqli_query($db, $sql)) {

            return true;



        }



    }

  

