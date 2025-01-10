<?php
$servername = "localhost";
$username = "root"; 
$password = "diru1234"; 
$dbname = "canteen";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
