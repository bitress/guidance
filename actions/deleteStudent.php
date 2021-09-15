<?php

include_once '../PHP/all.inc.php';



$id = $_POST['id'];





$sql = "DELETE FROM `student` WHERE `id` = '$id'";



if (mysqli_query($db, $sql)) {

    return true;

}



?>