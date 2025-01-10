<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = intval($_POST['user_id']);
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $profile_picture = null;

    // Handle file upload if a new picture is provided
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/';
        $file_name = basename($_FILES['profile_picture']['name']);
        $file_path = $upload_dir . $file_name;

        // Move uploaded file to the upload directory
        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $file_path)) {
            $profile_picture = $file_name;
        } else {
            echo "Error uploading file.";
            exit;
        }
    }

    // Prepare the SQL query
    if ($profile_picture) {
        $sql = "UPDATE users SET username = ?, email = ?, phone = ?, profile_picture = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssii", $username, $email, $phone, $profile_picture, $user_id);
    } else {
        $sql = "UPDATE users SET username = ?, email = ?, phone = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $username, $email, $phone, $user_id);
    }

    // Execute the query
    if ($stmt->execute()) {
        header("Location: profile.php?message=Profile updated successfully");
        exit;
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}
?>
