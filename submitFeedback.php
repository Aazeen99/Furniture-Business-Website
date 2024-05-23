<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page
    header("Location: userLoginForm.php");
    exit();
}

include "userNavigation.php";
// Include database connection
include "db.php";

// Check if the form is submitted
if (isset($_POST['submitFeedback'])) {
    // Retrieve user information from session
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];

    // Validate and sanitize feedback
    $feedback = htmlspecialchars($_POST['feedback']);

    // Insert feedback into the database
    $sql = "INSERT INTO feedback (user_id, user_name, feedback) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iss", $user_id, $user_name, $feedback);

    if (mysqli_stmt_execute($stmt)) {
        // Feedback inserted successfully
        echo "Feedback submitted successfully!";
        // JavaScript alert
        echo '<script>alert("Feedback submitted successfully!");</script>';
        // Redirect to index.php after displaying the alert
        echo '<script>window.location.href = "index.php";</script>';
        exit();
    } else {
        // Error occurred while inserting feedback
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    // If the form is not submitted, redirect to the feedback page
    header("Location: submitFeedback.php");
    exit();
}
?>
