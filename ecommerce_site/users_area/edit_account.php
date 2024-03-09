<?php 
//access the columns to change the user data
if(isset($_GET['edit_account'])) {
    $user_session_name = $_SESSION['username'];
    $select_query="SELECT * FROM `user_table` WHERE username='$user_session_name'";
    $result=mysqli_query($conn,$select_query);
    //query to fetch the data
    $row_fetch = mysqli_fetch_assoc($result);
    $user_id=$row_fetch['user_id'];
    $user_name=$row_fetch['username'];
    $email=$row_fetch['user_email'];
    $user_address=$row_fetch['user_address'];
    $user_mobile=$row_fetch['user_mobile'];
}
    //condition to update the user data table if button is clicked
    if(isset( $_POST["user_update"])) {
        $update_id=$user_id;
        $user_name=$_POST['username'];
        $email=$_POST['user_email'];
        $user_address=$_POST['user_address'];
        $user_mobile=$_POST['user_mobile'];
        $user_image=$_FILES['user_image']['name'];
        $user_image_tmp=$_FILES['user_image']['tmp_name'];
        //moves new image to folder
        move_uploaded_file($user_image_tmp, "./user_images/$user_image");

        //update query
        $update_data = "UPDATE `user_table` SET username='$user_name',user_email='$email', user_image='$user_image',
        user_address='$user_address', user_mobile='$user_mobile' WHERE user_id=$update_id";
        $result_update=mysqli_query($conn,$update_data);
        //checks if query is successful
        if ($result_update) {
            echo "<script>alert('Data updated successfully!')</script>";
            echo "<script>window.open('logout.php','_self')</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
</head>
<body>
    <h3 class="text-center mb-4">Edit Account</h3>
    <form action="" method="post" enctype="multipart/form-data">
        <!--username-->
        <div class="form-output mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_name ?>" name="user_username">
        </div>
        <!-- email -->
        <div class="form-output mb-4">
            <input type="email" class="form-control w-50 m-auto" name="user_email" value="<?php echo $email ?>">
        </div>
        <!--image-->
        <div class="form-output mb-4 d-flex w-50 m-auto">
            <input type="file" class="form-control m-auto" name="user_image">
            <img src="./user_images/<?php echo $user_image ?>" alt=""  class="edit_image">
        </div>
        <!--address-->
        <div class="form-output mb-4">
            <input type="email" class="form-control w-50 m-auto" name="user_address" value="<?php echo $user_address ?>">
        </div>
        <!-- mobile -->
        <div class="form-output mb-4">
            <input type="email" class="form-control w-50 m-auto" name="user_mobile" value="<?php echo $user_mobile ?>">
        </div>
        <input type="submit" value="Update" class="bg-info py-2 px-3 border-0" name="user_update">
    </form>
</body>
</html>