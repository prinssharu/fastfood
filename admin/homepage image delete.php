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
    $id = intval($_GET['id']); 

    
    $fetchSql = "SELECT image_path FROM homepage_images WHERE id = ?";
    $stmt = $conn->prepare($fetchSql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($imagePath);
    $stmt->fetch();
    $stmt->close();

    if ($imagePath && file_exists($imagePath)) {
       
        unlink($imagePath);
    }

    
    $deleteSql = "DELETE FROM homepage_images WHERE id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("i", $id);

    
    if ($stmt->execute()) {
        
        header("Location: homepage image.php");
        exit;
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    
    $stmt->close();
} else {
    echo "Invalid ID provided.";
}


$conn->close();
?>
