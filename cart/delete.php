<?php 

include "../connect.php" ; 

$usersid = filterRequest("userid");
$itemsid = filterRequest("itemid");

deleteData("cart" , "cart_id  = (SELECT cart_id FROM cart WHERE cart_userid = $usersid AND cart_itemid = $itemsid  LIMIT 1) "); 
// AND cart_orders = 0