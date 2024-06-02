<?php 
include "adminNavigation.php";
include "db.php";

$sql = "SELECT * FROM products";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Products</title>
    <link rel="stylesheet" href="view_product.css">
</head>
<body>
    <h2>Product List</h2>
    <section>
    
        <!-- <h2>Products</h2> -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th colspan="2">Product Name</th>
                    <th colspan="6">Product Description</th>
                    <th>Product Price</th>
                    <th colspan="4">Product Images</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody> 
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <tr>
                            <td><?php echo $row['prod_id']; ?></td>
                            <td colspan="2"><?php echo $row['prod_name']; ?></td>
                            <td colspan="6"><?php echo $row['prod_description']; ?></td>
                            <td><?php echo $row['prod_price']; ?></td>
                            <td colspan="2"> 
                                <img  height="150px" width="150px"src="thumbnailFolder/<?php echo $row['thumbnail_image']; ?>" alt="Product Thumbnail">
                            </td>
                            <td colspan="2" class="show-other-btn-cont">
                                <a style="background-color: rgb(255, 162, 0);" href="view_side_images.php?prod_id=<?php echo $row['prod_id']; ?>">Others</a>
                            </td>
                            <td colspan="2" class="action-btn-cont">
                                <a style="background-color: red;padding: 6px 16px;" href="delete_product.php?prod_id=<?php echo $row['prod_id']; ?>">Delete</a><br>
                                <a style="background-color: blue;" href="addFeatured.php?prod_id=<?php echo $row['prod_id']; ?>">Feature</a><br>
                            </td>
                        </tr>                       
                <?php
                    }
                }
                ?>                
            </tbody>   
        </table>
    </section>
</body>
</html>
