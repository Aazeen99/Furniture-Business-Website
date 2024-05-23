<?php
    include "adminNavigation.php";
   // Check if the user is logged in
   if (!isset($_SESSION['admin_id']) && $_SESSION['admin_name'] !== true) {
       // User is not logged in, redirect them to the login page
       header('Location: adminLoginForm.php');
       exit;
   }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Data</title>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #6f4e37;
            padding: 8px;
            text-align: left;
        }
        th {
            text-align: center;
            background-color: #6f4e37;
            color: #f2f2f2;
        }
        .slider_image {
            max-width: 150px; /* Adjust the width as needed */
            height: auto; /* Maintain aspect ratio */
        }
        .action-buttons form {
            display: inline;
        }
        .action-buttons form button {
            margin-right: 5px;
        }
        button {
            width: 80px;
            height: 40px;
            border: none;
            border-radius: 5px;
        }
        #deletebutton {
            background-color: red;
            color: white;
        }
        #editbutton {
            background-color: green;
            color: white;
        }
        h2{
            text-align: center;
            margin-top: 50px;
            font-size: 60px;
            color: #6f4e37;
        }
    </style>
</head>
<body>
    <h2>Home Slider</h2>
    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Tagline</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "db.php";
            $query = "SELECT * FROM home_slider";
            $data = mysqli_query($conn, $query);
            while ($result = mysqli_fetch_assoc($data)) {
            ?>
            <tr>
                <td>
                    <img src="<?php echo $result['slider_image']; ?>" alt="Slider Image" class="slider_image">
                </td>
                <td><?php echo $result['slider_tagline']; ?></td>
                <td class="action-buttons">
                    <form action="editSlider.php" method="GET">
                        <input type="hidden" name="slider_id" value="<?php echo $result['slider_id']; ?>">
                        <button type="submit" id="editbutton">Edit</button>
                    </form>
                    <form action="deleteSlider.php" method="GET">
                        <input type="hidden" name="delete_id" value="<?php echo $result['slider_id']; ?>">
                        <button type="submit" id="deletebutton">Delete</button>
                    </form>
                </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>
</html>
