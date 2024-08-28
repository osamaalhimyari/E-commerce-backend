 <?php

// $db = new PDO("mysql:host=localhost;dbname=database;port=3306","root","");
// $dsn = "mysql:host=localhost;dbname=ecommerce";
$dsn = "mysql:host=localhost;dbname=ecommerce";
$user = "root";
$pass = "";
$option = array(
   PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"
);
$countrowinpage = 9;

// constants






//

try {
   // $con = new PDO($dsn, $user, $pass, $option);
   $con = new PDO($dsn, $user, $pass, $option);
   $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   header("Access-Control-Allow-Origin: *");
   header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, Access-Control-Allow-Origin");
   header("Access-Control-Allow-Methods: POST, OPTIONS , GET");
   include "functions.php";
   // include "config.php";
   // include "authServer.php";
   if (!isset($notAuth)) {
      // checkAuthenticate();
   }
} catch (PDOException $e) {
   echo $e->getMessage();
} 

?>
