<?php 
//query to delete brand from databse
if(isset($_GET['delete_brand'])){
    $delete_brand=$_GET['delete_brand'];
    $delete_query="DELETE FROM `brands` WHERE brand_id=$delete_brand";
    //result query
    $result=mysqli_query($conn,$delete_query);
    if($result){
        echo "<script>alert('Brand has been deleted successfully!')</script>";
        echo "<script>window.open('./admin.php?view_brands','_self')</script>";
    }
}
?>