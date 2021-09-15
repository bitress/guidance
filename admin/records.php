<?php 

    include_once '../PHP/all.inc.php';



if (!isset($_SESSION['admin'])) {

    header('Location: login.php');

}

$res = getAdminDetails($currentUser);



if (isset($_POST['update'])) {



   $id = $_POST['id'];

   $student_id = $_POST['student_id'];

   $firstname = $_POST['firstname'];

   $lastname = $_POST['lastname'];

   $gender = $_POST['gender'];

   $course = $_POST['course'];

   $year = $_POST['year'];

   $section = $_POST['section'];

   $status = $_POST['status'];

   $address = $_POST['address'];

   $contact_number = $_POST['contact_number'];

   $email = $_POST['email'];



   $row = getStudentDetails($student_id);

 



   if (!empty($_POST['password'])) {

        $password = md5($_POST['password']);

   } else {

        $password = $row['password'];

       

   }



   $sql = "UPDATE student SET student_id = '$student_id', firstname = '$firstname', lastname = '$lastname', gender = '$gender', email = '$email', contact_number = '$contact_number', address = '$address', course = '$course', year = '$year', section = '$section', status = '$status', password = '$password' WHERE id = '$id'";



   if (mysqli_query($db, $sql)) {

       $success = "Updated successfully";  

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

	<title>Student Records | Guidance Counseling Management System</title>



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





					<h1 class="h3 mb-3"><strong>Students</strong> Records</h1>

        

					<div class="row">



                    <div class="input-group mb-3">

                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">Add Student</button>

                        </div>

						

					<div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">

                       

							<div class="card flex-fill w-100">

								<div class="card-body d-flex">

                               

									<div class="align-self-center w-100">

                                    <div class="table-responsive">

											<table id="students" class="table">

                                              <thead>

                                                <tr>

                                                  <th scope="col">Student ID</th>

                                                  <th scope="col" class="no-sort">Name</th>

                                                  <th scope="col">Course/Year/Section</th>

                                                  <th scope="col">Status</th>

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





            <!-- Add Student Modal -->

        <div class="modal fade" id="addStudentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addStudent" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="addStudent">Add Student</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body">

               

                    <div class="row">

                        

                        <div class="col-md-12">

                            <label for="student_id">Student ID</label>

                            <input type="text" class="form-control" id="add_student_id" placeholder="Enter Student's ID">

                        </div>

                        

                        

                        <div class="col-md-12">

                            <label for="firstname">First Name </label>

                            <input type="text" class="form-control" id="add_firstname" placeholder="Enter Student's First Name">

                        </div>

                        

                        

                        <div class="col-md-12">

                            <label for="lastname">Last Name </label>

                            <input type="text" class="form-control" id="add_lastname" placeholder="Enter Student's Last Name">

                        </div>

                        <div class="col-md-12">

                            <label for="lastname">Student's Email </label>

                            <input type="email" class="form-control" id="add_email" placeholder="Enter Student's Email">

                        </div>

                        

                        <div class="col-md-12">

                            <label for="lastname">Student's Contact Number </label>

                            <input type="number" class="form-control" id="add_contact_number" placeholder="Enter Student's Contact Number">

                        </div>

                        

                        <div class="col-md-12">

                            <label for="lastname">Student's Address </label>

                            <input type="text" class="form-control" id="add_address" placeholder="Enter Student's Address">

                        </div>

                        

                        

                        <div class="col-md-12">

                        <label for="gender">Gender</label>

                            <select name="gender" id="add_gender" class="form-control">

                                <option value="Male">Male</option>

                                <option value="Female">Female</option>

                            </select>

                        </div>

                        

                    

                        <div class="col-md-4">

                        <label for="course">Course</label>

                        <select name="course" id="add_course" class="form-control">

                        <option selected disabled>Choose Course</option>

                            <option value="BSED">Bachelor of Secondary Education</option>

                            <option value="BEEd">Bachelor of Elementary Education</option>

                            <option value="BPEd">Bachelor of Physical Education</option>

                            <option value="BSBA">Bachelor of Science in Business Administration</option>

                            <option value="BSMath">Bachelor of Science in Mathematics</option>

                            <option value="BSEL">Bachelor of Arts in English Language</option>

                            <option value="BAP">Bachelor of Arts in Psychology</option>

                            <option value="B.Soc.">Bachelor of Arts in Social Science</option>

                            <option value="BSEntrep">Bachelor of Science in Entrepreneurship</option>

                            <option value="BSIT">Bachelor of Science in Information Technology</option>

                        </select>

                    </div>

                        

                        <div class="col-md-4">

                           <label for="year">Year</label>

                            <select class="form-control" id="add_year" name="year">

                            <option selected disabled>Choose Year</option>

                                <option value="I">I</option>

                                <option value="II">II</option>

                                <option value="III">III</option>

                                <option value="IV">IV</option>

                            </select>

                        </div>



                        <div class="col-md-4">

                        <label for="section">Section</label>

                            <select class="form-control" id="add_section" name="section">
                            <option selected disabled>Choose Section</option>

                                <option value="A">A</option>

                                <option value="B">B</option>

                                <option value="C">C</option>

                                <option value="D">D</option>

                            </select>

                        </div>



                        <div class="col-md-12">

                           <label for="password">Password</label>

                            <input type="password" id="add_password" name="password" class="form-control" placeholder="Enter your Password" aria-label="password">

                        </div>

                        

                    </div>

              

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                <button type="button" id="add_Student" name="addStudent" class="btn btn-primary">Add Student</button>

            </div>



            </div>

        </div>

        </div>



            

                <!-- Edit Student Modal -->

            <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog">

                <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Edit Student</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body">

                    <form method="post" action="records.php">

                    <div class="row">

                        <div class="col-md-6">

                            <label for="student_id">Student ID</label>

                            <input type="hidden" name="id" id="id" value="">

                            <input type="text" name="student_id" class="form-control" readonly placeholder="Student ID" name="student_id" id="studentid" value="">

                        </div>

                                               <div class="col-md-3">

                           <label for="status">Status</label>

                            <select name="status" class="form-control" id="status">

                                <option value="Regular">Regular</option>

                                <option value="Irregular">Irregular</option>

                            </select>

                        </div>

                        <div class="col-md-3">

                        <label for="gender">Gender</label>

                        <select name="gender" class="form-control" id="gender">

                            <option value="Male">Male</option>

                            <option value="Female">Female</option>

                        </select>

                        </div>


                        <div class="col-md-12">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="edit_email" class="form-control">
                        </div>

                        <div class="col-md-12">
                            <label for="contact_number">Contact Number</label>
                            <input type="number" name="contact_number" id="edit_contact_number" class="form-control">
                        </div>

                        <div class="col-md-12">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="edit_address" class="form-control">
                        </div>


                        <div class="col-md-6">

                            <label for="firstname">First Name</label>

                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First name" aria-label="First name">

                        </div>



                        <div class="col-md-6">

                           <label for="lastname">Last Name</label>

                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last name" aria-label="Last name">

                        </div>





                        <div class="col-md-4">

                           <label for="lastname">Course</label>

                            <select name="course" class="form-control" id="course">

                                <option value="BSED">Bachelor of Secondary Education</option>

                                <option value="BEEd">Bachelor of Elementary Education</option>

                                <option value="BPEd">Bachelor of Physical Education</option>

                                <option value="BSBA">Bachelor of Science in Business Administration</option>

                                <option value="BSMath">Bachelor of Science in Mathematics</option>

                                <option value="BSEL">Bachelor of Arts in English Language</option>

                                <option value="BAP">Bachelor of Arts in Psychology</option>

                                <option value="B.Soc.">Bachelor of Arts in Social Science</option>

                                <option value="BSEntrep">Bachelor of Science in Entrepreneurship</option>

                                <option value="BSIT">Bachelor of Science in Information Technology</option>

                            </select>

                        </div>

                        

                        <div class="col-md-4">

                           <label for="year">Year</label>

                            <select class="form-control" name="year" id="year">

                                <option value="I">I</option>

                                <option value="II">II</option>

                                <option value="III">III</option>

                                <option value="IV">IV</option>

                            </select>

                        </div>



                        <div class="col-md-4">

                        <label for="section">Section</label>

                            <select class="form-control" name="section" id="section">

                                <option value="A">A</option>

                                <option value="B">B</option>

                                <option value="C">C</option>

                                <option value="D">D</option>

                            </select>

                        </div>



                        <div class="col-md-12">

                           <label for="password">Password</label>

                            <input type="password" name="password" class="form-control" placeholder="Password" aria-label="password">

                        </div>



                        </div>

                   

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    <button type="submit" name="update" class="btn btn-primary">Save changes</button>

                </div>

                </form>

                </div>

            </div>

            </div>



            <!-- Modal -->

            <div class="modal fade" id="showStudent" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

            <div class="modal-dialog modal-lg">

                <div class="modal-content">

                <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Student Details</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body">

                        <div class="row">

                        <div class="card flex-fill">

								<div class="card-body m-2 d-flex">

                         <div class="col-md-10">

                            <h2 class="py-0" id="fullname"></h2>

                            <p class="mb-0" id="student__id"></p>

                            <p class="mb-0" id="course__year__section"></p>

                            <p class="mb-0" id="email_"></p>
                            <p class="mb-0" id="contact"></p>
                            <p class="mb-3" id="address_"></p>
    

                            <h5>Visit</h5>

                            <input type="hidden" name="visit__id" id="visit__id">

                            <select class="form-control input-sm" id="purpose">

                                <option value="Excuse">Excuse</option>

                                <option value="CoC">Certificate of Candidacy</option>

                                <option value="Clearance">Clearance</option>

                            </select>

                            <button type="button" id="visit" class="btn btn-success btn-sm mt-2"><i class="fas fa-plus"></i> Set</button>

                            

                        </div>

                         <div class="col-md-2">

                             <div class="btn-group">

                            <form action="start_counseling.php" method="post">

                                <input type="hidden" name="student___id" id="student___id">

                            <button type="submit" name="startCounselling" class="btn btn-success">Start Counselling</button>

                            </form>

                           

                            </div>

                         </div>



                         

                                </div>

                                </div>

                                </div> <!--  Row END -->

                        

                         <div class="card flex-fill">

							<div class="card-body d-flex">

                                <div class="row">

                            <div class="col-md-8">



                              <h5><i class="fa fa-history"></i> Counseling Recent History </h5>

                            </div>

                                <div class="col-md-4">

                                <form action="counseling_history.php" method="post">

                                <input type="hidden" name="viewhistory" id="viewhistoryval">

                                <button type="submit" id="viewhistory" class="btn btn-success">View All History</button>

                                </form>

                               

                                </div>



                                <h5 id="nohistory"></h5>



                                <h6 id="cb">Case Background:</h6>

									<div class="text-justify mb-3" id="backgroundCase"></div>

								<h6 id="cg">Counseling Goal:</h6>

									<div class="text-justify mb-3" id="counselingGoal"></div>

								<h6 id="cmt">Comment:</h6>

									<div class="text-justify mb-3" id="comment"></div>

								<h6 id="rcmm">Recommendation:</h3>

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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>	

    <!-- JavaScript -->

	<script src="<?= BASE_URL ?>/vendor/alertify/alertify.min.js"></script>

    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script>

 $(document).on('click', 'button.edithere',function() { 

    var id = $(this).data('id'); 

     var modal = new bootstrap.Modal(document.getElementById('editModal'));



     modal.show();



      $.ajax({

        type: 'POST',

        url: '<?= BASE_URL ?>/actions/fetchstudent.php',

        data: {

            id: id

        },

        dataType: 'json',

        success: function (data) {

            $('#id').val(data.id);

            $('#studentid').val(data.student_id);

            $('#firstname').val(data.firstname);

            $('#lastname').val(data.lastname);
            $('#edit_address').val(data.address);
            $('#edit_email').val(data.email);
            $('#edit_contact_number').val(data.contact_number);

            $("#gender option[value=" +data.gender+"]").attr('selected', 'selected');

            $("#status option[value=" +data.status+"]").attr('selected', 'selected');

            $("#course option[value=" +data.course+"]").attr('selected', 'selected');

            $("#year option[value=" +data.year+"]").attr('selected', 'selected');

            $("#section option[value=" +data.section+"]").attr('selected', 'selected');



        }

      });

});


 $(document).on('click', 'button.deletehere',function() { 

    var id = $(this).data('id'); 

    alertify.confirm('Confirm Message', 
    function(e){  
        if (e) {
            $.ajax({

            type: 'POST',

            url: '<?= BASE_URL ?>/actions/deleteStudent.php',

            data: {
                id: id
            },
            success: function (data) {

                if (data === true) {
                   
                }

            }

            });
        }   
        alertify.success('Student Deleted Successfully');
                    $('#students').DataTable().ajax.reload(); 
    }, 
    function(){ alertify.error('Cancel')});
});



var myModalEl = document.getElementById('showStudent')

myModalEl.addEventListener('hidden.bs.modal', function (e) {

 location.reload();

});



$(document).on('click', 'button.viewhere',function() { 

    var id = $(this).data('id'); 

    var cs = $(this).data('case'); 

     var modal = new bootstrap.Modal(document.getElementById('showStudent'));



     modal.show();



      $.ajax({

        type: 'POST',

        url: '<?= BASE_URL ?>/actions/fetchstudent.php',

        data: {

            id: id

        },

        dataType: 'json',

        success: function (data) {

          $('#fullname').text(data.firstname + ' '+ data.lastname);

          $('#student__id').text('Student ID: '+ data.student_id);

          $('#visit__id').val(data.student_id);

          $('#student___id').val(data.id);
          $('#email_').html('Email: <a href="mailto:'+ data.email +'">'+ data.email+'</a>');
          $('#contact').text('Contact Number: '+ data.contact_number);
          $('#address_').text('Address: '+ data.address);

          $('#viewhistoryval').val(data.id);

          $('#course__year__section').text('Course/Year/Section: ' + data.course +' '+ data.year + '-' + data.section);

        //   $('#viewhistory').attr('data-id', data.id);  

                  

      $.ajax({

        type: 'POST',

        url: '<?= BASE_URL ?>/actions/fetchcounselingbystudentID.php',

        data: {

            id: cs

        },

        dataType: 'json',

        success: function (data) {

                 if($.isEmptyObject(data)) {



                $('#nohistory').text('No Recent History');

                $('#cb').addClass('d-none');

        //       $('#datetime').text(data.datetime_made);

                $('#counselingApproach').addClass('d-none');

                $('#cg').addClass('d-none');

                $('#cmt').addClass('d-none');

                $('#rcmm').addClass('d-none');

                $('#viewhistory').addClass('d-none');



                } 

       



                $('#backgroundCase').html(data.backgroundCase);

                //   $('#datetime').text(data.datetime_made);

                $('#counselingApproach').html(data.service_name);

                $('#counselingGoal').html(data.counselingGoal);

                $('#comment').html(data.comment);

                $('#recommendation').html(data.recommendation);

            

        }

      });



        }

      });



      

    



});



$(document).ready(function () {

    $('#visit').on('click', function (){

        var id = $('#visit__id').val(); //Student ID

        var purpose = $('#purpose').val();



        $.ajax({

            type: 'POST',

            url: '<?= BASE_URL ?>/actions/addvisit.php',

            data: {

                id: id,

                purpose: purpose

            },

            success: function (){

                alert("Visit set successfully");

            }

        });





    });



});



$(document).ready(function () {

    $('#add_Student').on('click', function (){

        var modal = new bootstrap.Modal(document.getElementById('addStudentModal'));



        var id = $('#add_student_id').val(); //Student ID

        var firstname = $('#add_firstname').val();

        var lastname = $('#add_lastname').val();

        var contact_number  = $('#add_contact_number').val();

        var email = $('#add_email').val();

        var address = $('#add_address').val();

        var gender = $('#add_gender option:selected').val();

        var course = $('#add_course option:selected').val();

        var year = $('#add_year option:selected').val();

        var section = $('#add_section option:selected').val();

        var password = $('#add_password').val();



        $.ajax({

            type: 'POST',

            url: '<?= BASE_URL ?>/actions/addStudent.php',

            data: {

                id: id,

                firstname: firstname,

                lastname: lastname,

                gender: gender,

                course: course,

                year: year,

                section: section,

                password: password,

                contact_number: contact_number,

                email: email,

                address: address

            },

            success: function (){

                alert("Student Added Successfully");

                $('#students').DataTable().ajax.reload();

                modal.hide();

            }

        });





    });



});

 

$(document).ready(function(){

   $('#students').DataTable({

      'processing': true,

      'serverSide': true,

      'serverMethod': 'post',

      'ajax': {

          'url':'<?= BASE_URL ?>/actions/students.datatables.php'

      },

      

      'columns': [

         { data: 'student_id' },

         { data: 'name' },

         { data: 'year' },

         { data: 'status' },

         { data: 'btn' }

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