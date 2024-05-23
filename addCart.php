<?php
session_start();
include "db.php";

if (isset($_POST['prod_id']) && isset($_POST['prod_name']) && isset($_POST['prod_description']) && isset($_POST['prod_price']) && isset($_POST['thumbnail_image'])) {
    $prod_id = $_POST['prod_id']; // Get the prod_id
    $_SESSION['prod_id'] = $prod_id; // Store prod_id in session
}

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page with the return URL and prod_id
    $current_url = "product_detail.php";
    $prod_id = isset($_SESSION['prod_id']) ? $_SESSION['prod_id'] : '';
    header("Location: userLoginForm.php?return_url=$current_url&prod_id=$prod_id");
    exit();
}

if (isset($_POST['prod_id']) && isset($_POST['prod_name']) && isset($_POST['prod_description']) && isset($_POST['prod_price']) && isset($_POST['thumbnail_image'])) {
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];
    $prod_id = $_POST['prod_id'];
    $prod_name = $_POST['prod_name'];
    $prod_description = $_POST['prod_description'];
    $prod_price = $_POST['prod_price'];
    $thumbnail_image = $_POST['thumbnail_image'];

    $sql = "INSERT INTO cart (user_id, user_name, prod_id, prod_name, prod_description, prod_price, thumbnail_image) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isissds", $user_id, $user_name, $prod_id, $prod_name, $prod_description, $prod_price, $thumbnail_image);

    if ($stmt->execute()) {
        // Product added successfully, redirect back to product detail page
        echo "<script>
            alert('Product added to Cart successfully.');
            window.location.href = 'product_detail.php?prod_id=$prod_id';
        </script>";
        exit();
    } else {
        // Failed to add product to cart
        $error_message = $conn->error;
        echo "<script>
            alert('Failed to add product to cart: $error_message');
            window.location.href = 'product_detail.php?prod_id=$prod_id';
        </script>";
        exit();
    }

    $stmt->close();
} else {
    // Invalid product details provided
    echo "<script>
        alert('Invalid product details provided.');
        window.location.href = 'product_detail.php';
    </script>";
    exit();
}
?>
