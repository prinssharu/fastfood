<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Management System</title>
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

 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $head = htmlspecialchars($_POST['head']);
        $booking = htmlspecialchars($_POST['booking']);
        $general = htmlspecialchars($_POST['general']);
        $technical = htmlspecialchars($_POST['technical']);
        $googlemap = htmlspecialchars($_POST['googlemap']);

        if (!empty($head) && !empty($booking) && !empty($general) && !empty($technical) && !empty($googlemap)) {
            $sql = "INSERT INTO contact_us (head, booking, general, technical, googlemap) 
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $head, $booking, $general, $technical, $googlemap);
            if ($stmt->execute()) {
                echo "<p style='color: green; text-align: center;'>Contact added successfully!</p>";
            } else {
                echo "<p style='color: red; text-align: center;'>Error: " . $stmt->error . "</p>";
            }
            $stmt->close();
        } else {
            echo "<p style='color: red; text-align: center;'>All fields are required!</p>";
        }
    }

    
    $sql = "SELECT * FROM contact_us";
    $result = $conn->query($sql);
    ?>

    <div class="container">
        <h1>Contact us Management System</h1>
        
        <form method="POST" action="">
            <label for="head">Heading:</label>
            <input type="text" id="head" name="head" required>

            <label for="booking">Booking Email:</label>
            <input type="email" id="booking" name="booking" required>

            <label for="general">General Email:</label>
            <input type="email" id="general" name="general" required>

            <label for="technical">Technical Email:</label>
            <input type="email" id="technical" name="technical" required>

            <label for="googlemap">Google Map Link:</label>
            <input type="link" id="googlemap" name="googlemap" required>

            <button type="submit">Add Contact</button>
        </form>

        <h2>Contact Us List</h2>
        <table>
            <thead>
                <tr>
                    <th>Heading</th>
                    <th>Booking Email</th>
                    <th>General Email</th>
                    <th>Technical Email</th>
                    <th>Google Map Link</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['head']) . "</td>
                    <td>" . htmlspecialchars($row['booking']) . "</td>
                    <td>" . htmlspecialchars($row['general']) . "</td>
                    <td>" . htmlspecialchars($row['technical']) . "</td>
                    <td>
                        <iframe 
                            src='" . htmlspecialchars($row['googlemap']) . "' 
                            style='border: 0; width: 100%; height: 200px; border-radius: 5px;' 
                            allowfullscreen='' 
                            loading='lazy'>
                        </iframe>
                    </td>
                    <td class='action-links'>
                        <a href='contact us edit.php?id=" . $row['id'] . "'>Edit</a>
                        <a href='contact us delete.php?id=" . $row['id'] . "' onclick=\"return confirm('Are you sure you want to delete this contact?')\">Delete</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No contacts found.</td></tr>";
    }
    ?>
</tbody>
        </table>
    </div>
</body>
</html>
