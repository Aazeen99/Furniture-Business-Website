<?php
    include "adminNavigation.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Other Images</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        
        h2 {
            text-align: center;
            margin-top: 50px;
            font-size: 60px;
            color: #6f4e37
        }
        
        .images-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 30px;
            padding: 20px;
        }
        
        .images-container .card {
            flex: 1 1 calc(40% - 40px); /* Adjust the width of the cards */
            max-width: calc(40% - 40px); /* Maintain the width constraint */
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
            transition: transform 0.3s;
        }

        .images-container .card:hover {
            transform: scale(1.05);
        }
        
        .images-container img {
            width: 100%;
            height: auto;
            max-height: 200px; /* Adjust as needed */
            object-fit: cover;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <h2>Other Images</h2>
    <div class="images-container">
        <?php
        include "db.php";

        if(isset($_GET['prod_id'])) {
            $prod_id = $_GET['prod_id'];

            $sql = "SELECT * FROM sideimages WHERE prod_id = $prod_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="card"><img src="sideImagesFolder/' . $row['side_image'] . '" alt="Product Image"></div>';
                }
            } else {
                echo "<p>No side images found for this product.</p>";
            }
        }
        ?>
    </div>
</body>
</html>