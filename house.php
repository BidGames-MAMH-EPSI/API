<?php
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
include_once 'config/database.php';
include_once 'models/house.php';

if(isset($_GET['house_id']) && !empty($_GET['house_id']) && is_numeric($_GET['house_id'])) {

    $database = new Database();
    $db = $database->getConnection();
    
    $house = new House($db);
    
    $stmt = $house->readOne($_GET['house_id']);
    $num = $stmt->rowCount();
    
    if($num==1) {
    
        $results=array();
        $results["results"]=array();

        $house = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $results['results'] = $house[0];
    
        http_response_code(200);

        echo json_encode($results);
    } else {
        http_response_code(404);
    
        echo json_encode(
            array("message" => "No house found.")
        );
    }

} else {
    http_response_code(404);
    
    echo json_encode(
        array("message" => "The parameter 'house_id' is missing.")
    );
}