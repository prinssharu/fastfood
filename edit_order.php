<?php
include 'connect/config.php';

if (isset($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']);

    $sql = "SELECT * FROM orders WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $order = $result->fetch_assoc();

    if ($order): ?>
        <h2>Edit Order</h2>
        <form method="POST" action="update_order.php">
            <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">

            <label>Item Name:</label>
            <input type="text" name="item_name" value="<?php echo htmlspecialchars($order['item_name']); ?>" required><br><br>

            <label>Quantity:</label>
            <input type="number" name="quantity" value="<?php echo $order['quantity']; ?>" required><br><br>

            <label>Total Price:</label>
            <input type="number" name="total_price" step="0.01" value="<?php echo $order['total_price']; ?>" required><br><br>

            <button type="submit" class="btn btn-success">Update</button>
        </form>
    <?php else: ?>
        <p>Order not found!</p>
    <?php endif;
}
?>
