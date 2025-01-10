<?php
include 'connect/config.php';

$query = "SELECT * FROM menu_items WHERE category IN ('breakfast', 'lunch', 'dinner')";
$result = mysqli_query($conn, $query);

 
function displayMenuItems($result, $category) {
    foreach ($result as $row) {
        if ($row['category'] === $category) {
            echo '<div class="col-lg-6">
                    <div class="d-flex align-items-center">
                        <img class="flex-shrink-0 img-fluid rounded" src="uploads/menu_items/' . $row['image_url'] . '" alt="" style="width: 80px;">
                        <div class="w-100 d-flex flex-column text-start ps-4">
                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                <span>' . $row['name'] . '</span>
                                <span class="text-primary">Rs ' . $row['price'] . '</span>
                            </h5>
                        </div>
                    </div>
                </div>';
        }
    }
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
        

    
        <?php
    
    $servername = "localhost";
    $username = "root";
    $password = "diru1234";
    $dbname = "canteen";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM logo";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $name = htmlspecialchars($row['name']);
            $image1 = htmlspecialchars($row['image']);
            $icon = htmlspecialchars($row['icon']);

            echo '<div class="container-xxl position-relative p-0"> ';
            echo ' <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">';
            echo '<a href="#" class="navbar-brand p-0">';
            echo '<h1 class="text-primary m-0"> <i class="' . $icon . '"></i><span>' . $name . '</span></h1>';
            echo '<img src="' . $image1 . '" alt="" width="80" style="display:block; margin-top:5px;" >';
            echo ' </a>';
            
        
        }
    }
?>


        <!-- Navbar & Hero Start -->
      <!-- <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i>Fast </h1>
                     <img src="img/logo.png" alt="Logo"> 
                </a>-->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="signIn.php" class="nav-item nav-link active">Home</a>
                        <a href="signIn.php" class="nav-item nav-link">About</a>
                        <a href="signIn.php" class="nav-item nav-link">Menu</a>
                        <a href="signIn.php" class="nav-item nav-link">Contact</a>
                    </div>
                    <a href="signIn.php" class="btn btn-primary py-2 px-4">Sign In</a>
                </div>
            </nav>

            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container my-5 py-5">
                    <div class="row align-items-center g-5">
                        <div class="col-lg-6 text-center text-lg-start">
                            <h1 class="display-3 text-white animated slideInLeft">Enjoy Our<br>Delicious Cappuccino</h1>
                            <p class="text-white animated slideInLeft mb-4 pb-2">Diseases are reduced when food intake is healthy and balanced.
The green leafy vegetable is good for increasing body strength.
Healthy food prevents obesity and can even promote fat loss.
Junk food is the opposite of healthy eating and contains too much sugar, salt, and fat.
Healthy food is cheaper and affordable.</p>
                            <a href="signin.php" class="btn btn-primary py-sm-3 px-sm-5 me-3 animated slideInLeft">Order Food</a>
                        </div>

                        <?php


