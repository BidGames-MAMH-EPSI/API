<?php
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
include_once 'config/database.php';
include_once 'models/buy_order.php';
include_once 'models/object_.php';
include_once 'models/user.php';

if($_SERVER['REQUEST_METHOD'] == "POST") {
    if(isset($_POST['user_id']) && !empty($_POST['user_id']) && is_numeric($_POST['user_id'])) {
        if(isset($_POST['object_id']) && !empty($_POST['object_id']) && is_numeric($_POST['object_id'])) {
            if(isset($_POST['value']) && !empty($_POST['value']) && is_numeric($_POST['value'])) {

                $database = new Database();
                $db = $database->getConnection();
                
                $buyOrderObject = new BuyOrder($db);
                $objectObject = new Object_($db);
                $userObject = new User($db);

                $object = $objectObject->readOne($_POST['object_id']);
                $numObject = $object->rowCount();
                
                if($numObject == 1) {

                    $user = $userObject->readOne($_POST['user_id']);
                    $numUser = $user->rowCount();
                    
                    if($numUser == 1) {
                        $nbRow = $buyOrderObject->readOne($_POST['user_id'], $_POST['object_id']);
                        $nbRow = $nbRow->rowCount();

                        if($nbRow == 0) {
                            $object = $object->fetchAll(PDO::FETCH_ASSOC);

                            if($object[0]['lower_price'] < $_POST['value']) {

                                $stmt = $buyOrderObject->add($_POST['user_id'], $_POST['object_id'], $_POST['value']);

                                if($stmt) {

                                    $results['message'] = "The order buy has been posted.";

                                    http_response_code(200);

                                    echo json_encode($results);
                                } else {

                                    http_response_code(404);
                        
                                    echo json_encode(
                                        array("message" => "The order buy hasn't been posted.")
                                    );
                                }

                            } else {
                                http_response_code(404);
                        
                                echo json_encode(
                                    array("message" => "The buy order value is lower or equal to the lower price.")
                                );
                            }

                        } else {
                            http_response_code(404);
                    
                            echo json_encode(
                                array("message" => "The user has already place a buy order on this object.")
                            );
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
                        array("message" => "No object found with this id.")
                    );
                }
            } else {
                http_response_code(404);
                
                echo json_encode(
                    array("message" => "The parameter 'value' is missing, empty or not a decimal value.")
                );
            }
        } else {
            http_response_code(404);
            
            echo json_encode(
                array("message" => "The parameter 'object_id' is missing, empty or not a integer value.")
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