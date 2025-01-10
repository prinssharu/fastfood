<?php
include '../connect/config.php';

if (isset($_GET['menu_id'])) {
    $menu_id = $_GET['menu_id'];

    $query = "DELETE FROM menu_items WHERE menu_id = $menu_id";
    if (mysqli_query($conn, $query)) {
        header("Location: manage_menu.php");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
?>
