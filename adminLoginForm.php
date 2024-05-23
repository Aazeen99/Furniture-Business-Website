<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
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
        input[type="text"]{
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Login</h1>
        <form action="adminLogin.php" method="post">
            <input type="text" id="admin_name" name="admin_name" placeholder="Enter Username" required>
            <input type="password" id="admin_password" name="admin_password" placeholder="Enter Password" required>
            <input type="submit" name="adminLogin" value="Login">
        </form>
    </div>
</body>
</html>
