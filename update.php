<?php

include 'connect/config.php';


$query = "SELECT image_path FROM hero_section WHERE id = 1 LIMIT 1";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$currentImage = $row ? $row['image_path'] : 'img/hero.png';
?>

<div class="col-lg-6 text-center text-lg-end overflow-hidden">
    <img id="heroImage" class="img-fluid" src="<?php echo $currentImage; ?>" alt="Hero Image">
    <form action="upload_hero_image.php" method="post" enctype="multipart/form-data" class="mt-3">
        <div class="form-group">
            <input type="file" name="hero_image" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Upload New Image</button>
    </form>
</div>
