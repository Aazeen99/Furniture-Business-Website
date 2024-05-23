<?php
include "db.php";

    if(isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        
        $query = "DELETE FROM home_slider WHERE slider_id = $delete_id";
        $result = mysqli_query($conn, $query);
        
        if($result) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    } else {
        echo "No record ID provided for deletion.";
    }

header("Location: viewSlider.php");
exit();
?>
