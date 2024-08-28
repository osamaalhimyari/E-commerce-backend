<?php

include "../../connect.php";

$orderid = filterRequest("orderid");

$userid = filterRequest("userid");

$data = array(
    "order_state" => 1
);

$count= updateData("orders", $data, "order_id = $orderid AND order_state = 0");
if($count>0){

    insertNotify("success", "The Order Has been Approved", $userid, "userid$userid", 'orderspending',  "refreshorderpending","","");
}
