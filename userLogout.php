<?php 

session_start();

$_SESSION = array();

session_destroy();

// Display JavaScript alert with a delay
echo '<script>
    setTimeout(function() {
        alert("Logged out successfully");
        window.location.href = "index.php";
    }, 100);
</script>';
exit();
?>
