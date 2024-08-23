<?php

// ==========================================================
//  Copyright Reserved Wael Wael Abo Hamza (Course Ecommerce)
// ==========================================================

// define("FILTER_SANITIZE_STRING", 513);
define("MB", 1048576);


function filterRequest($requestname)
{
    return  htmlspecialchars(strip_tags($_POST[$requestname]));
}
function filterRequestPass($requestname)
{
    return  sha1($_POST[$requestname]);
}
// function filterRequest($requestname)
// {
//     if (isset($_POST[$requestname])) {
//         return htmlspecialchars(strip_tags($_POST[$requestname]));
//     } else {
//         return '';
//     }
// }
function getAllData($table, $where ='1=1', $values = null, $json=true)
{
    global $con;
    $data = array();

$stmt = $con->prepare("SELECT  * FROM $table WHERE   $where ");
    $stmt->execute($values);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();
    if($json){
        if ($count > 0) {
            echo
                json_encode(array("status" => "success", "data" => $data));
           } else {
               echo json_encode(array("status" => "failure"));
           }
    }else{
        if ($count > 0) {
           return array("status" => "success", "data" => $data);
           } else {
            return array("status" => "failure");
           }
    }
  
  
}
function getData($table, $where = "1=1", $values = null, $json=true)
{
    global $con;
    $data = array();
    $stmt = $con->prepare("SELECT  * FROM $table WHERE   $where ");
    $stmt->execute($values);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();
    if($json){
        if ($count > 0) {
            echo
                json_encode(array("status" => "success", "data" => $data));
           } else {
               echo json_encode(array("status" => "failure"));
           }
    }else{
       
           return $data;
          
    }
}

function insertData($table, $data, $json = true)
{
    global $con;
    foreach ($data as $field => $v)
        $ins[] = ':' . $field;
    $ins = implode(',', $ins);
    $fields = implode(',', array_keys($data));
    $sql = "INSERT INTO $table ($fields) VALUES ($ins)";

    $stmt = $con->prepare($sql);
    foreach ($data as $f => $v) {
        $stmt->bindValue(':' . $f, $v);
    }
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    }
    return $count;
}


function updateData($table, $data, $where, $json = true)
{
    global $con;
    $cols = array();
    $vals = array();

    foreach ($data as $key => $val) {
        $vals[] = "$val";
        $cols[] = "`$key` =  ? ";
    }
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " WHERE $where";

    $stmt = $con->prepare($sql);
    $stmt->execute($vals);
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    }
    return $count;
}

function deleteData($table, $where, $json = true)
{
    global $con;
    $stmt = $con->prepare("DELETE FROM $table WHERE $where");
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    }
    return $count;
}

function imageUpload($imageRequest)
{
    global $msgError;
    $imagename  = rand(1000, 10000) . $_FILES[$imageRequest]['name'];
    $imagetmp   = $_FILES[$imageRequest]['tmp_name'];
    $imagesize  = $_FILES[$imageRequest]['size'];
    $allowExt   = array("jpg", "png", "gif", "mp3", "pdf");
    $strToArray = explode(".", $imagename);
    $ext        = end($strToArray);
    $ext        = strtolower($ext);

    if (!empty($imagename) && !in_array($ext, $allowExt)) {
        $msgError = "EXT";
    }
    if ($imagesize > 2 * MB) {
        $msgError = "size";
    }
    if (empty($msgError)) {
        move_uploaded_file($imagetmp,  "../upload/" . $imagename);
        return $imagename;
    } else {
        return "fail";
    }
}



function deleteFile($dir, $imagename)
{
    if (file_exists($dir . "/" . $imagename)) {
        unlink($dir . "/" . $imagename);
    }
}

function checkAuthenticate()
{
    if (isset($_SERVER['PHP_AUTH_USER'])  && isset($_SERVER['PHP_AUTH_PW'])) {
        if ($_SERVER['PHP_AUTH_USER'] != "wael" ||  $_SERVER['PHP_AUTH_PW'] != "wael12345") {
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'Page Not Found';
            exit;
        }
    } else {
        exit;
    }

    // End 
}

// function printData($data, $typeJson = false)
// {

//     if ($typeJson) {
//         echo "<pre>";
//         print_r($data);
//         echo "</pre>";
//     } else {

//         echo json_encode($data);
//     }


// }

function result($count)
{
    if ($count > 0) {
        printSuccess();
    } else {


        printFailur();
    }
}
function    printFailur($message = '')
{
    echo json_encode(array("status" => "failure", "message:" => "$message"));
}

function    printSuccess($message = '')
{


    echo json_encode(array("status" => "success", "message:" => "$message"));
}

function sendEmail($to, $title, $body)
{
    $header = "From:support@osamaEcommerce.com" . "" . "CC:osama@gmail.com";
    //    $email=$to;
    $to = "omh179999@gmail.com";
    mail($to, $title, $body, $header);
}
