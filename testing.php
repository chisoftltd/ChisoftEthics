<?php
/**
 * Created by PhpStorm.
 * User: Chisoft
 * Date: 2017-08-05
 * Time: 22:35
 */

session_start();
/*
if (!isset($_SESSION['usr_id'])) {
    header("Location: index.php");
    echo "''<h1>.Timed Out!.</h1>";
}*/

include_once 'dbconnect.php';

//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['applyform'])) {
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $supervisor = mysqli_real_escape_string($link, $_POST['supervisor']);
    $department = mysqli_real_escape_string($link, $_POST['department']);
    $projecttopic = mysqli_real_escape_string($link, $_POST['projecttopic']);
    $projectdescription = mysqli_real_escape_string($link, $_POST['projectdescription']);
    $startdate = mysqli_real_escape_string($link, $_POST['startdate']);
    $enddate = mysqli_real_escape_string($link, $_POST['enddate']);
    $datadetails = mysqli_real_escape_string($link, $_POST['datadetails']);

    if (mysqli_query($link, "INSERT INTO research(name,supervisor,department, projecttopic, projectdescription, startdate, enddate, datadetails ) 
VALUES('" . $name . "', '" . $supervisor . "', '" . $department . "','" . $projecttopic . "','" . $projectdescription . "','" . $startdate . "','" . $enddate . "','" . $datadetails . "')")) {
        $successmsg = "Research Ethics Successfuly Registered!";
        header("refresh:5; url=researchtable.php");
    } else {
        $errormsg = "Error in registering...Please try again later!";
    }
}

$result2 = mysqli_query($link, "SELECT id, name, supervisor, projecttopic, startdate, enddate FROM research") or die('cannot show columns from research');
$count = mysqli_num_rows($result2);

