<?php
include 'connect/config.php';

session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_type'] = $row['user_type'];
            $_SESSION['user_name'] = $row['name'];

            
            if ($row['user_type'] === 'admin') {
                $_SESSION['loggedin']=true;
                header("Location: admin/dashboard.php"); 
                exit();
            } else {
                header("Location: home.php"); 
                exit();
            }
        } else {
            
            echo "<script>alert('Invalid password!'); window.location.href='signin.php';</script>";

        }
    } else {
        
        echo "<script>alert('No user found with this email!'); window.location.href='signin.php';</script>";

    }

    $conn->close();
}
?>
