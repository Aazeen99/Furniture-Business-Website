<?php 
session_start();   
include "db.php";

if (isset($_POST['user_name']) && isset($_POST['user_password'])) {

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $user_name = validate($_POST['user_name']);
    $user_password = validate($_POST['user_password']);
    $return_url = isset($_POST['return_url']) ? $_POST['return_url'] : 'product_detail.php';
    $prod_id = isset($_POST['prod_id']) ? $_POST['prod_id'] : '';

    if (empty($user_name)) {
        header("Location: userLoginForm.php?error=User Name is required&return_url=" . urlencode($return_url) . "&prod_id=" . urlencode($prod_id));
        exit();
    }
    else if(empty($user_password)){
        header("Location: userLoginForm.php?error=Password is required&return_url=" . urlencode($return_url) . "&prod_id=" . urlencode($prod_id));
        exit();
    }
    else{
        $sql = "SELECT * FROM users WHERE user_name='$user_name' AND user_password='$user_password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);
            if ($row['user_name'] === $user_name && $row['user_password'] === $user_password) {
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['user_id'] = $row['user_id'];

                // Redirect to the original page with the prod_id
                
                echo "<script>
                alert('You\'ve been logged in successfully');
                window.location.href = '$return_url?prod_id=$prod_id';
            </script>";
                exit();
            } else {
                header("Location: userLoginForm.php?error=Incorrect Username or Password&return_url=" . urlencode($return_url) . "&prod_id=" . urlencode($prod_id));
                exit();
            }

        }
        else{
            header("Location: userLoginForm.php?error=Incorrect Username or Password&return_url=" . urlencode($return_url) . "&prod_id=" . urlencode($prod_id));
            exit();
        }

    }
}
else{
    header("Location: userLoginForm.php?error=Unknown error");
    exit();
}
?>
