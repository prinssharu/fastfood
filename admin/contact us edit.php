<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Contact Us</title>
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
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
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
    <h1>Edit Contact Us</h1>
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
    $sql = "SELECT * FROM contact_us WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Record not found.";
        exit;
    }

    $conn->close();
    ?>
    <form action="contact us update.php" method="POST">
        
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">

       
        <label for="head">Heading:</label>
        <input type="text" id="head" name="head" value="<?php echo htmlspecialchars($row['head']); ?>" required>

        
        <label for="booking">Booking Email:</label>
        <input type="email" id="booking" name="booking" value="<?php echo htmlspecialchars($row['booking_email']); ?>" required>

        
        <label for="General">General Email:</label>
        <input type="email" id="General" name="General" value="<?php echo htmlspecialchars($row['general_email']); ?>" required>

        
        <label for="Technical">Technical Email:</label>
        <input type="email" id="Technical" name="Technical" value="<?php echo htmlspecialchars($row['technical_email']); ?>" required>

        
        <label for="googlemap">Google Map Link:</label>
        <input type="text" id="googlemap" name="googlemap" value="<?php echo htmlspecialchars($row['google_map']); ?>" required>

        
        <button type="submit" name="update">Update Contact Us</button>
    </form>
</body>
</html>
