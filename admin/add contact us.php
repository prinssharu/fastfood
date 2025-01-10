<?php
$servername = "localhost";
$username = "root";
$password = "diru1234";
$dbname = "canteen";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $head = $_POST['head'];
    $booking = $_POST['booking'];
    $general = $_POST['general'];
    $technical = $_POST['technical'];
    $googlemap = $_POST['googlemap'];

    
    if (empty($head) || empty($booking) || empty($general) || empty($technical) || empty($googlemap)) {
        echo "All fields are required.";
        exit;
    }

    
    $sql = "INSERT INTO contact_us (head, booking, general, technical, googlemap) 
            VALUES (?, ?, ?, ?, ?);";

   
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $head, $booking, $general, $technical, $googlemap);
    

$sql = "SELECT googlemap FROM contact_us WHERE id = ?"; 
$stmt = $conn->prepare($sql);
$id = 1; 
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($googleMapLink);
$stmt->fetch();
?>

<div id="map">
    <?php if (!empty($googleMapLink)) { ?>
        <iframe 
            src="<?= htmlspecialchars($googleMapLink) ?>" 
            width="100%" 
            height="450" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    <?php } else { ?>
        <p>No Google Map link available.</p>
    <?php } ?>
</div>

<?php

$stmt->close();



    
    if ($stmt->execute()) {
        
        header("Location: contact us management.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    
    $stmt->close();
}


$conn->close();
?>
