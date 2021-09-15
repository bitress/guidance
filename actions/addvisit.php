<?php

include_once '../PHP/all.inc.php';

$id = $_POST['id'];
$purpose = $_POST['purpose'];

$sql = "INSERT INTO `visit_logs`(`purpose`, `student_id`) VALUES ('$purpose','$id')";
if(mysqli_query($db, $sql)) {
    return true;
}

?>