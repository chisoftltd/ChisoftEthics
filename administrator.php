<?php
/**
 * Created by PhpStorm.
 * User: Chisoft
 * Date: 2017-04-22
 * Time: 22:55
 */
ob_start();
session_start();
require_once 'dbconnect.php';

if (!isset($_SESSION['usr_id'])) {
    header("Location: index.php");
    echo "''<h1>.Timed Out!.</h1>";
}

// Check connection
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>RGUEthics | Administrator</title>
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
            <a class="navbar-brand" href="administrator.php">RGUEthics | Administrator</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="nav navbar-nav navbar-right">
                <?php if (isset($_SESSION['usr_id'])) { ?>
                    <li><a href="signinindex.php">Home</a></li>
                    <li><a href="research.php">Researchs</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="officerprojecttable.php">Ethics Approval Officers (EAO)</a></li>
                    <li class="active"><a href="administrator.php">Administrator</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><p class="navbar-text">Signed in as <?php echo $_SESSION['usr_name']; ?></p></li>
                    <li><a href="logout.php">Log Out</a></li>
                <?php } else { ?>
                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="registerresearcher.php">Register Researcher</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
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
    <fieldset>
        <legend style="text-align: center">Research Table</legend>
        <?php
        $sql = "SHOW TABLES FROM localdb LIKE 'research'";
        $result = mysqli_query($link, $sql);

        if (!$result) {
            echo "DB Error, could not list tables\n";
            echo 'MySQL Error: ' . mysqli_error();
            exit;
        }
        while ($row = mysqli_fetch_row($result)) {
                $result2 = mysqli_query($link, "SELECT * FROM research") or die('cannot show columns from research');
                $count = mysqli_num_rows($result2);
                if (mysqli_num_rows($result2)) {
                    echo '<table cellpadding="0" cellspacing="0" class="table table-striped">';
                    echo '<tr><th>Project ID</th><th>Researcher Name</th><th>Supervisor</th><th>Project Topic</th><th>Start Date</th><th>End Date</th></tr>';
                    while ($row2 = mysqli_fetch_array($result2)) {
                        echo '<tr>';
                        echo "<td>" . $row2[id] . "</td>";
                        echo "<td><a href='updatepage.php?p={$row2['id']}'>" . $row2[name] . "</td>";
                        echo "<td>" . $row2[supervisor] . "</td>";
                        echo "<td><a href='updatepage.php?p={$row2['id']}'>" . $row2[projecttopic] . "</a></td>";
                        echo "<td>" . $row2[startdate] . "</td>";
                        echo "<td>" . $row2[enddate] . "</td>";
                        echo "</tr>";
                    }
                    echo '</table><br />';
                }

        }

        ?>
    </fieldset>
    <div>
        <hr>
    </div>
    <fieldset>
        <legend style="text-align: center">Researcher Table</legend>
        <?php
        $sql = "SHOW TABLES FROM localdb LIKE 'students'";
        $result = mysqli_query($link, $sql);

        if (!$result) {
            echo "DB Error, could not list tables\n";
            echo 'MySQL Error: ' . mysqli_error();
            exit;
        }
        while ($row = mysqli_fetch_row($result)) {
            $result2 = mysqli_query($link, "SELECT * FROM students") or die('cannot show columns from research');
            $count = mysqli_num_rows($result2);
            if (mysqli_num_rows($result2)) {
                echo '<table cellpadding="0" cellspacing="0" class="table table-striped">';
                echo '<tr><th>Student ID</th><th>Researcher Name</th><th>Email</th><th>Regstration Date</th></tr>';
                while ($row2 = mysqli_fetch_array($result2)) {
                    echo '<tr>';
                    echo "<td>" . $row2[id] . "</td>";
                    echo "<td><a href='updatepage.php?p={$row2['id']}'>" . $row2[name] . "</td>";
                    echo "<td>" . $row2[email] . "</td>";
                    echo "<td><a href='updatepage.php?p={$row2['id']}'>" . $row2[date] . "</a></td>";
                    echo "</tr>";
                }
                echo '</table><br />';
            }

        }

        ?>
    </fieldset>

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

