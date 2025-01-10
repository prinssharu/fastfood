<?php
$servername = "localhost";
$username = "root"; 
$password = "diru1234"; 
$dbname = "canteen";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $message_id = intval($_GET['id']);

  
    $query = "DELETE FROM contact_form WHERE message_id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $message_id);
        if ($stmt->execute()) {
            header("Location: admin_messages.php?message=Message deleted successfully.");
        } else {
            header("Location: admin_messages.php?error=Failed to delete the message.");
        }
        $stmt->close();
    } else {
        header("Location: admin_messages.php?error=Failed to prepare query.");
    }
} else {
    header("Location: admin_messages.php?error=Invalid message ID.");
}

$conn->close();
exit();
?>
