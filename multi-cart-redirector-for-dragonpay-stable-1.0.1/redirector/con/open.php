<?php


// Get database connection's parameters
// no need to include config.php file here, it's has ever been included in return.ph & postback.ph at the begining


$db_host_persitent = 'p:'.$db_host;   // to get msqli persitent database connection


// Data base Connection
$db_connection = mysqli_connect($db_host_persitent,$db_username,$db_password);
   // use this in place of above if you wish no persitent db connection
  //$db_connection = mysqli_connect($db_host,$db_username,$db_password);


     if (!$db_connection) {
       die('Could not connect: ' . mysqli_error());
     }




// select the good database
mysqli_select_db($db_connection,$db_name);





?>
