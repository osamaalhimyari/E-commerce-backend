<?php
include "../connect.php";
$ordersid = filterRequest("id")  ;

getAllData("orderdetailsview" , "cart_orderid = $ordersid "); 

echo "this is orders c"; 