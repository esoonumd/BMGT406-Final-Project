<?php
include_once("connect_database.php");
include_once("support.php");
ini_set("display_errors","1");
error_reporting(E_ALL);

header("Content-type: text/xml; charset=utf-8");
// Start XML file, create parent node
$doc = new DOMDocument("1.0");
$node = $doc->createElement("markers");
$parnode = $doc->appendChild($node);
$name_of_table = "markers";

if (tableExists($db, $name_of_table)) {

    // Prepare a SQL. 
    $sqlQuery = "SELECT * FROM $name_of_table";
    $statement1 = $db->prepare($sqlQuery);

    // echo($sqlQuery);
    $result = $statement1->execute();
    if (!$result) {
        // Query fails.
        $body = 'Invalid query';
        die($body);
    } else {
        // Query is successful.
        $numberOfRows = $statement1->fetchAll(PDO::FETCH_ASSOC);

        if($numberOfRows) {
            foreach($numberOfRows as $row) {
                // Add to XML document node
                $node = $doc->createElement("marker");
                $newnode = $parnode->appendChild($node);
                $newnode->setAttribute("id",$row['id']);
                $newnode->setAttribute("name",$row['name']);
                $newnode->setAttribute("address", $row['address']);
                $newnode->setAttribute("lat", $row['lat']);
                $newnode->setAttribute("lng", $row['lng']);
                $newnode->setAttribute("type", $row['type']);
            }
        } else {
            // Invalid table name and nothing is returned from the SQL query
            $body = "Table does not exist";
            die($body);
        }
    }

    // Closing query connection
    $statement1->closeCursor();

} else { // Table does not exist in db.
    $body = "Table $name_of_table does not exist in database";
    die ($body);
}
// $node = $doc->createElement("marker");
// $newnode = $parnode->appendChild($node);
// $newnode->setAttribute("id",1);
// $newnode->setAttribute("name",1);
// $newnode->setAttribute("address",1);
// $newnode->setAttribute("lat",1);
// $newnode->setAttribute("lng",1);
// $newnode->setAttribute("type",1);
$xmlfile = $doc->saveXML();
echo $xmlfile;
?>
