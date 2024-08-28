<?php

include "../connect.php";

$userid = filterRequest("userid");

$data  = getAllData("cartview", "cart_userid = $userid", null, false);

$stmt = $con->prepare("SELECT SUM( COALESCE( totalprice ,0)) as totalprice , SUM(itemscount) as  itemscount  FROM `cartview`  
WHERE  cartview.cart_userid =  $userid 
GROUP BY cart_userid  ");

$stmt->execute(); 


$datacountprice = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode(array(
    "status" => "success",
    "countprice" =>   $datacountprice,
    "datacart" => $data,
));
