<?php
include 'connect/config.php';
session_start();

function show_alert($message, $type) {
    echo "<div class='alert alert-dismissible fade show alert-$type' role='alert'>
            " . htmlspecialchars($message) . "
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // CSRF token validation
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        show_alert("Invalid form submission.", "danger");
    } else {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $subject = trim($_POST['subject']);
        $message = trim($_POST['message']);

        if (empty($name) || empty($email) || empty($subject) || empty($message)) {
            show_alert("All fields are required.", "danger");
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            show_alert("Invalid email format.", "danger");
        } else {
            $servername = "localhost";
            $username = "root";
            $password = "diru1234";
            $dbname = "canteen";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $query = "INSERT INTO contact_form (name, email, subject, message) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssss", $name, $email, $subject, $message);

            if ($stmt->execute()) {
                show_alert("Message sent successfully!", "success");
            } else {
                show_alert("Error: " . $stmt->error, "danger");
            }

            $stmt->close();
            $conn->close();
        }
    }
}

// Generate a CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Fast Food Restaurant</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link href="img/favicon.ico" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container-xxl bg-white p-0">
        <?php include 'connect/user_header.php'; ?>

        <div class="container-xxl py-5 bg-dark hero-header mb-5">
            <div class="container text-center my-5 pt-5 pb-4">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Contact Us</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Contact</li>
                    </ol>
                </nav>
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


$sql = "SELECT * FROM contact_us";
$result = $conn->query($sql);


?>
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
            <div class="container-xxl py-5">
            <div class="container">
                
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">Contact Us</h5>

                <?php if ($result->num_rows > 0) { ?>
                    <?php while ($row = $result->fetch_assoc()) { 
                      
                        $heading = htmlspecialchars($row['head']);
                        $bookingEmail = htmlspecialchars($row['booking']);
                        $generalEmail = htmlspecialchars($row['general']);
                        $technicalEmail = htmlspecialchars($row['technical']);
                        $googleMapLink = htmlspecialchars($row['googlemap']);

                        
                    ?>
                        <h1 class="mb-4"><?= $heading ?></h1>
            <br><br>
<div class="email-section">
    <div class="email-item">
        <h3>Booking <span>───</span></h3>
        <p><a href="mailto:<?= $bookingEmail ?>"><i class="fas fa-envelope"></i> <?= $bookingEmail ?></a></p>
    </div>
    <div class="email-item">
        <h3>General <span>───</span></h3>
        <p><a href="mailto:<?= $generalEmail ?>"><i class="fas fa-envelope"></i> <?= $generalEmail ?></a></p>
    </div>
    <div class="email-item">
        <h3>Technical <span>───</span></h3>
        <p><a href="mailto:<?= $technicalEmail ?>"><i class="fas fa-envelope"></i> <?= $technicalEmail ?></a></p>
    </div>
</div>
<td>
    
    
 


                    <?php } ?>
                <?php } else { ?>
                    <div class="text-center">
                        <h3>No Contact Us information available.</h3>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php

$conn->close();
?>
 
 
 <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <h5 class="section-title ff-secondary text-center text-primary fw-normal">Contact Us</h5>
                        <h1 class="mb-4">Get In Touch</h1>
                        <p>If you have any queries, feel free to reach out to us using the contact form or the provided details.</p>
                    </div>

                    <div class="col-lg-6">
                        <form action="" method="post">
                            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" value="<?php echo htmlspecialchars($_SESSION['user_name'] ?? ''); ?>">
                                        <label for="name">Your Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" value="<?php echo htmlspecialchars($_SESSION['user_email'] ?? ''); ?>">
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
                                        <label for="subject">Subject</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a message here" id="message" name="message" style="height: 150px"></textarea>
                                        <label for="message">Message</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary w-100 py-3">Send Message</button>
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



 <!---<h1 class="mb-5">Contact For Any Query</h1>
                </div>
                <div class="row g-4">
                    <div class="col-12">
                        <div class="row gy-4">
                            <div class="col-md-4">
                                <h5 class="section-title ff-secondary fw-normal text-start text-primary">Booking</h5>
                                <p><i class="fa fa-envelope-open text-primary me-2"></i>book@example.com</p>
                            </div>
                            <div class="col-md-4">
                                <h5 class="section-title ff-secondary fw-normal text-start text-primary">General</h5>
                                <p><i class="fa fa-envelope-open text-primary me-2"></i>info@example.com</p>
                            </div>
                            <div class="col-md-4">
                                <h5 class="section-title ff-secondary fw-normal text-start text-primary">Technical</h5>
                                <p><i class="fa fa-envelope-open text-primary me-2"></i>tech@example.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 wow fadeIn" data-wow-delay="0.1s">
                        <iframe class="position-relative rounded w-100 h-100"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9049.010693292692!2d81.24222968442584!3d8.580510653137484!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3afbbca209ddef57%3A0x2e9e4b68861922df!2sThirukoneswaram%20Kovil!5e0!3m2!1sen!2slk!4v1717363046900!5m2!1sen!2slk"
                            frameborder="0" style="min-height: 350px; border:0;" allowfullscreen="" aria-hidden="false"
                            tabindex="0"></iframe>
                   Contact end -->
       