<?php
    include "adminNavigation.php";
    include "db.php";

    // Check if slider_id is set in the URL
    if(isset($_GET['slider_id'])) {
        $slider_id = $_GET['slider_id'];
        
        // Retrieve slider information (tagline only) from the database
        $query = "SELECT slider_tagline FROM home_slider WHERE slider_id = '$slider_id'";
        $result = mysqli_query($conn, $query);
        
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $slider_tagline = $row['slider_tagline'];
        } else {
            // If no matching record found, redirect back to the slider page
            header('Location: editSlider.php');
            exit;
        }
    } else {
        // If slider_id is not set, redirect back to the slider page
        header('Location: editSlider.php');
        exit;
    }

    // Check if form is submitted for updating slider information
    if(isset($_POST['update'])) {
        $slider_tagline = $_POST['slider_tagline'];
        $slider_image = $_FILES['slider_image']['name'];
        $temp_name = $_FILES['slider_image']['tmp_name'];
        $folder = "slider images/".$slider_image;

        move_uploaded_file($temp_name, $folder);
        
        // Update slider information in the database
        $sql = "UPDATE home_slider SET slider_tagline = '$slider_tagline', slider_image = '$folder' WHERE slider_id = '$slider_id'";
        $result = $conn->query($sql);
        
        if($result == TRUE) {
            echo '<script>alert("Record updated successfully.");</script>';
        } 
        else {
            echo '<script>alert("Failed to update slider information.");</script>';
        }
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

        input[type="text"], input[type="file"] {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 20px;
            border-radius: 6px;
            margin-top: 10px;
        }

        input[type="file"] {
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
        <form action="" method="post" enctype="multipart/form-data">
            <label for="tagline">Tagline</label>
            <input type="text" id="tagline" name="slider_tagline" placeholder="Enter Your Tagline Here" value="<?php echo $slider_tagline; ?>" required>
            <label for="slider_image">Upload New Slider Image</label>
            <input type="file" id="slider-image" name="slider_image" required>
            <input type="submit" name="update" value="Update">
        </form>
    </div>
</body>
</html>
