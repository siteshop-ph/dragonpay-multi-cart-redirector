<?php





require_once (dirname(__FILE__).'/config.php');




$proxy_table = array(
	$shopping_cart_1_param2   => $shopping_cart_1_return_url,
	$shopping_cart_2_param2   => $shopping_cart_2_return_url,
	$shopping_cart_3_param2   => $shopping_cart_3_return_url,
        $shopping_cart_4_param2   => $shopping_cart_4_return_url,
        $shopping_cart_5_param2   => $shopping_cart_5_return_url,
        $shopping_cart_6_param2   => $shopping_cart_6_return_url,
        $shopping_cart_7_param2   => $shopping_cart_7_return_url,
        $shopping_cart_8_param2   => $shopping_cart_8_return_url,
        $shopping_cart_9_param2   => $shopping_cart_9_return_url,
        $shopping_cart_10_param2 => $shopping_cart_10_return_url,
        $shopping_cart_11_param2 => $shopping_cart_11_return_url,
        $shopping_cart_12_param2 => $shopping_cart_12_return_url,
        $shopping_cart_13_param2 => $shopping_cart_13_return_url,
        $shopping_cart_14_param2 => $shopping_cart_14_return_url,
        $shopping_cart_15_param2 => $shopping_cart_15_return_url,
        $shopping_cart_16_param2 => $shopping_cart_16_return_url,
        $shopping_cart_17_param2 => $shopping_cart_17_return_url,
        $shopping_cart_18_param2 => $shopping_cart_18_return_url,
        $shopping_cart_19_param2 => $shopping_cart_19_return_url,
        $shopping_cart_20_param2 => $shopping_cart_20_return_url,
        $shopping_cart_21_param2 => $shopping_cart_21_return_url,
        $shopping_cart_22_param2 => $shopping_cart_22_return_url,
        $shopping_cart_23_param2 => $shopping_cart_23_return_url,
        $shopping_cart_24_param2 => $shopping_cart_24_return_url,
        $shopping_cart_25_param2 => $shopping_cart_25_return_url
);






// HERE DRAGONPAY SEND A REDIRECTION WITH ****GET  METHOD**** , with structure like this: 
//        http://proxy.netpublica.ph/return.php?txnid=8454791&refno=6TCG77A1&status=S&message=%5b000%5d+BOG+Reference+No%3a+20150305222955+%236TCG77A1+%7b...
// ALL data are within the URL




// Will give/insolate full  URL ending after return.php
$get_string =  $_SERVER["QUERY_STRING"];  





// Find what is value for param2 & definite url to redirect from above $proxy_table
$url = $proxy_table[$_GET['param2']];





$shopping_cart_id = $_GET['param2'];
$refno = $_GET['refno'];
$txnid = $_GET['txnid'];





if($url != null) {
	
               ### Let's prepare the redirection to Dragonpay
               $request_params = $get_string;

                $url_request_params = $url . $request_params;


                             

                              
                                    if ($log_redirections_mode == 1) {



                                         //CASE  $log_redirections_mode is enabled



                                              $url_request_params = mysqli_real_escape_string($db_connection, $url_request_params);
                                              $shopping_cart_id = mysqli_real_escape_string($db_connection, $shopping_cart_id);
                                              $refno = mysqli_real_escape_string($db_connection, $refno);
                                              $txnid = mysqli_real_escape_string($db_connection, $txnid);
                                              


                                              mysqli_query($db_connection,"INSERT INTO log_redirections (`action`, `shopping_cart_id`, `refno`, `txnid`, `destination`) VALUES ('return', '$shopping_cart_id', '$refno', '$txnid', '$url_request_params')");







                                    } else {  





                                          //CASE  $log_redirections_mode is NOT enabled


                                              // delete all row in log_redirections table
                                              mysqli_query($db_connection,"truncate log_redirections");



                             }  








                               // END connection: database
                               include(dirname(__FILE__).'/con/close.php');

            
                        header("Location: $url_request_params",TRUE,301);      // 200 HTTP status response will be managed at destination 


                        exit;    





} else {

        // no destination URL ($url) found
	    print 'No destination found';

}










// END connection: database
include(dirname(__FILE__).'/con/close.php');






 
 ?>
