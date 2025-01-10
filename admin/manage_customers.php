<?php
include '../connect/config.php';

session_start();
if (isset($_GET['delete'])) {
    $user_id = intval($_GET['delete']);
    $delete_query = "DELETE FROM users WHERE user_id = $user_id";
    if (mysqli_query($conn, $delete_query)) {
        header("Location: manage_customers.php?message=deleted");
        exit();
    } else {
        echo "<script>alert('Error deleting user');</script>";
    }
}


$search_query = "";
if (isset($_POST['search'])) {
    $search_query = $_POST['search'];
    $query = "SELECT user_id, name, email, user_type FROM users WHERE user_type = 'user' AND (name LIKE '%$search_query%' OR email LIKE '%$search_query%')";
} else {
    $query = "SELECT user_id, name, email, user_type FROM users WHERE user_type = 'user'";
}
$result = mysqli_query($conn, $query);
$count_query = "SELECT COUNT(*) as user_count FROM users WHERE user_type = 'user'";
$count_result = mysqli_query($conn, $count_query);
$count_row = mysqli_fetch_assoc($count_result);
$user_count = $count_row['user_count'];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Manage Customers</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
       
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="#" class="navbar-brand p-0">
                    <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i>Admin Panel</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="dashboard.php" class="nav-item nav-link">Dashboard</a>
                        <a href="manage_menu.php" class="nav-item nav-link">Menu</a>
                        <a href="manage_orders.php" class="nav-item nav-link">Orders</a>
                        <a href="manage_customers.php" class="nav-item nav-link active">Customers</a>
                        <a href="admin_contact.php" class="nav-item nav-link"> contact</a>
                    </div>
                    <a href="../connect/logout.php" class="btn btn-danger py-2 px-4">Sign Out</a>
                </div>
            </nav>
        </div>

  
        <div class="row mt-5">
            <div class="col-md-8 mx-auto">
                <h2 class="text-center mb-4">Manage Customers</h2>

                
                <form method="post" class="mb-3">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" name="search" value="<?php echo $search_query; ?>">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>

                <p>Total number of customers: <?php echo $user_count; ?></p>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $userId = 1;
                        if ($result->num_rows > 0) {
                            while ($user = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $userId++; ?></td>
                                    <td><?php echo $user['name']; ?></td>
                                    <td><?php echo $user['email']; ?></td>
                                    <td>
                                    <a href="editform.php?user_id=<?php echo $user['user_id']; ?>" class="btn btn-sm btn-primary">Edit</a>

                                        <a href="?delete=<?php echo $user['user_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='4'>No customers found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>
