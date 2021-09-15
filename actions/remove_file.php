<?php
include_once '../PHP/all.inc.php';

if(isset($_POST['store_id'])){
    $store_id = $_POST['store_id'];

    $query = mysqli_query($db, "SELECT * FROM `storage` WHERE `store_id` = '$store_id'");
    $res  = mysqli_fetch_array($query);
    $row = $query->num_rows;

    if($row > 0) {
    $filename = $res['filename'];
    $stud_no = $res['student_id'];
        if(unlink("../files/".$stud_no."/".$filename)){
            $query = "DELETE FROM `storage` WHERE `store_id` = '$store_id'";
                if(mysqli_query($db, $query)) {
                    echo "true";
                }
     }
    }
}