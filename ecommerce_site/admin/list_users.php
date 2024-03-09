<h3 class="text-center">All Users</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
    <!--php code to select data and populate table-->
    <?php 
    $get_users = "SELECT * FROM `user_table`";
    //query to run
    $result=mysqli_query($conn,$get_users);
    //count number of rows if users exist
    $row_count = mysqli_num_rows($result);

if($row_count== 0){
    echo "<h2 class='text-danger text-center mt-5'>No users yet</h2>";
}else{
    echo "<tr>
    <th>Serial No.</th>
    <th>Username</th>
    <th>User Email</th>
    <th>User Image</th>
    <th>User Address</th>
    <th>User Mobile</th>
    <th>Delete</th>
    </tr>
    </thead>
    <tbody class='bg-secondary text-light'>";
    $number=0;
    //data to be displayed in the table
    while($row_data=mysqli_fetch_assoc($result)){
        $user_id=$row_data['user_id'];
        $username=$row_data['username'];
        $user_email=$row_data['user_email'];
        $user_image=$row_data['user_image'];
        $user_address=$row_data['user_address'];
        $user_mobile=$row_data['user_mobile'];
        $number++;
        //prints data to table
        echo"<tr>
            <td>$number</td>
            <td>$username</td>
            <td>$user_email</td>
            <td><img class='product_img' src='../users_area/user_images/$user_image' alt='$username'></td>
            <td>$user_address</td>
            <td>$user_mobile</td>
            <td><a href='' class='text-light'><i class='fa-solid fa-trash'></a></td>
        </tr>";
    }
}
    ?>
    </tbody>
</table>