<?php
// Include necessary files
include 'connect/config.php'; 
session_start(); 

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Get the user details from session
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];
    $user_email = $_SESSION['user_email'];

    // Order processing code (Insert order into the database)
    // Example: Assuming you have an order table and you are inserting the order
    $order_number = rand(1000, 9999); // Just a random order number (you can use your own logic)
    $item_name = $_POST['item_name'];  // Getting item name from form
    $quantity = $_POST['quantity'];    // Getting quantity from form
    $total_price = $_POST['total_price']; // Getting total price from form

    // Insert order into the database
    $sql = "INSERT INTO orders (user_id, order_number, item_name, quantity, total_price) 
            VALUES ('$user_id', '$order_number', '$item_name', '$quantity', '$total_price')";
    if (mysqli_query($conn, $sql)) {
        // If the order was successfully processed, send confirmation email
        
        // Email subject and message
        $subject = "Order Confirmation";
        $message = "
            Dear $user_name,

            Thank you for your order! Your order has been successfully processed.

            Order Details:
            Order Number: $order_number
            Item: $item_name
            Quantity: $quantity
            Total Price: $total_price

            We will notify you once your order is ready for pickup.

            Best regards,
            Your Canteen Team
        ";

        // Email headers
        $headers = "From: no-reply@yourdomain.com\r\n";
        $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

        // Send email
        if (mail($user_email, $subject, $message, $headers)) {
            // If email is sent successfully, store success message
            $_SESSION['order_success_message'] = "Your order has been processed successfully. A confirmation email has been sent.";
        } else {
            // If email fails to send, store failure message
            $_SESSION['order_error_message'] = "Failed to send order confirmation email.";
        }

        // Redirect to profile page after processing the order
        header("Location: profile.php"); // You can change this to the appropriate page (e.g., order_confirmation.php)
        exit; // Ensure that the redirection happens immediately
    } else {
        // If order processing fails
        $_SESSION['order_error_message'] = "There was an error processing your order. Please try again.";
        header("Location: order_page.php"); // You can change this to where you want the user to go after an error
        exit;
    }
} else {
    // If the user is not logged in, redirect to the login page
    header("Location: login.php");
    exit;
}
?>
