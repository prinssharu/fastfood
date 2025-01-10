<?php
include 'connect/config.php'; // Include database connection code here
session_start(); // Start the session

// Fetch user orders
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM orders WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql);

$orders = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $orders[] = $row;
    }
}

// Function to generate random order number
function generateOrderNumber() {
    return strtoupper(bin2hex(random_bytes(4))); // Generates an 8-character hexadecimal string
}

// Process payment method selection
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['payment_method'])) {
    $payment_method = $_POST['payment_method'];
    $order_number = generateOrderNumber();

    $update_sql = "UPDATE orders SET payment_method = '$payment_method', order_number = '$order_number' WHERE user_id = $user_id AND order_status = 'Pending'";
    mysqli_query($conn, $update_sql);
    header("Location: profile.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Canteen</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Navbar & Hero Start -->
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
        <!-- Navbar & Hero End -->

        <!-- Profile Content Start -->
        <div class="container-xxl py-5 px-0">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Profile Information</h5>
                                <p class="card-text">Welcome, <?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Guest'; ?>!</p>
                                <p class="card-text">Email: <?php echo isset($_SESSION['user_email']) ? $_SESSION['user_email'] : ''; ?></p>
                                <a href="#" class="btn btn-primary">Edit Profile</a>
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
                                                <?php echo $order['item_name']; ?> x <?php echo $order['quantity']; ?> = <?php echo $order['total_price']; ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($orders)): ?>
                            <div class="card mt-4">
                                <div class="card-body">
                                    <h5 class="card-title">Select Payment Method</h5>
                                    <form method="POST" action="">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="payment_method" id="cash" value="Cash" required>
                                            <label class="form-check-label" for="cash">Cash</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="payment_method" id="online" value="Online" required>
                                            <label class="form-check-label" for="online">Online</label>
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                    </form>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($order_number)): ?>
                            <div class="card mt-4">
                                <div class="card-body">
                                    <h5 class="card-title">Order Number</h5>
                                    <p class="card-text">Your order number is: <?php echo $order_number; ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Profile Content End -->

        <!-- Footer Start -->
        <?php include 'connect/user_footer.php';?>
        <!-- Footer End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
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

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
