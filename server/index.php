<?php
include_once "managers/spotManager.php";

$spot = new Spot();
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

// manier 2, de url gebruiken om de request aan te geven, en alle request te maken zoals ze horen.
// echo $BASE_URL . 'spot/get_amount_free';
// var_dump( $BASE_URL . 'spot/get_amount_free' == $request);
switch ($request) {
    case $BASE_URL . '':
        echo "Home";
        break;
    case $BASE_URL . '/':
        echo "Home";
        break;
    case $BASE_URL . 'spot/get_all':
        echo "get All!";
        break;
    case $BASE_URL . 'spot/get_amount_free':
        var_dump($spot->getAmountFreeFromGarage(1));
        break;
    case $BASE_URL . 'spot/get_free_spaces':
        # code...
        break;
    case $BASE_URL . 'spot/set_space_occupied_state':
        var_dump($spot->setSpaceOccupiedState($_POST['id'],$_POST['verdieping'],$_POST['status']));
        break;
    default:
        http_response_code(404);
        break;
}
