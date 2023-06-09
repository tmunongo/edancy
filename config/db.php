<?php
// Database connection settings
$host = "localhost";
$dbName = "your_database_name";
$username = "your_username";
$password = "your_password";

// Establish database connection
$conn = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
