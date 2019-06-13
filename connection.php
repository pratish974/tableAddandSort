<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "test";
$conn = new mysqli($servername, $username, $password, $db);
// Create connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

 
 ?>