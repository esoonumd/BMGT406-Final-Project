<?php
include_once('support.php');
//connect_database.php contains your connection/creation of a PDO to connect to your MYSQL db on bmgt406.rhsmith.umd.edu/phpmyadmin
include_once('connect_database.php');
ini_set("display_errors","1");
error_reporting(E_ALL);

// Initialize $title and $body.
$title = "Add User";
$body = "<fieldset><legend> $title </legend>";

// Initialize variables with values for the name of the table ($name_of_table)
// and the 6 fields - firstname, lastname, address, email, password and plan.
$name_of_table = "player";
$inputfirstname =$_GET["firstname"];
$inputlastname =  $_GET["lastname"];
$email = $_GET["email"];
$emailConfirmation = $_GET["emailConfirmation"];

// Check if the table exists in the db.
if (tableExists($db, $name_of_table)) {

	if($email == $emailConfirmation){
		// Prepare a SQL query and bind all 6 variables. 
		$sqlQuery = "INSERT INTO $name_of_table (firstname, lastname, email)
				   VALUES (:firstname, :lastname, :email)";
		$statement1 = $db->prepare($sqlQuery);
		$statement1->bindValue(':firstname', $inputfirstname, PDO::PARAM_STR);
		$statement1->bindValue(':lastname', $inputlastname, PDO::PARAM_STR);
		$statement1->bindValue(':email', $email, PDO::PARAM_STR);
	
		// Execute the SQL query using $statement1->execute(); and assign the value
		// that is returned  to $result.
		$result = $statement1->execute();

		if(!$result) {
			// Query fails.
			$body .= "Inserting entry for $email failed.</br>";
		} else {
			// Query is successful.
			$body .= "The entry for $email has been successfully added to the table $name_of_table in the database.</br>";
		}
	
		// Closing query connection
			$statement1->closeCursor();	
	} else {
		$body .= "Email input does not match.</br>";
	}
} else {
// Table does not exist in db.
	$body .= "Table $name_of_table does not exist in database</br>";
}

$body .= "<br/><a href=\"index.html\"><input type=\"submit\" value = \"Main Menu\"/></a>";
$body .= "</fieldset>";
echo generatePage($title,$body);
?>
