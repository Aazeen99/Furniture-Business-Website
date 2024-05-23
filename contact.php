<?php
include "userNavigation.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: block;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f2f2f2;
        }

        .body-div{
            display: flex;
            justify-content: center;
            margin-bottom: 50px;
        }

        .container {
            text-align: center;
            margin-top: 100px;
            margin-bottom: 100px;
        }

        form {
            width: 500px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            background: #6F4E37;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 6px;
            border: 1px solid #6F4E37;
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
            margin-top: 80px;
            margin-bottom: 20px;
            color: #6F4E37;
        }

        .contact-form input[type="text"],
        .contact-form input[type="email"] {
            width: calc(100% - 20px);
        }

        .contact-form textarea {
            width: calc(100% - 20px);
            height: 150px;
            border: 1px solid #6F4E37;
        }
    </style>
</head>
<body>
    <div class="body-div">
        <div class="container">
            <h1>Contact Us</h1>
            <form class="contact-form" action="submitQuery.php" method="post">
                <div class="name">
                    <input type="text" id="first_name" name="first_name" placeholder="First Name" required>
                    <input type="text" id="last_name" name="last_name" placeholder="Last Name" required>
                </div>
                <input type="email" id="email" name="email" placeholder="Email Address" required>
                <textarea id="message" name="message" placeholder="Your Message" required></textarea>
                <input type="submit" name="submit" value="Submit">
            </form>
        </div>
    </div>

    <?php
        include "userFooter.php";
    ?>
</body>
</html>
