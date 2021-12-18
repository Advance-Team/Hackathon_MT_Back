<?php
include "./api.php";

$api = new API();

$data = $api->register($_GET['email'], $_GET['password']);
print_r($_GET);


if ($data){
    header('Content-Type: application/json');
    echo 1;
}else{
    http_response_code(404);
    die();
}
?>