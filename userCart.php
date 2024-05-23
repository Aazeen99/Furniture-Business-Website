<?php
include "userNavigation.php";
include "db.php";

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page with the return URL
    $current_url = urlencode($_SERVER['REQUEST_URI']);
    header("Location: userLoginForm.php?return_url=$current_url");
    exit();
}

// Get the logged-in user's ID
$user_id = $_SESSION['user_id'];

// Fetch cart items for the logged-in user from the database
$sql = "SELECT * FROM cart WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$cart_items = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <style>
        /* Basic styles for the cart page */
        *{
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            margin-top: 100px;
            background-color: #f2f2f2;
        }
        .cart-container {
            max-width: 800px;
            margin: 0 auto;
            margin-bottom: 100px;
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 10px;
            border: 2px solid #6F4E37;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #6F4E37;
            font-size: 50px;
            margin-bottom: 20px;
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .cart-item img {
            max-width: 100px;
            border-radius: 10px;
        }
        .cart-item-details {
            flex: 1;
            margin-left: 20px;
        }
        .cart-item-name {
            font-size: 1.2rem;
            font-weight: bold;
        }
        .cart-item-price {
            font-size: 1.1rem;
            margin-top: 8px;
            color: #6F4E37;
        }
        .cart-item-delete {
            margin-left: 20px;
        }
        .empty-cart {
            text-align: center;
            font-size: 1.2rem;
            color: #999;
        }
        .total {
            text-align: right;
            font-size: 1.2rem;
            font-weight: bold;
            margin-top: 20px;
        }
        .cart-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .btn {
            text-decoration: none;
            color: #fff;
            background-color: #6F4E37;
            padding: 10px 20px;
            border-radius: 10px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #f2f2f2;
            color: #6F4E37;
        }
    </style>
</head>
<body>
    <div class="cart-container">
        <h2>Your Cart</h2>
        <?php if (empty($cart_items)): ?>
            <p class="empty-cart">Your cart is empty.</p>
        <?php else: ?>
            <?php $total = 0; ?>
            <?php foreach ($cart_items as $item): ?>
                <div class="cart-item">
                    <img src="thumbnailFolder/<?php echo $item['thumbnail_image']; ?>" alt="Product Image">
                    <div class="cart-item-details">
                        <p class="cart-item-name"><?php echo $item['prod_name']; ?></p>
                        <p class="cart-item-description"><?php echo $item['prod_description']; ?></p>
                        <p class="cart-item-price">$<?php echo $item['prod_price']; ?></p>
                    </div>
                    <form action="deleteCartProduct.php" method="POST" class="cart-item-delete">
                        <input type="hidden" name="prod_id" value="<?php echo $item['prod_id']; ?>">
                        <button type="submit">Delete</button>
                    </form>
                </div>
                <?php $total += $item['prod_price']; ?>
            <?php endforeach; ?>
            <div class="total">
                <p>Total: $<?php echo number_format($total, 2); ?></p>
            </div>
            <div class="cart-actions">
                <a href="product_list.php" class="btn">Continue Shopping</a>
                <a href="checkout.php" class="btn">Proceed to Checkout</a>
            </div>
        <?php endif; ?>
    </div>

    <?php
        include "userFooter.php";
    ?>
</body>
</html>
