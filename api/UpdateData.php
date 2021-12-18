<?php
include "./api.php";
$api = new API();
$data = $api->updateData($_GET($ApiKey), $_GET($fio), $_GET($passData), $_GET($INN), $_GET($phone), $_GET($BIK), $_GET($KPP), $_GET($Korr), $_GET($Rasch));


if ($data){
    header('Content-Type: application/json');
    echo $data;
}else{
    http_response_code(404);
    die();
}
?>