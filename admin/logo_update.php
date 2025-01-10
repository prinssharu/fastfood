<?php

$servername = "localhost";
$username = "root"; 
$password = "diru1234"; 
$dbname = "canteen"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$id = $_POST['id'];
$icon = $_POST['icon'];
$name = $_POST['name'];


$query = "UPDATE logo SET icon = ?, name = ? WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('ssi', $icon, $name, $id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    header("Location: logo.php");
} else {
    echo "No changes made or update failed.";
}

$stmt->close();
$conn->close();
?>
