<?php

// local host configuration

//     $dsn = 'mysql:host=localhost;dbname=myDB';
//     $username = 'root';
//     $password = '';

// bmgt406 server configuration

    $dsn = 'mysql:host=bmgt406.rhsmith.umd.edu;dbname=bmgt406_16_db';
    $username = 'bmgt406_16';
    $password = 'bmgt406_16';


// Use PDO - PHP Data Object class - to open a connection to the database.
// $db will point to a new instance of the PDO class that is connected 
// to the database and server specified by the chosen configuration.

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('connect_database_error.php');
        exit();
    }
?>
