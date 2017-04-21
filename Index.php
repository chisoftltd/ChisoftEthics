<?php
/**
 * Created by PhpStorm.
 * User: 1609963
 * Date: 21/04/2017
 * Time: 16:19
 */
session_start();
include_once 'Dbconnect.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home | RGUEthics System</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
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
            <a class="navbar-brand" href="Index.php">Research Ethics and Integrity System</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="nav navbar-nav navbar-right">
                <?php if (isset($_SESSION['usr_id'])) { ?>
                    <li><p class="navbar-text">Signed in as <?php echo $_SESSION['usr_name']; ?></p></li>
                    <li><a href="Logout.php">Log Out</a></li>
                <?php } else { ?>
                    <li class="active"><a href="Index.php"></a></li>
                    <li><a href="About.php">About Us</a></li>
                    <li><a href="Contact.php">Contact</a></li>
                    <li><a href="Login.php">Login</a></li>
                    <li><a href="Register.php">Sign Up</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
<header>
    <?php include 'include/Header.php'; ?>
</header>
<div class="pageContent">
    <nav class="nav">
        <ul>
            <li><a href="Index.php">Home</a></li>
            <br>
            <li><a href="About.php">About Us</a></li>
            <br>
            <li><a href="Contact.php">Contact</a></li>
            <br>
            <li><a href="Login.php">Login</a></li>
            <br>
        </ul>
    </nav>
    <article class="article">
        <h2>Research Ethics and Integrity System</h2>
        <p>A Full Research Ethics and Integrity Assessment is required before, during and maybe after a research
            project. Most research institution and centers are
            commitment to promote and facilitate the conduct of research ethics and integrity.</p>
        <h3>Purpose of Ethical Standards</h3>
        <p>In line with acceptable police and framework, RGU attaches great importance to addressing the ethical
            implications of all research activities
            carried out by its members, be they undergraduates, postgraduates or academic members of staff.
            Attention to the ethical and legal implications of research for researchers, research subjects, sponsors and
            collaborators is an intrinsic
            part of good research <a
                href="http://www.ed.ac.uk/geosciences/intranet/working-in-school/other-important-information/ethicsinresearch">practice.</a>
        </p>
        <p>You need to assess whether your project needs an ethical submission. This can be done by completing the RESSA
            form and based on the outcome decide whether an application is needed.</p>
        <p><a class="more"
              href="http://www.rgu.ac.uk/download.cfm?downloadfile=5E84DCA0-2BEB-11E1-8D06000D609CAA9F&typename=dmFile&fieldname=filename">Student
                and Supervisor Appraisal (RESSA) Form</a></p>
        <h3>Assessment of Research Ethics is very important expecially when the following groups are involved:</h3>
        <ul>
            <li>vulnerable human subjects (e.g. children, people with cognitive disabilities and so on)
            </li>
            <br>
            <li>invasive procedures or addressing sensitive issues (e.g. video-taping without informed consent,
                questions about sexuality or about criminal<br> behaviour)
            </li>
            <br>
            <li>biophysical research which requires extraordinary permission from landowners, involves significant
                disturbance to vulnerable species or habitats,<br> sampling rare/endangered or harmful taxa/species,
                and/or transporting samples/specimens between countries or significant ‘boundaries’.
            </li>
            <br>
        </ul>

    </article>
</div>
<footer>
    <?php include 'include/Footer.php'; ?>
</footer>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>