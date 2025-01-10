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
    $sql = "DELETE FROM logo WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: logo.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


$conn->close();

?>
