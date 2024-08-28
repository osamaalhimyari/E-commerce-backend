<?php

// ==========================================================
//  Copyright Reserved Wael Wael Abo Hamza (Course Ecommerce)
// ==========================================================

define("MB", 1048576);
include "config.php";

function filterRequest($requestname)
{
    return  htmlspecialchars(strip_tags($_POST[$requestname]));
}
function filterRequestPass($requestname)
{
    return  sha1($_POST[$requestname]);
}
function filterRequest2($requestname)
{
   echo $requestname;
}
function getAllData($table, $where = '1=1', $values = null, $json = true)
{
    global $con;
    $data = array();

    $stmt = $con->prepare("SELECT  * FROM $table WHERE   $where ");
    $stmt->execute($values);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();
    if ($json) {
        if ($count > 0) {
            echo
            json_encode(array("status" => "success", "data" => $data));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    } else {
        if ($count > 0) {
            return array("status" => "success", "data" => $data);
        } else {
            return array("status" => "failure");
        }
    }
}
function getData($table, $where = "1=1", $values = null, $json = true)
{
    global $con;
    $data = array();
    $stmt = $con->prepare("SELECT  * FROM $table WHERE   $where ");
    $stmt->execute($values);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();
    if ($json) {
        if ($count > 0) {
            echo
            json_encode(array("status" => "success", "data" => $data));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    } else {

        return $data;
    }
}

function  insertData($table, $data, $json = true)
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

//

// function insertDataTest($table, $data, $json = true)
// {
//     global $con;
//     foreach ($data as $field => $v)
//         $ins[] = ':' . $field;
//     $ins = implode(',', $ins);
//     $fields = implode(',', array_keys($data));
//     $sql = "INSERT INTO $table ($fields) VALUES ($ins)";

//     $stmt = $con->prepare($sql);
//     foreach ($data as $f => $v) {
//         $stmt->bindValue(':' . $f, $v);
//     }
//     $stmt->execute();

//     return $stmt;
// }

//
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
            header('WWW-Authenticate=>Basic realm="My Realm"');
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
    echo json_encode(array("status" => "failure", "message:" => $message));
}

function    printSuccess($message = '')
{


    echo json_encode(array("status" => "success", "message:" => $message));
}

function sendEmail($to, $title, $body)
{
    $header = "From:support@osamaEcommerce.com" . "" . "CC:osama@gmail.com";
    //    $email=$to;
    $to = "omh179999@gmail.com";
    mail($to, $title, $body, $header);
}


function sendFCM($title,  $body, $topic, $pageid, $pagename)
{

    $message = [
        'message' => [ //change token with device token
            // 'token' => "e_Oj5hxdTnyAfbTHm2G8b7:APA91bFxZnvUQYuBRyNH2X_EHIHUwUyCf-tMEJEJW5qbYzmg7t3CdU7vEU-rSMjHSQHlYeEwN1Y24aurA1HeUHE203gQJhCPb65DI482yO5nDwZuG2XUG1OtR48aNA2gm1-EQtt6FX-S",
            'topic' => $topic, //"news",
            'notification' => [
                'title' => $title, //'Hello World',
                'body'  => $body, //'This is a test message from FCM API (V1)'
            ],
            'data' => array(
                "pageid" => $pageid,
                "pagename" => $pagename
            )
        ]
    ];

    $url = 'https://fcm.googleapis.com/v1/projects/ecommerce-7e6d2/messages:send';
    // $serverKey = 'Bearer ' . getAccessToken(); // Use OAuth 2.0 token
    $serverKey = 'Bearer ' . ACCESS_TOKEN; // Use OAuth 2.0 token

    $headers = array(
        'Authorization: ' . $serverKey,
        'Content-Type: application/json'
    );

    $fields = json_encode($message);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

    $result = curl_exec($ch);
    if ($result === FALSE) {
        die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);

    return $result;
}


function insertNotify($title, $body, $userid, $topic, $pageid, $pagename, $token, $accessTokenAuth)
{
    global $con;
     $stmt  = $con->prepare("INSERT INTO `notifications`(  `notification_title`, `notification_body`, `notification_userid`) VALUES (? , ? , ?)");
    $stmt->execute(array($title, $body, $userid));
   sendFCM($title,  $body, $topic, $pageid, $pagename, $token, $accessTokenAuth);
    $count = $stmt->rowCount();
    return $count;
}
////////////////////////////////////














////////////////////////////// utils

function getRelativePath($targetPath)
{

    $callingDir = getcwd();


    $from = rtrim($callingDir, DIRECTORY_SEPARATOR);
    $to = rtrim($targetPath, DIRECTORY_SEPARATOR);

    // Convert paths to arrays
    $from = explode(DIRECTORY_SEPARATOR, $from);
    $to = explode(DIRECTORY_SEPARATOR, $to);


    // Remove common path parts
    while (count($from) && count($to) && ($from[0] == $to[0])) {
        array_shift($from);
        array_shift($to);
    }

    // Add ".." for each remaining part in $from
    return str_repeat('..' . DIRECTORY_SEPARATOR, count($from)) . implode(DIRECTORY_SEPARATOR, $to);
}

/////////////////////////////
function getAccessToken()
{

    $targetPath = getRelativePath(CREDENTIAL_FILE);

    $credentials = json_decode(file_get_contents($targetPath), true);

    if (!$credentials) {
        die('Failed to load service account credentials.');
    }

    $privateKey = openssl_pkey_get_private($credentials['private_key']);

    if (!$privateKey) {
        die('Invalid private key.');
    }

    $jwt = createJWT($credentials, $privateKey);
    $response = getGoogleAccessToken($jwt);

    if (!isset($response['access_token'])) {
        die('Failed to obtain access token.');
    }

    return $response['access_token'];
}

function createJWT($credentials, $privateKey)
{
    $header = ['alg' => 'RS256', 'typ' => 'JWT'];
    $header = base64UrlEncode(json_encode($header));

    $now = time();
    $claims = [
        'iss' => $credentials['client_email'],
        'scope' => 'https://www.googleapis.com/auth/cloud-platform',
        'aud' => 'https://oauth2.googleapis.com/token',
        'exp' => $now + 3600,
        'iat' => $now
    ];
    $claims = base64UrlEncode(json_encode($claims));

    $signatureInput = $header . '.' . $claims;
    $signature = '';
    openssl_sign($signatureInput, $signature, $privateKey, 'sha256');

    return $signatureInput . '.' . base64UrlEncode($signature);
}

function getGoogleAccessToken($jwt)
{
    $url = 'https://oauth2.googleapis.com/token';
    $data = [
        'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
        'assertion' => $jwt
    ];

    $options = [
        'http' => [
            'header'  => 'Content-type: application/x-www-form-urlencoded',
            'method'  => 'POST',
            'content' => http_build_query($data)
        ]
    ];
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    return json_decode($result, true);
}

function base64UrlEncode($data)
{
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}
