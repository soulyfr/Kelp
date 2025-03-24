<?php
// $server = "localhost";  
// $username = "root";        
// $password = "";             
// $dbname = "kelpreviews";    

$server = getenv("DB_HOST");
$username = getenv("DB_USER");
$password = getenv("DB_PASSWORD");
$dbName = getenv("DB_NAME");

// Create connection
$connection = new mysqli($server, $username, $password, $dbName);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    service VARCHAR(100) NOT NULL,
    title VARCHAR(255) NOT NULL,
    user VARCHAR(100) NOT NULL,
    text TEXT NOT NULL,
    category VARCHAR(100) NOT NULL,
    stars INT NOT NULL CHECK (stars BETWEEN 1 AND 5),
    image VARCHAR(255) NULL
)";

if ($connection->query($sql) === TRUE) {
    echo "Table 'reviews' created successfully.";
} else {
    echo "Error creating table: " . $connection->error;
}

?>