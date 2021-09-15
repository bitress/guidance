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

	<title>Counseling Records | Guidance Counseling Management System</title>



	<link href="<?= BASE_URL ?>/css/app.css" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

	<script src="https://kit.fontawesome.com/15ebd7db73.js" crossorigin="anonymous"></script>

    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>



	<!-- CSS -->

	<link rel="stylesheet" href="<?= BASE_URL ?>/vendor/alertify/css/alertify.min.css"/>



</head>



<body>

	<div class="wrapper">





        <?php include_once '../includes/header.inc.php'; ?>

	



		<main class="content">

				<div class="container-fluid p-0">



					<h1 class="h3 mb-3">Counselling Records</h1>

          <form action="report.php?all=1" method="post">

      <button type="submit" class="btn btn-success mb-3" name="printall">Print All</button>

      </form>

                        <div class="row">

                        <div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">

                        <div class="card flex-fill w-100">

								<div class="card-body d-flex">

                                    

                                <div class="align-self-center w-100">
                                <div class="table-responsive">

											<table id="counselingrecords" class="table">

                                              <thead>

                                                <tr>

                                                  <th scope="col">Student ID</th>

                                                  <th scope="col" class="no-sort">Name</th>

                            

                                                  <th scope="col">Date</th>

                                                  <th scope="col" class="no-sort">Action</th>

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



				</div>

			</main>





			

            <!-- Modal -->

            <div class="modal fade" id="showCouselingRecord" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

            <div class="modal-dialog modal-lg">

                <div class="modal-content">

                <div class="modal-header">

                <h5 class="modal-title" id="clientName"></h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body">

                        <div class="row">



						<div class="col-12">

							

						<div class="p-5 mb-4 bg-light rounded-3">

							<div class="col-md-8">

								<h3 id="counselingApproach"></h3>

							</div>

							<div class="col-md-4">

								<h6 id="datetime"></h6>

							</div>

						</div>



						</div>



						<div class="col-md-12">

						<div class="p-5 mb-4 bg-light rounded-3">

								<h3>Case Background:</h3>

									<div class="text-justify mb-3" id="backgroundCase"></div>

								<h3>Counseling Goal:</h3>

									<div class="text-justify mb-3" id="counselingGoal"></div>

								<h3>Comment:</h3>

									<div class="text-justify mb-3" id="comment"></div>

								<h3>Recommendation:</h3>

									<div class="text-justify mb-3" id="recommendation"></div>

							</div>

						</div>

                       

                    	</div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>

                </div>

            </div>

            </div>



            <?php include_once '../includes/footer.inc.php'; ?>



		</div>

	</div>



	<script src="<?= BASE_URL ?>/js/app.js"></script>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

	<!-- JavaScript -->

	<script src="<?= BASE_URL ?>/vendor/alertify/alertify.min.js"></script>

    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>





    <script>

    if ( window.history.replaceState ) {

  window.history.replaceState( null, null, window.location.href );

}



$(document).ready(function(){

   $('#counselingrecords').DataTable({

      'processing': true,

	  'searching': false,

	  'paging': false,

	  'info': false,

      'serverSide': true,

      'serverMethod': 'post',

      'ajax': {

          'url':'<?= BASE_URL ?>/actions/counseling.datatables.php'

      },

      

      'columns': [

         { data: 'student_id' },

         { data: 'name' },

         { data: 'datetime_made'},

          {data: 'btn' },

      ],

      "columnDefs": [ {

          "targets": 'no-sort',

          "orderable": false,

    } ]

   });

});



$(document).on('click', 'button.view',function() { 

    var id = $(this).data('id'); 

     var modal = new bootstrap.Modal(document.getElementById('showCouselingRecord'));



     modal.show();



      $.ajax({

        type: 'POST',

        url: '<?= BASE_URL ?>/actions/fetchcounseling.php',

        data: {

            id: id,

			case_id: true

        },

        dataType: 'json',

        success: function (data) {

          $('#clientName').text(data.firstname + ' '+ data.lastname);

          $('#datetime').text(data.datetime_made);

		  $('#backgroundCase').html(data.backgroundCase);

          $('#counselingApproach').html(data.service_name);

          $('#counselingGoal').html(data.counselingGoal);

          $('#comment').html(data.comment);

          $('#recommendation').html(data.recommendation);

        }

      });

});



$(document).on('click', 'button.delete',function() { 

    var id = $(this).data('id'); 





      $.ajax({

        type: 'POST',

        url: '<?= BASE_URL ?>/actions/deletecounseling.php',

        data: {

            case_id: id

        },

        success: function (data) {

         alertify.success('Counseling Deleted!');

         $('#counselingrecords').DataTable().ajax.reload();

        }

      });

});

 </script>



</body>



</html>