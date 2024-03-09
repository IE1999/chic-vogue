<!--php code to fetch data to populate table-->
<?php 
// accessing user id from database
$username=$_SESSION['username'];
$get_user="SELECT * FROM `user_table` WHERE username='$username'";
$result=mysqli_query($conn,$get_user);
$row_fetch=mysqli_fetch_assoc($result);
$user_id=$row_fetch['user_id'];
?>

<h3>All Orders</h3>
<table class="table table-bordered mt-5">
    <thead>
    <tr>
        <th>Serial No.</th>
        <th>Amount Due</th>
        <th>Total Products</th>
        <th>Invoice Number</th>
        <th>Date</th>
        <th>Complete/Incomplete</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
        <!--php code to access order information-->
        <?php 
        $get_order_details="SELECT * FROM `user_orders` WHERE user_id=$user_id";
        $result_orders=mysqli_query($conn,$get_order_details);
        $number = 1;
        while($row_orders=mysqli_fetch_assoc($result_orders)){
            $order_id=$row_orders['order_id'];
            $amount_due=$row_orders['amount_due'];
            $amount_due=$row_orders['amount_due'];
            $total_products=$row_orders['total_products'];
            $invoice_number=$row_orders['invoice_number'];
            $order_status=$row_orders['order_status'];
            if($order_status=='pending'){
                $order_status='Incomplete';
            }else{
                $order_status='Complete';
            }
            $order_date=$row_orders['order_date'];
            echo "<tr>
                <td>$number</td>
                <td>$amount_due</td>
                <td>$total_products</td>
                <td>$invoice_number</td>
                <td>$order_date</td>
                <td>$order_status</td>";
                ?>
                <?php if($order_status=='Complete'){
                    echo"<td>Paid</td>";
                }else{
                    echo "<td><a href='confirm_payment.php?order_id=$order_id'>Confirm</a></td>
                    </tr>";
                }
            //increments the serial number by 1
            $number++;
        }
        ?>
    </tbody>
</table>