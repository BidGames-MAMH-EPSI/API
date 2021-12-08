<?php
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
include_once 'config/database.php';
include_once 'models/object_.php';
include_once 'models/add_favorite.php';
include_once 'models/image.php';

if(isset($_GET['sale_id']) && !empty($_GET['sale_id']) && is_numeric($_GET['sale_id'])) {

    $database = new Database();
    $db = $database->getConnection();
    
    $objectObject = new Object_($db);
    $favoritesObject = new Add_favorite($db);
    $imagesObject = new Image($db);
    
    $stmt = $objectObject->readBySaleId($_GET['sale_id']);
    $num = $stmt->rowCount();
    
    if($num > 0) {
    
        $results = [];
        $results["results"] = [];

        $objects = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($objects as $object) {
            $item = [
                "id" => $object['object_id'],
                "name" => $object['name'],
                "estimation" => [
                    "min" => null,
                    "max" => null
                ],
                "description" => $object['description'],
                "images" => [
                    "total" => 0,
                    "items" => []
                ],
                "favorites" => false
            ];

            if(isset($_GET['user_id']) && !empty($_GET['user_id']) && is_numeric($_GET['user_id'])) {
                $favorites = $favoritesObject->readOneByObjectIdAndUserId($object['object_id'], $_GET['user_id']);
                $favorites = $favorites->fetchAll(PDO::FETCH_ASSOC);

                if($favorites->rowCount() >= 1) {
                    $item['favorites'] = true;
                }
            }

            $images = $imagesObject->readByObjectId($object['object_id']);
            $item['images']['total'] = $images->rowCount();

            foreach($images->fetchAll(PDO::FETCH_ASSOC) as $image) {
                array_push($item['images']['items'], [
                    "id" => $image['image_id'],
                    "path" => $image['path']
                ]);
            }

            array_push($results['results'], $item);
        }
    
        http_response_code(200);

        echo json_encode($results);
    } else {
        http_response_code(404);
    
        echo json_encode(
            array("message" => "No objects found.")
        );
    }

} else {
    http_response_code(404);
    
    echo json_encode(
        array("message" => "The parameter 'sale_id' is missing.")
    );
}