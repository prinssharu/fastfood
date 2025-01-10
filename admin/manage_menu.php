<?php
include '../connect/config.php';

session_start(); 


function show_alert($message, $type) {
    echo "<div class='alert alert-$type' role='alert'>$message</div>";
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $itemName = $_POST['itemName'];
    $itemPrice = $_POST['itemPrice'];
    $itemCategory = $_POST['itemCategory'];

    
    $target_dir = "../uploads/menu_items/";
    $target_file = $target_dir . basename($_FILES["itemImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    
    $check = getimagesize($_FILES["itemImage"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        show_alert("File is not an image.", "error");
        $uploadOk = 0;
    }

    
    if (file_exists($target_file)) {
        show_alert("Sorry, file already exists.", "error");
        $uploadOk = 0;
    }

    
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        show_alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.", "error");
        $uploadOk = 0;
    }

   
    if ($uploadOk == 0) {
        
    } else {
        if (move_uploaded_file($_FILES["itemImage"]["tmp_name"], $target_file)) {
            $itemImage = basename($_FILES["itemImage"]["name"]);
            $query = "INSERT INTO menu_items (name, price, category, image_url) VALUES ('$itemName', '$itemPrice', '$itemCategory', '$itemImage')";
            if (mysqli_query($conn, $query)) {
                show_alert("The menu item has been added successfully.", "success");
            } else {
                show_alert("Error: " . $query . "<br>" . mysqli_error($conn), "error");
            }
        } else {
            show_alert("Sorry, there was an error uploading your file.", "error");
        }
    }
}


$query = "SELECT * FROM menu_items";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fast Food Resturant - Manage Menu</title>
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

<body>
    <div class="container-xxl bg-white p-0">
        
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        


        
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="dashboard.php" class="navbar-brand p-0">
                    <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i>Admin Panel</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="dashboard.php" class="nav-item nav-link">Dashboard</a>
                        <a href="manage_menu.php" class="nav-item nav-link active">Menu</a>
                        <a href="manage_orders.php" class="nav-item nav-link">Orders</a>
                        <a href="manage_customers.php" class="nav-item nav-link">Customers</a>
                        <a href="admin_contact.php" class="nav-item nav-link"> contact</a>
                    </div>
                    <a href="../connect/logout.php" class="btn btn-danger py-2 px-4">Sign Out</a>
                </div>
            </nav>

            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                
            </div>
        </div>
       

       
        <div class="row mt-5">
            <div class="col-md-8 mx-auto">
                
                <h3 class="text-center my-4">Add New Menu Item</h3>
                <form method="post" action= "" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="itemName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="itemName" name="itemName" required>
                    </div>
                    <div class="mb-3">
                        <label for="itemPrice" class="form-label">Price</label>
                        <input type="number" class="form-control" id="itemPrice" name="itemPrice" required>
                    </div>
                    <div class="mb-3">
                        <label for="itemCategory" class="form-label">Category</label>
                        <select class="form-select" id="itemCategory" name="itemCategory" required>
                            <option value="" selected>Select category</option>
                            <option value="breakfast">Breakfast</option>
                            <option value="lunch">Lunch</option>
                            <option value="dinner">Dinner</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="itemImage" class="form-label">Image</label>
                        <input type="file" class="form-control" id="itemImage" name="itemImage" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Item</button>
                </form>
                
                
                <h2 class="text-center mb-4">Manage Menu</h2>
                
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Price</th>
                            <th scope="col">Category</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $row['menu_id']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td>
                                        <img src="../uploads/menu_items/<?php echo $row['image_url']; ?>" alt="<?php echo $row['name']; ?>" style="max-width: 100px; max-height: 100px;">
                                    </td>
                                    <td><?php echo $row['price']; ?></td>
                                    <td><?php echo $row['category']; ?></td>
                                    

                                    <td>
                                    <a href="edit.php?menu_id=<?php echo $row['menu_id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="delete.php?menu_id=<?php echo $row['menu_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                                    </td>

                                </td>
                            </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='5'>No menu items found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                   
            </div>
           
        </div>

        
        <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">Fast Food Resturant</a>, All Right Reserved. 
							
							Designed By <a class="border-bottom" href="#">Dirukshika</a><br><br>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="">Home</a>
                                <a href="">Cookies</a>
                                <a href="">Help</a>
                                <a href="">FQAs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

         <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

   
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/wow/wow.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/counterup/counterup.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/tempusdominus/js/moment.min.js"></script>
    <script src="../lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

   
    <script src="../js/main.js"></script>
</body>

</html> 
