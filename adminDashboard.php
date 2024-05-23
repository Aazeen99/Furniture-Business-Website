<?php 
    include "adminNavigation.php";
    if (isset($_SESSION['admin_id']) && isset($_SESSION['admin_name'])) {

    ?>

        <!DOCTYPE html>
        <html>
            <head>
                <title>Admin Dashboard</title>
                <style>
                    body{
                        background-color: #f2f2f2;
                    }
                    .content{
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        z-index: -1;
                        text-align: center;
                        width: 100%;
                        color: #202020;
                    }
                    .content .title{
                        font-size: 40px;
                        font-weight: 700;
                    }
                    .content p{
                        font-size: 25px;
                        font-weight: 500;
                    }
                </style>
            </head>
            <body>
                <div class="content">
                    <div class="title">
                        Welcome to the Admin Dashboard, <?php echo $_SESSION['admin_name']; ?>
                    </div>
                    <p>
                        Select your options from the navigation bar in the corner.
                    </p>
                </div>
            </body>
        </html>
        <?php 
    }

    else{
        header("Location: adminDashbboard.php");
        exit();
        }
?>