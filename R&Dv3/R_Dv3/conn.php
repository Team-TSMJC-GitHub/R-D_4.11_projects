
<?php

$servername = "localhost";
$username = "root";
$password = "40458689";
$dbname = "4.11";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>