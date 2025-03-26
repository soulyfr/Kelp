<?php
// $server = "localhost";  
// $username = "root";        
// $password = "";             
// $dbName = "kelpreviews";    

$server = getenv("DB_HOST");
$username = getenv("DB_USER");
$password = getenv("DB_PASSWORD");
$dbName = getenv("DB_NAME");

$connection = new mysqli($server, $username, $password, $dbName);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// $sql_users = "
// CREATE TABLE IF NOT EXISTS users (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     username VARCHAR(255) NOT NULL UNIQUE,
//     password VARCHAR(255) NOT NULL
// )";

// if ($connection->query($sql_users) === FALSE) {
//     echo "Error creating users table: " . $connection->error;
// }

// $sql_reviews_auth = "
// CREATE TABLE IF NOT EXISTS reviews_auth (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     user_id INT NOT NULL,
//     service VARCHAR(100) NOT NULL,
//     title VARCHAR(255) NOT NULL,
//     user VARCHAR(100) NOT NULL,
//     text TEXT NOT NULL,
//     category VARCHAR(100) NOT NULL,
//     stars INT NOT NULL CHECK (stars BETWEEN 1 AND 5),
//     image VARCHAR(255) NULL,
//     FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
// )";

// if ($connection->query($sql_reviews_auth) === FALSE) {
//     echo "Error creating reviews_auth table: " . $connection->error;
// }
?>