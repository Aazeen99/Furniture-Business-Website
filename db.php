<?php
    $servername = "localhost:3306";
    $username = "root";
    $password = "";
    $dbname = "furniture_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        echo "Error connecting to database " .$conn->connect_error;
    }

?>