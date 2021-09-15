<?php
include_once '../PHP/all.inc.php';

$id = $_POST['id'];

$query = mysqli_query($db, "SELECT * FROM `student` WHERE `id` = '$id'");
$row = mysqli_fetch_assoc($query);
$count = $query->num_rows;

if($count > 0){
    echo json_encode($row);
}
