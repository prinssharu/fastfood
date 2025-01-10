<?php
include '../connect/config.php';

session_start(); 


if (isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']); //
    $query = "SELECT * FROM users WHERE user_id = $user_id";
    $result = mysqli_query($conn, $query);

    if ($result->num_rows == 1) {
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('User not found'); window.location.href='manage_customers.php';</script>";
        exit();
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_user'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $update_query = "UPDATE users SET name = '$name', email = '$email' WHERE user_id = $user_id";
    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('User updated successfully'); window.location.href='manage_customers.php';</script>";
    } else {
        echo "<script>alert('Error updating user');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit User</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
            </div>
            <button type="submit" name="update_user" class="btn btn-primary">Update</button>
            <a href="manage_customers.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
