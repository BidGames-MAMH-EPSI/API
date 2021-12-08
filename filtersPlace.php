<?php
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
include_once 'config/database.php';
include_once 'models/house.php';

$database = new Database();
$db = $database->getConnection();

$houseObject = new House($db);

$stmt = $houseObject->readDistinctCities();

$results=array();
$results["results"]=array();

$cities = $stmt->fetchAll(PDO::FETCH_ASSOC);

$results['results'] = $cities;

http_response_code(200);

echo json_encode($results);