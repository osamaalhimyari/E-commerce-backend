<?php

include "../connect.php";

$email =filterRequest('email');
$password=filterRequestPass('password');
$data =array("user_password" => $password);
updateData("users",$data,"user_email='$email'");


    
?>