<?php
    session_start();
    include "db.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_id = $_POST['user_id'];
        $user_name = $_POST['user_name'];
        $feedback = $_POST['feedback'];

        $sql = "INSERT INTO testimonials (user_id, user_name, testimonial) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "iss", $user_id, $user_name, $feedback);
        
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            echo '<script>alert("Testimonial added successfully");</script>';
            echo '<script>window.location.href = "viewFeedback.php";</script>';
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        
        mysqli_stmt_close($stmt);
        mysqli_close($conn);        
    }
?>
