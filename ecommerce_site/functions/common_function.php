<?php
//include connect file
// include('./includes/connect.php');

// getting products
function getproduct() {
    global $conn;
    //condition to check isset or not
    if(!isset($_GET['category'])){
        if(!isset($_GET['brand'])){
    $select_query="SELECT * FROM `products` order by rand() limit 0,9"; //limits how many products show up at once
    $result_query=mysqli_query($conn,$select_query);
                
    while($row=mysqli_fetch_assoc($result_query)){
        $product_id=$row['product_id'];
        $product_title=$row['product_title'];
        $product_description=$row['product_description'];
        $product_img1=$row['product_img1'];
        $product_price=$row['product_price'];
        $category_id=$row['category_id'];
        $brand_id=$row['brand_id'];
        echo" <div id='product-card' class='col-md-4 mb-2'>
            <div class='card'>
                <img class='card-img-top' src='admin/product_imgs/$product_img1' alt='$product_title'>
                <div class='card-body'>
                    <h5 class='card-title'>$product_title</h5>
                    <p class='card-text'>$product_description</p>
                    <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                    <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>See More</a>
                </div>
            </div>
        </div>";
    };
};
};
};

//getting all products
function get_all_products() {
    global $conn;
        //condition to check isset or not
        if(!isset($_GET['category'])){
            if(!isset($_GET['brand'])){
    $select_query="SELECT * FROM `products` order by rand()";
    $result_query=mysqli_query($conn,$select_query);
                
    while($row=mysqli_fetch_assoc($result_query)){
        $product_id=$row['product_id'];
        $product_title=$row['product_title'];
        $product_description=$row['product_description'];
        $product_img1=$row['product_img1'];
        $product_price=$row['product_price'];
        $category_id=$row['category_id'];
        $brand_id=$row['brand_id'];
        echo" <div id='product-card' class='col-md-4 mb-2'>
            <div class='card'>
                <img class='card-img-top' src='admin/product_imgs/$product_img1' alt='$product_title'>
                <div class='card-body'>
                    <h5 class='card-title'>$product_title</h5>
                    <p class='card-text'>$product_description</p>
                    <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                    <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>See More</a>
                </div>
            </div>
        </div>";
    };
};
};
}

// getting unique categories
function get_unique_categories() {
    global $conn;
    //condition to check isset or not
    if(isset($_GET['category'])){
        $category_id=$_GET['category'];
    $select_query="SELECT * FROM `products` WHERE category_id=$category_id";
    $result_query=mysqli_query($conn,$select_query);
    $number_of_rows=mysqli_num_rows($result_query);
    //displays no stock message if product doesn't exist in category
    if($number_of_rows==0){
        echo"<h2 class='text-center text-danger'>No stock for this category</h2>";
    }

    while($row=mysqli_fetch_assoc($result_query)){
        $product_id=$row['product_id'];
        $product_title=$row['product_title'];
        $product_description=$row['product_description'];
        $product_img1=$row['product_img1'];
        $product_price=$row['product_price'];
        $category_id=$row['category_id'];
        $brand_id=$row['brand_id'];
        echo" <div id='product-card' class='col-md-4 mb-2'>
            <div class='card'>
                <img class='card-img-top' src='admin/product_imgs/$product_img1' alt='$product_title'>
                <div class='card-body'>
                    <h5 class='card-title'>$product_title</h5>
                    <p class='card-text'>$product_description</p>
                    <p class='card-text'>Price: $ $product_price</p>
                    <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                    <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>See More</a>
                </div>
            </div>
        </div>";
    };
};
};

// getting unique brands
function get_unique_brands() {
    global $conn;
    //condition to check isset or not
    if(isset($_GET['brand'])){
        $brand_id=$_GET['brand'];
    $select_query="SELECT * FROM `products` WHERE brand_id=$brand_id";
    $result_query=mysqli_query($conn,$select_query);
    $number_of_rows=mysqli_num_rows($result_query);
    //displays no stock message if product doesn't exist in brand
    if($number_of_rows==0){
        echo"<h2 class='text-center text-danger'>No stock available for this brand</h2>";
    }

    while($row=mysqli_fetch_assoc($result_query)){
        $product_id=$row['product_id'];
        $product_title=$row['product_title'];
        $product_description=$row['product_description'];
        $product_img1=$row['product_img1'];
        $product_price=$row['product_price'];
        $category_id=$row['category_id'];
        $brand_id=$row['brand_id'];
        echo" <div id='product-card' class='col-md-4 mb-2'>
            <div class='card'>
                <img class='card-img-top' src='admin/product_imgs/$product_img1' alt='$product_title'>
                <div class='card-body'>
                    <h5 class='card-title'>$product_title</h5>
                    <p class='card-text'>$product_description</p>
                    <p class='card-text'>Price: $ $product_price</p>
                    <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                    <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>See More</a>
                </div>
            </div>
        </div>";
    };
};
};


