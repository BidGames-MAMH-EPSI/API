<?php
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'config/database.php';
include_once 'models/object_.php';
include_once 'models/user.php';
include_once 'models/flash_sale.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['user_id']) && !empty($_POST['user_id']) && is_numeric($_POST['user_id'])) {
        if (isset($_POST['object_id']) && !empty($_POST['object_id']) && is_numeric($_POST['object_id'])) {
            if (isset($_POST['value']) && !empty($_POST['value']) && is_numeric($_POST['value'])) {

                $database = new Database();
                $db = $database->getConnection();

                $flashSaleObject = new FlashSale($db);
                $objectObject = new Object_($db);
                $userObject = new User($db);

                $object = $objectObject->readOne($_POST['object_id']);
                $numObject = $object->rowCount();


                if ($numObject == 1) {

                    $user = $userObject->readOne($_POST['user_id']);
                    $numUser = $user->rowCount();

                    if ($numUser == 1) {

                        $countFlashSaleWithUserAndObject = $flashSaleObject->readOne($_POST['object_id'], $_POST['user_id']);
                        $countFlashSaleWithUserAndObject = $countFlashSaleWithUserAndObject->rowCount();

                        if ($countFlashSaleWithUserAndObject == 0) {

                            $object = $object->fetchAll(PDO::FETCH_ASSOC);

                            if ($_POST['value'] > $object[0]['lower_price']) {

                                $flashSaleObject->add($_POST['user_id'], $_POST['object_id'], $_POST['value'], 0);

                                http_response_code(200);
                                echo json_encode(array("message" => "Bien joué mon con !"));
                            } else {
                                http_response_code(404);

                                echo json_encode(
                                    array("message" => "You cannot ask an object for its lower price.")
                                );
                            }
                        } else {

                            http_response_code(404);

                            echo json_encode(
                                array("message" => "Demand already made by the user.")
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
}