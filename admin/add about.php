<?php
$servername = "localhost";
$username = "root";
$password = "diru1234";
$dbname = "canteen";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$head = $_POST['head'];
$about = $_POST['about'];


$image1 = $image2 = $image3 = $image4 = null;


$targetDir = "";


if (isset($_FILES['image1']) && $_FILES['image1']['error'] == UPLOAD_ERR_OK) {
    $image1Name = basename($_FILES['image1']['name']);
    $image1Path = $targetDir . $image1Name;
    if (move_uploaded_file($_FILES['image1']['tmp_name'], $image1Path)) {
        $image1 = $image1Path;
    }
}


if (isset($_FILES['image2']) && $_FILES['image2']['error'] == UPLOAD_ERR_OK) {
    $image2Name = basename($_FILES['image2']['name']);
    $image2Path = $targetDir . $image2Name;
    if (move_uploaded_file($_FILES['image2']['tmp_name'], $image2Path)) {
        $image2 = $image2Path;
    }
}


if (isset($_FILES['image3']) && $_FILES['image3']['error'] == UPLOAD_ERR_OK) {
    $image3Name = basename($_FILES['image3']['name']);
    $image3Path = $targetDir . $image3Name;
    if (move_uploaded_file($_FILES['image3']['tmp_name'], $image3Path)) {
        $image3 = $image3Path;
    }
}


if (isset($_FILES['image4']) && $_FILES['image4']['error'] == UPLOAD_ERR_OK) {
    $image4Name = basename($_FILES['image4']['name']);
    $image4Path = $targetDir . $image4Name;
    if (move_uploaded_file($_FILES['image4']['tmp_name'], $image4Path)) {
        $image4 = $image4Path;
    }
}


$sql = "INSERT INTO about_us (head, about, image1, image2, image3, image4) 
        VALUES ('$head', '$about', '$image1', '$image2', '$image3', '$image4')";

if ($conn->query($sql) === TRUE) {
   
    header("Location: About us management.php");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();
?>
