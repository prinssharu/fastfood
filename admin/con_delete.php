<?php
$servername = "localhost";
$username = "root";
$password = "diru1234";
$dbname = "canteen";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

   
    $stmt = $conn->prepare("DELETE FROM contact_form WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
       
        header("Location: admin_contact.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid ID.";
}

$conn->close();
?>
