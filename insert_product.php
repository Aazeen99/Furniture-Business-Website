<?php
    include "adminNavigation.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <script>
        function validateFileInput() {
            const sideImagesInput = document.querySelector('input[name="side_images[]"]');
            if (sideImagesInput.files.length !== 4) {
                alert("Please upload exactly 4 side images.");
                sideImagesInput.value = ""; // Clear the input
            }
        }
    </script>
    <link rel="stylesheet" href="insert_product.css">
</head>
<body>
    <section>
        <h1>Add Product</h1>
        <div class="form-container">
        <form action="action_product.php" method="POST" enctype="multipart/form-data">
            <div class="inputs">
                <input class="prod_name_input"type="text" name="prod_name" placeholder="Product Name" required>
                <input class="prod_price_input"type="text" name="prod_price" placeholder="Product Price" required pattern="\d*" title="Please enter only numeric values"><br>
            </div>
            <textarea name="prod_description" placeholder="Product Description" rows="5" cols="105" required></textarea><br>
            <div class="files">
                <div>
                    <label for="thumbnail_image">Upload Thumbnail</label><br>
                    <input type="file" name="thumbnail_image" accept="image/*" required>
                </div>
                <div>
                    <label for="side_images[]">Upload Side Images</label><br>
                    <input type="file" name="side_images[]" multiple accept="image/*" onchange="validateFileInput()"><br>   
                </div>
            </div>
            <input class="add-btn" type="submit" name="submit" value="Add Product">
            
        </form>
        </div> 
    </section>
    
    
</body>
</html>
