<?php
include 'connect/config.php';

$response = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

    if ($password == $cpassword) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            $response = "success"; 
        } else {
            $response = "error: " . $conn->error; 
        }
    } else {
        $response = "Passwords do not match!";
    }

    $conn->close();
}


if ($response === "success") {
    echo "<script>alert('New record created successfully'); window.location.href='signin.php';</script>";
} elseif ($response === "Passwords do not match!") {
    echo "<script>alert('Passwords do not match!'); window.location.href='signin.php';</script>";
} else {
    echo "<script>alert('Error: " . $response . "'); window.location.href='signin.php';</script>";
}
?>
