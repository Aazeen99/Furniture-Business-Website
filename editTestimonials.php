<?php
include "adminNavigation.php";
include "db.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Testimonials</title>
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
        .action-buttons form {
            display: inline;
        }
        .action-buttons form button {
            margin-right: 5px;
        }
        button {
            width: 100px;
            height: 40px;
            border: none;
            border-radius: 5px;
        }
        #deletebtn {
            background-color: #FF0000;
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
    <h2>Testimonials</h2>
    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Testimonial</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Include database connection
            include "db.php";
            // Fetch testimonials from the database
            $query = "SELECT * FROM testimonials";
            $data = mysqli_query($conn, $query);
            while ($result = mysqli_fetch_assoc($data)) {
            ?>
            <tr>
                <td><?php echo $result['user_name']; ?></td>
                <td><?php echo $result['testimonial']; ?></td>
                <td class="action-buttons">
                    <form action="deleteTestimonials.php" method="GET" onsubmit="return confirm('Are you sure you want to delete this testimonial?')">
                        <input type="hidden" name="delete_id" value="<?php echo $result['user_id']; ?>">
                        <button type="submit" id="deletebtn">Delete</button>
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
