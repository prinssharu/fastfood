<?php
$servername = "localhost";
$username = "root";
$password = "diru1234";
$dbname = "canteen";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$id = $_GET['id'];


$sql = "DELETE FROM contact_us WHERE id = $id";


if ($conn->query($sql) === TRUE) {
    
    header("Location: contact us management.php");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();
?>
