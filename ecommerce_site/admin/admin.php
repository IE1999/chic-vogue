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
    <title>Admin Dashboard</title>
    <!--Bootstrap Link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--Style CSS Link-->
    <link rel="stylesheet" href="../style.css">
    <!--Font Awesome Link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .product_img {
            width: 100px;
            object-fit: contain;
        }
    </style>
</head>

<body>
    <!--Navbar-->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <img src="../img/logo.png" class="logo">
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Welcome</a>
                        </li>
                    </ul>

                </nav>
            </div>
        </nav>
        <!--second nav-->
        <div class="bg-light">
            <h3 class="text-center p-2">Manage Details</h3>
        </div>
        <!--Third nav(main nav)-->
        <div class="row">
            <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
                <div class="p-3">
                    <a href="#"><img class="admin_img" src="../img/profile-pic.webp" alt=""></a>
                    <p class="text-light text-center">Admin Name</p>
                </div>
                <div class="button text-center">
                    <!--insert products button-->
                    <button class="my-3"><a href="insert_product.php" class="nav-link text-light my-1">Insert
                            Products</a></button>
                    <!--view products button-->
                    <button><a href="admin.php?view_products" class="nav-link text-light my-1">View
                            Products</a></button>
                    <!--insert categories button-->
                    <button>
                        <a href="admin.php?insert_category" class="nav-link text-light my-1">Insert Categories</a>
                    </button>
                    <!--view categories button-->
                    <button><a href="admin.php?view_categories" class="nav-link text-light my-1">View
                            Categories</a>
                    </button>
                    <!-- insert brands button -->
                    <button>
                        <a href="admin.php?insert_brand" class="nav-link text-light my-1">Insert Brands</a>
                    </button>
                    <!-- view brands -->
                    <button>
                        <a href="admin.php?view_brands" class="nav-link text-light my-1">View Brands</a>
                    </button>
                    <!-- all orders -->
                    <button>
                        <a href="admin.php?list_orders" class="nav-link text-light my-1">All Orders</a>
                    </button>
                    <!-- all payments -->
                    <button>
                        <a href="admin.php?list_payments" class="nav-link text-light my-1">All Payments</a>
                    </button>
                    <button>
                        <a href="admin.php?list_users" class="nav-link text-light my-1">List Users</a>
                    </button>
                    <button>
                        <a href="" class="nav-link text-light my-1">Logout</a>
                    </button>
                </div>
            </div>
        </div>

        <!--GET variables for inserting php pages into admin page-->
        <div class="container my-3">
            <?php
            //Inserting category
            if (isset($_GET['insert_category'])) {
                include('insert_categories.php');
            }
            //inserting brand
            if (isset($_GET['insert_brand'])) {
                include('insert_brands.php');
            }
            //including view products page
            if (isset($_GET['view_products'])) {
                include('view_products.php');
            }
            //include edit products page
            if (isset($_GET['edit_products'])) {
                include('edit_products.php');
            }
            //include delete products page
            if (isset($_GET['delete_products'])) {
                include('delete_products.php');
            }
            //include view categories page
            if (isset($_GET['view_categories'])) {
                include('view_categories.php');
            }
            //include view brands page
            if (isset($_GET['view_brands'])) {
                include('view_brands.php');
            }
            //include edit category page
            if (isset($_GET['edit_category'])) {
                include('edit_category.php');
            }
            //include edit brands page
            if (isset($_GET['edit_brands'])) {
                include('edit_brands.php');
            }
            //include delete category page
            if (isset($_GET['delete_category'])) {
                include('delete_category.php');
            }
            //include delete brands page
            if (isset($_GET['delete_brands'])) {
                include('delete_brands.php');
            }
            //include list orders page
            if (isset($_GET['list_orders'])) {
                include('list_orders.php');
            }
            //include list payments page
            if (isset($_GET['list_payments'])) {
                include('list_payments.php');
            }
            //include list users page
            if (isset($_GET['list_users'])) {
                include('list_users.php');
            }
            ?>
        </div>

        <!--footer menu-->
        <div class="bg-info p-3 text-center">
            <p>All Rights RESERVED &copy; Ivan Eskic 2024</p>
        </div>
    </div>
    <!--Boostrap JS Link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>