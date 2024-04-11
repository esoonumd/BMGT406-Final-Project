<?php


include_once('support.php');
//connect_database.php contains your connection/creation of a PDO to connect to your MYSQL db on bmgt406.rhsmith.umd.edu/phpmyadmin
include_once('connect_database.php');
ini_set("display_errors","1");
error_reporting(E_ALL);

// Initialize $title and $body.
$title = "Welcome an Existing User";
$body = "<fieldset class=\"card-body border border-secondary\"><legend> $title </legend>";

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ProcessLoginUsers.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>UMCP Event Signup</title>
    <link type="text/css" href='css/layout.css' rel="stylesheet">
    <link rel="shortcut icon" href="images/umd.jpeg" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body class="container">
    <!-- #header -->
    <header class="container">
        
    </header>
    <!-- /#header -->

    <!-- #navigation -->
    <div class="row">
    <div class = "col">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active"><a class="nav-link" href="http://www.umd.edu" title="UMCP" rel="home">UMCP</a></li>
                <li class="nav-item active"><a class="nav-link" href="./InsertUsers.html" title="Insert Users" rel="IU">Insert Users</a></li>
                <li class="nav-item active"><a class="nav-link" href="./InsertEvents.html" title="Insert Events" rel="IE">Insert Events</a></li>

            </ul>
        </div>
    </nav>
    </div>
    </div>
    <!-- /#navigation -->

    <!-- OK so type - same, label = for -->

    <!-- #content -->
    <article class="container">
        <legend>UMCP Event Creation and Signup</legend>
            <div class="container">
                <div class="row">
                    <img style="border-style: double;" src="images/UMDAdministration.jpg" width="400" height="200" alt="UMDAdministration Img" />
                </div>
                <div class="row">
                    <div class = "col-8">
                    <a href="InsertUsers.html"><input type="submit" class="btn btn-primary" name="InsertUsers" value="Register a User" /></a>

                    <a href="ProcessLoginUsers.php"><input type="submit" class="btn btn-primary" name="LoginUsers" value="Login an Existing User" /></a>

                    <a href="ProcessLogout.php"><input type="submit" class="btn btn-primary" name="LogoutUsers" value="Logout" /></a>

                    <a href="ProcessListUsers.php"><input type="submit" class="btn btn-secondary" name="ListUsers" value="List Users" /></a>

                    <a href="ProcessAddFriends.php"><input type="submit" class="btn btn-secondary" name="AddFriends" value="Add Friends" /></a>

                    <a href="InsertEvents.html"><input type="submit" class="btn btn-success" name="InsertEvents" value="Add an Event" /></a>

                    <a href="ProcessListEvents.php"><input type="submit" class="btn btn-danger" name="ListEvents" value="List Events" /></a>

                    <a href="SignupEvents.php"><input type="submit" class="btn btn-warning" name="event" value="Sign up For an Event" /></a>

                    <a href="ProcessListSignups.php"><input type="submit" class="btn btn-info" name="ListSignups" value="List Signups" /></a>

                    <a href="SignupEvents2.php"><input type="submit" class="btn btn-dark" name="event2" value="(Alt) Sign up For an Event" /></a>

                    <a href="googleMapsAll.html"><input type="submit" class="btn btn-info" name="mapRequest" value="All Locations" /></a>  

                    <a href="ChooseLocationDisplayMap_simple.php"><input type="submit" class="btn btn-warning" name="DisplayOneLoc" value="One Location" /></a> 

                    <a href="ChooseLocationType.html"><input type="submit" class="btn btn-warning" name="Choose Location Type" value="Choose Location Type" /></a>
                    </div>
                </div>
            </div>
            
        
    </article>


    <!-- #footer -->
    <footer>

        <div id="fb-like">

            <iframe src="https://www.facebook.com/plugins/like.php?href=http://www.umiacs.umd.edu/~louiqa/2016/BMGT406/" style="border:none; width:450px; height:80px"></iframe>

        </div>
    </footer>
    <!-- /#footer -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>