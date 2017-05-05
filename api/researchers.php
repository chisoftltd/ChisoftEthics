<?php
/**
 * Created by PhpStorm.
 * researcher: 1609963
 * Date: 04/05/2017
 * Time: 18:51
 */
//

// Report all PHP errors (see changelog)
error_reporting(E_ALL);
ini_set('display_error', 1);

require_once 'dbconnect.php'; // include database connection script


$urlInfo = explode("/", substr(@$_SERVER['REQUEST_URI'], 21));

//HTTP verb GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $page = $urlInfo[0];
    if ($page == "researchers") {
        $query = "SELECT * FROM researchers";
        $reply = null;
        $iterate = 0;
        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result) > 1) {
            while ($row = mysqli_fetch_assoc($result)) {
                $reply[$iterate] = $row;
                $iterate++;
            }
            //

            //print_r($reply);
            //header('Content Type: application/json');
            echo json_encode($reply);
            header("HTTP/1.0 200 OK");
        }
    } else {
        header("HTTP/1.0 204 No Content Found");
        //get_id_researcher($_GET['researchers']);
    }

    $number = $urlInfo[1];
echo isset($urlInfo[1]);
    if (isset($urlInfo[1]))  {

        $queryID = "SELECT * FROM researchers where id = '$number'";

        //$iterate =0;
        $resultID = mysqli_query($link, $queryID);
        $rowID = mysqli_fetch_assoc($resultID);
        //echo json_encode($rowID);
        header("HTTP/1.0 200 OK");
        echo json_encode($reply[0] = "GET Researcher Successfully");

    } else {
        header("HTTP/1.0 400 Bad Request");
        header("HTTP/1.0 204 No Content Found");
    }

}
//HTTP verb POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (count($urlInfo) > 0) {

        $researcherid = $urlInfo[1];
        $researchername = $urlInfo[2];
        $researcheremail = $urlInfo[3];
        $researcherpwd = $urlInfo[4];

        $queryPost = "insert into researchers(id, name, email, password, date) VALUES ('$researcherid', '$researchername', '$researcheremail', '$researcherpwd', now())";

        $reply = array();
        $resultPost = mysqli_query($link, $queryPost);

        $rowPost = mysqli_fetch_assoc($resultPost);

        //echo json_encode($rowPost);

        if ($resultPost) {
            header("HTTP/1.0 201 Created Successfully");
            echo json_encode($reply[0] = "Researcher registered");
        } else {
            header("HTTP/1.0 409 Conflicting, Researcher ID Exists");
            echo json_encode($reply[0] = "Researcher Exist, Please check the Researcher ID and try again");
        }
    } else {
        header("HTTP/1.0 400 Bad Reguest");
        echo json_encode($reply[0] = "Parameters must be greater than 1");
    }
}

//HTTP verb PUT
if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    $queryPut = "SELECT * FROM researchers";
    $reply = null;

    $resultPut = mysqli_query($link, $queryPut);
    $num_rows = mysqli_num_rows($resultPut);
    if ($num_rows >= $urlInfo[1]) {

        $query = "update researchers set ";

        if (isset($urlInfo[2])) {
            $query .= "name='$urlInfo[2]',";
        }
        if ($urlInfo[3] != "") {
            $query .= "email='$urlInfo[3]',";
        }
        if ($urlInfo[4] != "") {
            $query .= "password='$urlInfo[4]',";
        }
        $query .= "date = now() where id = $urlInfo[1]";

        $result = mysqli_query($link, $query);

        //$rowPut = mysqli_fetch_assoc($result);

        echo json_encode($result);

        if ($result) {
            header("HTTP/1.0 201 Modified Successfully");
            echo json_encode($reply[0] = "Modified Successfully");
        } else {
            header("HTTP/1.0 40, Researcher ID Not found");
        }

    } else {
        header("HTTP/1.0 40, Researcher ID Not found");
    }
}
//HTTP verb DELETE
if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $queryDel = "SELECT * FROM researchers";
    $reply = null;

    $resultDel = mysqli_query($link, $queryDel);
    $num_rows = mysqli_num_rows($resultDel);
    if ($num_rows >= $urlInfo[1]) {

        $query = "DELETE FROM researchers where id = $urlInfo[1]";

        $resultDel = mysqli_query($link, $query);
        //$rowDel = mysqli_fetch_assoc($resultDel);

        echo json_encode($resultDel);


        if ($resultDel) {
            header("HTTP/1.0 201 Deleted Successfully");
            echo json_encode($reply[0] = "Deleted successfully");
        } else {
            header("HTTP/1.0 40, Researcher ID Not found");
        }

    } else {
        header("HTTP/1.0 40, Researcher ID Not found");
    }
}