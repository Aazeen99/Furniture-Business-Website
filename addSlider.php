<?php
    include "adminNavigation.php";
    include "db.php";
   // Check if the user is logged in
   if (!isset($_SESSION['admin_id']) && $_SESSION['admin_name'] !== true) {
       // User is not logged in, redirect them to the login page
       header('Location: adminLoginForm.php');
       exit;
   }


    if (isset($_POST['add'])) {
        $slider_tagline = $_POST['slider_tagline'];
        $slider_image = $_FILES['slider_image']['name']; 
        $temp_name = $_FILES['slider_image']['tmp_name'];
        $folder = "slider images/".$slider_image;
        
        // Move the uploaded image to the desired folder
        move_uploaded_file($temp_name, $folder);
        
        // Insert the product information along with the image path into the database
        $sql = "INSERT INTO `home_slider`(`slider_tagline`, `slider_image`) VALUES ('$slider_tagline', '$folder')";
        $result = $conn->query($sql);
        
        if ($result == TRUE) {
            // Display JavaScript alert for successful record entry
            echo '<script>alert("New record created successfully.");</script>';
        } 
        else {
            echo '<script>alert("Failure to add record.");</script>';
        } 
        
        $conn->close(); 
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Slider</title>
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

        input[type="text"]{
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 20px;
            border-radius: 6px;
            margin-top: 10px;
        }

        input[type="file"]{
            display: block;
            margin-bottom: 20px;
            border-radius: 5px;
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
        <h1>Edit Home Slider</h1>
        <form action="addSlider.php" method="post" enctype="multipart/form-data">
            <input type="text" id="tagline" name="slider_tagline" placeholder="Enter Your Tagline Here" required>
            <input type="file" id="slider-image" name="slider_image" required>
            <input type="submit" name="add" value="Add">
        </form>
    </div>
</body>
</html>
