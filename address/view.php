<?php 

include "../connect.php" ; 

$usersid = filterRequest("userid") ; 

getAllData("address" , "address_usersid = $usersid ") ; 