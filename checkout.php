<?php
include "userNavigation.php";
include "db.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {
    echo "<p>Please log in to proceed to checkout.</p>";
    echo "<a href='userLoginForm.php'>Login</a>";
    exit;
}

// Get the logged-in user's ID and name
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

// Fetch cart items for the logged-in user from the database
$sql = "SELECT * FROM cart WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$cart_items = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $user_address = $_POST['user_address'];
    $user_zip = $_POST['user_zip'];
    $user_phone = $_POST['user_phone'];
    $payment_method = $_POST['payment_method'];

    // Calculate the total amount
    $total_amount = 0;
    foreach ($cart_items as $item) {
        $total_amount += $item['prod_price'];
    }

    // Insert order details into the Orders table
    $sql = "INSERT INTO orders (user_id, user_name, total_amount, user_address, user_zip, user_phone, payment_method) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isissss", $user_id, $user_name, $total_amount, $user_address, $user_zip, $user_phone, $payment_method);
    $stmt->execute();

    // Clear the cart after placing the order
    $sql = "DELETE FROM cart WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    echo "<script>
        alert('Your order has been placed successfully.');
        window.location.href = 'product_list.php';
    </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: block;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f2f2f2;
        }

        .body-div{
            display: flex;
            justify-content: center;
            margin-top: 100px;
            margin-bottom: 100px;    
        }

        .checkout-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            border: 2px solid #6F4E37;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 50px;
            color: #6F4E37;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .cart-summary {
            margin-bottom: 20px;
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .total {
            text-align: right;
            font-weight: bold;
            margin-top: 20px;
        }
        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #6F4E37;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #5a3f2b;
        }
    </style>
</head>
<body>
    <div class="body-div">
        <div class="checkout-container">
            <h2>Checkout</h2>
            <form method="POST" action="">
                <div class="cart-summary">
                    <?php if (empty($cart_items)): ?>
                        <p>Your cart is empty.</p>
                    <?php else: ?>
                        <?php $total = 0; ?>
                        <?php foreach ($cart_items as $item): ?>
                            <div class="cart-item">
                                <span><?php echo $item['prod_name']; ?> ($<?php echo $item['prod_price']; ?>)</span>
                            </div>
                            <?php $total += $item['prod_price']; ?>
                        <?php endforeach; ?>
                        <div class="total">
                            <p>Total: $<?php echo number_format($total, 2); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea name="user_address" id="address" required></textarea>
                </div>
                <div class="form-group">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" name="user_zip" id="zipcode" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" name="user_phone" id="phone" required>
                </div>
                <div class="form-group">
                    <label for="payment_method">Payment Method</label>
                    <select name="payment_method" id="payment_method" required>
                        <option value="Credit Card">Credit Card</option>
                        <option value="Cash">Cash</option>
                        <option value="PayPal">PayPal</option>
                    </select>
                </div>
                <button type="submit" class="btn">Place Order</button>
            </form>
        </div>

    </div>

    <?php
        include "userFooter.php";
    ?>
</body>
</html>
