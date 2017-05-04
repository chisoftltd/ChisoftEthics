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
    global $datab;
    //select case statement
    $query = "SELECT id, name, email, date FROM researchers where id = '$reseacher'";
    $reply = array();

    $result = mysqli_query($datab, $query);
    trigger_error($datab, E_USER_WARNING);

    if (mysqli_num_rows($query)) {
        while ($row = mysqli_fetch_assoc($query)) {
            $col1["Researcher ID"] = $row['id'];
            $col1['Name'] = $row['name'];
            $col1['Email'] = $row['email'];
            $col1['Date'] = $row['date'];

            $reply[] = $col1;

            header('Content Type: application/json');
            echo json_encode($reply);
        }
    } else {
        header("HTTP/1.0 204 No Content Found");
    }
}

function get_researcher()
{
    global $datab;
    //select case statement
    $query = "SELECT id, name, email, date FROM researchers";
    $reply = array();

    $result = mysqli_query($datab, $query);
    trigger_error($datab, E_USER_WARNING);

    if (mysqli_num_rows($query)) {
        while ($row = mysqli_fetch_assoc($query)) {
            $col1["Researcher ID"] = $row['id'];
            $col1['Name'] = $row['name'];
            $col1['Email'] = $row['email'];
            $col1['Date'] = $row['date'];

            $reply[] = $col1;

            header('Content Type: application/json');
            echo json_encode($reply);
        }
    } else {
        header("HTTP/1.0 204 No Content Found");
    }
}

function insert_researcher($researcher)
{
    global $datab;
    $password = generate();
    $pwd = "";

    for ($i = 0; $i < count($password); $i) {
        $pwd .= $password[rand(0, (count($password) - 1))];
    }

    $researcherid = $researcher[0];
    $researchername = $researcher[1];
    $researcheremail = $researcher[2];
    $researcherdate = new DateTime();

    $query = "insert into researcher(id, name, email, password, date) VALUES ('$researcherid', '$researchername', '$researcheremail', '$pwd', '$researcherdate')";

    $reply = array();
    $result = mysqli_query($datab, $query);

    if (mysqli_affected_rows($result) > 0) {
        header("HTTP/1.0 201 Created Successfully");
        echo json_encode($reply[0] = "researcher registered");
    } else {
        header("HTTP/1.0 409 Conflicting, Researcher ID Exists");
        echo json_encode($reply[0] = "Researcher Exist, Please check the Researcher ID and try again");
    }
}

function delete_researcher($researcher){
    global $datab;
    foreach ($researcher as $value) {

        $query = "delete from researcher where id='$value'";
        $result = mysqli_query($datab,$query) or die(trigger_error($datab, E_USER_WARNING));
        mysqli_free_result($result);
    }

    $response = array();
    if (mysqli_affected_rows($result) > 0) {
        header("HTTP/1.0 201 Deleted Successfully");
        echo json_encode($response[0]="Deleted successfully");
    } else {
        header("HTTP/1.0 204 No Content Found");

    }
}