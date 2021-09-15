<?php 

    include_once 'PHP/all.inc.php';



if (isset($_SESSION['admin'])) {

	header('Location: '. BASE_URL.'/actions/logout.php');

}



if (!isset($_SESSION['student'])) {

    header('Location: login.php');

}



$res = getStudentDetails($currentUser);



if(isset($_POST['councilme'])) {

	$backgroundCase = $_POST['backgroundCase___'];

	$student_id_number = $_POST['student_id_number'];

	$stu_id = $res['id'];





	//Insert Counseling Case to DB

	$query = "INSERT INTO `counseling_cases` (`student_id`, `backgroundCase`, `status`) VALUES ('".$student_id_number."', '".$backgroundCase."', 'Wait-List')";



	if(mysqli_query($db, $query)) {

		$case_id = mysqli_insert_id($db);

		//Notify the admin

		$message = $res['firstname'] . " " .$res['lastname'] . " wants a guidance!";

		$query2 = "INSERT INTO `admin_notif` (`message`, `student_id`, `case_id`) VALUES ('".$message."','".$stu_id."', '".$case_id."')";

		if(mysqli_query($db, $query2)) {

			header('Location: index.php');

		}

	}



}



//Upload File



if (isset($_POST['save'])) {



	if(empty($_POST['name'])){

		$error = "<center><label class='text-danger'>File Name is required!</label></center>";

		return;

	}

	

	if(empty($_POST['category'])){

		$error = "<center><label class='text-danger'>Please choose a category!</label></center>";

		return;

	}

	if (empty($_FILES['file'])) {

		$error = "<center><label class='text-danger'>Please upload file!</label></center>";

		return;

	}

	$stud_no = $currentUser;

		$category = $_POST['category'];

		$name = $_FILES["file"]["name"];

		$extension = pathinfo($name, PATHINFO_EXTENSION);

		$file_name = $_POST['name'] . '.'. $extension;

		$file_type = $_FILES['file']['type'];

		$file_temp = $_FILES['file']['tmp_name'];

		$location = "files/".$stud_no."/".$file_name;

		$date = date("Y-m-d, h:i A", strtotime("+8 HOURS"));

		if(!file_exists("files/".$stud_no)){;



			mkdir("files/".$stud_no);

				}

		

		if(move_uploaded_file($file_temp, $location)){

			if (insertFilesContent($stud_no, $file_name, $category, $file_type)) {

				header('Location: '. BASE_URL);

				$success = "<center><label class='text-success'>File uploaded successfully!</label></center>";

			}

		}

}

if (isset($_POST['sendMessage'])) {

	$id = $res['id'];
	$message = $_POST['message'];
	
	$sql = "INSERT INTO `messages` (`sender`, `receiver`, `message`) VALUES ('".$id."', 'admin', '".$message."')";

	if (mysqli_query($db, $sql)) {
		header('Location: /');
	}
}




?>
<!DOCTYPE html>

<html lang="en">



<head>

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



	<link rel="preconnect" href="https://fonts.gstatic.com">

	<link rel="icon" type="image/x-icon" href="https://ispsc.edu.ph/images/misc/favicon.ico" />



	<title>Student Profile | Guidance Counseling Management System</title>



	<link href="css/app.css" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

	<script src="https://kit.fontawesome.com/15ebd7db73.js" crossorigin="anonymous"></script>



	<!-- CSS -->

	<link rel="stylesheet" href="vendor/alertify/css/alertify.min.css"/>

	<style>
		#fixedbutton {
    position: fixed;
    bottom: 0px;
    right: 0px; 
}
	</style>


</head>



