<!--connect to database-->
<?php
include('../includes/connect.php');
include('../functions/common_function.php');
@session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <!--Bootstrap link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">User Login</h2>
        <div class="row d-flex align-items-center justify-content-center mt-5"> <!--centers items in container-->
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post">
                    <!--username field-->
                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label">Username: </label>
                        <input type="text" name="user_username" id="user_username" class="form-control"
                            placeholder="Enter your username" autocomplete="off" required>
                    </div>
                    <!--password field-->
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Password: </label>
                        <input type="password" name="user_password" id="user_password" class="form-control"
                            placeholder="Enter your password" autocomplete="off" required>
                    </div>
                    <!--register account button-->
                    <div class="mt-4 pt-2">
                        <input type="submit" value="Login" class="bg-info py-2 px-3 border-0" name="user_login">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account?
                            <a class="text-danger" href="user_registration.php">Register</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<!--php code for validating login credentials-->
<?php
if (isset($_POST['user_login'])) {
    //accessing login information inside database
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];

    //method to select & verify username
    $select_query = "SELECT* FROM `user_table` WHERE username='$user_username'";
    $result = mysqli_query($conn, $select_query);
    $row_count = mysqli_num_rows($result); //counts the number of rows to check if user is present in db
    $row_data = mysqli_fetch_assoc($result); //fetch password data
    $user_ip = getIPAddress();

    //accessing cart items
    $select_cart_query = "SELECT* FROM `cart_details` WHERE user_ip='$user_ip'";
    $select_cart = mysqli_query($conn, $select_cart_query);
    $cart_row_count = mysqli_num_rows($select_cart);
    if ($row_count > 0) {
        $_SESSION['username'] = $user_username;
        //method to verify password if user exists
        if (password_verify($user_password, $row_data['user_password'])) {
            if ($row_count == 1 and $cart_row_count == 0) { //if user is present & no items in the cart
                $_SESSION['username'] = $user_username; 
                echo "<script>alert('Login successful!')</script>";
                echo "<script>window.open('profile.php','_self')</script>";
            } else {
                $_SESSION['username'] = $user_username;
                echo "<script>alert('Login successful!')</script>";
                echo "<script>window.open('payment.php','_self')</script>";
            }
        } else {
            echo "<script>alert('Wrong Password')</script>";
        }
    } else {
        echo "<script>alert('Invalid Credentials')</script>";
    }
}
?>