<?php
include "db.php";

if (isset($_GET['prod_id'])) {
    $prod_id = $_GET['prod_id'];

    // Start a transaction
    $conn->begin_transaction();

    try {
        // First, delete related records in the sideimages table
        $delete_sideimages_sql = "DELETE FROM sideimages WHERE prod_id='$prod_id'";
        if (!$conn->query($delete_sideimages_sql)) {
            throw new Exception("Error deleting from sideimages: " . $conn->error);
        }

        // Then, delete the product from the products table
        $delete_product_sql = "DELETE FROM products WHERE prod_id='$prod_id'";
        if ($conn->query($delete_product_sql) === TRUE) {
            echo '<script>alert("Product removed from products.");</script>';
        } else {
            throw new Exception("Error deleting from products: " . $conn->error);
        }

        // Commit the transaction
        $conn->commit();

    } catch (Exception $e) {
        // Roll back the transaction if something failed
        $conn->rollback();
        echo $e->getMessage();
    }
} else {
    echo "Product ID not specified.";
}

echo '<script>window.location.href = "view_product.php";</script>';
exit();
?>