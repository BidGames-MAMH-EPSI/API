<?php
ini_set('display_errors', 1);
setlocale(LC_TIME, 'fr_FR');
date_default_timezone_set('Europe/Paris');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'config/database.php';
include_once 'models/sale.php';
include_once 'models/house.php';
include_once 'models/user.php';

$database = new Database();
$db = $database->getConnection();

$sale = new Sale($db);

$max = 10;
$page = 1;
$house_id = null;

if (isset($_GET['max']) && is_numeric($_GET['max']) && !empty($_GET['max']) && $_GET['max'] > 0) {
    $max = $_GET['max'];
}
if (isset($_GET['page']) && is_numeric($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0) {
    $page = $_GET['page'];
}
if (isset($_GET['house_id']) && is_numeric($_GET['house_id']) && !empty($_GET['house_id']) && $_GET['house_id'] > 0) {
    $house_id = $_GET['house_id'];
}


$stmt = $sale->findAllSalesWithThemImageByHouseId($max, $page, $house_id);
$num = $stmt->rowCount();

if ($num >= 1) {

    $results = [];
    $results["results"] = [];

    $homeSales = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($homeSales as $homeSale) {
        $houseOfSale = new House($db);
        $houseOfSale = $houseOfSale->readOne($homeSale['house_id']);
        $houseOfSale = $houseOfSale->fetchAll(PDO::FETCH_ASSOC)[0];

        $dateNow = new DateTime('now');
        $saleDate = new DateTime($homeSale['sale_date']);

        $interval = date_diff($dateNow, $saleDate);

        $item = [
            "id" => $homeSale['sale_id'],
            "house" => [
                "name" => $houseOfSale['name'],
                "adress" => $houseOfSale['adress'] . ', ' . $houseOfSale['cp'] . ' ' . $houseOfSale['city']
            ],
            "sale_date" => ucwords(utf8_encode(strftime("%A %d %B", strtotime($homeSale['sale_date'])))),
            "name" => $homeSale['name'],
            "imageInfo" => [
                "image_id" => $homeSale['image_id'],
                "path" => $homeSale['path']
            ],
            "timeRemainBeforeSale" => $interval->format('%aj %Hh %im %ss'),
            "type" => $homeSale['type'],
            "sale_start" => ucwords(utf8_encode(strftime("%A %d %B", strtotime($homeSale['sale_start'])))),
            "sale_end" => ucwords(utf8_encode(strftime("%A %d %B", strtotime($homeSale['sale_end']))))
        ];

        array_push($results["results"], $item);
    }

    http_response_code(200);

    echo json_encode($results);
} else {
    http_response_code(404);

    echo json_encode(
        array("message" => "No homeSales found.")
    );
}