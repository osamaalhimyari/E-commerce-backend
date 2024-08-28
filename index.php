
<?php
// session_start();
// include "connect.php";
// Get the requested URL from the query string
$request = $_POST['request'] ?? 0;

// Handle the request
switch ($request) {
    case 1:
        include 'orders/details.php';
        break;
    case 0:
        include 'items/c.php';
        break;
    case 2:
        echo 'Welcome to the homepage!';
        break;
    default:
        http_response_code(404);
        echo 'Page not found';
        break;
}
?>

<?php
// session_start();

// Retrieve the request from POST data instead of GET
// $request = $_POST['request'] ?? '';
// $requestParts = explode('/', $request);

// if ($requestParts[0] === 'admin') {
//     // Further process based on more detailed admin requests
//     include 'courseFiles/ecommerce/admin/' . $requestParts[1] . '.php';
// } elseif ($requestParts[0] === 'user') {
//     include 'courseFiles/ecommerce/user/' . $requestParts[1] . '.php';
// } else {
//     http_response_code(404);
//     echo 'Page not found';
// }
?>