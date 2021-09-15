<?php 

    include_once '../PHP/all.inc.php';



if (!isset($_SESSION['admin'])) {

    header('Location: login.php');

}

$res = getAdminDetails($currentUser);





?>

<!DOCTYPE html>

<html lang="en">



<head>

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



	<link rel="preconnect" href="https://fonts.gstatic.com">

	<link rel="icon" type="image/x-icon" href="https://ispsc.edu.ph/images/misc/favicon.ico" />



	<title>Files | Guidance Counseling Management System</title>



	<link href="<?= BASE_URL ?>/css/app.css" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

	<script src="https://kit.fontawesome.com/15ebd7db73.js" crossorigin="anonymous"></script>



	<!-- CSS -->

	<link rel="stylesheet" href="<?= BASE_URL ?>/vendor/alertify/css/alertify.min.css"/>

    <link href='//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>



</head>



<body>

	<div class="wrapper">





        <?php include_once '../includes/header.inc.php'; ?>

        

	



		<main class="content">

				<div class="container-fluid p-0">



					<h1 class="h3 mb-3"><strong>Files</strong> Records</h1>

        

					<div class="row">

						

					<div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">

                       

							<div class="card flex-fill w-100">

								<div class="card-body d-flex">

                               

									<div class="align-self-center w-100">
									<div class="table-responsive">
											<table id="students" class="table">

                                              <thead>

                                                <tr>

                                                  <th scope="col">Student ID</th>

                                                  <th scope="col">Name</th>

                                                  <th scope="col">Filename</th>

                                                  <th scope="col" class="no-sort">Filetype</th>

                                                  <th scope="col">Category</th>

                                                  <th scope="col">Date Uploaded</th>

                                                  <th scope="col" class="no-sort">Action</th>

                                                </tr>

                                              </thead>

                                              <tbody>

                                              <?php

								$query = mysqli_query($db, "SELECT * FROM `storage` JOIN student ON student.student_id = storage.student_id ORDER BY date_uploaded DESC");

								if ($query->num_rows > 0):			

								while($row = mysqli_fetch_array($query)):

								?>

								<tr id="delfile_<?= $row['store_id'] ?>">

								<th><?= $row['student_id'] ?></th>

								<th><?= $row['firstname'] . ' ' . $row['lastname'] ?></th>

								<th><?= $row['filename'] ?></th>

								<td><?= $row['file_type'] ?></td>

								<td><?= $row['category'] ?></td>

								<td><?= $row['date_uploaded'] ?></td>

								<td>

									<div class="btn-group">

									<a href="<?= BASE_URL ?>/download.php?id=<?= $row['store_id'] ?>&student=<?= $row['student_id'] ?>" type="button" class="btn btn-primary" id="download" data-id="<?= $row['store_id'] ?>"><i class="fas fa-download"></i> Dowload</a>

										<button type="button" class="btn btn-danger delete" id="delete" data-id="<?= $row['store_id'] ?>"><i class="fas fa-trash-alt"></i> Remove</button>

									</div>

								</td>

								</tr>



								<?php endwhile; else: ?>

								<tr>

								<td colspan="6">Wow! Such empty.</td>

								</tr>

								<?php endif; ?>

                                              </tbody>

                                            </table>
								</div>

									</div>

								</div>

							</div>

						</div>

						

					

						



				</div>

			</main>



			<?php include_once '../includes/footer.inc.php'; ?>



		</div>

	</div>



	<script src="<?= BASE_URL ?>/js/app.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>	

    <!-- JavaScript -->

	<script src="<?= BASE_URL ?>/vendor/alertify/alertify.min.js"></script>

    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

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

					url: "<?= BASE_URL ?>/actions/remove_file.php",

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