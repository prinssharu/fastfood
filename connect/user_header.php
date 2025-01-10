<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
    <a href="" class="navbar-brand p-0">
        <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i>Fast Food Resturant</h1>
        <!-- <img src="img/logo.png" alt="Logo"> -->
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0 pe-4">
            <a href="home.php" class="nav-item nav-link">Home</a>
            <a href="about.php" class="nav-item nav-link">About</a>
            <a href="menu.php" class="nav-item nav-link">Menu</a>
            <a href="booking.php" class="nav-item nav-link">Ordering</a>
            <a href="contact.php" class="nav-item nav-link">Contact</a>
        </div>
        <?php
        if (isset($_SESSION['user_name'])) {
            echo '<a href="profile.php" class="btn btn-primary py-2 px-4">' . $_SESSION['user_name'] . '</a>';
        } else {
            echo '<a href="signin.php" class="btn btn-primary py-2 px-4">Sign In</a>';
        }
        ?>
        <!-- <a href="connect/logout.php" class="btn btn-primary py-2 px-4">Logout </a>; -->
    </div>
</nav>
