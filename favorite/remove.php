<?php 

include "../connect.php" ; 

$usersid = filterRequest("userid") ; 
$itemsid = filterRequest("itemid") ; 

deleteData("favorite" , "fav_userid = $usersid AND fav_itemid = $itemsid") ; 
