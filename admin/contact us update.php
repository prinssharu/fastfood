<?php

$servername = "localhost";
$username = "root";
$password = "diru1234";
$dbname = "canteen";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $id = isset($_POST['id']) ? $_POST['id'] : null; 
    $head = $_POST['head'];
    $booking = $_POST['booking'];
    $general = $_POST['general'];
    $technical = $_POST['technical'];
    $googlemap = $_POST['googlemap'];

    if (empty($head) || empty($booking) || empty($general) || empty($technical) || empty($googlemap)) {
        echo "All fields are required.";
        exit;
    }

    if ($id) {
        
        $query = "UPDATE contact_us SET head = ?, booking = ?, general = ?, technical = ?, googlemap = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssssi', $head, $booking, $general, $technical, $googlemap, $id);
    } else {
        
        $query = "INSERT INTO contact_us (head, booking, general, technical, googlemap) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssss', $head, $booking, $general, $technical, $googlemap);
    }

    
    if ($stmt->execute()) {
        header("Location: contact us management.php"); 
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    
    $stmt->close();
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    $id = isset($_GET['id']) ? $_GET['id'] : 1;

    $query = "SELECT googlemap FROM contact_us WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($googleMapLink);
    $stmt->fetch();
    $stmt->close();
}

$conn->close();
?>

