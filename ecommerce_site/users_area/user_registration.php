<!--connect to database to insert data-->
<?php
include('../includes/connect.php');
include('../functions/common_function.php')
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!--Bootstrap link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">New User Registration</h2>
        <div class="row d-flex align-items-center justify-content-center"> <!--centers items in container-->
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <!--need enctype to insert images in database-->
                    <!--username field-->
                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label">Username: </label>
                        <input type="text" name="user_username" id="user_username" class="form-control"
                            placeholder="Enter your username" autocomplete="off" required>
                    </div>
                    <!--email field-->
                    <div class="form-outline mb-4">
                        <label for="user_email" class="form-label">Email: </label>
                        <input type="email" name="user_email" id="user_email" class="form-control"
                            placeholder="Enter your email" autocomplete="off" required>
                    </div>
                    <!--image field-->
                    <div class="form-outline mb-4">
                        <label for="user_image" class="form-label">User Image: </label>
                        <input type="file" name="user_image" id="user_image" class="form-control" required>
                    </div>
                    <!--password field-->
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Password: </label>
                        <input type="password" name="user_password" id="user_password" class="form-control"
                            placeholder="Enter your password" autocomplete="off" required>
                    </div>
                    <!--confirm password field-->
                    <div class="form-outline mb-4">
                        <label for="conf_user_password" class="form-label">Confirm Password: </label>
                        <input type="password" name="conf_user_password" id="conf_user_password" class="form-control"
                            placeholder="Confirm password" autocomplete="off" required>
                    </div>
                    <!--address field-->
                    <div class="form-outline mb-4">
                        <label for="user_address" class="form-label">Address: </label>
                        <input type="text" name="user_address" id="user_address" class="form-control"
                            placeholder="Enter your address" autocomplete="off" required>
                    </div>
                    <!--contact field-->
                    <div class="form-outline mb-4">
                        <label for="user_contact" class="form-label">Contact: </label>
                        <input type="text" name="user_contact" id="user_contact" class="form-control"
                            placeholder="Enter your mobile number" autocomplete="off" required>
                    </div>
                    <!--register account button-->
                    <div class="mt-4 pt-2">
                        <input type="submit" value="Register" class="bg-info py-2 px-3 border-0" name="user_register">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account?
                            <a class="text-danger" href="user_login.php">Login</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<!--php code for fetching user data-->
<?php
if (isset($_POST['user_register'])) {
    $user_username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $hash_password=password_hash(($user_password), PASSWORD_DEFAULT);
    $conf_user_password = $_POST['conf_user_password'];
    $user_address = $_POST['user_address'];
    $user_contact = $_POST['user_contact'];
    $user_image = $_FILES['user_image']['name']; //you need $_FILES to access images (you need multiple attributes)
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    $user_ip = getIPAddress();

    //select query to fetch user records and count number of rows
    $select_query = "SELECT * FROM `user_table` where username='$user_username' or user_email='$user_email'";
    $result = mysqli_query($conn, $select_query);
    $row_count = mysqli_num_rows($result);
    //checks if email and username already exists in database
    if($row_count > 0) {
        echo  "<script>alert('Username & email already exist')</script>";
        //checks if passwords match
    } else if($user_password!=$conf_user_password){
        echo  "<script>alert('Password does not match')</script>";
    } else {
        // insert query
        move_uploaded_file($user_image_tmp, "./user_images/$user_image"); //move profile images to folder
        $insert_query = "INSERT INTO `user_table` 
        (username,user_email, user_password,user_image,user_ip,user_address,user_mobile) 
        values('$user_username','$user_email','$hash_password',
        '$user_image','$user_ip','$user_address','$user_contact')";
        $sql_execute=mysqli_query($conn, $insert_query); //executes the query
    }

    //selecting cart items
    $select_cart_items="SELECT * FROIM `cart_details` WHERE ip_address= '$user_ip'";
    $result_cart=mysqli_query($conn,$select_cart_items);
    $rows_count = mysqli_num_rows($result_cart);
    if($rows_count > 0){
        $_SESSION['username']=$user_username;
        echo "<script>alert('You have items in your cart')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
    }else{
        echo "<script>window.open('../index.php','_self')</script>";
    }
}
?>