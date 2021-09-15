<?php



include_once '../PHP/all.inc.php';







$student_id = $_POST['id'];

$firstname = $_POST['firstname'];

$lastname = $_POST['lastname'];

$gender = $_POST['gender'];

$course = $_POST['course'];

$year = $_POST['year'];

$section = $_POST['section'];

$contact_number = $_POST['contact_number'];

$email = $_POST['email'];

$address = $_POST['address'];

$plain_pass = $_POST['password'];

$password = md5($plain_pass);



// $sql = ;



if (mysqli_query($db, "INSERT INTO `student` (`student_id`, `firstname`, `lastname`, `gender`, `email`, `contact_number`, `address`,`course`, `year`, `section`, `password`) VALUES ('".$student_id."', '".$firstname."', '".$lastname."', '".$gender."', '". $email ."', '". $contact_number ."', '". $address ."', '".$course."', '".$year."', '".$section."', '". $password ."')")) {

 return true;

  }



  ?>

