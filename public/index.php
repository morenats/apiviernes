<?php
// public/index.php

header("Access-Control-Allow-Origin: *");
header("Acces-Control-Allow-Methods.: GET, POST PUT, DELETE, OPTIONS");
header("Acces-Control-Allow-Headers: Content-Type, Authorization");
header('Content-Type: application/json');

include_once '../core/Router.php';
?>

