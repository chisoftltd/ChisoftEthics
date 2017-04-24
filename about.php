<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// it will never let you open index(login) page if session is set
/*
if (isset($_SESSION['user']) != "") {
    header("Location: login.php");
    exit;
}

$error = false;

if (isset($_POST['btn-login'])) {

    // prevent sql injections/ clear user invalid inputs
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);
    // prevent sql injections / clear user invalid inputs

    if (empty($email)) {
        $error = true;
        $emailError = "Please enter your email address.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address.";
    }

    if (empty($pass)) {
        $error = true;
        $passError = "Please enter your password.";
    }

    // if there's no error, continue to login
    if (!$error) {

        $password = hash('sha256', $pass); // password hashing using SHA256

        $res = mysqli_query($link, ("SELECT userId, userName, userPass FROM users WHERE userEmail='$email'"));
        $row = mysqli_fetch_array($res);
        $count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row

        if ($count == 1 && $row['userPass'] == $password) {
            $_SESSION['user'] = $row['userId'];
            header("Location: login.php");
        } else {
            $errMSG = "Incorrect Credentials, Try again...";
        }
    }
}*/
?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>RGUEthics | About Us</title>
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
                <a class="navbar-brand" href="about.php">RGUEthics | About Us</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar1">
                <ul class="nav navbar-nav navbar-right">
                    <?php if (isset($_SESSION['usr_id'])) { ?>
                        <li><a href="signinindex.php">Home</a></li>
                        <li><a href="researcher.php">Researchers</a></li>
                        <li class="active"><a href="about.php">About Us</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="officerprojecttable.php">Ethics Approval Officers (EAO)</a></li>
                        <li><p class="navbar-text">Signed in as <?php echo $_SESSION['usr_name']; ?></p></li>
                        <li><a href="logout.php">Log Out</a></li>
                    <?php } else { ?>
                        <li><a href="index.php">Home</a></li>
                        <li class="active"><a href="about.php">About Us</a></li>
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
        <h3>Web Application Description - RGUEthics</h3>
        <p>
            This web application which I called RGUEthics is an online application that will manage RGU researcher’s
            experiment ethics. </p>
        <p>The interface should have a logo, navigation bar with elements like “Home”, “About Us”, “Researcher”,
            “Ethics Approval Officers (EAO)”, “Contact US” and “Login”. </p>
        <p>The interface should have a “News Section” about current government and university policy on research
            ethics. </p>
        <p>The landing page should contain a summary of, a least five, ongoing Ethics. Also present on the
            interface is are logos to Social media platforms like Facebook etc. </p>
        <p>The application will allow researchers, after authentication to seek approval for their propose experiment from
            EAO. EAOs should be able to approve, request additional information or reject an experiment proposal. </p>
        <p>To implement fairness and objectivity each experiment will be randomly assign to two different EAOs, by an
            Administrator.
        </p>
        <p>Furthermore, the application will allow researchers and staff to submit assessment of EAO and the EAOs in turn
            will also have same permission for the Administrators.
        </p>

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
<?php ob_end_flush(); ?>