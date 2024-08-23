<?php

include "../connect.php";

$couponname=filterRequest("couponname");
$now = date("Y-m-d H:i:s");
getData("coupons","coupon_name='$couponname'  AND coupon_expire > '$now' AND coupon_count > 0 ")

?>