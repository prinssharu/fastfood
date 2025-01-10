<?php
$servername = "localhost";
$username = "root"; 
$password = "diru1234"; 
$dbname = "canteen";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

if (isset($_GET['message'])) {
    echo "<div class='alert alert-success'>" . htmlspecialchars($_GET['message']) . "</div>";
}

if (isset($_GET['error'])) {
    echo "<div class='alert alert-danger'>" . htmlspecialchars($_GET['error']) . "</div>";
}

$query = "SELECT * FROM contact_form ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - User Messages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 style="text-align: center;">User Messages</h2>

        <table class="table table-bordered table-striped" id="">
            <thead>
                <tr>
                
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                               
                                <td>{$row['name']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['subject']}</td>
                                <td>{$row['message']}</td>
                                <td>{$row['created_at']}</td>
                                <td>
                                    <a href='con_delete.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\");'>Delete</a>
                                </td>
                              </tr>";
                              
                    }
                } else {
                    echo "<tr><td colspan='7'>No messages found.</td></tr>";
                }
                ?>
                
            </tbody>
        </table>
    </div>
</body>
</html>
