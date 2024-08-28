<?php


include "../connect.php";


$usersid = filterRequest("userid");
$itemsid = filterRequest("itemid");


  getData("cart", "cart_itemid = $itemsid AND cart_userid = $usersid AND cart_orderid = 0 " ,null  , false );


$data = array(
    "cart_userid" =>  $usersid,
    "cart_itemid" =>  $itemsid
);

insertData("cart", $data);
 

    // Mysql 

    // PHP 