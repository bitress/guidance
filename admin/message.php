<?php 

    include_once '../PHP/all.inc.php';



if (!isset($_SESSION['admin'])) {

    header('Location: login.php');

}

if (isset($_GET['id'])) {
	$stu = $_GET['id'];
	$ee = getStudentDetailByID($stu);
} else {
	$d_none = true;
}


if(isset($_GET['ref'])){
	$eeeee = $_GET['id'];

	$sql = "UPDATE `messages` SET `status` = '1' WHERE sender = '$eeeee'";

	mysqli_query($db, $sql);

}

if (isset($_POST['sendMessage'])) {

	$id = $_POST['id'];
	$message = $_POST['message'];
	
	$sql = "INSERT INTO `messages` (`receiver`, `sender`, `message`) VALUES ('".$id."', 'admin', '".$message."')";

	if (mysqli_query($db, $sql)) {
		header('Location: message.php?id='.$id);
	}
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



	<title>Admin Panel | Guidance Counseling Management System</title>



	<link href="<?= BASE_URL ?>/css/app.css" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

	<script src="https://kit.fontawesome.com/15ebd7db73.js" crossorigin="anonymous"></script>



	<!-- CSS -->

	<link rel="stylesheet" href="<?= BASE_URL ?>/vendor/alertify/css/alertify.min.css"/>



</head>



<body>

	<div class="wrapper">





        <?php include_once '../includes/header.inc.php'; ?>

	


<main class="content">
				<div class="container-fluid p-0">

					<div class="mb-3">
						<h1 class="h3 d-inline align-middle">Messages</h1></div>

					<div class="card">
						<div class="row g-0">
							<div class="col-12 col-lg-5 col-xl-3 border-end">

								<div class="px-4 d-none d-md-block">
									<div class="d-flex align-items-center">
										<div class="flex-grow-1">
											<input type="text" class="form-control my-3" placeholder="Search...">
										</div>
									</div>
								</div>

								<?php 
								
								$sql = "SELECT * FROM student ORDER BY `lastname` ASC";

								$stmt = mysqli_query($db, $sql);

								while ($row = mysqli_fetch_assoc($stmt)):
								?>

								<a href="message.php?id=<?= $row['id'] ?>" class="list-group-item list-group-item-action border-0">
									<div class="d-flex align-items-start">
										<img src="https://www.freeiconspng.com/uploads/profile-user-outline-vector-icon--social-icons--icons-download-26.png" class="rounded-circle me-1" alt="Vanessa Tucker" width="40" height="40">
										<div class="flex-grow-1 ms-3">
											<?= $row['firstname'] .  ' ' . $row['lastname'] ?>
										</div>
									</div>
								</a>

								<?php endwhile;
								

									

								?>

								<hr class="d-block d-lg-none mt-1 mb-0" />
							</div>
							<div class="col-12 col-lg-7 col-xl-9 <?= ($d_none) ? 'd-none' : '' ; ?>">
								<div class="py-2 px-4 border-bottom d-none d-lg-block">
									<div class="d-flex align-items-center py-1">
										<div class="position-relative">
											<img src="https://www.freeiconspng.com/uploads/profile-user-outline-vector-icon--social-icons--icons-download-26.png" class="rounded-circle me-1" alt="Sharon Lessman" width="40" height="40">
										</div>
										<div class="flex-grow-1 ps-3">
											<strong><?= $ee['firstname']. ' ' . $ee['lastname']?></strong>
										</div>
										<form action="report.php" method="post">
										<div>
										<input type="hidden" name="student_id" value="<?= $ee['id'] ?>">
										<button type="submit" class="btn btn-danger" name="print_mess">Print</button>
										
											<button data-bs-toggle="modal" data-bs-target="#info" class="btn btn-light border btn-lg px-3"><i class="feather-lg" data-feather="more-horizontal"></i></button>
										</div>
										</form>
										<div class="modal fade" id="info" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="staticBackdropLabel"><?= $ee['firstname']. ' ' . $ee['lastname']?></h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body">
													<div class="col-md-12">
														<p class="mb-2">Contact No: <?= $ee['contact_number'] ?></p>
														<p class="mb-2">Email Address: <?= $ee['email'] ?></p>
														<p class="mb-2">Address: <?= $ee['address'] ?></p>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
												</div>
												</div>
											</div>
											</div>
									</div>
								</div>

								<div class="position-relative">
									<div class="chat-messages p-4">

									<?php 

									

			 $sql = "SELECT * FROM messages LEFT JOIN student ON student.id = messages.receiver
			 WHERE (messages.receiver = '$stu' AND sender = 'admin')
			 OR (receiver = 'admin' AND messages.sender = '$stu') ORDER BY msg_id";

								$query = mysqli_query($db, $sql);
								
							
									while($row = mysqli_fetch_assoc($query)):

										if ($row['receiver'] === $stu):
									?>

										<div class="chat-message-right mb-4">
											<div>
												<img src="https://i.pinimg.com/564x/29/47/9b/29479ba0435741580ca9f4a467be6207.jpg" class="rounded-circle me-1" alt="Chris Wood" width="40" height="40">
												<div class="text-muted small text-nowrap mt-2"><?= $row['datetime'] ?></div>
											</div>
											<div class="flex-shrink-1 bg-light rounded py-2 px-3 me-3">
												<div class="font-weight-bold mb-1">You</div>
												<?= $row['message']; ?>
											</div>
										</div>

										<?php else: ?>

										<div class="chat-message-left pb-4">
											<div>
												<img src="https://www.freeiconspng.com/uploads/profile-user-outline-vector-icon--social-icons--icons-download-26.png" class="rounded-circle me-1" alt="Sharon Lessman" width="40" height="40">
												<div class="text-muted small text-nowrap mt-2"><?= $row['datetime'] ?></div>
											</div>
											<div class="flex-shrink-1 bg-light rounded py-2 px-3 ms-3">
												<div class="font-weight-bold mb-1"><?= $ee['firstname'] . ' '. $ee['lastname'] ?></div>
												<?= $row['message']; ?>
											</div>
										</div>

								<?php endif; endwhile; ?>


									</div>
								</div>

								<div class="flex-grow-0 py-3 px-4 border-top">
								<form action="message.php" method="post">
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
			</main>
            <script src="<?= BASE_URL ?>/js/app.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!-- JavaScript -->

<script src="<?= BASE_URL ?>/vendor/alertify/alertify.min.js"></script>

<script>
		// Chat
		document.addEventListener("DOMContentLoaded", function() {
			var chatMessagesElement = document.querySelector(".chat-messages");
			chatMessagesElement.scrollTop = chatMessagesElement.scrollHeight;
		});
	</script>

</body>



</html>