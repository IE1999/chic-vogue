<!--connect file-->
<?php
    include('../includes/connect.php');
    include('../functions/common_function.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chic Vogue - User Profile</title>
    <!--Bootstrap link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--Font Awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" 
    referrerpolicy="no-referrer" />
    <!--CSS Link-->
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <!--Bootstrap navbar-->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <img src="../img/logo.png" alt="logo" class="logo">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="../index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../display_all.php">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="profile.php">My Account</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item();?></sup></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Total: $ <?php total_price();?> </a>
            </li>
        </ul>
        <!--search bar-->
        <form class="d-flex" action="../search_product.php" method="get">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
            <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
        </form>
    </div>
    </nav>
    <!--calling cart function-->
    <?php 
    cart();
    ?>

    <!--secondary nav-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <ul class="navbar-nav me-auto">
            <?php 
                //checks if user is logged in
                if(!isset($_SESSION['username'])){
                    echo "<li class=nav-item>
                    <a class='nav-link' href='#'>Welcome Guest</a>
                </li>";
                }else{
                    //if user is logged in
                    echo"<li class=nav-item>
                    <a class='nav-link' href='#'>Welcome".$_SESSION['username']."</a>
                    </li>";
                }

            //checks if user is logged in
            if(!isset($_SESSION['username'])){
                echo "<li class=nav-item>
                <a class='nav-link' href='./users_area/user_login.php'>Login</a>
                </li>";
            }else{
                echo"<li class=nav-item>
                <a class='nav-link' href='./users_area/logout.php'>Logout</a>
                </li>";
            }
            ?>
        </ul>
    </nav>

    <div class="bg-light">
        <h3 class="text-center">Chic Vogue</h3>
        <p class="text-center">"Where commerce and connections intersect"</p>
    </div>
    <!--sidebar-->
    <div class="row">
        <div class="col-md-2 p-0">
            <ul class="navbar-nav bg-secondary text-center">
                <li class="nav-item bg-info">
                    <a class="nav-link text-light" href="#"><h4>Profile</h4></a>
                </li>
                <!--fetching user profile picture from database to display image-->
                <?php 
                    $username=$_SESSION['username'];
                    $user_img="SELECT * FROM `user_table` WHERE  username = '$username'";
                    //runs the query
                    $result_image=mysqli_query($conn,$user_img);
                    $row_img=mysqli_fetch_array($result_image);
                    $user_image=$row_img['user_image'];
                    echo "<li class='nav-item'>
                    <img src='./user_images/$user_image' class='profile_img'>
                    </li>";
                ?>
                <li class="nav-item">
                    <a class="nav-link text-light" href="profile.php">Pending Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="profile.php?edit_account">Edit Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="profile.php?my_orders">My Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="profile.php?delete_account">Delete Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
        <div class="col-md-10 text-center">
            <!-- display pending orders and edit account page -->
            <?php get_order_details(); 
            if(isset($_GET['edit_account'])){
                include('edit_account.php');
            }
            if(isset($_GET['my_orders'])){
                include('user_orders.php');
            }
            //display delete account page
            if(isset($_GET['delete_account'])){
                include('delete_account.php');
            }
            ?>
        </div>
    </div>
    

    <!--footer menu-->
    <div class="bg-info p-3 text-center">
        <p>All Rights RESERVED &copy; Ivan Eskic 2024</p>
    </div>
</div>
<!-- Include jQuery Link-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!--bootstrap js link-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" 
integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>