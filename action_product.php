<?php
include "db.php";

if (isset($_POST['submit'])) {
    $name = $_POST['prod_name'];
    $description = $_POST['prod_description'];
    $price = $_POST['prod_price'];

    // Handle thumbnail image upload
    $thumbnailName = $_FILES['thumbnail_image']['name'];
    $thumbnailTempName = $_FILES['thumbnail_image']['tmp_name'];
    $thumbnailFolder = 'thumbnailFolder/' . $thumbnailName;

    if (move_uploaded_file($thumbnailTempName, $thumbnailFolder)) {
        echo "Thumbnail image uploaded successfully.<br>";
    } else {
        echo "Error uploading thumbnail image.<br>";
    }

    // Handle multiple side images upload
    $sideImages = $_FILES['side_images'];
    $totalSideImages = count($sideImages['name']);
    $sideImagesFolder = 'sideImagesFolder/';

    // Ensure exactly 4 images are selected
    if ($totalSideImages != 4) {
        echo "<script>alert('Please upload exactly 4 side images.');</script>";
        exit; // Stop further execution
    }

    // Insert product information into the database
    $sql = "INSERT INTO products (prod_name, prod_description, prod_price, thumbnail_image) VALUES ('$name', '$description', '$price', '$thumbnailName')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully.";
        $lastProductId = $conn->insert_id; // Get the ID of the last inserted product

        // Insert side images into the sideimages table
        for ($i = 0; $i < $totalSideImages; $i++) {
            $sideImageName = $sideImages['name'][$i];
            $sideImageTempName = $sideImages['tmp_name'][$i];
            $sideImagePath = $sideImagesFolder . basename($sideImageName);

            if (move_uploaded_file($sideImageTempName, $sideImagePath)) {
                $sql = "INSERT INTO sideimages (prod_id, side_image) VALUES ('$lastProductId', '$sideImageName')";
                
                if ($conn->query($sql) === TRUE) {
                    echo "Side image " . basename($sideImageName) . " inserted successfully.<br>";
                } else {
                    echo "Error inserting side image " . basename($sideImageName) . ": " . $conn->error . "<br>";
                }
            } else {
                echo "Error uploading side image " . basename($sideImageName) . ".<br>";
            }
        }
        
        // Redirect with JS alert after successful insertion
        echo "<script>
                alert('Product has been added successfully.');
                window.location.href = 'insert_product.php';
              </script>";
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
