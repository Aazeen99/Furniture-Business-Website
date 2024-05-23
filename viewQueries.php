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
    <title>Customer Queries</title>
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
    <h2>Customer Queries</h2>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Queries</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "db.php";
            $query = "SELECT * FROM queries";
            $data = mysqli_query($conn, $query);
            while ($result = mysqli_fetch_assoc($data)) {
            ?>
            <tr>
                <td><?php echo $result['query_id']; ?></td>
                <td><?php echo $result['firstname']; ?></td>
                <td><?php echo $result['lastname']; ?></td>
                <td><?php echo $result['email']; ?></td>
                <td><?php echo $result['query']; ?></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>
</html>
