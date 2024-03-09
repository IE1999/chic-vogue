<!--connect file-->
<?php
include('includes/connect.php');
include('functions/common_function.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chic Vogue - Cart Details</title>
    <!--Bootstrap link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--Font Awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--CSS Link-->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!--Bootstrap navbar-->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <img src="img/logo.png" alt="logo" class=logo>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="display_all.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./users_area/user_registration.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup>
                                <?php cart_item(); ?>
                            </sup></a>
                    </li>
                </ul>
            </div>
        </nav>
        <!--calling cart function-->
        <?php
        cart();
        ?>

        <!--secondary nav-->
        <nav class="navbar navbar-expand-lg navbar-dark">
            <ul class="navbar-nav me-auto">
                <?php
                                //checks if user is logged in
                                if(!isset($_SESSION['username'])){
                                    echo "<li class=nav-item>
                                    <a class='nav-link' href='#'>Welcome Guest</a>
                                </li>";
                                }else{
                                    //displays welcome message if user is logged in
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

        <!--table to display items in cart-->
        <div class="container">
            <div class="row">
                <form action="" method="post">
                    <table class="table table-bordered text-center">
                        <tbody>
                            <!--php code to display dynamic data-->
                            <?php
                            global $conn; //connect to database
                            $get_ip_add = getIPAddress(); //save ip address for each user
                            $total = 0; //initialize value as 0
                            $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'"; //Fetches records from database and stores it
                            $result = mysqli_query($conn, $cart_query);
                            $result_count = mysqli_num_rows($result); //counts number of rows in database
                            if ($result_count > 0) {
                                echo "                
                            <thead>
                                <tr>
                                    <th>Product Title</th>
                                    <th>Product Image</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Remove</th>
                                    <th colspan='2'>Operations</th>
                                </tr>
                            </thead>
                            ";
                                while ($row = mysqli_fetch_array($result)) {
                                    //fetching data from table
                                    $product_id = $row['product_id'];
                                    $select_products = "SELECT * FROM `products` WHERE product_id='$product_id'";
                                    //executes record
                                    $result_products = mysqli_query($conn, $select_products);
                                    //fetches product details and stores in an array
                                    while ($row_price = mysqli_fetch_array($result_products)) {
                                        $product_price = array($row_price['product_price']);
                                        $price_table = $row_price['product_price'];
                                        $product_title = $row_price['product_title'];
                                        $product_img1 = $row_price['product_img1'];
                                        $product_values = array_sum($product_price); //array sum of all products in cart
                                        $total += $product_values;

                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $product_title; ?>
                                            </td>
                                            <td><img src="admin/product_imgs/<?php echo $product_img1 ?>" class="cart-img"></td>
                                            <!--input field for quantity-->
                                            <td><input type="text" class="form-input w-50" name="qty"></td>
                                            <!--php code to update cart quantity-->
                                            <?php
                                            $get_ip_add = getIPAddress();
                                            if (isset($_POST['update_cart'])) {
                                                $quantity = $_POST['qty'];
                                                $update_cart = "UPDATE `cart_details` set quantity=$quantity WHERE ip_address='$get_ip_add'";
                                                $result_quantity = mysqli_query($conn, $update_cart); //executes query
                                                $total_price = $total_price * $quantity;
                                            }
                                            ;
                                            ?>
                                            <td>$
                                                <?php echo $price_table; ?>
                                            </td>
                                            <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>"></td>
                                            <td>
                                                <!-- <button class="bg-info px-3 py-2 border-0 mx-3">Update</button> -->
                                                <input type="submit" value="Update Cart" class="bg-info px-3 py-2 border-0 mx-3"
                                                    name="update_cart">
                                                <!-- <button class="bg-info px-3 py-2 border-0 mx-3">Remove</button> -->
                                                <input type="submit" value="Remove Cart" class="bg-info px-3 py-2 border-0 mx-3"
                                                    name="remove_cart">
                                            </td>
                                        </tr>
                                        <!--closes table inside while loop-->
                                    <?php
                                    } //end of inner if statement
                                }
                            } else {
                                echo "<h2 class='text-center text-danger'>Cart Is Empty</h2>";
                            }
                            ;
                            ?>
                        </tbody>
                    </table>
                    <!--subtotal-->
                    <div class="d-flex mb-5">
                        <?php
                        // global $conn; //connect to database
                        $get_ip_add = getIPAddress(); //save ip address for each user
                        $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'"; //Fetches records from database and stores it
                        $cart_result = mysqli_query($conn, $cart_query);
                        $result_count = mysqli_num_rows($cart_result); //counts number of rows in database
                        // hides buttons and total if cart is empty
                        if ($result_count > 0) {
                            echo "
                        <h4 class='px-4'>Subtotal: <strong class='text-info'> $total </strong></h4>
                        <input type='submit' value='Continue Shopping' class='bg-info px-3 py-2 border-0 mx-3' name='continue_shopping'>
                        <button id='checkout' class='bg-secondary px-3 py-2 border-0'>
                        <a href='./users_area/checkout.php' class='text-light text-decoration-none'>Checkout</a>
                        </button>";
                        } else {
                            echo "<input type='submit' value='Continue Shopping' class='bg-info 
                            px-3 py-2 border-0 mx-3' name='continue_shopping'>";
                        }

                        if (isset($_POST['continue_shopping'])) {
                            echo "<script>window.open('index.php','_self')</script>";
                        }
                        ?>
                    </div>
            </div>
        </div>
        </form>
        <!--function to remove items from cart-->
        <?php
        function remove_cart_item()
        {
            global $conn;
            if (isset($_POST['remove_cart'])) {
                foreach ($_POST['removeitem'] as $remove_id) {
                    echo $remove_id;
                    $delete_query = "DELETE FROM `cart_details` WHERE product_id=$remove_id";
                    $run_delete = mysqli_query($conn, $delete_query);
                    if ($run_delete) {
                        echo "<script>window.open('cart.php','_self')</script>";
                    }
                }
            }
        }
        echo remove_cart_item();
        ?>

        <!--footer menu-->
        <div class="bg-info p-3 text-center">
            <p>All Rights RESERVED &copy; Ivan Eskic 2024</p>
        </div>
    </div>

    <!-- Include jQuery Link -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!--bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>

</html>