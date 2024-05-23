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
    <title>User Feedbacks</title>
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
        #testimonialbutton {
            background-color: #2196F3;
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
    <h2>Feedbacks</h2>
    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Feedbacks</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "db.php";
            $query = "SELECT * FROM feedback";
            $data = mysqli_query($conn, $query);
            while ($result = mysqli_fetch_assoc($data)) {
            ?>
            <tr>
                <td><?php echo $result['user_name']; ?></td>
                <td><?php echo $result['feedback']; ?></td>
                <td class="action-buttons">
                    <form action="addTestimonials.php" method="POST">
                        <input type="hidden" name="user_id" value="<?php echo $result['user_id']; ?>">
                        <input type="hidden" name="user_name" value="<?php echo $result['user_name']; ?>">
                        <input type="hidden" name="feedback" value="<?php echo $result['feedback']; ?>">
                        <button type="submit" id="testimonialbutton">Add as Testimonial</button>
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
