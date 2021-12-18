<?php
include "./api.php";
$api = new API();
$data = $api->getUserInfo($_GET["ApiKey"]);

if ($data){
    header('Content-Type: application/json');
    echo json_encode($data);
}else{
    http_response_code(404);
    die();
}
?>