<?php
session_start();
include "db.php";

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page with the return URL
    $current_url = urlencode($_SERVER['REQUEST_URI']);
    header("Location: userLoginForm.php?return_url=$current_url");
    exit();
}


// Check if all required POST variables are set
if (isset($_POST['prod_id']) && isset($_POST['prod_name']) && isset($_POST['prod_description']) && isset($_POST['prod_price']) && isset($_POST['thumbnail_image'])) {
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];
    $prod_id = $_POST['prod_id'];
    $prod_name = $_POST['prod_name'];
    $prod_description = $_POST['prod_description'];
    $prod_price = $_POST['prod_price'];
    $thumbnail_image = $_POST['thumbnail_image'];

    // Add item to the cart
    $sql = "INSERT INTO cart (user_id, user_name, prod_id, prod_name, prod_description, prod_price, thumbnail_image) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isissds", $user_id, $user_name, $prod_id, $prod_name, $prod_description, $prod_price, $thumbnail_image);

    if ($stmt->execute()) {
        echo "<script>
            alert('Product added to cart successfully.');
            window.location.href = 'product_detail.php?prod_id=$prod_id';
        </script>";
    } else {
        echo "<script>
            alert('Failed to add product to cart: " . $conn->error . "');
            window.location.href = 'product_detail.php?prod_id=$prod_id';
        </script>";
    }

    $stmt->close();
} else {
    // Debugging: Log POST variables
    $post_data = json_encode($_POST);
    error_log("Missing product details. POST data: $post_data");

    // Redirect with an error
    $prod_id = isset($_POST['prod_id']) ? $_POST['prod_id'] : '';
    echo "<script>
        alert('Invalid product details provided.');
        window.location.href = 'product_detail.php?prod_id=$prod_id';
    </script>";
}
?>