// displaying brands in sidenav
function getbrands() {
    global $conn;
    //condition to check isset or not
    if(!isset($_GET['category'])){
        if(!isset($_GET['brand'])){

    //insert brands from database
    $select_brands= "SELECT * FROM `brands`";
    $result_brands = mysqli_query($conn, $select_brands);

    //fetches all data in brand column instead of 1x1
    while($row_data = mysqli_fetch_assoc($result_brands)) {
        $brand_title = $row_data['brand_title'];
        $brand_id = $row_data['brand_id'];
        echo " <li class='nav-item'>
            <a href='index.php?brand=$brand_id' class='nav-link text-light'>$brand_title</a>
        </li>";
    };
};
};
};

// displaying categories in sidenav
function getcategories(){
    global $conn;
    //insert categories from database
    $select_categories= "SELECT * FROM `categories`";
    $result_categories = mysqli_query($conn, $select_categories);

    //fetches all data in category column instead of 1x1
    while($row_data = mysqli_fetch_assoc($result_categories)) {
        $category_title = $row_data['category_title'];
        $category_id = $row_data['category_id'];
        echo " <li class='nav-item'>
        <a href='index.php?category=$category_id' class='nav-link text-light'>$category_title</a>
    </li>";
    };
};

// function for searching products
function search_product() {
    global $conn;
    if(isset($_GET['search_data_product'])){
        $search_data_value=$_GET['search_data'];
$search_query="SELECT * FROM `products` WHERE product_keywords like '%$search_data_value%'";
$result_query=mysqli_query($conn,$search_query);
$number_of_rows=mysqli_num_rows($result_query);
//displays no stock message if product doesn't exist
if($number_of_rows==0){
    echo"<h2 class='text-center text-danger'>No products found for this category</h2>";
}

while($row=mysqli_fetch_assoc($result_query)){
    $product_id=$row['product_id'];
    $product_title=$row['product_title'];
    $product_description=$row['product_description'];
    $product_img1=$row['product_img1'];
    $product_price=$row['product_price'];
    $category_id=$row['category_id'];
    $brand_id=$row['brand_id'];
    echo" <div id='product-card' class='col-md-4 mb-2'>
        <div class='card'>
            <img class='card-img-top' src='admin/product_imgs/$product_img1' alt='$product_title'>
            <div class='card-body'>
                <h5 class='card-title'>$product_title</h5>
                <p class='card-text'>$product_description</p>
                <p class='card-text'>Price: $ $product_price</p>
                <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>See More</a>
            </div>
        </div>
    </div>";
};
};
};

//view details function
function view_details(){
    global $conn;
    //condition to check isset or not
    if(isset($_GET['product_id'])){
    if(!isset($_GET['category'])){
        if(!isset($_GET['brand'])){
            $product_id=$_GET['product_id'];
    $select_query="SELECT * FROM `products` where product_id=$product_id";
    $result_query=mysqli_query($conn,$select_query);
                
    while($row=mysqli_fetch_assoc($result_query)){
        $product_id=$row['product_id'];
        $product_title=$row['product_title'];
        $product_description=$row['product_description'];
        $product_img1=$row['product_img1'];
        $product_img2=$row['product_img2'];
        $product_img3=$row['product_img3'];
        $product_price=$row['product_price'];
        $category_id=$row['category_id'];
        $brand_id=$row['brand_id'];
        echo" <div id='product-card' class='col-md-4 mb-2'>
            <div class='card'>
                <img class='card-img-top' src='admin/product_imgs/$product_img1' alt='$product_title'>
                <div class='card-body'>
                    <h5 class='card-title'>$product_title</h5>
                    <p class='card-text'>$product_description</p>
                    <p class='card-text'>Price: $ $product_price</p>
                    <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                    <a href='index.php' class='btn btn-secondary'>Back</a>
                </div>
            </div>
        </div>
        <div class='col-md-8'>
        <div class='row'>
            <div class='col-md-12'>
                <h4 class='text-center text-info mb-5'>Related Products</h4>
            </div>
            <div class='col-md-6'>
                <img class='card-img-top' src='img/$product_img2' alt='$product_title'>
            </div>
            <div class='col-md-6'>
                <img class='card-img-top' src='img/$product_img3' alt='$product_title'>
            </div>
        </div>
    </div>";
    };
};
};
};
};

