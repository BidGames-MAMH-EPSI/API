<?php
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
include_once 'config/database.php';
include_once 'models/category.php';

$database = new Database();
$db = $database->getConnection();

$category = new Category($db);

$stmt = $category->read();
$num = $stmt->rowCount();

if($num > 0) {

    $results=array();
    $results["results"]=array();

    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $results['results'] = $categories;

    http_response_code(200);

    echo json_encode($results);
} else {
    http_response_code(404);

    echo json_encode(
        array("message" => "No categories found.")
    );
}