<?php
include 'connect/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = intval($_POST['order_id']);
    $item_name = htmlspecialchars($_POST['item_name']);
    $quantity = intval($_POST['quantity']);
    $total_price = floatval($_POST['total_price']);

    // Update query
    $sql = "UPDATE orders SET item_name = ?, quantity = ?, total_price = ? WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sidi", $item_name, $quantity, $total_price, $order_id);

    if ($stmt->execute()) {
        // Redirect to the orders page with a success message
        header("Location: profile.php?message=Order updated successfully");
        exit;
    } else {
        echo "Error updating order: " . $conn->error;
    }
}
?>