// Check if delete button active, start this
if (isset($_POST['deleteform'])) {
    for ($i = 0; $i < $count; $i++) {
        $del_id = $checkbox[$i];
        $sql = "DELETE FROM research WHERE id='$del_id'";
        $result3 = mysqli_query($link, $sql);
    }
// if successful redirect to delete_multiple.php
    if ($result3) {
        echo "Record deleted successfully";
        header("refresh:5; url=officerprojecttable.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>RGUEthics | Research Registration</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main-style.css">
</head>
<body>
<header>
    <!-- add top navigational bar using bootstrap-->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navweboil">
                    <!--<span class="sr-only">Toggle navigation</span>-->
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/index.php">WebOil | Assessment</a>
            </div>
            <div class="collapse navbar-collapse" id="navweboil">
                <ul class="nav navbar-nav navbar-right">
                    <!-- check if same user is still same as the active session user and load appropriate menu options -->
                    <?php if (isset($_SESSION['usr_id'])) { ?>
                        <li><a href="signinindex.php">Home</a></>
                        <li><a href="/menu/about.php">About Us</a></li>
                        <li><a href="/menu/courses.php">Courses</a></li>
                        <li class="active"><a href="/menu/assessment.php">Assessment</a></li>
                        <li><a href="/menu/submission.php">Submission</a></li>
                        <li><a href="/menu/demo.php">Demo</a></li>
                        <li><a href="/menu/contact.php">Contact Us</a></li>
                        <li><a href="/menu/help.php">Help</a></li>
                        <li><p class="navbar-text"><span
                                        class="glyphicon glyphicon-user">Signed in as <?php echo $_SESSION['usr_name']; ?>
                            </p></li>
                        <li><a href="/index.php"><span class="glyphicon glyphicon-log-out">Log Out</a></li>
                        <form class="navbar-form navbar-right">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    <?php } else { ?>
                        <li><a href="/index.php">Home</a></>
                        <li><a href="/menu/about.php">About Us</a></li>
                        <li><a href="/menu/courses.php">Courses</a></li>
                        <li class="active"><a href="/menu/assessment.php">Assessment</a></li>
                        <li><a href="/menu/submission.php">Submission</a></li>
                        <li><a href="/menu/demo.php">Demo</a></li>
                        <li><a href="/menu/contact.php">Contact Us</a></li>
                        <li><a href="/menu/help.php">Help</a></li>
                        <li><a href="/menu/login.php"><span class="glyphicon glyphicon-log-in">Login</a></li>
                        <li><a href="/menu/register.php"><span class="glyphicon glyphicon-user"></span>Register</a></li>
                        <form class="navbar-form navbar-right">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

</header>
<form>
    <hr> <!-- draw a line-->
</form>
<section>
    <div class="container">

        <h3 style="text-align: center">WebOil Assessments</h3>
        <p>Test youself</p>
        <div>
            <hr>
        </div>
        <div style="width: 100%" class="btn-group">
            <div class="row">
                <button onclick="document.getElementById('drilling').style.display='block'" style="width: 30%;">
                    Drilling
                </button>
                <button onclick="document.getElementById('control').style.display='block'" style="width: 30%">
                    Well Control
                </button>
                <button onclick="document.getElementById('completion').style.display='block'" style="width: 30%;">
                    Well Completion
                </button>
                <button onclick="document.getElementById('treatment').style.display='block'" style="width: 30%;">
                    Oil & Gas Treatment
                </button>
                <button onclick="document.getElementById('cement').style.display='block'" style="width: 30%">
                    Well Cementing
                </button>
                <button onclick="document.getElementById('storageandexport').style.display='block'" style="width: 30%;">
                    Storage and Export
                </button>
            </div>
        </div>
        <div>
            <hr>
        </div>
        <div id="apply" class="modal">

            <!-- <form class="modal-content animate" action="/action_page.php">
                 <div class="imgcontainer">
                             <span onclick="document.getElementById('apply').style.display='none'" class="close"
                                   title="Close Modal">&times;</span>
                     <!-- <img src="img_avatar2.png" alt="Avatar" class="avatar">
                 </div> -->

            <div class="row">
                <div class="col-md-8 col-md-offset-2 well">
                    <form role="form" class="modal-content animate" action="<?php echo $_SERVER['PHP_SELF']; ?>"
                          method="post"
                          name="ethicsform">
                        <div class="imgcontainer">
                        <span onclick="document.getElementById('apply').style.display='none'" class="close"
                              title="Close Modal">&times;</span>
                            <!-- <img src="img_avatar2.png" alt="Avatar" class="avatar">-->
                        </div>
                        <fieldset>
                            <legend style="text-align: center">Drilling Quiz</legend>
                            <ol>
                                <li>
                                    <h5>CSS Stands for...</h5>
                                    <div class="form-group">
                                        <div>
                                            <input type="radio" name="question-1-answers" id="question-1-answers-A"
                                                   value="A"/>
                                            <label for="question-1-answers-A">A) Computer Styled Sections </label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div>
                                            <input type="radio" name="question-1-answers" id="question-1-answers-B"
                                                   value="B"/>
                                            <label for="question-1-answers-B">B) Cascading Style Sheets</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div>
                                            <input type="radio" name="question-1-answers" id="question-1-answers-C"
                                                   value="C"/>
                                            <label for="question-1-answers-C">C) Crazy Solid Shapes</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div>
                                            <input type="radio" name="question-1-answers" id="question-1-answers-D"
                                                   value="D"/>
                                            <label for="question-1-answers-D">D) None of the above</label>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <h5>Internet Explorer 6 was released in...</h5>
                                    <div class="form-group">
                                        <input type="radio" name="question-2-answers" id="question-2-answers-A"
                                               value="A"/>
                                        <label for="question-2-answers-A">A) 2001</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="radio" name="question-2-answers" id="question-2-answers-B"
                                               value="B"/>
                                        <label for="question-2-answers-B">B) 1998</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="radio" name="question-2-answers" id="question-2-answers-C"
                                               value="C"/>
                                        <label for="question-2-answers-C">C) 2006</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="radio" name="question-2-answers" id="question-2-answers-D"
                                               value="D"/>
                                        <label for="question-2-answers-D">D) 2003</label>
                                    </div>
                                </li>
                                <li>
                                    <h5>SEO Stand for...</h5>
                                    <div class="form-group">
                                        <input type="radio" name="question-3-answers" id="question-3-answers-A"
                                               value="A"/>
                                        <label for="question-3-answers-A">A) Secret Enterprise
                                            Organizations</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" name="question-3-answers" id="question-3-answers-B"
                                               value="B"/>
                                        <label for="question-3-answers-B">B) Special Endowment
                                            Opportunity</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" name="question-3-answers" id="question-3-answers-C"
                                               value="C"/>
                                        <label for="question-3-answers-C">C) Search Engine Optimization</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" name="question-3-answers" id="question-3-answers-D"
                                               value="D"/>
                                        <label for="question-3-answers-D">D) Seals End Olives</label>
                                    </div>
                                </li>
                                <li>
                                    <h5>A 404 Error...</h5>

                                    <div class="form-group">
                                        <input type="radio" name="question-4-answers" id="question-4-answers-A"
                                               value="A"/>
                                        <label for="question-4-answers-A">A) is an HTTP Status Code meaning Page
                                            Not Found</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" name="question-4-answers" id="question-4-answers-B"
                                               value="B"/>
                                        <label for="question-4-answers-B">B) is a good excuse for a clever
                                            design</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" name="question-4-answers" id="question-4-answers-C"
                                               value="C"/>
                                        <label for="question-4-answers-C">C) should be monitored for in web
                                            analytics</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" name="question-4-answers" id="question-4-answers-D"
                                               value="D"/>
                                        <label for="question-4-answers-D">D) All of the above</label>
                                    </div>
                                </li>

                                <li>
                                    <h5>Your favorite website is</h5>

                                    <div class="form-group">
                                        <input type="radio" name="question-5-answers" id="question-5-answers-A"
                                               value="A"/>
                                        <label for="question-5-answers-A">A) CSS-Tricks</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="radio" name="question-5-answers" id="question-5-answers-B"
                                               value="B"/>
                                        <label for="question-5-answers-B">B) CSS-Tricks</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="radio" name="question-5-answers" id="question-5-answers-C"
                                               value="C"/>
                                        <label for="question-5-answers-C">C) CSS-Tricks</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="radio" name="question-5-answers" id="question-5-answers-D"
                                               value="D"/>
                                        <label for="question-5-answers-D">D) CSS-Tricks</label>
                                    </div>

                                </li>

                            </ol>
                            <input type="submit" value="Submit Quiz"/>
                        </fieldset>
                    </form>

                </div>
            </div>
            <!--</form>-->
        </div>


        <div id="update" class="modal">

            <!-- <form class="modal-content animate" action="/action_page.php">
                <div class="imgcontainer">
                            <span onclick="document.getElementById('update').style.display='none'" class="close"
                                  title="Close Modal">&times;</span>
                    <!-- <img src="img_avatar2.png" alt="Avatar" class="avatar">
                </div> -->

            <div class="row">
                <div class="col-md-10 col-md-offset-1 well">
                    <form role="form" class="modal-content animate" action="<?php echo $_SERVER['PHP_SELF']; ?>"
                          method="post"
                          name="updateform">
                        <div class="imgcontainer">
                        <span onclick="document.getElementById('update').style.display='none'" class="close"
                              title="Close Modal">&times;</span>
                            <!-- <img src="img_avatar2.png" alt="Avatar" class="avatar">-->
                        </div>
                        <fieldset>
                            <legend style="text-align: center">Ethics Update Form</legend>

                            <?php
                            include_once "dbconnect.php";

                            echo '<h3 style="text-align: center">', RESEARCH_ETHICS, '</h3>';
                            //$result2 = mysqli_query($link, "SELECT id, name, supervisor, projecttopic, startdate, enddate FROM research") or die('cannot show columns from research');
                            //$count = mysqli_num_rows($result2);
                            if (mysqli_num_rows($result2)) {
                                echo '<table cellpadding="0" cellspacing="0" class="table table-striped">';
                                echo '<tr><th>Project ID</th><th>Researcher Name</th><th>Supervisor</th><th>Project Topic</th><th>Start Date<th>End Date</th></tr>';
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
                            ?>

                        </fieldset>
                    </form>
                </div>
            </div>

        </div>
        <div id="delete" class="modal">

            <!--<form class="modal-content animate" action="/action_page.php">
                <div class="imgcontainer">
                        <span onclick="document.getElementById('delete').style.display='none'" class="close"
                              title="Close Modal">&times;</span>
                    <!-- <img src="img_avatar2.png" alt="Avatar" class="avatar">
                </div>-->

            <div class="row">
                <div class="col-md-10 col-md-offset-1 well">
                    <form role="form" class="modal-content animate" action="<?php echo $_SERVER['PHP_SELF']; ?>"
                          method="post"
                          name="deleteform">
                        <div class="imgcontainer">
                        <span onclick="document.getElementById('delete').style.display='none'" class="close"
                              title="Close Modal">&times;</span>
                            <!-- <img src="img_avatar2.png" alt="Avatar" class="avatar">-->
                        </div>
                        <fieldset>
                            <legend style="text-align: center">Ethics Delete Form</legend>

                            <?php
                            include_once "dbconnect.php";

                            echo '<h3 style="text-align: center">', RESEARCH_ETHICS, '</h3>';
                            $result2 = mysqli_query($link, "SELECT id, name, supervisor, projecttopic, startdate, enddate FROM research") or die('cannot show columns from research');
                            $count = mysqli_num_rows($result2);
                            if (mysqli_num_rows($result2)) {
                                echo '<table cellpadding="0" cellspacing="0" class="table table-striped">';
                                echo '<tr><th>Check to Delete</th><th>Project ID</th><th>Researcher Name</th><th>Supervisor</th><th>Project Topic</th><th>Start Date<th>End Date</th></tr>';
                                while ($row2 = mysqli_fetch_array($result2)) {
                                    echo '<tr>';
                                    echo "<td>" . "<input name='checkbox[]' type='checkbox' id='checkbox[]' value= '<?php echo $row2[id]; ?>'>" . "</td>";
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
                            ?>
                            <div class="form-group">
                                <input type="submit" style="text-align: center; width: 30%" name="deleteform"
                                       value="Delete"
                                       class="btn btn-primary center-block"/>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <script>
            // Get the modal
            var modal = document.getElementById('apply');
            var modal = document.getElementById('update');
            var modal = document.getElementById('delete');

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>
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