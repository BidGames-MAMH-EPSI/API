<?php
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
include_once 'config/database.php';
include_once 'models/user.php';

if(isset($_GET['user_id']) && !empty($_GET['user_id']) && is_numeric($_GET['user_id'])) {

    $database = new Database();
    $db = $database->getConnection();
    
    $user = new User($db);
    
    $stmt = $user->readOne($_GET['user_id']);
    $num = $stmt->rowCount();
    
    if($num==1) {
    
        $results=array();
        $results["results"]=array();

        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $results['results'] = $user[0];
    
        http_response_code(200);

        echo json_encode($results);
    } else {
        http_response_code(404);
    
        echo json_encode(
            array("message" => "No user found.")
        );
    }

} else {
    http_response_code(404);
    
    echo json_encode(
        array("message" => "The parameter 'user_id' is missing.")
    );
}