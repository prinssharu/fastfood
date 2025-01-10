<?php
include 'connect/config.php'; 
session_start(); 

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM orders WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql);

$orders = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $orders[] = $row;
    }
}


if (isset($_SESSION['order_success_message'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['order_success_message'] . "</div>";
    unset($_SESSION['order_success_message']);
}
?>
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
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
       
        <div class="container-xxl position-relative p-0">
            <?php include 'connect/user_header.php'; ?>

            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Profile</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        
        <div class="container-xxl py-5 px-0">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Profile Information</h5>
                                <p class="card-text">Thankyou, <?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Guest'; ?>!</p>
                                <p class="card-text">Email: <?php echo isset($_SESSION['user_email']) ? $_SESSION['user_email'] : ''; ?></p>
                                <p class="card-text">

                               <p class="card-text">
                               <?php echo "Wait 10 minutes, your order is processing."; ?>
                               </p>
                               
                                
                                <a href="connect/logout.php" class="btn btn-primary">Logout</a>
                            </div>
                        </div>

                        <?php if (!empty($orders)): ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Your Orders</h5>
            <ul class="list-group">
                <?php foreach ($orders as $order): ?>
                    <li class="list-group-item">
                        <strong>Order Number:</strong> <?php echo $order['order_number']; ?><br>
                        <strong>Item:</strong> <?php echo $order['item_name']; ?><br>
                        <strong>Quantity:</strong> <?php echo $order['quantity']; ?><br>
                        <strong>Total Price:</strong> <?php echo $order['total_price']; ?><br><br>

                       

                       
                        <a href="delete profile order.php?order_id=<?php echo $order['order_id']; ?>" 
                           class="btn btn-sm btn-danger" 
                           onclick="return confirm('Are you sure you want to delete this order?')">Delete</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-info mt-4" role="alert">
        No orders found.
    </div>
<?php endif; ?>
</div>
</div>
</div>
        
        
        <?php include 'connect/user_footer.php';?>
        
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
