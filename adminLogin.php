<?php 
session_start();   
include "db.php";

if (isset($_POST['admin_name']) && isset($_POST['admin_password'])) {

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $admin_name = validate($_POST['admin_name']);
    $admin_password = validate($_POST['admin_password']);

    if (empty($admin_name)) {
        header("Location: adminLoginForm.php?error=User Name is required");
        exit();
    }
    else if(empty($admin_password)){
        header("Location: adminLoginForm.php?error=Password is required");
        exit();
    }
    else{
        $sql = "SELECT * FROM admin WHERE admin_name='$admin_name' AND admin_password='$admin_password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['admin_name'] === $admin_name && $row['admin_password'] === $admin_password) {

                echo "Logged in!";

                $_SESSION['admin_name'] = $row['admin_name'];
                $_SESSION['admin_id'] = $row['admin_id'];

                header("Location: adminDashboard.php");
                exit();

            }
            else{
                header("Location: adminLoginForm.php?error=Incorrect Username or Password");
                exit();
            }

        }
        else{
            header("Location: adminLoginForm.php?error=Incorrect Username or Password");
            exit();
        }

    }

}
else{
    header("Location: adminLoginForm.php");
    exit();
}
?>