<body>

	<div class="wrapper">





        <?php include_once 'includes/topbar.inc.php'; ?>

	


				

			<main class="content">

				<div class="container-fluid p-0">



					<h1 class="h3 mb-3"><?php echo greetUser($res['firstname']) ?></h1>



					<div class="row">

					

				



					<div class="col-md-8">

						<div class="card">

							<div class="card-body">

							<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="mt-3" method="post">

								<input type="hidden" name="student_id_number" value="<?= $res['student_id'] ?>">

							<label class="fw-bold" for="case">What's the Concern?</label>

							<textarea name="backgroundCase___" class="form-control mb-3" placeholder="What's the concern?" cols="30" rows="3"></textarea>

							<button type="submit" name="councilme" class="btn btn-warning"> Submit!</button>

							</form>

							</div>

						</div>

	

							<div class="card">

								<div class="card-body">

								<div class="card-title">

									Your Files

								</div>

									<div class="table-responsive">

                                <table class="table">

                                <thead>

                                    <tr>

                                    <th scope="col">Filename</th>

                                    <th scope="col">Filetype</th>

                                    <th scope="col">Category</th>

                                    <th scope="col">Date Uploaded</th>

                                    <th scope="col">Action</th>

                                    </tr>

                                </thead>

                                <tbody>



								<?php

								$query = mysqli_query($db, "SELECT * FROM `storage` WHERE `student_id` = '$currentUser'");

								if ($query->num_rows > 0):			

								while($row = mysqli_fetch_array($query)):

								?>

								<tr id="delfile_<?= $row['store_id'] ?>">

								<th><?= $row['filename'] ?></th>

								<td><?= $row['file_type'] ?></td>

								<td><?= $row['category'] ?></td>

								<td><?= $row['date_uploaded'] ?></td>

								<td>

									<div class="btn-group">

										<a href="download.php?id=<?= $row['store_id'] ?>&student=<?= $row['student_id'] ?>" type="button" class="btn btn-primary" id="download" data-id="<?= $row['store_id'] ?>"><i class="fas fa-download"></i> Dowload</a>

										<button type="button" class="btn btn-danger delete" id="delete" data-id="<?= $row['store_id'] ?>"><i class="fas fa-trash-alt"></i> Remove</button>

									</div>

								</td>

								</tr>



								<?php endwhile; else: ?>

								<tr>

								<td colspan="5">Wow! Such empty.</td>

								</tr>

								<?php endif; ?>



                                </tbody>

                                </table>

									</div>

								</div>

							</div>

							

							<div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">

                        <div class="card flex-fill w-100">

								<div class="card-body d-flex">

                                    

                                <div class="align-self-center w-100">

											<h4>Counseling Record</h4>

										<?php
										$id = $res['student_id'];
					$sql = "SELECT * FROM counseling_cases LEFT JOIN counseling_services ON counseling_cases.counselingApproach = counseling_services.service_id INNER JOIN student ON counseling_cases.student_id = student.student_id WHERE student.student_id = '$id'";

					$council = mysqli_query($db, $sql);
										// if ($council->num_rows > 0):

										while($row = mysqli_fetch_assoc($council)):

										//    echo json_encode($row);

										?>



                                    <div class="row">



                                    <h1>Case # <?= $row['case_id'] ?></h1>





                                     <div class="col-12 mb-3">

                                        <label for="caseBackground">Background of the Case: </label>

                                        <div class="text-justify" id="caseBackground" cols="30" rows="5"><?= $row['backgroundCase'] ?></div>

                                     </div>



									 <?php if ($row['status'] == 'Wait-List'): ?>

 
 



                                     <div class="col-12 mb-3">

                                        <label for="caseBackground">Counseling Goals: </label>

                                        <div name="counselingGoals"  id="caseBackground" cols="30" rows="5"><?= $row['counselingGoal'] ?></div>

                                     </div>

 



                                     <div class="col-12 mb-3">

                                        <label for="caseBackground">Comment: </label>

                                        <div name="comment"  id="caseBackground" cols="30" rows="5"><?= $row['comment'] ?></div>

                                     </div>

 



                                     <div class="col-12 mb-3">

                                        <label for="caseBackground">Recommendation: </label>

                                        <div name="recommendation"  id="caseBackground" cols="30" rows="5"><?= $row['recommendation'] ?></div>

                                     </div>



										

									 

									 <?php else: ?>

										<div class="col-12 mb-3">

                                        <label for="caseBackground">Status: </label>

										<div class="badge bg-warning my-2">Wait List</div>

                                     </div>



									 <?php endif; ?>

 

                                        </div>



                                



                        <?php 

					endwhile; 

				// endif; ?>

									</div>

                                  

                        </div>

                        </div>

							</div>

						</div>



                       <div class="col-md-4">

                   <div class="card text-left">

						<img class="card-img-top" src="holder.js/100px180/" alt="">

						<div class="card-body">

							<h4 class="card-title">Student Profile</h4>

							<div class="d-flex flex-column mb-2">

                            <div class="p-2">Student ID: <?php echo $res['student_id'] ?></div>

                            <div class="p-2">Name: <?php echo $res['firstname']. ' '. $res['lastname'] ?></div>

                            <div class="p-2">Gender: <?php echo $res['gender'] ?></div>

                            <div class="p-2">Course: <?php echo $res['course'] ?></div>

                            <div class="p-2">Year & Section: <?php echo $res['year']. '-'. $res['section'] ?></div>

							

                            </div>

						</div>

						</div>

                   <div class="card text-left">

						<div class="card-body">

							<h4 class="card-title">Upload File</h4>

							<div class="d-flex flex-column mb-2">

								<?php if (isset($error)): echo $error; endif; ?>

								<?php if (isset($success)): echo $success; endif; ?>

							<div class="input-group mb-3">

								<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data" method="post">

                              <input type="text" name="name" id="" class="form-control mb-3" placeholder="File Name" aria-describedby="button-save">

							  <select name="category" class="form-control mb-3">

								  <option value="Excuse Letter">Excuse Letter</option>

								  <option value="Promissory Note">Promissory Note</option>

								  <option value="Others">Others</option>

							  </select>

                              <input type="file" name="file" id="" class="form-control" placeholder="" aria-describedby="button-save">

                              <button type="submit" name="save" id="button-save" class="btn btn-primary mt-3">Add File</button>

								</form>



                            </div>

                            </div>

                           

						</div>

						</div>

            </div>

                       



					</div> 

				</div>

			</main>
			<button id="fixedbutton" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#helpDesk"><i class="fas fa-phone"></i> Help Desk</button>


			<!-- Modal -->
