<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit About Us</title>
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

        input[type="text"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        textarea {
            height: 100px;
            resize: vertical;
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
    <h1>Edit About Us</h1>
    <?php
    $servername = "localhost";
    $username = "root";  
    $password = "diru1234";      
    $dbname = "canteen";  

   
    $conn = new mysqli($servername, $username, $password, $dbname);

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $id = $_GET['id'];
    $sql = "SELECT * FROM about_us WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Record not found.";
        exit;
    }

    $conn->close();
    ?>
    <form action=" about Us Update.php" method="POST" enctype="multipart/form-data">
       
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">

        
        <label for="head">Heading:</label>
        <input type="text" id="head" name="head" value="<?php echo htmlspecialchars($row['head']); ?>">

        
        <label for="about">Description:</label>
        <textarea id="about" name="about"><?php echo htmlspecialchars($row['about']); ?></textarea>

        
        <label for="image1">Image 1:</label>
        <input type="file" id="image1" name="image1">
        <?php if (!empty($row['image1'])): ?>
            <img src="<?php echo htmlspecialchars($row['image1']); ?>" alt="Image 1">
        <?php endif; ?>

        <label for="image2">Image 2:</label>
        <input type="file" id="image2" name="image2">
        <?php if (!empty($row['image2'])): ?>
            <img src="<?php echo htmlspecialchars($row['image2']); ?>" alt="Image 2">
        <?php endif; ?>

        <label for="image3">Image 3:</label>
        <input type="file" id="image3" name="image3">
        <?php if (!empty($row['image3'])): ?>
            <img src="<?php echo htmlspecialchars($row['image3']); ?>" alt="Image 3">
        <?php endif; ?>

        <label for="image4">Image 4:</label>
        <input type="file" id="image4" name="image4">
        <?php if (!empty($row['image4'])): ?>
            <img src="<?php echo htmlspecialchars($row['image4']); ?>" alt="Image 4">
        <?php endif; ?>

        
        <button type="submit" name="update"> About Us Update</button>
    </form>
</body>
</html>
