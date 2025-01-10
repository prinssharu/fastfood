<?php

include 'connect/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['menu_category'])) {
    $menu_category = $_POST['menu_category'];

    
    $query = "SELECT * FROM menu_items WHERE category = '$menu_category'";
    $result = mysqli_query($conn, $query);

    $menu_items = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $menu_items[] = $row;
    }

    
    echo json_encode($menu_items);
    exit;
} else {
    
    echo json_encode(array('error' => 'Invalid request'));
    exit;
}
?>
