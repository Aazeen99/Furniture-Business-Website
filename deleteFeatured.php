<?php
include "db.php";

if (isset($_GET['prod_id'])) {
    $prod_id = $_GET['prod_id'];
    
    $delete_sql = "DELETE FROM featured_products WHERE prod_id='$prod_id'";
    if ($conn->query($delete_sql) === TRUE) {
        echo '<script>alert("Product removed from featured products.");</script>';
    } else {
        echo "Error: " . $delete_sql . "<br>" . $conn->error;
    }
} else {
    echo "Product ID not specified.";
}

echo '<script>window.location.href = "editFeatured.php";</script>';
exit();
?>
