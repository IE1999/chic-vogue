<?php 
//GET method to access brands from database
if(isset($_GET['edit_brand'])){
    $edit_brand=$_GET['edit_brand'];
    //fetching brand if id is matched with variable
    $get_brands = "SELECT * FROM `brands` WHERE brand_id = $edit_brand";
    $result=mysqli_query($conn,$get_brands);
    //fetch brand title if query is successful
    $row=mysqli_fetch_assoc($result);
    $brand_title=$row['brand_title'];
}
//post method to update brand data after editing
if(isset($_POST['edit_brand'])){
    $brand_title=$_POST['brand_title'];
    //query to update table
    $update_query="UPDATE `brands` SET brand_title='$brand_title' WHERE 
    brand_id=$edit_brand";
    $result_brand = mysqli_query($conn,$update_query);
    //query to check if query runs successfully
    if($result_brand){
        echo "<script>alert('brand updated successfully!')</script>";
        echo "<script>window.open('./admin.php?view_brands','_self')</script>";
    }
}

?>

<div class="container mt-3">
    <h1 class="text-center">Edit Brand</h1>
    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="brand_title" class="form-label">Brand Title</label>
            <input type="text" name="brand_title" id="brand_title" class="form-control" 
            required value='<?php echo $brand_title; ?>'>
        </div>
        <input type="submit" value="Update" class="btn btn-info px-3 mb-3" name="edit_brand">
    </form>
</div>