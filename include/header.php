<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<header>
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="signinindex.php">Home | RGUEthics System</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar1">
                <ul class="nav navbar-nav navbar-right">
                    <?php if (isset($_SESSION['usr_id'])) { ?>
                        <li class="active"><a href="signinindex.php">Home</a></li>
                        <li> <a href="researcher.php">Researcher</a></li>
                        <li> <a href="officerprojecttable.php">Ethics Approval Officers (EAO)</a></li>
                        <li><a href="administrator.php">Administrator</a></li>
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
    <div id="logo">
        <a href="index.php" style="top: auto"><img src="images/RGUEthics.png" alt="Company logo" /></a>
    </div>
    <nav>
        <ul class="header-links">
            <li> <a href="index.php">Home</a></li>
            <li> <a href="about.php">About Us</a></li>
            <li> <a href="contact.php">Contact</a></li>
            <li> <a href="login.php">Login</a></li>
            <li><a href="registerresearcher.php">Register Researcher</a></li>
        </ul>
    </nav>
</header>