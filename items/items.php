<?php
include "../connect.php";
$categoryid = filterRequest("catid");
$userid = filterRequest("userid");



$stmt = $con->prepare("SELECT items1view.* , 1 as favorite , (item_price - (item_price * item_discount / 100 ))  as itempricedisount  FROM items1view 
INNER JOIN favorite ON favorite.fav_itemid = items1view.item_id AND favorite.fav_userid =$userid
WHERE cat_id =$categoryid
UNION ALL 
SELECT *  , 0 as favorite  , (item_price - (item_price * item_discount / 100 ))  as itempricedisount  FROM items1view
WHERE  cat_id =$categoryid AND item_id NOT IN  ( SELECT items1view.item_id FROM items1view 
INNER JOIN favorite ON favorite.fav_itemid = items1view.item_id AND favorite.fav_userid =$userid  ); )
");

$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count  = $stmt->rowCount();

if ($count > 0) {
    echo json_encode(array("status" => "success", "data" => $data));
} else {
    echo json_encode(array("status" => "failure"));
}


?>