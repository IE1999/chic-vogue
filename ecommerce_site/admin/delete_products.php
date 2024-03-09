<?php 
if(isset($_GET['delete_product'])){
    $delete_id = $_GET['product_id'];
    //delete query
    $delete_product = "DELETE FROM `products` WHERE  product_id='$delete_id'";
    $delete_result = mysqli_query($conn, $delete_product);
    if($delete_result) {
        echo "<script>alert('Deleted product successfully!')</script>";
        echo "<script>window.open('./admin.php','_self')</script>";
    }
}
?>