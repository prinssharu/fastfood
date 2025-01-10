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
    
    $id = intval($_POST['id']);
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;

    
    if (!isset($_FILES["image"]) || $_FILES["image"]["error"] != 0) {
        echo "No file selected or an error occurred.";
        $uploadOk = 0;
    }

    
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

   
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    if (!in_array($fileType, $allowedTypes)) {
        echo "Only JPG, JPEG, PNG, and GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($_FILES["image"]["size"] > 5000000) { 
        echo "File is too large.";
        $uploadOk = 0;
    }

    
    if ($uploadOk) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
           
            $sql = "UPDATE homepage_images SET image_path = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("si", $targetFile, $id);

                if ($stmt->execute()) {
                    echo "Image updated successfully!";
                    header("Location: homepage image edit.php?id=$id"); 
                    exit;
                } else {
                    echo "Error updating record: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Failed to prepare the database statement.";
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "File upload validation failed.";
    }
}

$conn->close();
?>
