<?php 

include "../connect.php" ; 

$search = filterRequest("search") ; 

$categoryid= filterRequest("catid")  ;

if($categoryid>0 ){
    getAllData("items1view" , "item_name_en LIKE '%$search%' OR item_name_ar  LIKE '%$search%' AND item_cat= $categoryid   ") ; 

}else{
    getAllData("items1view" , "item_name_en LIKE '%$search%' OR item_name_ar  LIKE '%$search%'  ") ; 

}

?>