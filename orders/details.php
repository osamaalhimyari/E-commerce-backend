<?php 

include "../connect.php" ; 

$ordersid = filterRequest("id")  ;

getAllData("orderdetailsview" , "cart_orderid = $ordersid "); 

?>