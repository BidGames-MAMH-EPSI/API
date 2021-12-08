<?php
ini_set('display_errors', 1);
setlocale(LC_TIME, 'fr_FR');
date_default_timezone_set('Europe/Paris');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
include_once 'config/database.php';
include_once 'models/object_.php';
include_once 'models/category.php';
include_once 'models/bid.php';
include_once 'models/image.php';

if(isset($_GET['sale_id']) && !empty($_GET['sale_id']) && is_numeric($_GET['sale_id'])) {

    $database = new Database();
    $db = $database->getConnection();
    
    $userObject = new Object_($db);
    $categoryObject = new Category($db);
    $bidObject = new Bid($db);
    $imageObject = new Image($db);

    $max = 10;
    $page = 1;

    if (isset($_GET['max']) && is_numeric($_GET['max']) && !empty($_GET['max']) && $_GET['max'] > 0) {
        $max = $_GET['max'];
    }
    if (isset($_GET['page']) && is_numeric($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0) {
        $page = $_GET['page'];
    }
    
    $stmt = $userObject->readBySaleId($_GET['sale_id'], $max, $page);
    $num = $stmt->rowCount();
    
    if($num > 0) {
    
        $results = [];
        $results["results"] = [];

        $objects = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($objects as $object) {
            $category = $categoryObject->readOne($object['category_id']);
            $category = $category->fetchAll(PDO::FETCH_ASSOC)[0];

            $lastBid = $bidObject->readLastBid($object['object_id']);
            $countBid = $lastBid->rowCount();
            $lastBid = $lastBid->fetchAll(PDO::FETCH_ASSOC);

            if($object['type'] == 1) { // Vente EBAY
                $dateNow = new DateTime('now');
                $objectSaleDate = new DateTime($object['bid_end']);
    
                $interval = date_diff($dateNow, $objectSaleDate);

                $remainTime = ucwords(utf8_encode(strftime("%A %d %B", strtotime($object['bid_end'])))).' '.$interval->format('%aj %Hh %im %ss');
            } else { // Vente LIVE
                $remainTime = ucwords(utf8_encode(strftime("%A %d %B", strtotime($object['bid_start']))));
            }


            if(time() < strtotime($object['bid_start'])) {
                $status = 'À venir';
            } elseif((time() > strtotime($object['bid_start']) && !is_null($object['bid_end']) && time() < strtotime($object['bid_end'])) || (time() > strtotime($object['bid_start']) && is_null($object['bid_end']))) {
                $status = 'En cours';
            } elseif($countBid > 0) {
                $stauts = 'Vendu';
            } else {
                $status = 'Non vendu';
            }

            $item = [
                "id" => $object['object_id'],
                "name" => $object['name'],
                "description" => $object['description'],
                "category" => [
                    "id" => $category['category_id'],
                    "name" => $category['name']
                ],
                "estimation" => [
                    "min" => 0,
                    "max" => 0
                ],
                "status" => $status,
                "remain_time" => $remainTime,
                "bid_price" => isset($lastBid[0]['bid_price']) ? $lastBid[0]['bid_price'] : null,
                "lower_price" => $object['lower_price'],
                "images" => [
                    "total" => 0,
                    "items" => []
                ],
                "favorites" => false,
            ];

            $images = $imageObject->readByObjectId($object['object_id']);
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