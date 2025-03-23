<?php
$server = "localhost";  
$username = "root";        
$password = "";             
$dbname = "kelpreviews";    

// Create connection
$connection = new mysqli($server, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>
