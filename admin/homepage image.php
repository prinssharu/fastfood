<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page Image Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 60%;
            margin: auto;
            overflow: hidden;
        }
        h1, h2 {
            text-align: center;
            color: red;
        }
        form {
            background: #fff;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px #ccc;
        }
        form label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        form input, form button {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        form button {
            background: #333;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
        form button:hover {
            background: red;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }
        table th {
            background: #333;
            color:red;
        }
        .action-links a {
            margin: 0 5px;
            text-decoration: none;
            color: #333;
        }
        .action-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Home Page Image Management System</h1>
        
        <form method="POST" action="" enctype="multipart/form-data">
            <label for="image">Upload Image:</label>
            <input type="file" id="image" name="image" >
            <button type="submit">Add Image</button>
        </form>

        <h2>Home Page Image List</h2>
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
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
                    
                    if (!empty($_FILES['image']['name'])) {
                        
                        $uploadDir = "uploads/";

                        
                        if (!is_dir($uploadDir)) {
                            mkdir($uploadDir, 0777, true);
                        }

                   
                        $imageName = basename($_FILES['image']['name']);
                        $imagePath = $uploadDir . $imageName;
                        $imageTempPath = $_FILES['image']['tmp_name'];

                        
                        if (move_uploaded_file($imageTempPath, $imagePath)) {
                        
                            $sql = "INSERT INTO homepage_images (image_path) VALUES (?)";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("s", $imagePath);

                           
                            if ($stmt->execute()) {
                                echo "<p style='color:green;text-align:center;'>Image uploaded successfully!</p>";
                            } else {
                                echo "<p style='color:red;text-align:center;'>Error inserting into database: " . $stmt->error . "</p>";
                            }

                            
                            $stmt->close();
                        } else {
                            echo "<p style='color:red;text-align:center;'>Failed to upload the image.</p>";
                        }
                    } else {
                        echo "<p style='color:red;text-align:center;'>No image selected.</p>";
                    }
                }

                

$sql = "SELECT id, image_path FROM homepage_images";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td><img src='" . htmlspecialchars($row['image_path']) . "' alt='Image' style='width: 100px; height: auto;'></td>
                <td class='action-links'>
                    <a href='homepage image edit.php?id=" . $row['id'] . "'>Edit</a>
                    <a href='homepage image delete.php?id=" . $row['id'] . "' onclick=\"return confirm('Are you sure you want to delete this image?')\">Delete</a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='2'>No images found.</td></tr>";
}
?>
