<?php 

include "../connect.php" ; 


$usersid = filterRequest("userid") ; 
$itemsid = filterRequest("itemid") ; 


$data = array(
    "fav_userid"  =>   $usersid , 
    "fav_itemid"  =>   $itemsid
);


insertData("favorite" ,$data) ; 
