	<?php
include_once('support.php');
include_once('connect_database.php');
//connect_database.php contains your connection/creation of a PDO to connect to your MYSQL db on bmgt406.rhsmith.umd.edu/phpmyadmin
ini_set("display_errors","1");
error_reporting(E_ALL);

// Initialize $title and $body.
$title = "Sign up for a Game";
$body = "<fieldset class=\"card-body border border-secondary\" ><legend> $title </legend><div class=\"container\">";

// Initialize default name of the table ($name_of_table)
$name_of_table = "games";

// Check if the table exists in the db.
if (tableExists($db, $name_of_table)) { 

	// Prepare a SQL query
	$sqlQuery ="SELECT *
	FROM games g 
	WHERE g.gameid NOT IN( 
    SELECT g.gameid 
    FROM games g, signups s 
    WHERE g.gameid = s.gameid 
    GROUP BY g.eventname, g.maxplayers 
    HAVING g.maxplayers = count(s.gameid))";
	$statement1= $db->prepare($sqlQuery);

	// Execute the SQL query using $statement1->execute(); and assign the value
	// that is returned  to $result.
	$result = $statement1->execute();

	if (!$result) {
		// Query fails.
		$body = "Retrieving records failed." .$db->errorInfo();
	} else {
		// Query is successful.
		// Convert sqlQuery result to an array and store it in $numberOfRows using $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
		$numberOfRows = $statement1->fetchAll(PDO::FETCH_ASSOC);
		$body .="<legend>Game Event Information</legend><table class=\"table table-bordered\">";
		$body .="<tr><th>Game ID</th><th>Game Name</th><th># of Max Players</th><th>Game Date</th><th>Sign Up</th></tr>";

		$body .= "<form id=\"signup\" action=\"SignupEvents2.php\" method=\"get\">";
			
		if($numberOfRows) {
			foreach($numberOfRows as $resultRow) {
			// Using a foreach loop to iterate through each row of events that is returned.
			// Display the event information (eventID, eventName, eventDesc)
				$body .= "<input type=\"hidden\" value=\"{$resultRow['gameID']}\" name=\"gameID\">";
				$body .= "<tr><td>{$resultRow['gameID']}</td>";
				$body .= "<input type=\"hidden\" value=\"{$resultRow['eventName']}\" name=\"eventName\">";
				$body .= "<td>{$resultRow['eventName']}</td>";
				$body .= "<input type=\"hidden\" value=\"{$resultRow['maxPlayers']}\" name=\"maxPlayers\">";
				$body .= "<td>{$resultRow['maxPlayers']}</td>";
				$body .= "<input type=\"hidden\" value=\"{$resultRow['eventDate']}\" name=\"eventDate\">";
				$body .= "<td>{$resultRow['eventDate']}</td>";
				$body .= "<td><input type=\"text\" name=\"email\"> </td>";

				$body .= "<td><input type=\"submit\" name=\"signUpForEvent\" value=\"Sign Up\" </td></tr>";
			}
			$body .="</form></table><br/>";
			$body .= "<a href=\"index.html\"><input type=\"submit\" value = \"Main Menu\"/></a>";
			
		} else {
			// Nothing is returned from the SQL query
			$body = "No results.";
		}
	}

	// Closing query connection
	$statement1->closeCursor();	
} else {
	// Table does not exist in db.
	$body = "Table does not exist";
}


$body.= "</div></fieldset>";

echo generatePage($title,$body);

?>
