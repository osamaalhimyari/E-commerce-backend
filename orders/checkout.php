<?php

include "../connect.php";


$usersid = filterRequest("userid");
$addressid = filterRequest("addressid");
$orderstype = filterRequest("orderstype");
$pricedelivery = filterRequest("pricedelivery");
$ordersprice = filterRequest("ordersprice");
$couponid = filterRequest("couponid");
$paymentmethod = filterRequest("paymentmethod");
$coupondiscount = filterRequest("coupondiscount");

if ($orderstype == 1) {
    $pricedelivery = 0;
}

$totalprice = $ordersprice  + $pricedelivery;


// Check Coupon 

$now = date("Y-m-d H:i:s");

// $checkcoupon = getData("coupons", "coupon_id = '$couponid' AND coupon_expire > '$now' AND coupon_count > 0  ", null,  false);


$stmt = $con->prepare("UPDATE `coupons` SET  `coupon_count`= `coupon_count` - 1  WHERE coupon_id = '$couponid' AND coupon_id = '$couponid' AND coupon_expire > '$now' AND coupon_count > 0   AND coupon_discount ='$coupondiscount' ");
$stmt->execute();
$count1 = $stmt->rowCount();

if ($count1   > 0) {
    $totalprice =  $totalprice - $ordersprice * $coupondiscount / 100;
    
}




$data = array(
    "order_userid"  =>  $usersid,
    "order_addressid"  =>  $addressid,
    "order_type"  =>  $orderstype,
    "order_deliveryprice"  =>  $pricedelivery,
    "order_price"  =>  $ordersprice,
    "order_coupon"  =>  $couponid,
    "order_totalprice"  =>  $totalprice,
    "order_paymethod"  =>  $paymentmethod
);

$count2 = insertData("orders", $data, false);

if ($count2 > 0) {

    $stmt = $con->prepare("SELECT MAX(order_id) from orders ");
    $stmt->execute();
    $maxid = $stmt->fetchColumn();

    $data = array("cart_orderid" => $maxid);

    updateData("cart", $data, "cart_userid = $usersid  AND cart_orderid = 0 ");
    
}
else{

    printFailur();
}




