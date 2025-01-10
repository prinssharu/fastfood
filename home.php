<?php
include 'connect/config.php';

session_start(); 
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
       


       
        <div class="container-xxl position-relative p-0">
            <?php include 'connect/user_header.php'; ?>

            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container my-5 py-5">
                    <div class="row align-items-center g-5">
                        <div class="col-lg-6 text-center text-lg-start">
                            <h1 class="display-3 text-white animated slideInLeft">Enjoy Our<br>Delicious Cappuccino</h1>
                            <p class="text-white animated slideInLeft mb-4 pb-2">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                            <a href="booking.php" class="btn btn-primary py-sm-3 px-sm-5 me-3 animated slideInLeft">Order food</a>
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
        
        
    


                        
                         <!--<div class="col-lg-6 text-center text-lg-end overflow-hidden">
                            <img class="img-fluid" src="img/hero.png" alt="">--! 
                        </div>--->
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->


        <!-- Service Start -->
        <!-- <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="service-item rounded pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-user-tie text-primary mb-4"></i>
                                <h5>Master Chefs</h5>
                                <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="service-item rounded pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-utensils text-primary mb-4"></i>
                                <h5>Quality Food</h5>
                                <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="service-item rounded pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-cart-plus text-primary mb-4"></i>
                                <h5>Online Order</h5>
                                <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                        <div class="service-item rounded pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-headset text-primary mb-4"></i>
                                <h5>24/7 Service</h5>
                                <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- Service End -->
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


        <!-- About Start -
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
                        <p class="mb-4">Our team is dedicated to providing exceptional service and a warm, inviting atmosphere. We continually strive to innovate and enhance our offerings, ensuring that there’s always something new for you to enjoy. Thank you for choosing Canteen – where great food and great moments come together.</p>                        <a class="btn btn-primary py-3 px-5 mt-2" href="">Read More</a>
                    </div>
                </div>
            </div>
        </div>
        About End -->
        

        
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