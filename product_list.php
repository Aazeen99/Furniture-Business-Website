<?php 
include "userNavigation.php";
include "db.php";

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Products</title>
    <link rel="stylesheet" href="product_list.css">
</head>
<body>
    <h2 class="heading">Products</h2>
    <section>
    <div class="container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>
                <div class="card" onclick="location.href='product_detail.php?prod_id=<?php echo $row['prod_id']; ?>'">
                    <img src="thumbnailFolder/<?php echo $row['thumbnail_image']; ?>" alt="Product Thumbnail">
                    <div class="name-price-container">
                        <h4><?php echo $row['prod_name']; ?></h4>
                        <p class="price">$<?php echo $row['prod_price']; ?></p>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<p>No products found.</p>";
        }
        ?>
    </div>
    </section>

    <?php
        include "userFooter.php";
    ?>
</body>
</html>