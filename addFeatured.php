<?php
include "db.php";

// Check if the 'prod_id' parameter is set in the URL
if (isset($_GET['prod_id'])) {
    // Retrieve the product ID from the URL
    $prod_id = $_GET['prod_id'];
    
    // Retrieve data of the selected product from the 'products' table
    $select_sql = "SELECT * FROM products WHERE prod_id='$prod_id'";
    $result = $conn->query($select_sql);
    
    if ($result->num_rows > 0) {
        // Fetch the row data
        $row = $result->fetch_assoc();
        
        // Insert the product into the 'featured_products' table
        $insert_sql = "INSERT INTO featured_products (prod_id, prod_name, prod_description, prod_price, thumbnail_image) 
                       VALUES ('$prod_id', '{$row['prod_name']}', '{$row['prod_description']}', '{$row['prod_price']}', '{$row['thumbnail_image']}')";
        if ($conn->query($insert_sql) === TRUE) {
            // Display JavaScript alert
            echo '<script>alert("Product marked as featured successfully.");</script>';
        } else {
            echo "Error: " . $insert_sql . "<br>" . $conn->error;
        }
    } else {
        echo "No product found with the provided ID.";
    }
} else {
    echo "Product ID not specified.";
}

// Redirect back to the previous page after alert
echo '<script>window.location.href = "view_product.php";</script>';
exit();
?>
