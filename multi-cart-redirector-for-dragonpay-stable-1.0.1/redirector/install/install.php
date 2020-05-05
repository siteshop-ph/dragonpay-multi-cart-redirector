<?php


// Get database connection's parameters
     // config.ph is located at one directory above
include("../config.php");









// START connection: database
include("../con/open.php");









echo 'Success in connecting to the mySQL database... ' . $db_connection->host_info . "<br /><br />";


echo 'Retrieving sql install file' . "<br /><br />";
 


$sql = file_get_contents('install.mysql.utf8.sql');
if (!$sql){
	die ('ERROR - Opening sql install file');
}
 


echo 'Processing sql install file <br /><br />';



$install = mysqli_multi_query($db_connection,$sql);



if(! $install)
{
  die('ERROR when running SQL query for install: ' . mysqli_error($db_connection));
}



 
echo 'INSTALLATION COMPLETED SUCCESSFULLY'. "<br /><br />";


echo 'Please delete "install" folder'. "<br /><br />";






// END connection: database
include("../con/close.php");





?>