<div class="modal fade" id="helpDesk" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Help Desk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

<div class="card flex-fill w-100">

		<div class="card-body d-flex">
		<div class="align-self-center w-100">
			
	

		<div class="col-12 col-lg-12 col-xl-12">
				<div class="py-2 px-4 border-bottom d-none d-lg-block">
					<div class="d-flex align-items-center py-1">
						<div class="position-relative">
							<img src="https://i.pinimg.com/564x/29/47/9b/29479ba0435741580ca9f4a467be6207.jpg" class="rounded-circle me-1" alt="Sharon Lessman" width="40" height="40">
						</div>
						<div class="flex-grow-1 ps-3">
							<strong>School Counselor</strong>
						</div>
						
					</div>
				</div>

				<div class="position-relative">
					<div class="chat-messages p-4">

					<?php 



$sql = "SELECT * FROM messages LEFT JOIN student ON student.id = messages.sender
WHERE (messages.sender = '".$res['id']."' AND receiver = 'admin')
OR (sender = 'admin' AND messages.receiver = '".$res['id']."') ORDER BY msg_id";

				$query = mysqli_query($db, $sql);
				
			
					while($row = mysqli_fetch_assoc($query)):

						if ($row['receiver'] === 'admin'):
					?>

						<div class="chat-message-right mb-4">
							<div>
								<img src="img/avatars/avatar.jpg" class="rounded-circle me-1" alt="Chris Wood" width="40" height="40">
								<div class="text-muted small text-nowrap mt-2">2:43 am</div>
							</div>
							<div class="flex-shrink-1 bg-light rounded py-2 px-3 me-3">
								<div class="font-weight-bold mb-1">You</div>
								<?= $row['message']; ?>
							</div>
						</div>

						<?php else: ?>

						<div class="chat-message-left pb-4">
							<div>
								<img src="https://i.pinimg.com/564x/29/47/9b/29479ba0435741580ca9f4a467be6207.jpg" class="rounded-circle me-1" alt="Sharon Lessman" width="40" height="40">
								<div class="text-muted small text-nowrap mt-2">2:44 am</div>
							</div>
							<div class="flex-shrink-1 bg-light rounded py-2 px-3 ms-3">
								<div class="font-weight-bold mb-1">School Counselor</div>
								<?= $row['message']; ?>
							</div>
						</div>

				<?php endif; endwhile; ?>


					</div>
				</div>

				<div class="flex-grow-0 py-3 px-4 border-top">
				<form action="index.php" method="post">
					<div class="input-group">
						<input type="hidden" name="id" value="<?= $stu ?>">
						
						<input type="text" name="message" class="form-control" placeholder="Type your message">
						<button name="sendMessage" type="submit" class="btn btn-primary">Send</button>
						</div>	
					</form>
				
				</div>

			</div>


		
		</div>
	</div>
	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>      </div>
    </div>
  </div>
</div>
			<?php include_once 'includes/footer.inc.php'; ?>



		</div>

	</div>



	<script src="js/app.js"></script>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

	<!-- JavaScript -->

	<script src="vendor/alertify/alertify.min.js"></script>

	<script>

	$(document).ready(function(){

		$("#logout").click(function() {

			alertify.confirm('Are you sure, You want to logout?', function(e){

				if (e) {

					window.location.href = 'actions/logout.php';

				}

			})

		});

	});

	</script>

	<script>

	$(document).ready(function(){

		$('.delete').on('click',function(){

			var id = $(this).data('id');

			console.log(id);

			alertify.confirm('Confirm Message',

			 function(e){ 

				 if(e) {



					$.ajax({

					type: "POST",

					url: "actions/remove_file.php",

					data:{

						store_id: id

					},

					success: function(data){

						$("#delfile_" + id).empty();

						$("#delfile_" + id).html("<td colspan='4'><center class='text-danger'>Deleting...</center></td>");

						setTimeout(function(){

							$("#delfile_" + id).fadeOut('slow');

						}, 1000);

						}		

				});

				alertify.success('Deleted Successfully!');



				 }

			});



		});



	



	});

	</script>



</body>



</html>