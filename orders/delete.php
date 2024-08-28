<?php 

include "../connect.php"  ;

$ordersid = filterRequest("id") ; 

deleteData("orders" , "order_id = $ordersid AND order_state = 0"); 