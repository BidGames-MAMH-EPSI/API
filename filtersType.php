<?php
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$results=array();
$results["results"]=array();

$results['results'] = [
    "Direct",
    "Live",
    "En cours",
    "À venir"
];

http_response_code(200);

echo json_encode($results);