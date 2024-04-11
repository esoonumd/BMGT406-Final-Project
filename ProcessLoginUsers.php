<?php
include_once('support.php');
//connect_database.php contains your connection/creation of a PDO to connect to your MYSQL db on bmgt406.rhsmith.umd.edu/phpmyadmin
include_once('connect_database.php');
ini_set("display_errors","1");
error_reporting(E_ALL);

// Initialize $title and $body.
$title = "Login an Existing User";
$body = "<fieldset class=\"card-body border border-secondary\"><legend> $title </legend>";

// Initialize the session
session_start();
 
// If the user is already logged in then redirect to the Welcome page and exit script.
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: Welcome.php");
    exit;
}

if (isset($_POST["email"]))
{
// Check non-empty email
if (empty(trim($_POST["email"]))){
        $useremail_err = "Please enter user email.";
        $body .= "Please enter user email";
        $_SESSION["loggedin"] = false;
    } else 
    	{
    	// MISSING !!!! MUST VALIDATE USER IN THE DATABASE
    	$_SESSION["loggedin"] = true;
        $_SESSION["email"] = trim($_POST["email"]);
       	header("location: Welcome.php");
    	exit;
    }
}

$body .= "<br/><a href=\"index.html\"><input type=\"submit\" value = \"Main Menu\"/></a>";
$body .= "</fieldset>";
// echo generatePage($title,$body);
?>

<!DOCTYPE html>
<html>
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
	<nav class="navbar navbar-expand-md navbar-dark bg-dark">
		<div class="collapse navbar-collapse" id="navbarsExampleDefault">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active"><a class="nav-link" href="http://www.umd.edu" title="UMCP" rel="home">UMCP</a></li>
				<li class="nav-item active"><a class="nav-link" href="./InsertUsers.html" title="Insert Users" rel="IU">Insert Users</a></li>
				<li class="nav-item active"><a class="nav-link" href="./InsertEvents.html" title="Insert Events" rel="IE">Insert Events</a></li>
			</ul>
		</div>
	</nav>
	   <article class="container">
	   		<div class="article-border">
				<form id="wholeForm" action="ProcessLoginUsers.php" method="POST">
					<fieldset>
						<legend><em>User Information</em></legend>
						<label for="email">Email: </label><input type="text" name="email" id="email" size="63"/><br/><br/>
						<label for="password">Password: </label><input type="password" name="password" id="password" size="20"/><br/><br/>
				</fieldset>
				<input type="reset"/>
				<input type="submit" value="Login an Existing User"/>
				</fieldset>
			</form>
			</div>
		</article>
	<footer>
  		<div class="footer-text">
    		© 2016 
    	<a href="#">Smith School</a>. 
    		All Rights Reserved.
    	<br />
  	</div>
  	<div id="badges">
    <!-- #html5-css3 logo -->
    <div id="html5-icon">
      <a href="http://www.w3.org/html/logo/" target="_blank">
        <img src="./images/html5-css3-logo.png" width="133" height="64" alt=
        "HTML5 image&#39;" />
      </a>
  	</div>
  	<!-- #facebook like button -->
  	<div id="fb-like">
      <iframe src="https://www.facebook.com/plugins/like.php?href=http://www.umiacs.umd.edu/~louiqa/2016/BMGT406/" style="border:none; width:450px; height:80px"></iframe>
  	</div>
	</footer>
</body>	
</html>
