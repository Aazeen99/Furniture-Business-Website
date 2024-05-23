<?php 
include "adminNavigation.php";
include "db.php";

$sql = "SELECT * FROM featured_products";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Featured Products</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

*{
  font-family: "Poppins", sans-serif;
  font-optical-sizing: auto;
}
body{
    height: 100%;
    width: 100%;
    margin: 0;
    margin-top: 50px;
}
section{
    display: flex; 
    justify-content: center;
    align-items: center; 
    background-color: #f2f2f2;
    padding: 30px;
    
}
 table {
    border-collapse: collapse;
    width: 80%;
    border: 1px solid #6f4e37;

}
th{
    background-color: #6f4e37;
    color: #f2f2f2;
}

td{
    border-right: 1px solid #6f4e37;
    border-bottom: 1px solid #6f4e37;
    padding: 8px;
}

.product-thumbnail {
    max-width: 150px; /* Adjust the width as needed */
    height: auto;
}
.product-images {
    display: flex;
}
.product-images div {
    margin-right: 10px;
}
.other-images-btn {
    background-color: blue;
    color: white;
    padding: 5px 10px;
    border: none;
    cursor: pointer;
}
.show-other-btn-cont{
    padding: 8px;
}

.action-btn-cont{
    justify-content: center;
    align-items: center;
    padding: 16px;
}
a{
    padding: 6px 12px;
    border-radius: 6px;
    text-decoration: none;
    color: #fff;
    margin-top: 10px; 
    /* margin-top: 10px; */
}

h2{
    text-align: center;
    margin-top: 50px;
    font-size: 60px;
    color: #6f4e37;
}
    </style>
</head>
<body>
    <h2>Featured Products</h2>
    <section>
    
        <!-- <h2>Products</h2> -->
        <table class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Product Description</th>
                    <th>Product Price</th>
                    <th >Product Images</th>
                    <th >Actions</th>
                </tr>
            </thead>
            <tbody> 
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <tr>
                            <td><?php echo $row['prod_name']; ?></td>
                            <td><?php echo $row['prod_description']; ?></td>
                            <td><?php echo $row['prod_price']; ?></td>
                            <td> 
                                <img  height="150px" width="150px"src="thumbnailFolder/<?php echo $row['thumbnail_image']; ?>" alt="Product Thumbnail">
                            </td>
                            <td class="action-btn-cont">
                                <a style="background-color: red;padding: 6px 16px;" href="deleteFeatured.php?prod_id=<?php echo $row['prod_id']; ?>">Delete</a><br>
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
