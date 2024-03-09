<?php
include('../includes/connect.php');
include('../functions/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="style.css">
    <!--Bootstrap link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<style>
#paypal{
    width: 50%;
    margin: auto;
    display: block;
}
</style>
<body>
    <!--php code to access user id-->
    <?php
    $user_ip = getIPAddress(); //get the ip address of the client machine
    $get_user = "SELECT * FROM `user_table` WHERE user_ip='$user_ip'";
    //query to execute a result
    $result=mysqli_query($conn,$get_user);
    $run_query=mysqli_fetch_array($result); //returns fetched data as an array
    $user_id=$run_query['user_id']; //gets user id

    //NOTE: will throw an error if there's no user in the database
    ?>
    <div class="container">
        <h2 class="text-center text info">Payment Options</h2>
        <div class="row d-flex justify-content-center align-items-center my-5">
            <div class="col-md-6">
                <a href="https://www.paypal.com" target="_blank"><img id="paypal" src="../img/paypal_logo.png" alt="" ></a>
            </div>
            <div class="col-md-6">
                <a href="order.php?user_id=<?php echo $user_id ?>"><h2 class="text-center">Pay Offline</h2></a>
            </div>
        </div>
    </div>
</body>
</html>