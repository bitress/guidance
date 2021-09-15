<?php

date_default_timezone_set('Asia/Manila');



define('BASE_URL', 'https://www.guidanceispsctagudin.info');

 define('ADMIN_URL', 'https://www.guidanceispsctagudin.info/admin');

//define('BASE_URL', 'http://localhost:8080');

//define('ADMIN_URL', 'http://localhost:8080/admin');



include_once 'Connection.php';

include_once 'functions.php';



session_start();



if (isset($_SESSION['student'])) {

    $currentUser = $_SESSION['student'];

}



if (isset($_SESSION['admin'])) {

    $currentUser = $_SESSION['admin'];

}