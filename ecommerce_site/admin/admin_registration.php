<?php
include('../includes/connect.php');
include('../functions/common_function.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
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
        <h2 class="text-center m-5">Admin Registration</h2>
        <div class="row d-flex justify-content-center align-items-center">
            <!--admin image section-->
            <div class="col-lg-6 col-xl-5">
                <img src="../img/adminreg.jpg" alt="admin Registration" class="img-fluid">
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
                        <!-- email -->
                        <label for="admin_email" class="form-label">Email</label>
                        <input type="email" id="admin_email" name="admin_email" placeholder="Enter an email address" required
                            class="form-control">
                    </div>
                    <div class="form-outline mb-4">
                        <!-- password -->
                        <label for="admin_password" class="form-label">Password</label>
                        <input type="text" id="admin_password" name="admin_password" placeholder="Enter a password" required
                            class="form-control">
                    </div>
                    <div class="form-outline mb-4">
                        <!-- confirm password -->
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required
                            class="form-control">
                    </div>
                    <div>
                        <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_register" value="Register">
                        <p class="small fw-bold mt-2 pt-1">Already have an account? <a href="admin_login.php" class="link-danger">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<!--php logic to register admin account-->
<?php
if (isset($_POST['admin_register'])) {
    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];
    $hash_password=password_hash(($admin_password), PASSWORD_DEFAULT);
    $conf_admin_password = $_POST['confirm_password'];

    //select query to fetch user records and count number of rows
    $select_query = "SELECT * FROM `admin_table` where admin_name='$admin_name' or admin_email='$admin_email'";
    $result = mysqli_query($conn, $select_query);
    $row_count = mysqli_num_rows($result);
    //checks if email and username already exists in database
    if($row_count > 0) {
        echo  "<script>alert('name & email already exist')</script>";
        //checks if passwords match
    } else if($admin_password!=$conf_admin_password){
        echo  "<script>alert('Password does not match')</script>";
    } else {
        // insert query
        $insert_query = "INSERT INTO `admin_table` 
        (admin_name,admin_email, admin_password) 
        values('$admin_name','$admin_email','$hash_password')";
        $sql_execute=mysqli_query($conn, $insert_query); //executes the query
    }
}
?>