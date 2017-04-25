<?php
/**
 * Created by PhpStorm.
 * User: 1609963
 * Date: 21/04/2017
 * Time: 18:45
 */

session_start();

if (!isset($_SESSION['usr_id'])) {
    header("Location: index.php");
    echo "''<h1>.Timed Out!.</h1>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>RGUEthics | Researcher Database</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main-style.css">
</head>
<body>

<header>
    <?php if (isset($_SESSION['usr_id'])) { ?>
        <?php include 'include/signinheader.php'; ?>

    <?php } else { ?>
        <?php include 'include/header.php'; ?><?php } ?>
</header>
<form>
    <hr>
</form>
<div class="container">

    <?php
    include_once "dbconnect.php";

        echo '<h3>', RESEARCH, '</h3>';
        $result2 = mysqli_query($link, "SELECT id, name, supervisor, projecttopic, startdate, enddate FROM research") or die('cannot show columns from research' );
        $count = mysqli_num_rows($result2);
        if (mysqli_num_rows($result2)) {
            echo '<table cellpadding="0" cellspacing="0" class="table table-striped">';
            echo '<tr><th>Project ID</th><th>Researcher Name</th><th>Supervisor</th><th>Project Topic</th><th>Start Date<th>End Date</th></tr>';
            while ($row2 = mysqli_fetch_array($result2)) {
                echo '<tr>';
                echo "<td>" . $row2[id] . "</td>";
                echo "<td>" . $row2[name] . "</td>";
                echo "<td>" . $row2[supervisor] . "</td>";
                echo "<td><a href='projdetails.php?p={$row2['id']}'> " . $row2[projecttopic] . "</a></td>";
                echo "<td>" . $row2[startdate] . "</td>";
                echo "<td>" . $row2[enddate] . "</td>";
                echo "</tr>";
            }
            echo '</table><br />';
    }
    ?>
</div>
<footer>
    <?php include 'include/footer.php'; ?>
</footer>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
