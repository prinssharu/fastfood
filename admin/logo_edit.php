

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit image</title>
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
<body>
    <h1>Edit image</h1>
    <?php


   $servername = "localhost";
   $username = "root";  
   $password = "diru1234";      
   $dbname = "canteen";  
   
   
   $conn = mysqli_connect($servername, $username, $password, $dbname);
   
   
   if (!$conn) {
       die("Connection failed: " . mysqli_connect_error());
   }

    
   $id = $_GET['id'];
   $sql = "SELECT * FROM logo WHERE id=$id";
   $result = $conn->query($sql);
   $row = $result->fetch_assoc();

$conn->close();
    ?>
    <form action="logo_update.php" method="POST" enctype="multipart/form-data">
   
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

       
    
            <label for="image">Logo Image:</label>
            <input type="file" id="image" name="image" value="<?php echo $$row(image); ?>">
    
        <button type="submit" name="update">Update image</button>
    </form>
</body>
</html>
