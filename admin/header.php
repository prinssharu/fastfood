<?php
include 'config.php';


$query = "SELECT * FROM settings WHERE id = '1'"; 
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);


$logoUrl = $row['logo_url'];
$name = $row['name'];
?>


<img src="<?php echo $logoUrl; ?>" alt="Logo" style="width: 100px;">
<h1><?php echo $name; ?></h1>
