<?php

include "connect.php";

$name=filterRequest('name');
$password=filterRequestPass('password');
$phone=filterRequest('phone');
$email=filterRequest('email');
$vefyCode=rand(10000,99999);

// if (isset($_REQUEST['name'])&& isset($_REQUEST['password'])){

    $stmt=$con->prepare("SELECT * FROM users WHERE user_email =?  OR  user_phone=? union select * from cart where cart_userid=29 ");
    $stmt->execute(array($email,$phone));
    // $count=$stmt->rowCount();
    $data=$stmt->fetchAll();
    
    printSuccess( $data);
    // if($count>0){
    // }else{
    //     $data=array(
    // "user_name"=>$name,
    // "user_password"=>$password,
    // "user_email"=>$email,
    // "user_phone"=>$phone,
    // "user_verfycode" => $vefyCode,
    
    //     );
    //     // $email
    // sendEmail($email, "verfy Code Ecommerce"," hello $name \nYour Verfy Code  $vefyCode ");
    //     insertData('users',$data);
    // }


?>
