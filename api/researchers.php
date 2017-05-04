<?php
/**
 * Created by PhpStorm.
 * User: 1609963
 * Date: 04/05/2017
 * Time: 18:51
 */

// Report all PHP errors (see changelog)
error_reporting(E_ALL);
ini_set('display_errors', 'On');

include_once '../dbconnect.php'; // include database connection script

$request_type = $_SERVER["REQUEST_METHOD"];
$urlInfo = explode("/", substr($_SERVER['REQUEST_URL'], 11));

// Use SWITCH case to implement the appropiate REQUEST METHOD
switch ($request_type) {
    case 'GET': // GET case
        if (!isset($_GET["researchers"])) {
            get_researcher();
        } else {
            get_id_researcher($_GET['researchers']);
        }
        break;
    case 'POST': // POST case
        if (count($urlInfo) > 1) {
            insert_researcher($urlInfo);
        } else {
            header("HTTP/1.0 400 Bad Reguest");
            echo json_encode($reply[0] = "Parameters must be greater than 1");
        }
        break;

    case 'PUT': //PUT case
        update_researcher($urlInfo);
        break;

    case 'DELETE':
        //DELETE case
        delete_researcher($urlInfo);
        break;

    default:

        header("HTTP/1.0 405 Method Not Allowed");
}

function get_id_researcher($reseacher)
{
    //select case statement
    $query = "SELECT id, name, email, date FROM researchers where id = '$reseacher'";
    $reply = array();

    $result = mysqli_query($link, $query);
}