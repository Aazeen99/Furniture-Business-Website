<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #6F4E37;
        }

        .container {
            text-align: center;
        }

        form {
            width: 500px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            background: #f2f2f2;
        }

        input[type="text"],
        input[type="password"] {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 20px;
            border-radius: 6px;
        }
        
        input[type="text"] {
            margin-top: 10px;
        }

        input[type="submit"] {
            width: 30%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: #fff;
            cursor: pointer;
            border-radius: 10px;
        }

        input[type="submit"]:hover {
            background-color: #6F4E37;
            color: #f2f2f2;
        }

        h1 {
            font-size: 45px;
            margin-bottom: 20px;
            color: #f2f2f2;
        }

        .register-link {
            margin-top: 20px;
        }

        .register-link a {
            color: #FED8B1;
            text-decoration: underline;
        }

        .register-link a:hover {
            color: #007BFF;
        }

        p{
            color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>User Login</h1>
        <form action="userLogin.php" method="post">
            <input type="text" id="user_name" name="user_name" placeholder="Enter Username" required>
            <input type="password" id="user_password" name="user_password" placeholder="Enter Password" required>
            <input type="hidden" name="return_url" value="<?php echo isset($_GET['return_url']) ? htmlspecialchars($_GET['return_url']) : ''; ?>">
            <input type="submit" name="userLogin" value="Login">
        </form>
        <div class="register-link">
            <p>New to the website? <a href="userRegistration.php">Register now</a></p>
        </div>
    </div>
</body>
</html>
