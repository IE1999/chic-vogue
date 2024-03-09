<?php
//get method to retrieve product data from database for editing
if (isset($_GET['edit_products'])) {
    $edit_id = $_GET['edit_products'];
    $get_data = "SELECT * FROM `products` WHERE product_id=$edit_id";
    $result_data = mysqli_query($conn, $get_data);
    $row = mysqli_fetch_assoc($result_data);

    $product_title = $row['product_title'];
    $product_description = $row['product_description'];
    $product_keywords = $row['product_keywords'];
    $category_id = $row['category_id'];
    $brand_id = $row['brand_id'];
    $product_img1 = $row['product_img1'];
    $product_img2 = $row['product_img2'];
    $product_img3 = $row['product_img3'];
    $product_price = $row['product_price'];

    //fetching category id
    $select_category = "SELECT * FROM `categories` WHERE category_id=$category_id";
    $result_category = mysqli_query($conn, $select_category);
    $category_row = mysqli_fetch_assoc($result_category);
    //Display category name tied to id
    $category_title = $category_row['category_title'];

    //fetching brand id
    $select_brand = "SELECT * FROM `brands` WHERE brand_id=$brand_id";
    $result_brand = mysqli_query($conn, $select_brand);
    $brand_row = mysqli_fetch_assoc($result_brand);
    //Display brand name tied to id
    $brand_title = $brand_row['brand_title'];
}
?>

<div class="container mt-5">
    <h1 class="text-center">Edit Products</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <!-- product title -->
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_title" class="form-label">Product Title</label>
            <input type="text" id="product_title" value="<?php echo $product_title; ?>" name="product_title"
                class="form-control" required="required">
        </div>
        <!-- product description -->
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_description" class="form-label">Product Description</label>
            <input type="text" id="product_description" value="<?php echo $product_description; ?>"
                name="product_description" class="form-control" required="required">
        </div>
        <!-- product keywords -->
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_keywords" class="form-label">Product Keywords</label>
            <input type="text" id="product_keywords" value="<?php echo $product_keywords; ?>" name="product_keywords"
                class="form-control" required="required">
        </div>
        <!-- product category -->
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_category" class="form-label">Product Category</label>
            <select name="product_category" class="form-select">
                <option value="<?php echo $category_title; ?>">
                    <?php echo $category_title; ?>
                </option>
                <?php
                //fetching all categories from database     
                $select_all_category = "SELECT * FROM `categories`";
                $result_category_all = mysqli_query($conn, $select_all_category);
                while ($category_row_all = mysqli_fetch_assoc($result_category_all)) {
                    $category_title = $category_row_all['category_title'];
                    $category_id = $category_row_all['category_id'];
                    echo "<option value='$category_id'>$category_title</option>";
                }
                ?>
            </select>
        </div>
        <!--product brand-->
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_brand" class="form-label">Product Brand</label>
            <select name="product_brand" class="form-select">
                <option value="<?php echo $brand_title; ?>">
                    <?php echo $brand_title; ?>
                </option>
                <?php
                //fetching all brands from database     
                $select_all_brand = "SELECT * FROM `brands`";
                $result_brand_all = mysqli_query($conn, $select_all_brand);
                while ($brand_row_all = mysqli_fetch_assoc($result_brand_all)) {
                    $brand_title = $brand_row_all['brand_title'];
                    $brand_id = $brand_row_all['brand_id'];
                    echo "<option value='$brand_id'>$brand_title</option>";
                }
                ?>
            </select>
        </div>
        <!-- product image 1 -->
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_img1" class="form-label">Product Image 1</label>
            <div class="d-flex">
                <input type="file" id="product_img1" name="product_img1" class="form-control w-90 m-auto"
                    required="required">
                <img src="./product_imgs/<?php echo $product_img1 ?>" alt="" class="product_img">
            </div>
        </div>
        <!-- product image 2 -->
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_img2" class="form-label">Product Image 2</label>
            <div class="d-flex">
                <input type="file" id="product_img2" name="product_img2" class="form-control w-90 m-auto"
                    required="required">
                <img src="./product_imgs/<?php echo $product_img2 ?>" alt="" class="product_img">
            </div>
        </div>
        <!-- product image 3 -->
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_img3" class="form-label">Product Image 1</label>
            <div class="d-flex">
                <input type="file" id="product_img3" name="product_img3" class="form-control w-90 m-auto"
                    required="required">
                <img src="./product_imgs/<?php echo $product_img3 ?>" alt="" class="product_img">
            </div>
        </div>
        <!-- product price -->
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_price" class="form-label">Product Price</label>
            <input type="text" id="product_price" value="<?php echo $product_price; ?>" name="product_price"
                class="form-control" required="required">
        </div>
        <div class="text-center">
            <input type="submit" name="edit_product" value="Update Product" class="btn btn-info px-3 mb-3">
        </div>
    </form>
</div>

<!--editing products-->
<?php
if (isset($_POST['edit_product'])) {
    //fetching and storing data inside input fields
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_keywords = $_POST['product_keywords'];
    $product_category = $_POST['product_category'];
    $product_brand = $_POST['product_brand'];
    $product_price = $_POST['product_price'];

    $product_img1 = $_FILES['product_img1']['name'];
    $product_img2 = $_FILES['product_img2']['name'];
    $product_img3 = $_FILES['product_img3']['name'];

    //fetching temporary images
    $temp_img1 = $_FILES['product_img1']['tmp_name'];
    $temp_img2 = $_FILES['product_img2']['tmp_name'];
    $temp_img3 = $_FILES['product_img3']['tmp_name'];

    //checking if fields are empty or not (if fields are not listed as required)
    if($product_title=='' or $product_description=='' or  $product_keywords=='' or  
    $product_category=='' or $product_brand or $product_img1=='' or $product_img2=='' 
    or $product_img3=='' or $product_price==''){
        echo "<script>alert('Fields cannot be empty!')</script>";
    } else {
        //moves images to database
        move_uploaded_file($temp_img1, "./product_imgs/$product_img1");
        move_uploaded_file($temp_img2, "./product_imgs/$product_img2");
        move_uploaded_file($temp_img3, "./product_imgs/$product_img3");

        //query to update products
        $update_products = "UPDATE `products` SET  product_title='$product_title',
        product_description='$product_description', product_keywords='$product_keywords', 
        category_id='$product_category', brand_id='$product_brand', 
        product_img1='$product_img1',product_img2='$product_img2', 
        product_img3='$product_img3', product_price='$product_price', date=NOW() WHERE product_id=$edit_id";
        
        //execute result query to update product
        $update_result=mysqli_query($conn,$update_products);
        if($update_result){
            echo "<script>alert('Updated successfully!')</script>";
            echo "<script>window.open('./insert_product.php','_self')</script>";
        }
    }
}
?>