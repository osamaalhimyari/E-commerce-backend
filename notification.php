<?php 

include "./connect.php"  ;

$userid = filterRequest("userid") ; 

getAllData("notifications"  , "notification_userid = $userid") ; 


?>