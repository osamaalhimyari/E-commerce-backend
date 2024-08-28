<?php 

include "../connect.php" ; 

$userid = filterRequest("id") ; 

getAllData('orderview' , "order_userid = '$userid' AND order_state !=  4") ; 

?>