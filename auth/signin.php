<?php

include "../connect.php";

$email = filterRequest('email');
$password = filterRequestPass('password');

getData("users"," user_email =?  AND  user_password=?  AND  user_approve=1 ",array($email, $password));

?>