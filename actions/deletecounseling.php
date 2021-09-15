<?php
include_once '../PHP/all.inc.php';

$case_id = $_POST['case_id'];


$sql = "DELETE FROM `counseling_cases` WHERE `case_id` = '$case_id'";

if (mysqli_query($db, $sql)) {
    return true;
}

?>