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

   $searchQuery = " and (firstname like '%".$searchValue."%' or 

        lastname like '%".$searchValue."%' or 

        student_id like'%".$searchValue."%' ) ";

}



## Total number of records without filtering

$sel = mysqli_query($db,"select count(*) as allcount from student");

$records = mysqli_fetch_assoc($sel);

$totalRecords = $records['allcount'];



## Total number of record with filtering

$sel = mysqli_query($db,"select count(*) as allcount from student WHERE 1 ".$searchQuery);

$records = mysqli_fetch_assoc($sel);

$totalRecordwithFilter = $records['allcount'];



## Fetch records

$empQuery = "select * from student WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;

$empRecords = mysqli_query($db, $empQuery);

$data = array();



while ($row = mysqli_fetch_assoc($empRecords)) {

   $data[] = array( 

      "student_id"=>$row['student_id'],

      "name"=>$row['firstname'] . ' '. $row['lastname'],

      "year"=>$row['course'] . ' ' . $row['year'] . ' '.$row['section'],

      "status"=>$row['status'],

      "btn"=> '

      <div class="btn-group" role="group">

      <button type="button" class="btn btn-danger deletehere" data-id="'.$row['id'].'">Remove</button>
      <button type="button" class="btn btn-secondary edithere" data-id="'.$row['id'].'">Edit</button>
      <button type="button" class="btn btn-primary viewhere" data-case="'. $row['student_id'].'" data-id="'.$row['id'].'">View</button>
      	<form action="report.php" method="post">
									
<input type="hidden" name="student_id" value="'. $row['id'] .'">
<button type="submit" class="btn btn-danger" name="print_student">Print</button>
					</form>

         <form action="start_counseling.php" method="post">

         <input type="hidden" name="student___id" value="'. $row['id'] .'">

         <button type="submit" name="startCounselling" class="btn btn-success">Start Counselling</button>

         </form>

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