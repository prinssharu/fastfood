<?php
// Fetch current user details from the database
include 'db_connection.php';
session_start();

$user_id = $_SESSION['user_id']; // Assume the user ID is stored in the session
$sql = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<h2>Edit Profile</h2>
<form action="update_profile.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">

    <label>Username:</label>
    <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required><br><br>

    <label>Email:</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br><br>

    <label>Phone:</label>
    <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required><br><br>

    <label>Profile Picture:</label>
    <?php if (!empty($user['profile_picture'])): ?>
        <img src="uploads/<?php echo $user['profile_picture']; ?>" alt="Profile Picture" width="100"><br>
    <?php endif; ?>
    <input type="file" name="profile_picture"><br><br>

    <button type="submit" class="btn btn-success">Update Profile</button>
</form>
