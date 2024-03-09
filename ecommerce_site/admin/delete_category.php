<?php 
//query to delete category from databse
if(isset($_GET['delete_category'])){
    $delete_category=$_GET['delete_category'];
    $delete_query="DELETE FROM `categories` WHERE category_id=$delete_category";
    //result query
    $result=mysqli_query($conn,$delete_query);
    if($result){
        echo "<script>alert('Category has been deleted successfully!')</script>";
        echo "<script>window.open('./admin.php?view_categories','_self')</script>";
    }
}
?>