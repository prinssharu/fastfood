<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Homepage Image</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
        }

        input[type="file"],
        input[type="hidden"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        img {
            display: block;
            margin-top: 10px;
            max-width: 100%;
            height: auto;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Edit Homepage Image</h1>
    <?php
   
    $servername = "localhost";
    $username = "root";
    $password = "diru1234";
    $dbname = "canteen";

    
    $conn = new mysqli($servername, $username, $password, $dbname);

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

   
    $id = isset($_GET['id']) ? intval($_GET['id']) : 1; 
    $sql = "SELECT * FROM homepage_images WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Image not found.";
        exit;
    }

    $conn->close();
    ?>
    <form action="homepage image update.php" method="POST" enctype="multipart/form-data">
      
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">

        
        <label for="image">Upload New Image:</label>
        <input type="file" id="image" name="image">
        <?php if (!empty($row['image_path'])): ?>
            <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="Current Image">
        <?php endif; ?>

        
        <button type="submit" name="update">Update Image</button>
    </form>
</body>
</html>
