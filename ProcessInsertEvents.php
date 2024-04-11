<?php
include_once('support.php');
//connect_database.php contains your connection/creation of a PDO to connect to your MYSQL db on bmgt406.rhsmith.umd.edu/phpmyadmin
include_once('connect_database.php');
ini_set("display_errors","1");
error_reporting(E_ALL);
// var_dump($_FILES);


// Initialize $title and $body.
$title = "Add Game";
$body = "<fieldset><legend> $title </legend>";

// Initialize variables with values for the name of the table ($name_of_table)
// and the 3 fields - eventName, eventDesc, eventPictureFileName
$name_of_table = "games";
$gameName = $_POST["gameName"];
$maxPlayers = $_POST["maxPlayers"];
$date = $_POST["gameDate"];

// Check if the table exists in the db.
if (tableExists($db, $name_of_table)) {
	// Prepare a SQL query and bind all 3 variables. 
	$sqlQuery = "INSERT INTO $name_of_table (eventName, maxPlayers, eventDate)
	VALUES (:gameName, :maxPlayers, :gameDate)";
	$statement1 = $db->prepare($sqlQuery);
	$statement1->bindValue(':gameName', $gameName, PDO::PARAM_STR);
	$statement1->bindValue(':maxPlayers', $maxPlayers, PDO::PARAM_STR);
	$statement1->bindValue(':gameDate', $date, PDO::PARAM_STR);
	
	// Execute the SQL query using $statement1->execute(); and assign the value
	// that is returned  to $result.
	$result = $statement1->execute();

	if(!$result) {
		// Query fails.
		$body .= "Inserting entry for $eventName failed.</br>";
	} else {
		// Query is successful.
		$body .= "The entry for $gameName has been successfully added to the table $name_of_table in the database.</br>";
	}
	// Closing query connection
	$statement1->closeCursor();	
} else { // Table does not exist in db.
	$body = "Table $name_of_table does not exist in database</br>";
}

$body .= "<br/><a href=\"index.html\"><input type=\"submit\" value = \"Main Menu\"/></a>";
$body .= "</fieldset>";
echo generatePage($title,$body);
?>
