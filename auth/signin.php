<?php

include "../connect.php";

$email = filterRequest('email');
$password = filterRequestPass('password');

getData("users"," user_email =?  AND  user_password=?   ",array($email, $password));

?>