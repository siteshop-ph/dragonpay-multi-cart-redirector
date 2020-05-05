<?php



require_once (dirname(__FILE__).'/config.php');




$proxy_table = array(
	$shopping_cart_1_param2   => $shopping_cart_1_postback_url,
	$shopping_cart_2_param2   => $shopping_cart_2_postback_url,
	$shopping_cart_3_param2   => $shopping_cart_3_postback_url,
        $shopping_cart_4_param2   => $shopping_cart_4_postback_url,
        $shopping_cart_5_param2   => $shopping_cart_5_postback_url,
        $shopping_cart_6_param2   => $shopping_cart_6_postback_url,
        $shopping_cart_7_param2   => $shopping_cart_7_postback_url,
        $shopping_cart_8_param2   => $shopping_cart_8_postback_url,
        $shopping_cart_9_param2   => $shopping_cart_9_postback_url,
        $shopping_cart_10_param2 => $shopping_cart_10_postback_url,
        $shopping_cart_11_param2 => $shopping_cart_11_postback_url,
        $shopping_cart_12_param2 => $shopping_cart_12_postback_url,
        $shopping_cart_13_param2 => $shopping_cart_13_postback_url,
        $shopping_cart_14_param2 => $shopping_cart_14_postback_url,
        $shopping_cart_15_param2 => $shopping_cart_15_postback_url,
        $shopping_cart_16_param2 => $shopping_cart_16_postback_url,
        $shopping_cart_17_param2 => $shopping_cart_17_postback_url,
        $shopping_cart_18_param2 => $shopping_cart_18_postback_url,
        $shopping_cart_19_param2 => $shopping_cart_19_postback_url,
        $shopping_cart_20_param2 => $shopping_cart_20_postback_url,
        $shopping_cart_21_param2 => $shopping_cart_21_postback_url,
        $shopping_cart_22_param2 => $shopping_cart_22_postback_url,
        $shopping_cart_23_param2 => $shopping_cart_23_postback_url,
        $shopping_cart_24_param2 => $shopping_cart_24_postback_url,
        $shopping_cart_25_param2 => $shopping_cart_25_postback_url
);






// HERE DRAGONPAY send data with  ****POST  METHOD**** , with URL structure like this: 
//       http://proxy.netpublica.ph/ipn.php
// IMPORTANT: Data are not send in the URL





// Get all data posted by dragonpay
   //Both can work, use one:
        $post_string = http_build_query($_POST);
       //$post_string = file_get_contents('php://input');






// find what is value for param2 & definite url to redirect from above proxy_table
$url = $proxy_table[$_POST['param2']];




$shopping_cart_id = $_POST['param2'];
$refno = $_POST['refno'];
$txnid = $_POST['txnid'];









if($url != null) {






function http_execute_post($url, $post_string)
{
	$ch = curl_init($url);

	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $result = curl_exec($ch);
	             
	curl_close($ch);	


}
 








        // run http_execute_post function if there is a destination $url found in $proxy_table
	print http_execute_post($url, $post_string);




                              
                                    if ($log_redirections_mode == 1) {


                                         //CASE  $log_redirections_mode is enabled


                                              $url = mysqli_real_escape_string($db_connection, $url);
                                              $shopping_cart_id = mysqli_real_escape_string($db_connection, $shopping_cart_id);
                                              $refno = mysqli_real_escape_string($db_connection, $refno);
                                              $txnid = mysqli_real_escape_string($db_connection, $txnid);
                                             

                                             

                                              mysqli_query($db_connection,"INSERT INTO log_redirections (`action`, `shopping_cart_id`, `refno`, `txnid`, `destination`) VALUES ('postback', '$shopping_cart_id', '$refno', '$txnid', '$url')");




                                     
                                    } else {  



                                          //CASE  $log_redirections_mode is NOT enabled


                                               // delete all row in log_redirections table
                                               mysqli_query($db_connection,"truncate log_redirections");



                             }   









} else {


	print 'No destination found';

}










// END connection: database
include(dirname(__FILE__).'/con/close.php');









 ?>
