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
    <title>Admin Login</title>
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
        body {
            overflow: hidden;
        }
    </style>
</head>

<body>
    <div class="container-fluid m-3">
        <h2 class="text-center m-5">Admin Login</h2>
        <div class="row d-flex justify-content-center align-items-center">
            <!--admin image section-->
            <div class="col-lg-6 col-xl-5">
                <img src="../img/adminreg.jpg" alt="admin login" class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-5">
                <form action="" method="post">
                    <div class="form-outline mb-4">
                        <!-- username -->
                        <label for="admin_name" class="form-label">Username</label>
                        <input type="text" id="admin_name" name="admin_name" placeholder="Enter a username" required
                            class="form-control">
                    </div>
                    <div class="form-outline mb-4">
                        <!-- password -->
                        <label for="admin_password" class="form-label">Password</label>
                        <input type="text" id="admin_password" name="admin_password" placeholder="Enter a password" required
                            class="form-control">
                    </div>
                    <div>
                        <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_login" value="Login">
                        <p class="small fw-bold mt-2 pt-1">Don't have an account? <a href="admin_registration.php"
                                class="link-danger">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<!--php code for validating login credentials-->
<?php
if (isset($_POST['admin_login'])) {
    //assigning input field values to variables
    $admin_name = $_POST['admin_name'];
    $admin_password = $_POST['admin_password'];

    //method to select & verify username
    $select_query = "SELECT* FROM `admin_table` WHERE admin_name='$admin_name'";
    $result = mysqli_query($conn, $select_query);
    $row_count = mysqli_num_rows($result); //counts the number of rows to check if user is present in db
    $row_data = mysqli_fetch_assoc($result); //fetch password data
    $user_ip = getIPAddress();

    if ($row_count > 0) {
        $_SESSION['admin_name'] = $admin_name;
        //method to verify password if user exists
        if (password_verify($admin_password, $row_data['admin_password'])) {
            if ($row_count == 1 and $cart_row_count == 0) { //if user is present & no items in the cart
                $_SESSION['admin_name'] = $admin_name; 
                echo "<script>alert('Login successful!')</script>";
                echo "<script>window.open('admin.php','_self')</script>";
            } else {
            echo "<script>alert('Wrong Password')</script>";
        }
    } else {
        echo "<script>alert('Invalid Credentials')</script>";
    }
}
}
?>