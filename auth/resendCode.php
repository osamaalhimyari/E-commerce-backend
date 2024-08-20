<?php 

include "../connect.php"  ;

$email = filterRequest("email");
$triedTimes = filterRequest("triedtimes");

$verfiycode     = rand(10000 , 99999);
if($triedTimes<=5){
  $data = array(
"user_verfycode" => $verfiycode
) ; 

updateData("users" ,  $data  , "user_email = '$email'" ) ; 

sendEmail($email, "verfy Code Ecommerce"," hello $email \nYour Verfy Code  $verfiycode ");  
}else{

    echo json_encode(array("status" => "failure"));
}
?>