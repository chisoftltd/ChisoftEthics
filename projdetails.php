<?php
/**
 * Created by PhpStorm.
 * User: 1609963
 * Date: 21/04/2017
 * Time: 19:24
 */
ob_start();
session_start();
require_once 'dbconnect.php';

if (!isset($_SESSION['usr_id'])) {
    header("Location: index.php");
    echo "''<h1>.Timed Out!.</h1>";
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    echo "I am here 0";
    $id = $_GET['p'];
    $query = "SELECT * FROM research WHERE id =" . $id;
    echo $query;
    $result = mysqli_query($link, $query);
    //echo $result;
    $row = mysqli_fetch_array($result);
    //echo $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>RGUEthics | Research Ethics Database</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main-style.css">
</head>
<body>

<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Research Ethics Database</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="nav navbar-nav navbar-right">
                <?php if (isset($_SESSION['usr_id'])) { ?>
                    <li class="active"><a href="signinindex.php">Home</a></li>
                    <li><a href="student.php">Student</a></li>
                    <li><a href="eao.php">Experiment Approval Officers (EAO)</a></li>
                    <li><p class="navbar-text">Signed in as <?php echo $_SESSION['usr_name']; ?></p></li>
                    <li><a href="logout.php">Log Out</a></li>
                <?php } else { ?>
                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
<header>
    <?php include 'include/signinheader.php'; ?>
</header>

<div class="container">

    <h3>Student Number: <?php echo $row['id']; ?></h3>
    <h3>Student Name: <?php echo $row['name']; ?></h3>
    <h3>Project Supervisor: <?php echo $row["supervisor"]; ?></h3>
    <h3>Department: <?php echo $row['department']; ?></h3>
    <h3>Project Topice: <?php echo $row['projecttopic']; ?></h3>
    <h3>Project Description.: <?php echo $row['projectdescription']; ?></h3>
    <h3>Start Date: <?php echo $row['startdate']; ?></h3>
    <h3>Deadline: <?php echo $row['enddate']; ?></h3>
    <h3>Data Handling details: <?php echo $row['datadetails']; ?></h3>

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
