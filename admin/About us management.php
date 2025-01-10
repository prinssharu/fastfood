<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
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
            color: red;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
        form button:hover {
            background: #555;
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
            color: red;
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
    <?php
    
    $servername = "localhost";
    $username = "root";
    $password = "diru1234";
    $dbname = "canteen";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $sql = "SELECT * FROM about_us";
    $result = $conn->query($sql);
    ?>

    <div class="container">
        <h1>About Us Management</h1>
        
        <form action="add about.php" method="post" enctype="multipart/form-data">
            <label for="head">Head:</label>
            <input type="text" id="head" name="head" >

            <label for="about">About:</label>
            <input type="text" id="about" name="about" >

            <label for="image1">Image 1:</label>
            <input type="file" id="image1" name="image1" >

            <label for="image2">Image 2:</label>
            <input type="file" id="image2" name="image2" >

            <label for="image3">Image 3:</label>
            <input type="file" id="image3" name="image3" >

            <label for="image4">Image 4:</label>
            <input type="file" id="image4" name="image4" >

            <button type="submit">Add About</button>
        </form>

       
        <h2>About List</h2>
        <table>
            <thead>
                <tr>
                    <th>Head</th>
                    <th>About</th>
                    <th>Image 1</th>
                    <th>Image 2</th>
                    <th>Image 3</th>
                    <th>Image 4</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['head']) . "</td>
                                <td>" . htmlspecialchars($row['about']) . "</td>
                                <td><img src='" . htmlspecialchars($row['image1']) . "' alt='Image 1' style='height: 50px;'></td>
                                <td><img src='" . htmlspecialchars($row['image2']) . "' alt='Image 2' style='height: 50px;'></td>
                                <td><img src='" . htmlspecialchars($row['image3']) . "' alt='Image 3' style='height: 50px;'></td>
                                <td><img src='" . htmlspecialchars($row['image4']) . "' alt='Image 4' style='height: 50px;'></td>
                                <td class='action-links'>
                                    <a href='about us edit.php?id=" . $row['id'] . "'>Edit</a>
                                    <a href='delete about us.php?id=" . $row['id'] . "'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No About Us data found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>