<?php
include_once '../PHP/all.inc.php';

    $backgroundCase = $_POST['backgroundCase'];
    $approach = $_POST['approach'];
    $counselingGoals = $_POST['counselingGoals'];
    $comment = $_POST['comment'];
    $recommendation = $_POST['recommendation'];
    $student_id = $_POST['student_id'];

    $sql = "INSERT INTO `counseling_cases`(`student_id`, `backgroundCase`, `counselingApproach`, `counselingGoal`, `comment`, `recommendation`) VALUES
     ('$student_id','$backgroundCase','$approach','$counselingGoals','$comment','$recommendation')";

     if (mysqli_query($db, $sql)) {
         return true;
     }
?>