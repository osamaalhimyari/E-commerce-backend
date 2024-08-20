<?php 

include "../connect.php" ; 

$id = filterRequest("id") ;  

deleteData("favorite" , "fav_id = $id"); 
