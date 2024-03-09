<h3 class="text-center">All Payments</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
    <!--php code to select data and populate table-->
    <?php 
    $get_payments = "SELECT * FROM `user_payments`";
    //query to run
    $result=mysqli_query($conn,$get_payments);
    //count number of rows if orders are placed
    $row_count = mysqli_num_rows($result);

if($row_count== 0){
    echo "<h2 class='text-danger text-center mt-5'>No payment received</h2>";
}else{
    echo "<tr>
    <th>Serial No.</th>
    <th>Invoice Number</th>
    <th>Amount</th>
    <th>Payment Type</th>
    <th>Order Date</th>
    <th>Delete</th>
    </tr>
    </thead>
    <tbody class='bg-secondary text-light'>";
    $number=0;
    while($row_data=mysqli_fetch_assoc($result)){
        $order_id=$row_data['order_id'];
        $payment_id=$row_data['payment_id'];
        $amount=$row_data['amount'];
        $invoice_no=$row_data['invoice_number'];
        $payment_type=$row_data['payment_type'];
        $order_date=$row_data['order_date'];
        $number++;
        echo"<tr>
            <td>$number</td>
            <td>$invoice_no</td>
            <td>$amount</td>
            <td>$payment_type</td>
            <td>$order_date</td>
            <td><a href='' class='text-light'><i class='fa-solid fa-trash'></a></td>
        </tr>";
    }
}
    ?>
    </tbody>
</table>