$servername = "localhost";
$username = "root";
$password = "diru1234";
$dbname = "canteen";


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 
 $sql = "SELECT id, image_path FROM homepage_images";
 $result = $conn->query($sql);

 if ($result->num_rows > 0) {
     while ($row = $result->fetch_assoc()) {
         echo "<tr><td><img src='" . htmlspecialchars($row['image_path']) . "' alt='Image' style='width: 500px; height: auto;'></td>
 </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No images found.</td></tr>";
                }

                
                $conn->close();
                ?>


                        <!---<div class="col-lg-6 text-center text-lg-end overflow-hidden">
                            <img class="img-fluid" src="img/hero.png" alt="">-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
         
         <?php
         
    $servername = "localhost";
    $username = "root";
    $password = "diru1234";
    $dbname = "canteen";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    
    $sql = "SELECT * FROM about_us";
    $result = $conn->query($sql);
    
   
    ?>
    <div class="container-xxl py-5">
        <div class="container">
             <div class="row g-5 align-items-center">
                        <div class="col-lg-6">
                            <div class="row g-3">
            <?php if ($result->num_rows > 0) { ?>
                <?php while ($row = $result->fetch_assoc()) { 
                    $heading = htmlspecialchars($row['head']);
                    $description = htmlspecialchars($row['about']);
                    $image1 = htmlspecialchars($row['image1']);
                    $image2 = htmlspecialchars($row['image2']);
                    $image3 = htmlspecialchars($row['image3']);
                    $image4 = htmlspecialchars($row['image4']);
                ?>
                   
                                <?php if (!empty($image1)) { ?>
                                    <div class="col-6 text-start">
                                        <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.1s"  src="<?= $image1 ?>" alt="Image 1">
                                    </div>
                                <?php } ?>
                                <?php if (!empty($image2)) { ?>
                                    <div class="col-6 text-start">
                                        <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.3s" src="<?= $image2 ?>" alt="Image 2" style="margin-top: 25%;">
                                    </div>
                                <?php } ?>
                                <?php if (!empty($image3)) { ?>
                                    <div class="col-6 text-end">
                                        <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.5s" src="<?= $image3 ?>" alt="Image 3">
                                    </div>
                                <?php } ?>
                                <?php if (!empty($image4)) { ?>
                                    <div class="col-6 text-end">
                                        <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.7s" src="<?= $image4 ?>" alt="Image 4">
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h5 class="section-title ff-secondary text-start text-primary fw-normal">About Us</h5>
                            <h1 class="mb-4"><?= $heading ?></h1>
                            <p class="mb-4"><?= $description ?></p>
                            <a class="btn btn-primary py-3 px-5 mt-2" href="#">Read More</a>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="text-center">
                    <h3>No About Us information available.</h3>
                </div>
            <?php } ?>
            
        </div>
    </div>
    </div>
    <?php
    
    $conn->close();
    ?>

        <!-- About Sta
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <div class="row g-3">
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.1s" src="img/about-1.jpg">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.3s" src="img/about-2.jpg" style="margin-top: 25%;">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.5s" src="img/about-3.jpg">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.7s" src="img/about-4.jpg">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h5 class="section-title ff-secondary text-start text-primary fw-normal">About Us</h5>
                        <h1 class="mb-4">Welcome to <i class="fa fa-utensils text-primary me-2"></i>Fast Food Resturant</h1>
                        <p class="mb-4">At Fast Food Resturant, we believe in creating delightful dining experiences. Our diverse menu, crafted with fresh ingredients, caters to all taste preferences. Whether you are here for a quick bite or a leisurely meal, our goal is to make every visit memorable.</p>
                        <p class="mb-4">Our team is dedicated to providing exceptional service and a warm, inviting atmosphere. We continually strive to innovate and enhance our offerings, ensuring that there’s always something new for you to enjoy. Thank you for choosing Canteen – where great food and great moments come together.</p>
                        <a class="btn btn-primary py-3 px-5 mt-2" href="upload_about.php">Read More</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


        <!-- Menu Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">Food Menu</h5>
                    <h1 class="mb-5">Most Popular Items</h1>
                </div>
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
                    <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill" href="#tab-1" onclick="showCategory('breakfast')">
                                <i class="fa fa-coffee fa-2x text-primary"></i>
                                <div class="ps-3">
                                    <small class="text-body">Popular</small>
                                    <h6 class="mt-n1 mb-0">Breakfast</h6>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill" href="#tab-2" onclick="showCategory('lunch')">
                                <i class="fa fa-hamburger fa-2x text-primary"></i>
                                <div class="ps-3">
                                    <small class="text-body">Special</small>
                                    <h6 class="mt-n1 mb-0">Lunch</h6>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 me-0 pb-3" data-bs-toggle="pill" href="#tab-3" onclick="showCategory('dinner')">
                                <i class="fa fa-utensils fa-2x text-primary"></i>
                                <div class="ps-3">
                                    <small class="text-body">Lovely</small>
                                    <h6 class="mt-n1 mb-0">Dinner</h6>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <div id="breakfast-menu" class="row g-4">
                                <?php displayMenuItems($result, 'breakfast'); ?>
                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane fade show p-0">
                            <div id="lunch-menu" class="row g-4">
                                <?php displayMenuItems($result, 'lunch'); ?>
                            </div>
                        </div>
                        <div id="tab-3" class="tab-pane fade show p-0">
                            <div id="dinner-menu" class="row g-4">
                                <?php displayMenuItems($result, 'dinner'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Menu End -->


        

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