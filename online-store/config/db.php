<?php
$servername = "localhost"; // Change if your database is hosted elsewhere
$username = "root"; // Change this if using a different MySQL user
$password = ""; // Change if you have set a password
$database = "onlinestore"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
