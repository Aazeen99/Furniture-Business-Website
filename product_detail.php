<?php 
include "userNavigation.php";
include "db.php";

if (isset($_GET['prod_id'])) {
    $prod_id = $_GET['prod_id'];
    $sql = "SELECT * FROM products WHERE prod_id = $prod_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "<p>Product not found.</p>";
        exit;
    }

    $side_images_sql = "SELECT * FROM sideimages WHERE prod_id = $prod_id";
    $side_images_result = $conn->query($side_images_sql);
    $side_images = [];
    if ($side_images_result->num_rows > 0) {
        while ($row = $side_images_result->fetch_assoc()) {
            $side_images[] = $row['side_image'];
        }
    }
} else {
    echo "<p>No product ID provided.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Details</title>
    <link rel="stylesheet" href="product_detail.css">
    <script>
        function changeThumbnail(imageSrc, element) {
            document.getElementById('main-thumbnail').src = imageSrc;
            var sideImages = document.querySelectorAll('.side-images img');
            sideImages.forEach(img => img.classList.remove('selected'));
            element.classList.add('selected');
        }
    </script>
</head>
<body>
<h2 class="heading">Product Details</h2>
    <section>
        <div class="card">
            <div class="img-container">
                <img id="main-thumbnail" src="thumbnailFolder/<?php echo $product['thumbnail_image']; ?>" alt="Product Thumbnail">
                <div class="side-images">
                    <img src="thumbnailFolder/<?php echo $product['thumbnail_image']; ?>" alt="Product Thumbnail" class="selected" onclick="changeThumbnail('thumbnailFolder/<?php echo $product['thumbnail_image']; ?>', this)">
                    <?php foreach ($side_images as $side_image) { ?>
                        <img src="sideImagesFolder/<?php echo $side_image; ?>" alt="Side Image" onclick="changeThumbnail('sideImagesFolder/<?php echo $side_image; ?>', this)">
                    <?php } ?>
                </div>
            </div>
            <div class="detail-container">
                <div class="name-price-container">
                    <h3><?php echo $product['prod_name']; ?></h3>
                    <p class="price">$<?php echo $product['prod_price']; ?></p>
                </div>
                <p><?php echo $product['prod_description']; ?></p>
                <form action="addcart.php" method="POST">
                    <input type="hidden" name="prod_id" value="<?php echo $product['prod_id']; ?>">
                    <input type="hidden" name="prod_name" value="<?php echo $product['prod_name']; ?>">
                    <input type="hidden" name="prod_description" value="<?php echo $product['prod_description']; ?>">
                    <input type="hidden" name="prod_price" value="<?php echo $product['prod_price']; ?>">
                    <input type="hidden" name="thumbnail_image" value="<?php echo $product['thumbnail_image']; ?>">
                    <button type="submit">Add to Cart</button>
                </form>
            </div>  
        </div>
    </section>
    
    <?php
        include "userFooter.php";
    ?>
</body>
</html>
