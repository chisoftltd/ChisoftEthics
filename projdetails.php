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
    $id = $_GET['p'];
    $query = "SELECT * FROM research WHERE id =" . $id;
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);
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
    <div>
        <hr>
    </div>
    <h4>Research Number:</h4> <?php echo $row['id']; ?>
    <div>
        <hr>
    </div>
    <h4>Student Name: </h4><?php echo $row['name']; ?>
    <div>
        <hr>
    </div>
    <h4>Project Supervisor: </h4><?php echo $row["supervisor"]; ?>
    <div>
        <hr>
    </div>
    <h4>Department: </h4><?php echo $row['department']; ?>
    <div>
        <hr>
    </div>
    <h4>Project Topice: </h4><?php echo $row['projecttopic']; ?>
    <div>
        <hr>
    </div>
    <h4>Project Description: </h4><?php echo $row['projectdescription']; ?>
    <div>
        <hr>
    </div>
    <h4>Start Date: </h4><?php echo $row['startdate']; ?>
    <div>
        <hr>
    </div>
    <h4>Deadline: </h4><?php echo $row['enddate']; ?>
    <div>
        <hr>
    </div>
    <h4>Data Handling details: </h4><?php echo $row['datadetails']; ?>
    <div>
        <hr>
    </div>
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
