<?php
include('../includes/connect.php');
include('../functions/common_function.php');

//get method to retrieve user id
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
}

// getting total items and total price of all items from database
$get_ip = getIPAddress();
$total_price = 0;
$cart_price_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip'";
$result_cart_price = mysqli_query($conn, $cart_price_query);
//generates a random invoice number
$invoice_number = mt_rand();
$status = 'pending';

//counts number of rows
$count_products = mysqli_num_rows($result_cart_price);
while ($row_price = mysqli_fetch_array($result_cart_price)) {
    $product_id = $row_price['product_id'];
    $select_product_query = "SELECT * FROM `products` WHERE product_id=$product_id";
    $run_price = mysqli_query($conn, $select_product_query);
    //fetch product price
    while ($row_product_price = mysqli_fetch_array($run_price)) {
        $product_price = array($row_product_price['product_price']);
        $product_value = array_sum($product_price);
        $total_price += $product_value;//adds up the total price of all cart items
    }
}

// getting quantity from cart
$get_cart = "SELECT * FROM `cart_details`";
$run_cart = mysqli_query($conn, $get_cart);
$get_item_quantity = mysqli_fetch_array($run_cart);
$quantity = $get_item_quantity['quantity'];
if ($quantity == 0) {
    $quantity = 1;
    $subtotal = $total_price;
} else {
    $quantity = $quantity;
    $subtotal = $total_price * $quantity;
}

$insert_orders = "INSERT INTO `user_orders` (user_id,amount_due,invoice_number,total_products, 
order_date, order_status) values($user_id, $subtotal, $invoice_number, $count_products, now(),'$status')";
$result_query=mysqli_query($conn,$insert_orders);
//checks if query was successful
if($result_query){
    echo "<script>alert('Orders are submited successfully!')</script>";
    echo "<script>window.open('profile.php','_self')</script>";
}

//orders pending
$insert_pending_orders = "INSERT INTO `pending_orders` (user_id,invoice_number,product_id, 
quantity, order_status) values($user_id, $invoice_number, $product_id, $quantity,'$status')";
$pending_result=mysqli_query($conn,$insert_pending_orders);

//delete items from cart
$empty_cart = "DELETE FROM `cart_details` WHERE ip_address='$get_ip'";
$delete_result=mysqli_query($conn,$empty_cart);
?>