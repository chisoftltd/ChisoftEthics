<?php
/**
 * Created by PhpStorm.
 * User: Chisoft
 * Date: 2017-05-02
 * Time: 15:02
 */
// Start a session
ob_start();
session_start();

// include the database script
require_once 'dbconnect.php';
// Return to home page if user not same
if (!isset($_SESSION['usr_id'])) {
    header("Location: index.php");
    echo "''<h1>.Wrong User!.</h1>";
}

$select = mysqli_query($link, 'select * from students');
$rows = array();

while ($row=mysqli_fetch_array($select)){
    $row[] = $row;
}

echo json_encode($row);

?>