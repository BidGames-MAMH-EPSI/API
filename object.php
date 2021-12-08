<?php
ini_set('display_errors', 1);
setlocale(LC_TIME, 'fr_FR');
date_default_timezone_set('Europe/Paris');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
include_once 'config/database.php';
include_once 'models/object_.php';
include_once 'models/user.php';
include_once 'models/add_favorite.php';
include_once 'models/bid.php';
include_once 'models/image.php';
include_once 'models/transport_society.php';
include_once 'models/payment_way.php';


if(isset($_GET['object_id']) && !empty($_GET['object_id']) && is_numeric($_GET['object_id'])) {

    $database = new Database();
    $db = $database->getConnection();
    
    $object = new Object_($db);
    $favorites = new Add_favorite($db);
    $user = new User($db);
    $bid = new Bid($db);
    $images = new Image($db);
    $transport_societies = new Transport_society($db);
    $payment_ways = new Payment_way($db);
    

    
    $stmt_obj = $object->readOne($_GET['object_id']);
    $object = $stmt_obj->fetchAll(PDO::FETCH_ASSOC);
    $num = $stmt_obj->rowCount();
    
    if($num>=1) {
        $results=array();
        $results["results"]=array();
        $results['results'] = $object[0];
        $results['results']['date'] = $object[0]['bid_start'];
        $results['results']['createdAt'] = ucwords(utf8_encode(strftime("%A %d %B", strtotime($object[0]['createdAt']))));
        $results['results']['created_user_id'] = $object[0]['user_id'];
        $results['results']['favorites']=false;

        
        if(isset($_GET['user_id']) && !empty($_GET['user_id']) && is_numeric($_GET['user_id'])) {

            $stmt_fav = $favorites->readOneByObjectIdAndUserId($_GET['object_id'] ,$_GET['user_id']);
            // $favorites = $stmt_fav->fetchAll(PDO::FETCH_ASSOC);
            $num_fav = $stmt_fav->rowCount();
            if($num_fav >= 1) {
                $results['results']['favorites']=true;
            }

        }

        $stmt_lastbid = $bid->readLastBid($_GET['object_id']);
        if($stmt_lastbid->rowCount() > 0) {
            $lastbid = $stmt_lastbid->fetchAll(PDO::FETCH_ASSOC);

            $results['results']['current_bid'] = $lastbid[0]['bid_price'];
        } else {
            $results['results']['current_bid'] = null;
        }

        //Image
        $stmt_images = $images->readByObjectId($_GET['object_id']);
        $imagesbyobjectif = $stmt_images->fetchAll(PDO::FETCH_ASSOC);

        $results['results']['images']=[];
        foreach($imagesbyobjectif as $image) {
            $item = [
                "path" => $image['path'],
                "alt" => $object[0]['name']
            ];
            array_push($results['results']['images'], $item);
        }

        // estimation
        $results['results']['estimation'] = [
            "min" => null,
            "max"=> null
        ];


        //general information

        // min and max delivery prices
        $stmt_min_price = $transport_societies->readMinTransportSocietyPrice();
        $min_price = $stmt_min_price->fetchAll(PDO::FETCH_ASSOC);
        $stmt_max_price = $transport_societies->readMaxTransportSocietyPrice();
        $max_price = $stmt_max_price->fetchAll(PDO::FETCH_ASSOC);

        $results['results']['general_informations']['delivery_price']=[
            "min" => $min_price[0]['price'],
            "max" => $max_price[0]['price']
        ];

        //delivery delays
        // min and max delivery delays
        $stmt_min_delay = $transport_societies->readMinTransportSocietyDelay();
        $min_delay = $stmt_min_delay->fetchAll(PDO::FETCH_ASSOC);
        $stmt_max_delay = $transport_societies->readMaxTransportSocietyDelay();
        $max_delay = $stmt_max_delay->fetchAll(PDO::FETCH_ASSOC);
        
        $results['results']['general_informations']['delivery_time']=[
            "min" => $min_delay[0]['max_delay'],
            "max" => $max_delay[0]['max_delay']
        ];


        // Payment ways
        $stmt_payment_way = $payment_ways->read();
        $payment_ways = $stmt_payment_way->fetchAll(PDO::FETCH_ASSOC);

        $results['results']['general_informations']['payment_ways']=[];

        foreach($payment_ways as $payment_way) {
            $stmt_images_payment = $images->readOne($payment_way['image_id']);
            $images_payment = $stmt_images_payment->fetchAll(PDO::FETCH_ASSOC);
            $item = [
                "name" => $payment_way['name'],
                "image_path" => $images_payment[0]['path']
            ];
            array_push($results['results']['general_informations']['payment_ways'], $item);
        }

        //Status
        if(time() < strtotime($object[0]['bid_start'])) {
            $status = 'À venir';
        } elseif((time() > strtotime($object[0]['bid_start']) && !is_null($object[0]['bid_end']) && time() < strtotime($object[0]['bid_end'])) || (time() > strtotime($object[0]['bid_start']) && is_null($object[0]['bid_end']))) {
            $status = 'En cours';
        } else {
            $status = 'Fermée';
        }
        $results['results']['state'] = $status;

        $results['results']['type'] = $object[0]['type'];

        http_response_code(200);

        echo json_encode($results);
    } else {
        http_response_code(404);
    
        echo json_encode(
            array("message" => "No object found.")
        );
    }

} else {
    http_response_code(404);

    echo json_encode(
        array("message" => "The parameter 'object_id' is missing.")
    );
}