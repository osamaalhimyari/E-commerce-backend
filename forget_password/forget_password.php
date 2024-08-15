<?php

include "../connect.php";


$email =filterRequest('email');
$verfy=rand(10000,99999);

$stmt=$con->prepare("SELECT * FROM users WHERE user_email='$email' ");
$stmt->execute();
$account=$stmt->rowCount();

if($account>0){
    
     $data =array("user_verfycode" => $verfy);
     updateData("users",$data,"user_email='$email'");
     sendEmail($email, "verfy Code Ecommerce"," hello $email \nYour Verfy Code  $verfy ");
}else {
    printFailur('account not exist');
    
   

}


    
?>