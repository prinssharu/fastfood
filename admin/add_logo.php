<?php
$servername = "localhost";
$username = "root";
$password = "diru1234";
$dbname = "canteen";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


    $icon = $_POST['icon'];
    $name = $_POST['name'];
    $image = null;

    
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $imageName = basename($_FILES['image']['name']);
        $targetDir = "";
        $targetFilePath = $targetDir .$imageName;
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            $image = $imageName;
        }
    }

    $sql = "INSERT INTO logo (icon, name, image) VALUES ('$icon', '$name', '$image')";
    if ($conn->query($sql) === TRUE) {
        header("Location: logo.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
   
?>
