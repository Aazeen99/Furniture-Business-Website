<?php
session_start();
include "db.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {
    echo "<p>Please log in to delete items from your cart.</p>";
    echo "<a href='userLoginForm.php'>Login</a>";
    exit;
}

// Check if the prod_id is set in the POST request
if (isset($_POST['prod_id'])) {
    $user_id = $_SESSION['user_id'];
    $prod_id = $_POST['prod_id'];

    // Prepare and execute the delete statement
    $sql = "DELETE FROM cart WHERE user_id = ? AND prod_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $prod_id);

    if ($stmt->execute()) {
        echo "<script>
            alert('Product removed from cart successfully.');
            window.location.href = 'userCart.php';
        </script>";
    } else {
        echo "<script>
            alert('Failed to remove product from cart: " . $conn->error . "');
            window.location.href = 'userCart.php';
        </script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>
        alert('Invalid product details provided.');
        window.location.href = 'userCart.php';
    </script>";
}
?>
