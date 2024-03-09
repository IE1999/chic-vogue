    <h3 class="mb-4">Delete Account</h3>
    <form action="" method="post">
        <!-- delete account button -->
        <div class="form-outline mb-4">
            <input type="submit" class="form-control w-50 m-auto" name="delete" value="Delete Account">
        </div>
        <div class="form-outline mb-4">
            <input type="submit" class="form-control w-50 m-auto" name="keep" value="Keep Account">
        </div>
    </form>

<?php
//query to destroy session and user account if delete button is clicked
$user_session = $_SESSION['username'];
if(isset($_POST['delete'])){
    $delete_query = "DELETE FROM `user_table` WHERE username=$user_session";
    $result = mysqli_query($conn, $delete_query);
    if($result){
        session_destroy();
        echo "<script>alert('Account deleted successfully!')</script>";
        echo "<script>window.open('../index.php','_self')</script>";
    }
}

//query to keep account if keep account button is clicked
if(isset($_POST['keep'])){
    echo "<script>window.open('profile.php','_self')</script>";
}
?>