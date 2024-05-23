<?php
   session_start();

   // Check if the user is logged in
   if (!isset($_SESSION['admin_id']) && $_SESSION['admin_name'] !== true) {
       // User is not logged in, redirect them to the login page
       echo '<script>window.location.href = "adminLoginForm.php";</script>';
       exit;
   }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <style>@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
            *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            }
            .wrapper{
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background: linear-gradient(-135deg, #FED8B1, #6F4E37);
            /* background: linear-gradient(375deg, #1cc7d0, #2ede98); */
            /* clip-path: circle(25px at calc(0% + 45px) 45px); */
            clip-path: circle(25px at calc(100% - 45px) 45px);
            transition: all 0.3s ease-in-out;
            }
            #active:checked ~ .wrapper{
            clip-path: circle(75%);
            }
            .menu-btn{
            position: fixed;
            z-index: 2;
            right: 20px;
            /* left: 20px; */
            top: 20px;
            height: 50px;
            width: 50px;
            text-align: center;
            line-height: 50px;
            border-radius: 50%;
            font-size: 20px;
            color: #f2f2f2;
            cursor: pointer;
            background: linear-gradient(-135deg, #FED8B1, #6F4E37);
            /* background: linear-gradient(375deg, #1cc7d0, #2ede98); */
            transition: all 0.3s ease-in-out;
            }
            #active:checked ~ .menu-btn{
            background: #fff;
            color: #6F4E37;
            }
            #active:checked ~ .menu-btn i:before{
            content: "\f00d";
            }
            .wrapper ul{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            list-style: none;
            text-align: center;
            }
            .wrapper ul li{
            margin: 15px 0;
            }
            .wrapper ul li a{
            color: none;
            text-decoration: none;
            font-size: 20px; /* Adjusted font size */
            font-weight: 600;
            padding: 15px 30px;
            color: #543310;
            position: relative;
            line-height: 20px; /* Adjusted line height */
            transition: all 0.3s ease;
            }
            .wrapper ul li a:after{
            position: absolute;
            content: "";
            background: #fff;
            width: calc(100% + 20px); /* Adjusted width */
            height: 45px; /* Adjusted height */
            left: -10px; /* Adjusted left position */
            top: 50%;
            transform: translateY(-50%) scaleY(0);
            border-radius: 50px;
            z-index: -1;
            transition: transform 0.3s ease;
            }
            .wrapper ul li a:hover:after{
            transform: translateY(-50%) scaleY(1);
            }
            .wrapper ul li a:hover{
            color: #543310;
            }
            input[type="checkbox"]{
            display: none;
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
            font-size: 35px;
            font-weight: 600;
            }
        </style>
    
        <!--this link is to add the icons that are visible when we want to click on navigation bar symbol-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>
      <input type="checkbox" id="active">
      <label for="active" class="menu-btn"><i class="fas fa-bars"></i></label>
      <div class="wrapper">
         <ul>
            <li><a href="adminDashboard.php">Dasboard</a></li>
            <br>
            <li><a href="insert_product.php">Add Products</a></li>
            <li><a href="view_product.php">View Products</a></li>
            <li><a href="editFeatured.php">Edit Featured Products</a></li>
            <br>
            <li><a href="viewOrders.php">View Orders</a></li>
            <li><a href="viewQueries.php">View Queries</a></li>
            <br>
            <li><a href="addSlider.php">Add Home Slider</a></li>
            <li><a href="viewSlider.php">Edit Home Slider</a></li>
            <li><a href="customizeAboutUs.php">Customize About Us</a></li>
            <li><a href="viewFeedback.php">View Feedbacks</a></li>
            <li><a href="editTestimonials.php">Customize Testimonials</a></li>
            <br>
            <li><a href="adminLogout.php">Logout</a></li>
         </ul>
      </div>
   </body>
</html>
