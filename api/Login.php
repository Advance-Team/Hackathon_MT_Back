<?php
include "./api.php";
$api = new API();
$data = $api->login($_GET["email"], $_GET["password"]);


if ($data){
    header('Content-Type: application/json');
    echo $data;
}else{
    http_response_code(404);
    die();
}
?>