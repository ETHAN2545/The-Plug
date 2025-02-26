<?php
$servername = "localhost";  // Keep this as 'localhost' (Apache is on 8080 but MySQL is different)
$username = "root";  // Default for XAMPP
$password = "";  // Leave blank if no password is set
$dbname = "theplug_db";  // Your database name
$port = 3307;  // Use your MySQL port number

// Create connection with port specified
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully to theplug_db on port 3307!";
?>
