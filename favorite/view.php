<?php


include "../connect.php";


$id = filterRequest("userid");


getAllData("myfavorite", "fav_userid = ?  ", array($id));
