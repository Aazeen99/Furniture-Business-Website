<?php
session_start();
require 'db.php'; // Include the database configuration file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['check_username'])) {
        $user_name = $_POST['user_name'];
        // Check if username is available
        $sql = "SELECT * FROM users WHERE user_name='$user_name'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            echo json_encode(['status' => 'error', 'message' => 'Username is not available']);
        } else {
            echo json_encode(['status' => 'success', 'message' => 'Username is available']);
        }
        exit();
    } else {
        $user_name = $_POST['user_name'];
        $user_password = $_POST['user_password'];

        // Insert the new user into the database without hashing the password
        $sql = "INSERT INTO users (user_name, user_password) VALUES ('$user_name', '$user_password')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('User registered successfully'); window.location.href = 'userLoginForm.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
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

        .sign-in-link {
            margin-top: 20px;
        }

        .sign-in-link a {
            color: #FED8B1;
            text-decoration: underline;
        }

        .sign-in-link a:hover {
            color: #007BFF;
        }

        p {
            color: #f2f2f2;
        }
    </style>
    <script>
        function validateForm() {
            var password = document.getElementById("user_password").value;
            var confirmPassword = document.getElementById("confirm_password").value;
            if (password != confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }
            return true;
        }

        function checkUsernameAvailability() {
            var username = document.getElementById("user_name").value;
            if (username == '') {
                alert('Please enter a username');
                return false;
            }
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "userRegistration.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status == 'error') {
                        alert(response.message);
                        return false;
                    } else {
                        document.getElementById("registrationForm").submit();
                    }
                }
            };
            xhr.send("check_username=true&user_name=" + username);
            return false; // Prevent form submission
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>User Registration</h1>
        <form id="registrationForm" action="userRegistration.php" method="post" onsubmit="return validateForm() && checkUsernameAvailability();">
            <input type="text" id="user_name" name="user_name" placeholder="Enter Username" required>
            <input type="password" id="user_password" name="user_password" placeholder="Enter Password" required>
            <input type="password" id="confirm_password" placeholder="Re-enter Password" required>
            <input type="submit" name="userRegister" value="Register">
        </form>
        <div class="sign-in-link">
            <p>Already have an account? <a href="userLoginForm.php">Sign in</a></p>
        </div>
    </div>
</body>
</html>
