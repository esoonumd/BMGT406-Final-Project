<?php
include_once('support.php');
include_once('connect_database.php');
//connect_database.php contains your connection/creation of a PDO to connect to your MYSQL db on bmgt406.rhsmith.umd.edu/phpmyadmin
ini_set("display_errors","1");
error_reporting(E_ALL);

// Initialize $title and $body.
$title = "Sign up Confirmation";
$body = "<fieldset class=\"card-body border border-secondary\" ><legend> $title </legend><div class=\"container\">";

// Initialize default name of the table ($name_of_table)
$name_of_table = "signups";
$email = $_GET["email"];
$gameID = $_GET["gameID"];

// Check if the table exists in the db.
if (tableExists($db, $name_of_table)) { 

	// Prepare a SQL query
	$sqlQuery = "INSERT INTO $name_of_table (gameID, email)
				   VALUES (:gameID, :email)";
		$statement1 = $db->prepare($sqlQuery);
		$statement1->bindValue(':gameID', $gameID, PDO::PARAM_STR);
		$statement1->bindValue(':email', $email, PDO::PARAM_STR);

	// Execute the SQL query using $statement1->execute(); and assign the value
	// that is returned  to $result.
	$result = $statement1->execute();
	
	if(!$result) {
		// Query fails.
		$body .= "Inserting entry for $email failed.</br>";
	} else {
		// Query is successful.
		$body .= "$email has been successfully signed up for GameID:#$gameID.</br>";
	}
} else {
// Table does not exist in db.
	$body .= "Table $name_of_table does not exist in database</br>";
}

$body .= "<br/><a href=\"index.html\"><input type=\"submit\" value = \"Main Menu\"/></a>";
$body .= "</fieldset>";
echo generatePage($title,$body);
?>
