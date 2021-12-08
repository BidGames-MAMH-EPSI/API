<?php
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
include_once 'config/database.php';
include_once 'models/sale.php';
include_once 'models/house.php';
include_once 'models/category.php';

if(isset($_GET['sale_id']) && !empty($_GET['sale_id']) && is_numeric($_GET['sale_id'])) {

    $database = new Database();
    $db = $database->getConnection();
    
    $saleObject = new Sale($db);
    $houseObject = new House($db);
    $categoryObject = new Category($db);
    
    $stmt = $saleObject->readOne($_GET['sale_id']);
    $num = $stmt->rowCount();
    
    if($num==1) {
    
        $results=array();
        $results["results"]=array();

        $sale = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $sale = $sale[0];

        $house = $houseObject->readOne($sale['house_id']);
        $house = $house->fetchAll(PDO::FETCH_ASSOC);
        $house = $house[0];

        // $category = $categoryObject->readOne($sale['category_id']);
        // $category = $category->fetchAll(PDO::FETCH_ASSOC);
        // $category = $category[0];
        
        $results['results'] = [
            'id' => $sale['sale_id'],
            'name' => $sale['name'],
            'date' => $sale['sale_date'],
            'house' => [
                'id' => $house['house_id'],
                'name' => $house['name'],
                'adress' => $house['adress'] . ', ' . $house['cp'] . ' ' . $house['city']
            ],
            // 'category' => [
            //     'id' => $category['category_id'],
            //     'name' => $category['name']
            // ]
        ];
    
        http_response_code(200);

        echo json_encode($results);
    } else {
        http_response_code(404);
    
        echo json_encode(
            array("message" => "No sale found.")
        );
    }

} else {
    http_response_code(404);
    
    echo json_encode(
        array("message" => "The parameter 'sale_id' is missing.")
    );
}