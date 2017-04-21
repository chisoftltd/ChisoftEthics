<?php
/**
 * Created by PhpStorm.
 * User: 1609963
 * Date: 21/04/2017
 * Time: 18:01
 */
session_start();

if (!isset($_SESSION['usr_id'])) {
    header("Location: index.php");
    echo "''<h1>.Timed Out!.</h1>";
}

include_once 'dbconnect.php';

//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['signup'])) {
    echo "I am here 0";
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $supervisor = mysqli_real_escape_string($link, $_POST['supervisor']);
    $department = mysqli_real_escape_string($link, $_POST['department']);
    $projectopic = mysqli_real_escape_string($link, $_POST['projectopic']);
    $projectdescription = mysqli_real_escape_string($link, $_POST['projectdescription']);
    $startdate = mysqli_real_escape_string($link, $_POST['startdate']);
    $enddate = mysqli_real_escape_string($link, $_POST['enddate']);
    $datadetails = mysqli_real_escape_string($link, $_POST['datadetails']);

    //name can contain only alpha characters and space
    /*if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
        $error = true;
        $name_error = "Student Name must contain only alphabets and space";
    }

    if (!preg_match("/^[a-zA-Z ]+$/", $supervisor)) {
        $error = true;
        $supervisor_error = "Supervisor Name must contain only alphabets and space";
    }

    if (!preg_match("/^[a-zA-Z 0-9]+$/", $department)) {
        $error = true;
        $department_error = "Department must contain only numbers alphabets special characters and space";
    }

    if (!preg_match("/^[[a-zA-Z][0-9]] +$/", $projectopic)) {
        $error = true;
        $projectopic_error = "Porject Toipc must contain only numbers alphabets special characters and space";
    }

    if (!preg_match("/^[a-zA-Z0-9]+$/", $projectdescription)) {
        $error = true;
        $projectdescription_error = "Project Description must contain only numbers alphabets special characters and space";
    }

    if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $startdate)) {
        $error = true;
        $startdate_error = "Date must contain only numbers, - and format 0000-00-00.";
    }

    if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $enddate)) {
        $error = true;
        $enddate_error = "Date must contain only numbers, - and format 0000-00-00.";
    }
    if (!preg_match("/^[a-zA-Z0-9]+$/", $datadetails)) {
        $error = true;
        $datadetails_error = "Data details must contain only numbers, alphabets '-'.";
    }*/
echo "I am here 1";
    //if (!$error) {
        echo "I am here 2";
        if (mysqli_query($link, "INSERT INTO research(name,supervisor,department, projecttopic, projectdescription, startdate, enddate, datadetails ) 
VALUES('" . $name . "', '" . $supervisor . "', '" . $department . "','" . $projectopic . "','" . $projectdescription . "','" . $startdate . "','" . $enddate . "','" . $datadetails . "')")) {
            echo "I am here 3";
            $successmsg = "Research Ethics Successfuly Registered!";
            header("refresh:5; url=researchtable.php");
        } else {
            $errormsg = "Error in registering...Please try again later!";
        }
   // }
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
    <div class="row">
        <div class="col-md-4 col-md-offset-4 well">
            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="ethicsform">
                <fieldset>
                    <legend>Ethics Register Form</legend>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" placeholder="Enter Full Name" required
                               value="<?php if ($error) echo $name; ?>" class="form-control"/>
                        <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="name">Supervisor</label>
                        <input type="text" name="supervisor" placeholder="Supervisor" required
                               value="<?php if ($error) echo $supervisor; ?>" class="form-control"/>
                        <span class="text-danger"><?php if (isset($supervisor_error)) echo $supervisor_error; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="name">Department</label>
                        <input type="text" name="department" placeholder="Department" required class="form-control"/>
                        <span class="text-danger"><?php if (isset($department_error)) echo $department_error; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="name">Project Topic</label>
                        <input type="text" name="projecttopic" placeholder="Project Topic" required
                               class="form-control"/>
                        <span
                            class="text-danger"><?php if (isset($projecttopic_error)) echo $projecttopic_error; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="name">Project Description</label>
                        <textarea name="projectdescription" rows="20" cols="auto"
                                  placeholder="Provide a brief outline of the aims and objectives of the proposed research project."
                                  required class="form-control"></textarea>
                        <span
                            class="text-danger"><?php if (isset($projectdescription_error)) echo $projectdescription_error; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="name">Start Date</label>
                        <input type="date" name="startdate" placeholder="Start Date" required class="form-control"/>
                        <span class="text-danger"><?php if (isset($startdate_error)) echo $startdate_error; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="name">End Date (Deadline)</label>
                        <input type="date" name="enddate" placeholder="End Date (deadline)" required
                               class="form-control"/>
                        <span class="text-danger"><?php if (isset($enddate_error)) echo $enddate_error; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="name">Data Details</label>
                        <textarea style="text-align: left" name="datadetails" rows="20" cols="auto" placeholder="Describe how you will store your data, who will have access to it, and what happens to the data at the end of the project. Also how you will maintain the confidentiality of the research data collected. Also, describe how you will ensure that research participants are anonymised in your data analysis." required
                                  class="form-control"></textarea>
                        <span
                            class="text-danger"><?php if (isset($datadetails_error)) echo $datadetails_error; ?></span>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="signup" value="Register" class="btn btn-primary"/>
                    </div>
                </fieldset>
            </form>
            <span class="text-success"><?php if (isset($successmsg)) {
                    echo $successmsg;
                } ?></span>
            <span class="text-danger"><?php if (isset($errormsg)) {
                    echo $errormsg;
                } ?></span>
        </div>
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