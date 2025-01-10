<?php
include '../connect/config.php';

session_start();


function show_alert($message, $type) {
    echo "<div class='alert alert-$type' role='alert'>$message</div>";
}


function send_email_notification($email, $orderId) {
    $subject = "Order Processed";
    $message = "Your order #$orderId has been processed. Please take your order from the counter.";
    $headers = "From: no-reply@canteen.com";

    
    echo "<script>alert('Email sent to customer for Order #$orderId');</script>";
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['process_order'])) {
    $orderId = $_POST['order_id_to_process'];

   
    $update_query = "UPDATE orders SET status = 'processed' WHERE order_id = $orderId";
    if (mysqli_query($conn, $update_query)) {
        
        show_alert("Order processed. Notification will be sent in 10 minutes.", "success");

        
        echo "<script>
            setTimeout(function() {
                alert('Customer notified for Order #$orderId');
                send_email_notification('$row[email]', $orderId);
            }, 60000); // 60000 ms = 1 minutes
        </script>";
    } else {
        
        show_alert("Error processing order: " . mysqli_error($conn), "danger");
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_order'])) {
    $orderId = $_POST['order_id_to_delete'];

    
    $delete_query = "DELETE FROM orders WHERE order_id = $orderId";
    if (mysqli_query($conn, $delete_query)) {
        show_alert("Order deleted successfully.", "success");
    } else {
        show_alert("Error deleting order: " . mysqli_error($conn), "danger");
    }
}


$query = "SELECT * FROM orders";
$result = mysqli_query($conn, $query);
?>


<div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i> Admin Panel</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="dashboard.php" class="nav-item nav-link active">Dashboard</a>
                        <a href="manage_menu.php" class="nav-item nav-link">Menu</a>
                        <a href="manage_orders.php" class="nav-item nav-link">Orders</a>
                        <a href="manage_customers.php" class="nav-item nav-link">Customers</a>
                        <a href="admin_contact.php" class="nav-item nav-link">Contact</a>
                    </div>
                    <a href="../connect/logout.php" class="btn btn-danger py-2 px-4">Sign Out</a>
                </div>
            </nav>

            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                
            </div>
        </div>
        
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fast Food Resturant</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    
    <link href="img/favicon.ico" rel="icon">

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

   
    <link href="../lib/animate/animate.min.css" rel="stylesheet">
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    
    <link href="../css/style.css" rel="stylesheet">
</head>
  
</head>
<body>
    
 <?php include 'connect/user_header.php'; ?>
    <div class="container-xxl bg-white p-0">
        <div class="row mt-5">
            <div class="col-md-10 mx-auto">
                <h2 class="text-center mb-4">Manage Orders</h2>
                
               
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $row['order_id']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['item_name']; ?></td>
                                    <td><?php echo $row['quantity']; ?></td>
                                    <td><?php echo $row['total_price']; ?></td>
                                    <td><?php echo $row['status']; ?></td>
                                    <td>
                                        <form method="POST">
                                            <input type="hidden" name="order_id_to_process" value="<?php echo $row['order_id']; ?>">
                                            <button type="submit" name="process_order" class="btn btn-sm btn-success">Process</button>
                                            <input type="hidden" name="order_id_to_delete" value="<?php echo $row['order_id']; ?>">
                                            <button type="submit" name="delete_order" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='7'>No orders found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
