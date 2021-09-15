<?php



define('DB_SERVER', '46.21.149.90');

define('DB_USERNAME', 'guidanc1_guide1');

define('DB_PASSWORD', 'Tagudin2021');

define('DB_NAME', 'guidanc1_guidance');

 

 

// define('DB_SERVER', 'localhost');

// define('DB_USERNAME', 'root');

// define('DB_PASSWORD', '');

// define('DB_NAME', 'guidance');

 

/* Attempt to connect to MySQL database */

$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

 

// Check connection

if($db === false){

    die("ERROR: Could not connect. " . mysqli_connect_error());

}