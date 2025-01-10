<?php
include 'connect/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['hero_image'])) {
    $uploadDir = 'img/'; 
    $fileName = basename($_FILES['hero_image']['name']);
    $uploadFilePath = $uploadDir . $fileName;

    
    if (move_uploaded_file($_FILES['hero_image']['tmp_name'], $uploadFilePath)) {
        
        $query = "SELECT image_path FROM hero_section WHERE id = 1 LIMIT 1";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        if ($row && file_exists($row['image_path'])) {
            unlink($row['image_path']);
        }

        
        $query = "UPDATE hero_section SET image_path = '$uploadFilePath' WHERE id = 1";
        mysqli_query($conn, $query);

        echo "<script>alert('Image uploaded successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Failed to upload the image!'); window.location.href='index.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request!'); window.location.href='index.php';</script>";
}
?>
