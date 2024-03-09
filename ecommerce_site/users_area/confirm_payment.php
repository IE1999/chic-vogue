<?php
    include('../includes/connect.php');
    session_start();
    if(isset($_GET['$order_id'])){
        $order_id= $_GET['$order_id'];
        $select_data = "SELECT * FROM `user_orders`  WHERE order_id=$order_id";
        $result = mysqli_query($conn, $select_data);
        $row_fetch=mysqli_fetch_assoc($result);
        $invoice_number=$row_fetch['invoice_number'];
        $amount_due=$row_fetch['amount_due'];
    }
    //condition to confirm payment
    if(isset($_POST['confirm_payment'])){
        $invoice_number=$_POST['invoice_number'];
        $amount=$_POST['amount'];
        $payment_type=$_POST['payment_type'];
        //insert query
        $insert_payment="INSERT INTO `user_payments` (order_id,invoice_number,amount, payment_type) 
        values($order_id,$invoice_number,$amount,'$payment_type')";
        //execute query
        $result=mysqli_query($conn,$insert_payment);
        //checks if query runs successfully
        if($result){
            echo "<h3 class='text-center text-light'>Payment completed successfully!</h3>";
            echo "<script>window.open('profile.php?user_orders','_self')</script>";
        }
        $update_orders="UPDATE `user_orders` SET order_status='Complete' WHERE order_id=$order_id";
        $result_orders=mysqli_query($conn,$update_orders);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <h1 class="text-center">Confirm Payment</h1>
    <div class="container my-5">
        <form action="" method="post">
            <div class="form_outline my-4 text-center w-50 m-auto">
                <label>Invoice Number</label>
                <input type="text" class="form-control w-50 m-auto" name="invoice number" 
                value="<?php echo  $invoice_number; ?>">
            </div>
            <div class="form_outline my-4 text-center w-50 m-auto">
                <label for="">Amount</label>
                <input type="text" class="form-control w-50 m-auto" name="amount" 
                value="<?php echo $amount_due; ?>">
            </div>
            <div class="form_outline my-4 text-center w-50 m-auto">
                <label for="">Payment Method</label>
                <select name="payment_type"class="form-select w-50 m-auto">
                    <option>Select Payment Option</option>
                    <option>UPI</option>
                    <option>Paypal</option>
                    <option>Pay Offline</option>
                    <option>Netbanking</option>
                </select>
            </div>
            <div class="form_outline my-4 text-center w-50 m-auto">
                <input type="submit" class="bg-info py-2 px-3 border-0" value="Confirm" name="confirm_payment">
            </div>
        </form>
    </div>
</body>
</html>