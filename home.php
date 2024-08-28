<?php
include "connect.php";
$allData=array();
$allData['status']='success';
$allData['categories']=  getAllData('categories','1=1',null,false);
$allData['items']=  getAllData('itemtopselling','1=1 ORDER BY countitems DESC',null,false);


echo json_encode($allData);
?>