<?php

include "../connect.php";

$email =filterRequest('email');
$verfy=filterRequest('verfycode');

$stmt=$con->prepare("SELECT * FROM users WHERE user_email='$email' AND user_verfycode='$verfy'");
$stmt->execute();
$account=$stmt->rowCount();

if($account>0){
    
     $data =array("user_approve"=>1);
     updateData("users",$data,"user_email='$email'");
}else {
    printFailur('verfy code is not true');
    
   

}


?>