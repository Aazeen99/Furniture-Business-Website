<?php
    include "adminNavigation.php";
    include "db.php";
    
   // Check if the user is logged in
   if (!isset($_SESSION['admin_id']) && $_SESSION['admin_name'] !== true) {
       // User is not logged in, redirect them to the login page
       header('Location: adminLoginForm.php');
       exit;
   }
   

    // Fetch the current record from the database
    $query = "SELECT * FROM customize_about_us WHERE about_us_id = 1";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $about_us_text = $row['about_us'];

    // Check if the form is submitted for update
    if (isset($_POST['update'])) {
        $about_us_text = $_POST['about_us'];

        // Update the record in the database
        $sql = "UPDATE customize_about_us SET about_us = '$about_us_text' WHERE about_us_id = 1";
        $result = $conn->query($sql);

        if ($result) {
            echo '<script>alert("Record updated successfully.");</script>';
        } else {
            echo '<script>alert("Failed to update record.");</script>';
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit About Us</title>
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

        textarea {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 20px;
            border-radius: 6px;
            margin-top: 10px;
            resize: vertical; /* Allow vertical resizing */
            min-height: 150px; /* Set a minimum height */
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
        <h1>Edit About Us</h1>
        <form action="customizeAboutUs.php" method="post">
            <textarea id="about_us_id" name="about_us" required><?php echo $about_us_text; ?></textarea>
            <input type="submit" name="update" value="Update">
        </form>
    </div>
</body>
</html>
