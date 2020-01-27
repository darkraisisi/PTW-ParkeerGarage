<?php
include_once "managers/spotManager.php";

$spot = new Spot();
$SECRET = "6423834HeuEHUADd679ii7e67990YEu";
$BASE_URL = "/ptw/server/";
$request = $_SERVER['REQUEST_URI'];
// var_dump($request);
//manier 1, de functie uit de request halen.

/*
if($_SERVER['REQUEST_METHOD'] === 'POST'){
$params = $_POST["params"];
$function = $_POST["func"];

var_dump($params);
var_dump($function);
}else{
print('No post has been made');
}
 */

//manier 2, de url gebruiken om de request aan te geven, en alle request te maken zoals ze horen.
if(hash("sha256", $_POST["verify_time"].$SECRET) == $_POST["hash"]) {
    switch ($request) {
        case $BASE_URL . '':
            require __DIR__ . '/index.php';
            break;
        case $BASE_URL . '/':
            require __DIR__ . '/index.php';
            break;
        case $BASE_URL . 'spot/get_all_garages':
            echo(json_encode($spot->getParkingGarages()));
            break;
        case $BASE_URL . 'spot/get_all_from_garage':
            echo(json_encode($spot->getAllFromGarage($_POST['garage_id'])));
            break;
        case $BASE_URL . 'spot/get_amount_free_from_garage':
            echo(json_encode($spot->getAmountFreeFromGarage($_POST['garage_id'])));
            break;
        case $BASE_URL . 'spot/get_free_spaces_from_garage':
            echo(json_encode($spot->getFreeSpacesFromGarage($_POST['garage_id'])));
            break;
        case $BASE_URL . 'spot/set_space_occupied_state':
            // echo('set_space_occupied_state');
            echo(json_encode($spot->setSpaceOccupiedState($_POST['garage_id'],$_POST['level_number'],$_POST['spot_number'],$_POST['state'])));
            break;
        default:
            http_response_code(404);
            break;
    }    
} else{
    echo"Not authorised.";
    http_response_code(401);
}

