<?php
include_once('support.php');
include_once('connect_database.php');
//connect_database.php contains your connection/creation of a PDO to connect to your MYSQL db on bmgt406.rhsmith.umd.edu/phpmyadmin
ini_set("display_errors","1");
error_reporting(E_ALL);

// Initialize $title and $body.
$title = "List Games";
$body = "<fieldset class=\"card-body border border-secondary\"><legend> $title </legend>";

// Initialize variables with values for the name of the table ($name_of_table)
$name_of_table = "games";

// Check if the table exists in the db.
if (tableExists($db, $name_of_table)) { 

	// Prepare a SQL query
	$sqlQuery ="SELECT g.gameID, g.eventName, g.eventDate
	FROM games g, signups s 
	WHERE g.gameid = s.gameid 
	GROUP BY g.eventname, g.maxplayers 
	HAVING g.maxplayers = count(s.gameid)";
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
		$body .="<legend>Full Games</legend><table class=\"table table-bordered\">";
		$body .="<tr><th>Game ID </th><th>Game Name</th><th>Date</th></tr>";
		
		if($numberOfRows) {
			foreach($numberOfRows as $resultRow) {
			// Using a foreach loop to iterate through each row of result that is returned.
			// Display the event information (eventID, eventName, eventDesc)
				$body .= "<tr><td>{$resultRow['gameID']}</td>";
				$body .= "<td>{$resultRow['eventName']}</td>";
				$body .= "<td>{$resultRow['eventDate']}</td>";
			}
			$body .="</table><br/>";
		} else {			
			// Invalid table name and nothing is returned from the SQL query
				$body = "Table does not contain data.";
		}
	}

	// Closing query connection
	$statement1->closeCursor();	

} else {
	// Table does not exist in db.
	$body = "Table does not exist.";
}



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
		$body .="<legend>Avaliable Games</legend><table class=\"table table-bordered\">";
		$body .="<tr><th>Game ID </th><th>Game Name</th><th># of Max Players</th><th>Date</th></tr>";
		
		if($numberOfRows) {
			foreach($numberOfRows as $resultRow) {
			// Using a foreach loop to iterate through each row of result that is returned.
			// Display the event information (eventID, eventName, eventDesc)
				$body .= "<tr><td>{$resultRow['gameID']}</td>";
				$body .= "<td>{$resultRow['eventName']}</td>";
				$body .= "<td>{$resultRow['maxPlayers']}</td>";
				$body .= "<td>{$resultRow['eventDate']}</td>";
			}
					
			$body .="</table><br/>";
			$body .= "<a href=\"index.html\"><input type=\"submit\" value = \"Main Menu\"/></a>";
			
		} else {			
			// Invalid table name and nothing is returned from the SQL query
				$body = "Table does not contain data.";
		}
	}

	// Closing query connection
	$statement1->closeCursor();	

} else {
	// Table does not exist in db.
	$body = "Table does not exist.";
}


















$body.= "</fieldset>";

echo generatePage($title,$body);

?>
