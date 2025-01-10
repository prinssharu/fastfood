<?php
include '../connect/config.php';
session_start();

if (isset($_GET['menu_id'])) {
    $menu_id = $_GET['menu_id'];
    $query = "SELECT * FROM menu_items WHERE menu_id = $menu_id";
    $result = mysqli_query($conn, $query);
    $menu_item = mysqli_fetch_assoc($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $menu_id = $_POST['menu_id'];
    $itemName = $_POST['itemName'];
    $itemPrice = $_POST['itemPrice'];
    $itemCategory = $_POST['itemCategory'];
    $itemImage = $menu_item['image_url']; 
    if (!empty($_FILES["itemImage"]["name"])) {
        $target_dir = "../uploads/menu_items/";
        $target_file = $target_dir . basename($_FILES["itemImage"]["name"]);
        move_uploaded_file($_FILES["itemImage"]["tmp_name"], $target_file);
        $itemImage = basename($_FILES["itemImage"]["name"]);
    }

    $update_query = "UPDATE menu_items SET name = '$itemName', price = '$itemPrice', category = '$itemCategory', image_url = '$itemImage' WHERE menu_id = $menu_id";
    if (mysqli_query($conn, $update_query)) {
        header("Location: manage_menu.php");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Menu Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('4to.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .edit-form-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 10px;
            border-radius: 8px;
            width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .edit-form-container h3 {
            text-align: center;
            color: #333;
        }
        .edit-form-container img {
            display: block;
            margin: 10px auto;
            max-width: 100px;
            border-radius: 5px;
        }
        .btn-primary {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="edit-form-container">
        <h3>Edit Menu Item</h3>
        <form method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="menu_id" value="<?php echo $menu_id; ?>">

            
            <div class="mb-3">
                <label for="itemName" class="form-label">Name</label>
                <input type="text" class="form-control" id="itemName" name="itemName" value="<?php echo $menu_item['name']; ?>" required>
            </div>

            
            <div class="mb-3">
                <label for="itemPrice" class="form-label">Price</label>
                <input type="number" class="form-control" id="itemPrice" name="itemPrice" value="<?php echo $menu_item['price']; ?>" required>
            </div>

            
            <div class="mb-3">
                <label for="itemCategory" class="form-label">Category</label>
                <select class="form-select" id="itemCategory" name="itemCategory" required>
                    <option value="breakfast" <?php if($menu_item['category'] == "breakfast") echo "selected"; ?>>Breakfast</option>
                    <option value="lunch" <?php if($menu_item['category'] == "lunch") echo "selected"; ?>>Lunch</option>
                    <option value="dinner" <?php if($menu_item['category'] == "dinner") echo "selected"; ?>>Dinner</option>
                </select>
            </div>

            
            <div class="mb-3">
                <label for="itemImage" class="form-label">Image</label>
                <input type="file" class="form-control" id="itemImage" name="itemImage">
                <img src="../uploads/menu_items/<?php echo $menu_item['image_url']; ?>" alt="Current Image">
            </div>

            
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
