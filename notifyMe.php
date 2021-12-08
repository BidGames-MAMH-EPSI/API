<?php
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
include_once 'config/database.php';
include_once 'models/be_warned.php';
include_once 'models/sale.php';
include_once 'models/user.php';

if($_SERVER['REQUEST_METHOD'] == "POST") {
    if(isset($_POST['user_id']) && !empty($_POST['user_id']) && is_numeric($_POST['user_id'])) {
        if(isset($_POST['sale_id']) && !empty($_POST['sale_id']) && is_numeric($_POST['sale_id'])) {

            $database = new Database();
            $db = $database->getConnection();
            
            $beWarnedObject = new Be_warned($db);
            $saleObject = new Sale($db);
            $userObject = new User($db);

            $sale = $saleObject->readOneIdById($_POST['sale_id']);
            $numSale = $sale->rowCount();
            
            if($numSale == 1) {

                $user = $userObject->readOne($_POST['user_id']);
                $numUser = $user->rowCount();
                
                if($numUser == 1) {

                    $countWarneWithUserAndObject = $beWarnedObject->readOneBySaleIdAndUserId($_POST['sale_id'], $_POST['user_id']);
                    $countWarneWithUserAndObject = $countWarneWithUserAndObject->rowCount();
            
                    if($countWarneWithUserAndObject == 0) {

                        $results = [];

                        $stmt = $beWarnedObject->add($_POST['user_id'], $_POST['sale_id']);

                        if($stmt) {
                            $results['message'] = "The notify has been added.";

                            http_response_code(200);

                            echo json_encode($results);
                        } else {
                            $results['message'] = "The notify has not been added.";

                            http_response_code(404);

                            echo json_encode($results);
                        }
                    } else {
                        $results['message'] = "The user has already been create a notification for this object.";

                        http_response_code(404);

                        echo json_encode($results);
                    }
                } else {
                    http_response_code(404);
                
                    echo json_encode(
                        array("message" => "No user found with this id.")
                    );
                }
            } else {
                http_response_code(404);
            
                echo json_encode(
                    array("message" => "No sale found with this id.")
                );
            }
        } else {
            http_response_code(404);
            
            echo json_encode(
                array("message" => "The parameter 'sale_id' is missing, empty or not a integer value.")
            );
        }
    } else {
        http_response_code(404);
        
        echo json_encode(
            array("message" => "The parameter 'user_id' is missing, empty or not a integer value.")
        );
    }
} else {
    http_response_code(404);
}