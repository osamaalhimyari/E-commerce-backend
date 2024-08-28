<?php




// function sendFCM2($title,  $body, $topic, $pageid, $pagename) {
   
//     $message = [
//         'message' => [//change token with device token
//             // 'token' => "e_Oj5hxdTnyAfbTHm2G8b7:APA91bFxZnvUQYuBRyNH2X_EHIHUwUyCf-tMEJEJW5qbYzmg7t3CdU7vEU-rSMjHSQHlYeEwN1Y24aurA1HeUHE203gQJhCPb65DI482yO5nDwZuG2XUG1OtR48aNA2gm1-EQtt6FX-S",
//             'topic'=>$topic,//"news",
//             'notification' => [
//                 'title' =>$title,//'Hello World',
//                 'body'  => $body,//'This is a test message from FCM API (V1)'
//             ]
//         ]
//     ];
   
//     $url = 'https://fcm.googleapis.com/v1/projects/ecommerce-7e6d2/messages:send';
//     $serverKey = 'Bearer ' . getAccessToken(); // Use OAuth 2.0 token


//     // $message =     [
//     //     'message' => [
//     //         // 'priority' => 'high',
//     //         // 'content_available' => true,
//     //         // 'topic' => $topic,
//     //         'token' => 'fsb9aThYRb-fy157shYL6d:APA91bEpM_osfAKIx3kaF8OWtO56tALZ9MNZJf13PVARlvfytGwJHJo_xrI_n4X1ysONFW4YkKZtyj4EKrLimNPnGqshrYW3BNwm7MKbhaujcIAC5ZzZK5Uiw9yjYl5JqiwPsjR0rhD_',
//     //         'notification' => [
//     //             'title' => $title,
//     //             'body'  => $body
//     //         ]
//     //     //  ,   "data"=>
//     //     //     [  "type"=>"type",
//     //     //   "id"=>"userId",
//     //     //   "click_action"=>"FLUTTER_NOTIFICATION_CLICK"]
//     //         ],
//     // ];

//     $headers = array(
//         'Authorization: ' . $serverKey,
//         'Content-Type: application/json'
//     );

//     $fields = json_encode($message);

//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL, $url);
//     curl_setopt($ch, CURLOPT_POST, true);
//     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

//     $result = curl_exec($ch);
//     if ($result === FALSE) {
//         die('FCM Send Error: ' . curl_error($ch));
//     }
//     curl_close($ch);

//     return $result;
// }
// include "config.php";
// function getAccessToken() {
//     // $credentialsPath = '../../authServer.json'; // Replace with the correct path
//     $credentials = json_decode(file_get_contents( CREDENTIAL_FILE), true);
    
//     if (!$credentials) {
//         die('Failed to load service account credentials.');
//     }
    
//     $privateKey = openssl_pkey_get_private($credentials['private_key']);

//     if (!$privateKey) {
//         die('Invalid private key.');
//     }

//     $jwt = createJWT($credentials, $privateKey);
//     $response = getGoogleAccessToken($jwt);

//     if (!isset($response['access_token'])) {
//         die('Failed to obtain access token.');
//     }

//     return $response['access_token'];
// }

// function createJWT($credentials, $privateKey) {
//     $header = ['alg' => 'RS256', 'typ' => 'JWT'];
//     $header = base64UrlEncode(json_encode($header));

//     $now = time();
//     $claims = [
//         'iss' => $credentials['client_email'],
//         'scope' => 'https://www.googleapis.com/auth/cloud-platform',
//         'aud' => 'https://oauth2.googleapis.com/token',
//         'exp' => $now + 3600,
//         'iat' => $now
//     ];
//     $claims = base64UrlEncode(json_encode($claims));

//     $signatureInput = $header . '.' . $claims;
//     $signature = '';
//     openssl_sign($signatureInput, $signature, $privateKey, 'sha256');

//     return $signatureInput . '.' . base64UrlEncode($signature);
// }

// function getGoogleAccessToken($jwt) {
//     $url = 'https://oauth2.googleapis.com/token';
//     $data = [
//         'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
//         'assertion' => $jwt
//     ];

//     $options = [
//         'http' => [
//             'header'  => 'Content-type: application/x-www-form-urlencoded',
//             'method'  => 'POST',
//             'content' => http_build_query($data)
//         ]
//     ];
//     $context  = stream_context_create($options);
//     $result = file_get_contents($url, false, $context);

//     return json_decode($result, true);
// }

// function base64UrlEncode($data) {
//     return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
// }

// // Example usage
// $topic="userid29";
// // $topic="news";
// echo sendFCM("success", "The Order Has been Approved", $topic , "none",  "refreshorderpending");

// // // insertNotify("success", "The Order Has been Approved", 29,$topic , "none",  "refreshorderpending","","");

// // insertNotify("success", "The Order Has been Approved", $userid, "user$userid", "none",  "refreshorderpending","","");

// //   sendFCM("success", "The Order Has been Approved", $userid, "user$userid", "none","authServer.json");
