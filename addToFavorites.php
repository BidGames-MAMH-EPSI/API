<?php
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
include_once 'config/database.php';
include_once 'models/add_favorite.php';
include_once 'models/object_.php';
include_once 'models/user.php';

if($_SERVER['REQUEST_METHOD'] == "POST") {
    if(isset($_POST['user_id']) && !empty($_POST['user_id']) && is_numeric($_POST['user_id'])) {
        if(isset($_POST['object_id']) && !empty($_POST['object_id']) && is_numeric($_POST['object_id'])) {

            $database = new Database();
            $db = $database->getConnection();
            
            $AddFavoriteObject = new Add_favorite($db);
            $objectObject = new Object_($db);
            $userObject = new User($db);

            $object = $objectObject->readOne($_POST['object_id']);
            $numObject = $object->rowCount();
            
            if($numObject == 1) {

                $user = $userObject->readOne($_POST['user_id']);
                $numUser = $user->rowCount();
                
                if($numUser == 1) {

                    $countFavoriteWithUserAndObject = $AddFavoriteObject->readOneByObjectIdAndUserId($_POST['object_id'], $_POST['user_id']);
                    $countFavoriteWithUserAndObject = $countFavoriteWithUserAndObject->rowCount();
            
                    if($countFavoriteWithUserAndObject == 0) {

                        $results = [];

                        $stmt = $AddFavoriteObject->add($_POST['user_id'], $_POST['object_id']);

                        if($stmt) {
                            $results['message'] = "The favorite has been added.";

                            http_response_code(200);

                            echo json_encode($results);
                        } else {
                            $results['message'] = "The favorite has not been added.";

                            http_response_code(404);

                            echo json_encode($results);
                        }
                    } else {
                        $results['message'] = "The user has already been add to his favorites this object.";

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
                    array("message" => "No object found with this id.")
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