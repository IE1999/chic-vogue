<?php 
    include '../includes/connect.php';

    if(isset($_POST['insert_product'])){
        //accesses the data and stores it inside variables
        $product_title = $_POST['product_title'];
        $description = $_POST['description'];
        $product_keywords = $_POST['product_keywords'];
        $product_category = $_POST['product_category'];
        $product_brand = $_POST['product_brand'];
        $product_price = $_POST['product_price'];
        $product_status='true';

        //accessing images
        $product_img1 = $_FILES['product_img1']['name'];
        $product_img2 = $_FILES['product_img2']['name'];
        $product_img3 = $_FILES['product_img3']['name'];

        //accessing temp names for imgs
        $temp_img1 = $_FILES['product_img1']['tmp_name'];
        $temp_img2 = $_FILES['product_img2']['tmp_name'];
        $temp_img3 = $_FILES['product_img3']['tmp_name'];

        //check to make sure properties are filled
        if($product_title=='' || $description=='' || $product_keywords=='' || $product_category==''
        || $product_brand=='' || $product_price=='' || $product_img1=='' || $product_img2=='' 
        || $product_img3=='') {
            echo "<script>alert('Please fill in all the fields')</script>";
            exit();
        }else{

            //Moves images to product image folder to store it
            move_uploaded_file($temp_img1,"./product_imgs/$product_img1");
            move_uploaded_file($temp_img2,"./product_imgs/$product_img2");
            move_uploaded_file($temp_img3,"./product_imgs/$product_img3");

            //Insert product query
            $insert_product="INSERT INTO `products`(product_title, product_description,
            product_keywords, category_id, brand_id, product_img1, product_img2, product_img3, 
            product_price, date, status) VALUES ('$product_title','$description','$product_keywords','$product_category',
            '$product_brand', '$product_img1', '$product_img2', '$product_img3', '$product_price', NOW(),'$product_status')";

            //executes result query
            $result_query=mysqli_query($conn, $insert_product);

            if($result_query){
                echo "<script>alert('Product has been added successfully!')</script>";
            } else {
                echo "Error: " . $insert_product . "<br>" . mysqli_error($conn);
            }
        }
    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products - Admin Dashboard</title>
    <!--Bootstrap Link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--Style CSS Link-->
    <link rel="stylesheet" href="../style.css">
    <!--Font Awesome Link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" 
    referrerpolicy="no-referrer" />
</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Products</h1>
        <!--form-->
        <form action="" method="POST" enctype="multipart/form-data" required><!--enctype is used for inserting images-->
            <!--title-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Product Title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" 
                placeholder="Enter a title" autocomplete="off" required>
            </div>
            <!--description-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="description" class="form-label">Product Description</label>
                <input type="text" name="description" id="description" class="form-control" 
                placeholder="Enter a description" autocomplete="off" required>
            </div>
            <!--keywords-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keywords" class="form-label">Product Keywords</label>
                <input type="text" name="product_keywords" id="product_keywords" class="form-control" 
                placeholder="Enter product keywords" autocomplete="off" required>
            </div>
        </form>
        <!--Dropdown for selecting categories-->
        <div class="form-outline mb-4 w-50 m-auto">
        <select name="product_category" class="form_select">
            <option value="">Select a Category</option>
            <?php 
                $select_query="SELECT * FROM `categories`";
                $result_query=mysqli_query($conn,$select_query);
                while($row=mysqli_fetch_assoc($result_query)) {
                    $category_title=$row['category_title'];
                    $category_id=$row['category_id'];
                    echo "<option value='$category_id'>$category_title</option>";
                }
            ?>
        </select>
        </div>
        <br>
        <!--Dropdown for selecting brands-->
        <div class="form-outline mb-4 w-50 m-auto">
        <select name="product_brand" class="form_select">
            <option value="">Select a Brand</option>
            <?php 
                $select_query = "SELECT * FROM `brands`";
                $result_query = mysqli_query($conn,$select_query);
                while($row = mysqli_fetch_assoc($result_query)) {
                    $brand_title = $row['brand_title'];
                    $brand_id = $row['brand_id'];
                    echo "<option value='$brand_id'>$brand_title</option>";
                }
            ?>
        </select>
        </div>
        <!--Image 1-->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_img1" class="form-label">Product Image 1</label>
            <input type="file" name="product_img1" id="product_img1" class="form-control" required>
        </div>
        <!--Image 2-->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_img2" class="form-label">Product Image 2</label>
            <input type="file" name="product_img2" id="product_img2" class="form-control" required>
        </div>
        <!--Image 3-->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_img3" class="form-label">Product Image 3</label>
            <input type="file" name="product_img3" id="product_img3" class="form-control" required>
        </div>
        <!--price-->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_price" class="form-label">Product Price</label>
            <input type="text" name="product_price" id="product_price" class="form-control" 
            placeholder="Enter a price" autocomplete="off" required>
        </div>
        <!--price-->
        <div class="form-outline mb-4 w-50 m-auto">
        <input id="insert-product" type="submit" name="insert_product" class="btn btn-info mb-3 px-3" value="Insert Products">
        </div>
    </div>
</body>
</html>