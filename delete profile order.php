<?php
// Include database connection
include 'connect/config.php';

// Check if order_id exists in the GET request
if (isset($_GET['order_id'])) {
    // Sanitize the input
    $order_id = intval($_GET['order_id']);

    // Prepare and execute the DELETE query
    $sql = "DELETE FROM orders WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);

    if ($stmt->execute()) {
        // Redirect with success message
        header("Location: profile.php?message=Order deleted successfully");
        exit;
    } else {
        echo "Error deleting order: " . $conn->error;
    }
} else {
    // Redirect if no order_id provided
    header("Location: profile.php?error=Invalid order ID");
    exit;
}
?>
