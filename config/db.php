<?php
// Database connection settings
$host = "localhost";
$dbName = "edancy";
$username = "root";
$password = "";

// Establish database connection
try {
    $db = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    // Set PDO attributes or perform other initialization steps
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    // Handle the connection error gracefully
}
