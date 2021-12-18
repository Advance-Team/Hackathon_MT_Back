<?php
include "./api.php";
$api = new API();
$data = $api->createDOC($_GET["ApiKey"], $_GET["INN"], $_GET["rs"], $_GET["bik"], $_GET["ks"]);

?>