// get ip address from user
function getIPAddress() {  
    //whether ip is from the share internet  
    if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
    }  
//whether ip is from the remote address  
    else{  
        $ip = $_SERVER['REMOTE_ADDR'];  
    }  
    return $ip;  
}   

// cart function
function cart() {
    if(isset($_GET['add_to_cart'])) {
        global $conn;
        $get_ip_add = getIPAddress();
        $get_product_id=$_GET['add_to_cart'];

        //checks if data & item are present inside database
        $select_query="SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add' and product_id=$get_product_id";
        $result_query=mysqli_query($conn, $select_query);
        //fetches number of rows from the table
        $number_of_rows=mysqli_num_rows($result_query);
        //checks number of rows & displays message if item is already in cart
        if($number_of_rows>0){
            echo"<script>alert('Item already inside cart')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        }else{
            //inserts data into database
            $insert_query="INSERT INTO `cart_details` (product_id,ip_address,quantity) values($get_product_id, '$get_ip_add',0)";
            $result_query=mysqli_query($conn, $insert_query);
            echo"<script>alert('Item is added to cart')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        };
    };
};

//function for item cart number
function cart_item(){
    if(isset($_GET['add_to_cart'])) {
        global $conn;
        $get_ip_add = getIPAddress();
        //checks if data & item are present inside database
        $select_query="SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
        $result_query=mysqli_query($conn, $select_query);
        $count_cart_items=mysqli_num_rows($result_query);

        }else{
            global $conn;
            $get_ip_add = getIPAddress();
            //checks if data & item are present inside database
            $select_query="SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
            $result_query=mysqli_query($conn, $select_query);
            $count_cart_items=mysqli_num_rows($result_query);
        }
        echo $count_cart_items;
}

// total price function
function total_price() {
    global $conn; //connect to database
    $get_ip_add = getIPAddress(); //save ip address for each user
    $total=0; //initialize value as 0
    $cart_query="SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'"; //Fetches records from database and stores it
    $result=mysqli_query($conn,$cart_query);  
    while($row=mysqli_fetch_array($result)){
        //fetching data from table
        $product_id=$row['product_id'];
        $select_products="SELECT * FROM `products` WHERE product_id='$product_id'";
        //executes record
        $result_products=mysqli_query($conn,$select_products);
        //fetches price and stores in an array
        while($row_price=mysqli_fetch_array($result_products)){
            $product_price=array($row_price['product_price']);
            $product_values=array_sum($product_price);
            $total+= $product_values;
        }
    }
    echo $total;
}

// get user order details function
function get_order_details(){
    global $conn;
    $username=$_SESSION['username'];
    $get_details="SELECT * FROM `user_table` WHERE username='$username'";
    $result_detail_query= mysqli_query($conn, $get_details);
    while($row_query=mysqli_fetch_array($result_detail_query)){
        //fetch user id from database
        $user_id=$row_query['user_id'];
        if(!isset($_GET['edit_account'])){
            if(!isset($_GET['my_orders'])){
                if(!isset($_GET['delete_account'])){
                    $get_orders="SELECT * FROM `user_orders` WHERE user_id=$user_id and order_status='pending'";
                    $result_orders_query=mysqli_query($conn, $get_orders);
                    $row_count=mysqli_num_rows($result_orders_query);
                    if($row_count>0){
                        echo "<h3 class='text-center text-success'>You have <span class='text-danger'>
                        $row_count</span> pending orders.</h3>
                        <p class='text-center'><a href='profile.php?my_orders' class='text-dark'>order details</a></p>";
                    }else{
                        echo "<h3 class='text-center text-success'>You have 0 pending orders.</h3>
                        <p class='text-center'><a href='../index.php' class='text-dark'>Explore Products</a></p>";
                    }
                }
            }
        }
    }
}

?>