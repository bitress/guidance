<?php



/**

 *        _                 _                  _              __                          _     _                       

 *  ___  | |_   _   _    __| |   ___   _ __   | |_   ___     / _|  _   _   _ __     ___  | |_  (_)   ___    _ __    ___ 

 * / __| | __| | | | |  / _` |  / _ \ | '_ \  | __| / __|   | |_  | | | | | '_ \   / __| | __| | |  / _ \  | '_ \  / __|

 * \__ \ | |_  | |_| | | (_| | |  __/ | | | | | |_  \__ \   |  _| | |_| | | | | | | (__  | |_  | | | (_) | | | | | \__ \

 * |___/  \__|  \__,_|  \__,_|  \___| |_| |_|  \__| |___/   |_|    \__,_| |_| |_|  \___|  \__| |_|  \___/  |_| |_| |___/                                                                                                                    

 * 

 */

function getStudentDetails($id) {

    global $db;



    $query = mysqli_query($db, "SELECT * FROM `student` WHERE `student_id` = '$id'");

    $row = mysqli_fetch_array($query);

    $count = $query->num_rows;

    

    if($count > 0){

        return $row;

    }

}



function getStudentDetailByID($id) {

    global $db;



    $query = mysqli_query($db, "SELECT * FROM `student` WHERE `id` = '$id'");

    $row = mysqli_fetch_assoc($query);

    $count = $query->num_rows;

    

    if($count > 0){

        return $row;

    } else {
      return false;
    }

}





function insertFilesContent($student_id, $filename, $category, $file_type) {

  global $db;



  $date_uploaded = date('Y-m-d h:i:s');



  $query = "INSERT INTO `storage` (student_id, filename, category, file_type, date_uploaded) VALUES ('$student_id', '$filename','$category', '$file_type', '$date_uploaded')";



    if(mysqli_query($db, $query)) {

      return true;

    }





}



 /**

  *                 _               _              __                          _     _                       

  *      __ _    __| |  _ __ ___   (_)  _ __      / _|  _   _   _ __     ___  | |_  (_)   ___    _ __    ___ 

  *     / _` |  / _` | | '_ ` _ \  | | | '_ \    | |_  | | | | | '_ \   / __| | __| | |  / _ \  | '_ \  / __|

  *    | (_| | | (_| | | | | | | | | | | | | |   |  _| | |_| | | | | | | (__  | |_  | | | (_) | | | | | \__ \

  *     \__,_|  \__,_| |_| |_| |_| |_| |_| |_|   |_|    \__,_| |_| |_|  \___|  \__| |_|  \___/  |_| |_| |___/

  *                                                                                                      

  */



  function getAdminDetails($id) {

    global $db;



    $query = mysqli_query($db, "SELECT * FROM `users` WHERE `id` = '$id'");

    $row = mysqli_fetch_array($query);

    $count = $query->num_rows;

    

    if($count > 0){

        return $row;

    }

  }



  function countRows($table) {

      global $db;



      $query = mysqli_query($db, "SELECT * FROM $table");

      $rows = $query->num_rows;



      return $rows;

  }



  function couselingCases() {

    

  }



  function countUnseenNotif() {

    global $db;

    $count = 0;

    $sql = "SELECT COUNT(*) FROM admin_notif WHERE status = '0'";

    $query = mysqli_query($db, $sql);

    $rows = mysqli_fetch_row($query);

    $count = $rows[0];

      return $count;

  }

  function countUnseenMSG() {

    global $db;

    $count = 0;

    $sql = "SELECT COUNT(*) FROM `messages` WHERE status = '0' AND sender <> 'admin'";

    $query = mysqli_query($db, $sql);

    $rows = mysqli_fetch_row($query);

    $count = $rows[0];

      return $count;

  }



  function countservice($id) {

    global $db;

    $count = 0;

    $sql = "SELECT COUNT(*) FROM counseling_cases WHERE counselingApproach = '$id'";

    $query = mysqli_query($db, $sql);

    $rows = mysqli_fetch_row($query);

    $count = $rows[0];

      return $count;





  }

  

  function countvisit($purpose) {

    global $db;

    $count = 0;

    $sql = "SELECT COUNT(*) FROM visit_logs WHERE purpose = '$purpose'";

    $query = mysqli_query($db, $sql);

    $rows = mysqli_fetch_row($query);

    $count = $rows[0];

      return $count;





  }

  



  /***

   *          _     _                        __                          _     _                       

   *   ___   | |_  | |__     ___   _ __     / _|  _   _   _ __     ___  | |_  (_)   ___    _ __    ___ 

   *  / _ \  | __| | '_ \   / _ \ | '__|   | |_  | | | | | '_ \   / __| | __| | |  / _ \  | '_ \  / __|

   * | (_) | | |_  | | | | |  __/ | |      |  _| | |_| | | | | | | (__  | |_  | | | (_) | | | | | \__ \

   *  \___/   \__| |_| |_|  \___| |_|      |_|    \__,_| |_| |_|  \___|  \__| |_|  \___/  |_| |_| |___/

   */



function greetUser($user) {

    $time = date('H');



    switch (true) {

      case $time < "12" :

        return "Good morning, ".$user."!";

        break;

      case $time >= "12" && $time < "17":

        return "Good afternoon, ".$user."!";

        break;

      case $time >= "17" && $time < "19":

        return "Good evening, ".$user."!";

        break;

      case $time >= "19":

        return "Good night, ".$user."!";

        break;

      

      default:

        # code...

        break;

    }


    function ago($time)
{
   $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
   $lengths = array("60","60","24","7","4.35","12","10");

   $now = time();

       $difference     = $now - $time;
       $tense         = "ago";

   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
       $difference /= $lengths[$j];
   }

   $difference = round($difference);

   if($difference != 1) {
       $periods[$j].= "s";
   }

   return "$difference $periods[$j] 'ago' ";
}

    

}