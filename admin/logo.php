<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logo Management</title>
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

    $sql = "SELECT * FROM logo";
    $result = $conn->query($sql);
    ?>

    <div class="container">
        <h1>Logo Management </h1>
        
        <form action="add_logo.php" method="post" enctype="multipart/form-data">
            <label for="icon">Icon Class:</label>
            <input type="text" id="icon" name="icon" >

            <label for="name">Logo Text:</label>
            <input type="text" id="name" name="name" >

            <label for="image">Logo Image:</label>
            <input type="file" id="image" name="image" >

            <button type="submit">Add Logo</button>
        </form>

       
        <h2>Logo List</h2>
        <table>
            <thead>
                <tr>
                    <th>Icon Class</th>
                    <th>Logo Text</th>
                    <th>Logo Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['icon']) . "</td>
                                <td>" . htmlspecialchars($row['name']) . "</td>
                                <td><img src='" . htmlspecialchars($row['image']) . "' alt='Logo Image' style='height: 50px;'></td>
                                <td class='action-links'>
                                    <a href='logo_edit.php?id=" . $row['id'] . "'>Edit</a>
                                    <a href='delete_logo.php?id=" . $row['id'] . "'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No logos found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
