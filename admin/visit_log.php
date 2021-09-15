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
	<title>Visit Logs | Guidance Counseling Management System</title>

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

					<h1 class="h3 mb-3"><strong>Visit</strong> Logs</h1>
        
					<div class="row">

					<div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
                       
							<div class="card flex-fill w-100">
								<div class="card-body d-flex">
                               
									<div class="align-self-center w-100">
											<table id="students" class="table">
                                              <thead>
                                                <tr>
                                                  <th scope="col">Visit Purpose</th>
                                                  <th scope="col" class="no-sort">Student ID</th>
                                                  <th scope="col" class="no-sort">Student Name</th>
                                                  <th scope="col">Course/Year/Section</th>
                                                  <th scope="col" class="no-sort">Date Time</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                              </tbody>
                                            </table>
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
   $('#students').DataTable({
      'processing': true,
      'searching': false,
	  'paging': false,
	  'info': false,
      'serverSide': true,
      'serverMethod': 'post',
      'ajax': {
          'url':'<?= BASE_URL ?>/actions/visit_log.datatables.php'
      },
      
      'columns': [
         { data: 'purpose' },
         { data: 'student_id' },
         { data: 'name' },
         { data: 'year' },
         { data: 'datetime' }
      ],
      "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ]
   });
});
</script>



</body>

</html>