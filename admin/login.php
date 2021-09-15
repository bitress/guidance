<?php 

    include_once '../PHP/all.inc.php';



if (isset($_SESSION['admin'])) {

	header('Location: '. ADMIN_URL);

}



if (isset($_POST['login'])) {

    $username = $_POST['username'];

    $password = $_POST['password'];



    $query = mysqli_query($db, "SELECT * FROM `users` WHERE `username` = '$username' LIMIT 1");

    $fetch = mysqli_fetch_array($query);

    $row = $query->num_rows;

    

    if($row > 0){



            if ($password == $fetch['password']) {

                  $_SESSION['admin'] = $fetch['id'];

                  header('Location: message.php');

            } else {

                echo "<center><label class='text-danger'>Invalid username or password</label></center>";

            }

    }else{

        echo "<center><label class='text-danger'>Invalid username or password</label></center>";

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

	<title>Sign In | Guidance Counseling Management System</title>



	<link href="<?= BASE_URL ?>/css/app.css" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

</head>



<body>

	<main class="d-flex w-100">

		<div class="container d-flex flex-column">

			<div class="row vh-100">
			    
			    			<div style="margin-top: 150px !important;" class="col-md-4 col-sm-2 col-lg-6 h-100 mx-auto d-table mt-4 d-none d-lg-block">
				 
			<div class="d-table-cell align-middle ">
				<h1 class="text-center mt-4 h1">Mission & Vision</h1>
				<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-12">
		<img src="https://www.ispsctagudin.info/logo.gif" class="img-fluid">  
				</div>

				<div class="col-lg-8 col-md-8 col-sm-12">
					<h3>Vision</h3>
					<p> A vibrant and nurturing Polytechnic Service College for transforming lives and communities.   		</p>	
					<h3>Mission</h3>
					<p> To improve the lives of people and communities through quality instruction, innovations, productivity initiatives, environment and industry-feasible technologies, resource mobilization and transformation outreach programs and services.  </p>
				</div>	
				</div>
			</div>
			</div>
			

				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">

					<div class="d-table-cell align-middle">



						<div class="text-center mt-4">

							<h1 class="h2">Welcome</h1>

							<p class="lead">

								Sign in to your account to continue

							</p>

						</div>



						<div class="card">

							<div class="card-body">

								<div class="m-sm-4">

									<form method="POST" action="login.php">

										<div class="mb-3">

											<label class="form-label">Username</label>

											<input class="form-control form-control-lg" type="text" name="username" placeholder="Enter your username" />

										</div>

										<div class="mb-3">

											<label class="form-label">Password</label>

											<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" />

											<!-- <small><a href="pages-reset-password.html">Forgot password?</a></small> -->

										</div>

										<div>

									

										</div>

										<div class="text-center mt-3">

											<!-- <a href="index.html" class="btn btn-lg btn-primary">Sign in</a> -->

											<button type="submit" name="login" class="btn btn-lg btn-primary">Sign in</button>

										</div>

									</form>

								</div>

							</div>

						</div>



					</div>

				</div>

			</div>

		</div>

	</main>



	<script src="<?= BASE_URL ?>/js/app.js"></script>



</body>



</html>