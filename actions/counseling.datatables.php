<?php

include_once '../PHP/all.inc.php';



$draw = $_POST['draw'];

$row = $_POST['start'];

$rowperpage = $_POST['length']; // Rows display per page

$columnIndex = $_POST['order'][0]['column']; // Column index

$columnName = $_POST['columns'][$columnIndex]['data']; // Column name

$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc

$searchValue = mysqli_real_escape_string($db,$_POST['search']['value']); // Search value



## Search 

$searchQuery = " ";

if($searchValue != ''){

   $searchQuery = " and (student.firstname like '%".$searchValue."%' or 

   student.lastname like '%".$searchValue."%' or 

   service_name like'%".$searchValue."%' ) ";

}



## Total number of records without filtering

$sel = mysqli_query($db,"select count(*) as allcount from counseling_cases");

$records = mysqli_fetch_assoc($sel);

$totalRecords = $records['allcount'];



## Total number of record with filtering

$sel = mysqli_query($db,"select count(*) as allcount from counseling_cases WHERE 1 ".$searchQuery);

$records = mysqli_fetch_assoc($sel);

$totalRecordwithFilter = $records['allcount'];



## Fetch records

// $empQuery = "SELECT * FROM counseling_cases LEFT JOIN counseling_services ON counseling_cases.counselingApproach = counseling_services.service_id INNER JOIN student ON counseling_cases.student_id = student.student_id WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;

$empQuery = "SELECT * FROM counseling_cases LEFT JOIN counseling_services ON counseling_cases.counselingApproach = counseling_services.service_id INNER JOIN student ON counseling_cases.student_id = student.student_id";

$empRecords = mysqli_query($db, $empQuery);

$data = array();



while ($row = mysqli_fetch_assoc($empRecords)) {

   $data[] = array( 

      "student_id"=>$row['student_id'],

      "name"=>$row['firstname'] . ' '. $row['lastname'],

      "datetime_made"=>$row['datetime_made'],

      "btn"=> '

      <div class="btn-group">

      <form action="report.php" method="post">

      <input type="hidden" name="case_id" value="'.$row['case_id'].'">

      <button type="submit" class="btn btn-success" name="print">Print</button>

      </form>

      <a  class="btn btn-warning" href="start_counseling.php?id='. $row['id'] .'&case='.$row['case_id'].'">Edit</a>

      <button type="button" class="btn btn-danger delete" data-id="'.$row['case_id'].'">Remove</button>

      <button type="button" class="btn btn-primary view" data-id="'.$row['case_id'].'">View</button>

      </div>

      '

   );

}



## Response

$response = array(

  "draw" => intval($draw),

  "iTotalRecords" => $totalRecords,

  "iTotalDisplayRecords" => $totalRecordwithFilter,

  "aaData" => $data

);



echo json_encode($response);