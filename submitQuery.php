<?php
// Include the database configuration file
include "db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data and escape special characters
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Insert data into the queries table
    $sql = "INSERT INTO queries (firstname, lastname, email, query) VALUES ('$first_name', '$last_name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Message submitted successfully'); window.location.href = 'index.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
