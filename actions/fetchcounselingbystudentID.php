<?php
include_once '../PHP/all.inc.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
}


    $sql = "SELECT * FROM counseling_cases LEFT JOIN counseling_services ON counseling_cases.counselingApproach = counseling_services.service_id INNER JOIN student ON counseling_cases.student_id = student.student_id WHERE student.student_id = '$id'";


$query = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($query);
    echo json_encode($row);
