<?php
$hostname = "localhost";
$username = "root";        
$password = "";            
$dbname = "cardeno_mid"; 


$conn = new mysqli($hostname, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
