<?php
include "userNavigation.php";

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page with the return URL
    $current_url = urlencode($_SERVER['REQUEST_URI']);
    header("Location: userLoginForm.php?return_url=$current_url");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Feedback</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: block;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #6F4E37;
        }

        .body-div{
            display: flex;
            justify-content: center;
            background-color: #f2f2f2;
        }
        .container {
            text-align: center;
            margin-top: 100px;
            margin-bottom: 100px;
        }

        form {
            width: 500px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            background: #6F4E37;
        }

        textarea {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 20px;
            border-radius: 6px;
            resize: none;
        }

        input[type="submit"] {
            width: 30%;
            padding: 10px;
            background-color: #ECB176;
            border: 2px solid #ECB176;
            color: #6f4e37;
            cursor: pointer;
            border-radius: 10px;
        }

        input[type="submit"]:hover {
            border: 2px solid #f2f2f2;
            background-color: #6F4E37;
            color: #f2f2f2;
        }

        h1 {
            font-size: 45px;
            margin-top: 70px;
            margin-bottom: 20px;
            color: #6F4E37;
        }
    </style>
</head>
<body>
    <div class="body-div">
        <div class="container">
            <h1>Feedback</h1>
            <form action="submitFeedback.php" method="post">
                <textarea id="feedback" name="feedback" placeholder="Enter your feedback here" rows="8" required></textarea>
                <input type="submit" name="submitFeedback" value="Submit Feedback">
            </form>
        </div>
    </div>

    <?php
        include "userFooter.php";
    ?>
</body>
</html>
