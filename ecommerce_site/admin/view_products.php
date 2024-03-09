<h3 class="text-center">View Products</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <tr>
            <th>Product ID</th>
            <th>Product Title</th>
            <th>Product Image</th>
            <th>Price</th>
            <th>Total Sold</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class="bg-secondary text-light">
        <!--php code to fetch and load dynamic data into the table-->
        <?php
        $get_products = "SELECT * FROM `products`";
        $result = mysqli_query($conn, $get_products);
        $number = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_img1 = $row['product_img1'];
            $product_price = $row['product_price'];
            $product_status = $row['status'];
            $number++;
            ?>
            <tr class='text-center'>
                <td>
                    <?php echo $number; ?>
                </td>
                <td>
                    <?php echo $product_title ?>
                </td>
                <td><img src='./product_imgs/<?php echo $product_img1; ?>' class='product_img' /></td>
                <td>
                    <?php echo $product_price; ?>
                </td>
                <td>
                    <?php
                    $get_count = "SELECT * FROM `pending_orders` WHERE product_id=$product_id";
                    $result_count = mysqli_query($conn, $get_count);
                    $count_rows = mysqli_num_rows($result_count);
                    echo $count_rows;
                    ?>
                </td>
                <td>
                    <?php $product_status ?>
                </td>
                <td><a href='admin.php?edit_products=<?php echo $product_id ?>' class='text-light'><i
                    class='fa-solid fa-pen-to-square'></i></a></td>
                <td><a href='admin.php?delete_products=<?php echo $product_id ?>' class='text-light'><i 
                    class='fa-solid fa-trash'></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>