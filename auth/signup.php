<?php

include "../connect.php";

$name=filterRequest('name');
$password=filterRequestPass('password');
$phone=filterRequest('phone');
$email=filterRequest('email');
$vefyCode=rand(10000,99999);

// if (isset($_REQUEST['name'])&& isset($_REQUEST['password'])){

    $stmt=$con->prepare("SELECT * FROM users WHERE user_email =?  OR  user_phone=? ");
    $stmt->execute(array($email,$phone));
    $count=$stmt->rowCount();
    
    if($count>0){
        printFailur();
    }else{
        $data=array(
    "user_name"=>$name,
    "user_password"=>$password,
    "user_email"=>$email,
    "user_phone"=>$phone,
    "user_verfycode" => $vefyCode,
    
        );
        // $email
    sendEmail($email, "verfy Code Ecommerce"," hello $name \nYour Verfy Code  $vefyCode ");
        insertData('users',$data);
    }


?>