<h3 class="text-center">All Orders</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
    <!--php code to select data and populate table-->
    <?php 
    $get_orders = "SELECT * FROM `user_orders`";
    //query to run
    $result=mysqli_query($conn,$get_orders);
    //count number of rows if orders are placed
    $row_count = mysqli_num_rows($result);

if($row_count==0){
    echo "<h2 class='text-danger text-center mt-5'>No orders</h2>";
}else{
    echo "<tr>
    <th>Serial No.</th>
    <th>Amount Due</th>
    <th>Invoice Number</th>
    <th>Total Products</th>
    <th>Order Date</th>
    <th>Status</th>
    <th>Delete</th>
    </tr>
    </thead>
    <tbody class='bg-secondary text-light'>";
    $number=0;
    while($row_data=mysqli_fetch_assoc($result)){
        $order_id=$row_data['order_id'];
        $user_id=$row_data['user_id'];
        $amount_due=$row_data['amount_due'];
        $invoice_no=$row_data['invoice_number'];
        $total_products=$row_data['total_products'];
        $order_date=$row_data['order_date'];
        $order_status=$row_data['order_status'];
        $number++;
        echo"<tr>
            <td>$number</td>
            <td>$amount_due</td>
            <td>$invoice_no</td>
            <td>$total_products</td>
            <td>$order_date</td>
            <td>$order_status</td>
            <td><a href='' class='text-light'><i class='fa-solid fa-trash'></a></td>
        </tr>";
    }
}
    ?>
    </tbody>
</table>