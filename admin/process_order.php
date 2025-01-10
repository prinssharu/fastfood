<?php
include 'connect/config.php'; 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $user_id = $_SESSION['user_id'];
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $total_price = $_POST['total_price'];

    
    $sql = "INSERT INTO orders (user_id, item_name, quantity, total_price, order_status) 
            VALUES ($user_id, '$item_name', $quantity, $total_price, 'pending')";
    if (mysqli_query($conn, $sql)) {
       
        $customer_email = $_SESSION['dirukshikaj@gmail.com'];
        $subject = "Order Confirmation";
        $message = "Dear " . $_SESSION['user_name'] . ",\n\nThank you for your order! Your order is being processed and will be ready in approximately 10 minutes.\n\nOrder Details:\nItem: $item_name\nQuantity: $quantity\nTotal Price: $total_price\n\nThank you for choosing our canteen!";
        $headers = "From: noreply@canteen.com";

        if (mail($customer_email, $subject, $message, $headers)) {
            echo "Order confirmation email sent!";
        } else {
            echo "Failed to send email.";
        }

        
        $_SESSION['order_success_message'] = "Your order has been placed successfully! It will be ready in approximately 10 minutes.";
        header("Location: profile.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

