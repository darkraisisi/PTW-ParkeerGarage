<?php
include_once "managers/spotManager.php";

$spot = new Spot();
$BASE_URL = "/PTW-parkeergarage/server/";
$request = $_SERVER['REQUEST_URI'];
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
switch ($request) {
    case $BASE_URL . '':
        require __DIR__ . '/index.php';
        break;
    case $BASE_URL . '/':
        require __DIR__ . '/index.php';
        break;
    case $BASE_URL . 'spot/get_all':
        # code...
        break;
    case $BASE_URL . 'spot/get_amount_free':
        $spot->getAmountFree();
        break;
    case $BASE_URL . 'spot/get_free_spaces':
        # code...
        break;
    case $BASE_URL . 'spot/set_space_occupied_state':
        # code...
        break;
    default:
        http_response_code(404);
        break;
}
