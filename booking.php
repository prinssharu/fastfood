<?php

include 'connect/config.php';


session_start();


function show_alert($message, $type) {
    echo "<div class='alert alert-$type alert-dismissible fade show' role='alert'>
            $message
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
}


$menu_items = array();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['menu_category'])) {
    $menu_category = $_POST['menu_category'];
    $query = "SELECT * FROM menu_items WHERE category = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $menu_category);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        $menu_items[] = $row;
    }
}

function generateOrderNumber() {
    return strtoupper(bin2hex(random_bytes(4)));
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_order'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $payment_method = $_POST['payment_method'];
    $menu_items_selected = $_POST['menu_items'] ?? [];
    $menu_quantities = $_POST['menu_quantities'] ?? [];

    
    if (empty($name) || empty($email) || empty($phone) || empty($menu_items_selected)) {
        show_alert("Please fill out all required fields and select at least one menu item.", "danger");
    } else {
        $order_number = generateOrderNumber();
        $user_id = $_SESSION['user_id'];
        $success = true;

        foreach ($menu_items_selected as $menu_id) {
            $quantity = (int)($menu_quantities[$menu_id] ?? 1);
            if ($quantity < 1) continue;

            
            $query = "SELECT name, price FROM menu_items WHERE menu_id = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "i", $menu_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $menu_item = mysqli_fetch_assoc($result);

            if ($menu_item) {
                $item_name = $menu_item['name'];
                $item_price = $menu_item['price'];
                $total_price = $item_price * $quantity;

                
                $query = "INSERT INTO orders (user_id, name, email, phone, item_name, item_price, quantity, total_price, payment_method, order_number) 
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, "issssdssss", $user_id, $name, $email, $phone, $item_name, $item_price, $quantity, $total_price, $payment_method, $order_number);

                if (!mysqli_stmt_execute($stmt)) {
                    show_alert("Failed to place the order for $item_name. Error: " . mysqli_stmt_error($stmt), "danger");
                    $success = false;
                }
            } else {
                show_alert("Menu item with ID $menu_id not found.", "danger");
                $success = false;
            }
        }

        if ($success) {
            show_alert("Order placed successfully! Your order number is: $order_number", "success");
            header("Location: profile.php");
            exit();
        }
    }
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

    
    <link href="img/favicon.ico" rel="icon">

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    
    <link href="css/bootstrap.min.css" rel="stylesheet">

    
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        

       
        <div class="container-xxl position-relative p-0">
            <?php include 'connect/user_header.php'; ?>

            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Ordering</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Booking</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        
        <div class="container-xxl py-5 px-0 wow fadeInUp" data-wow-delay="0.1s">
            <div class="row g-0">
                <div class="col-md-6">
                    <div class="video">
                        <button type="button" class="btn-play" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-bs-target="#videoModal">
                            <span></span>
                        </button>
                    </div>
                </div>
                <div class="col-md-6 bg-dark d-flex align-items-center">
                    <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
                        <h5 class="section-title ff-secondary text-start text-primary fw-normal">Reservation</h5>
                        <h1 class="text-white mb-4">Online Ordering</h1>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" value="<?php echo $_SESSION['user_name']; ?>">
                                        <label for="name">Your Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" value="<?php echo $_SESSION['user_email']; ?>">
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>
                                
    <div class="col-md-6">
    <div class="form-floating">
        <select class="form-select" id="menu_category" name="menu_category" onchange="this.form.submit()">
            <option value="">Select Category</option>
            <option value="breakfast" <?php if (isset($_POST['menu_category']) && $_POST['menu_category'] == 'breakfast') echo 'selected'; ?>>Breakfast</option>
            <option value="lunch" <?php if (isset($_POST['menu_category']) && $_POST['menu_category'] == 'lunch') echo 'selected'; ?>>Lunch</option>
            <option value="dinner" <?php if (isset($_POST['menu_category']) && $_POST['menu_category'] == 'dinner') echo 'selected'; ?>>Dinner</option>
        </select>
        <label for="menu_category">Select Menu Category</label>
    </div>
</div>
<div class="col-md-6">
    <div class="form-floating">
        <input type="text" class="form-control" id="phone" name="phone" placeholder="Your Phone Number">
        <label for="phone">Phone Number</label>
    </div>
</div>



<div id="menu_items_container">
    <div class="row g-3">
        <?php if (isset($menu_items)): ?>
            <?php foreach ($menu_items as $key => $item): ?>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="checkbox" class="form-check-input" id="item_<?php echo $key; ?>" name="menu_items[]" value="<?php echo $item['menu_id']; ?>">
                        <label for="item_<?php echo $key; ?>"><?php echo $item['name'] . ' - Rs.' . $item['price']; ?></label>
                    </div>
                </div>
               
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="number" class="form-control" id="quantity_<?php echo $key; ?>" name="menu_quantities[<?php echo $item['menu_id']; ?>]" placeholder="Quantity" min="1">
                        <label for="quantity_<?php echo $key; ?>">Quantity</label>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>



                                
                                </div>
                                <div class="col-md-6">
    <div class="form-floating">
        <select class="form-select" id="payment_method" name="payment_method">
            <option value="pickup only">Pickup Only</option>
           
        </select>
        <label for="payment_method">Payment Method</label>
    </div>
</div>



<div class="col-12 text-center mt-3">
    <button class="btn btn-warning fw-bold w-50 py-3" type="submit" name="submit_order">
        PLACE ORDER
    </button>
</div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        

       
        <?php include 'connect/user_footer.php'; ?>
        
        
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