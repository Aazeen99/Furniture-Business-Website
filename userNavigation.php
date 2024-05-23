<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Font import */
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

        /* Navbar styles */
        .navbar {
            position: fixed; /* Make the navbar stick to the top */
            top: 0; /* Position it at the top */
            width: 100%; /* Occupy full width */
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #6F4E37;
            color: #f2f2f2;
            height: 60px;
            z-index: 999; /* Ensure it's above other content */
        }

        .navbar-menu {
            list-style: none;
            display: flex;
            font-family: 'Poppins', sans-serif;
        }

        .navbar-menu li {
            margin: 0 15px;
        }

        .navbar-menu li a {
            text-decoration: none;
            color: #fff;
            font-weight: 500;
            padding: 10px 20px;
            transition: color 0.3s ease;
        }

        .navbar-menu li a:hover {
            color: #6F4E37;
            background-color: #f2f2f2;
            padding: 10px 20px;
            border-radius: 10px;
        }

        .logo {
            margin-left: 40px;
            text-decoration: none;
            font-size: 1.2rem;
            font-weight: bold;
            color: #fff;
        }
        
        .logo img{
            height: 40px;
            border-radius: 100%;
        }

        .navbar-left{
            display: flex;
        }

        .navbar-left p{
            margin-left: 5px;
            margin-top: 5px;
            font-size: 22px;
        }

        .navbar-right {
            display: flex;
            align-items: center;
        }

        .signin-btn {
            text-decoration: none;
            color: #6F4E37;
            padding: 8px 16px;
            border-radius: 20px;
            background-color: #FED8B1;
            transition: background-color 0.3s ease;
            margin-right: 20px;
        }

        .signin-btn:hover {
            background-color: #f2f2f2;
            border: #6F4E37 solid 1px;
            color: #6F4E37;
        }

        .cart-btn {
            text-decoration: none;
            color: #6F4E37;
            padding: 8px 16px;
            border-radius: 20px;
            background-color: #FED8B1;
            transition: background-color 0.3s ease;
            margin-right: 20px;
        }

        .cart-btn:hover {
            background-color: #f2f2f2;
            border: #6F4E37 solid 1px;
            color: #6F4E37;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <!-- Left section -->
        <div class="navbar-left">
            <a href="index.php" class="logo"><img class="fas fa-store" src="logo.png" alt="Furniture Website logo"></a>
            <p>Furniture Store</p>
        </div>
        
        <!-- Center section -->
        <div class="navbar-center">
            <ul class="navbar-menu">
                <li><a href="product_list.php">Products</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="feedbackForm.php">Feedback</a></li>
            </ul>
        </div>

        <!-- Right section -->
        <div class="navbar-right">
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="userLogout.php" class="cart-btn">Sign out</a>
            <?php else: ?>
                <a href="userLoginForm.php?return_url=index.php" class="signin-btn">Sign In</a>
            <?php endif; ?>
                <a href="userCart.php" class="cart-btn">Cart</a>
        </div>
    </nav>
</body>
</html>


