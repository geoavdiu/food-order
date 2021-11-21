<?php include 'Partials/menu.php'; ?>

    <div class="main-content">
        <div class="wrapper">
            <h1 class="text-center">Update admin</h1>
            <br><br>
            <?php
            //get the id of selectet Admin
            $id =$_GET['id'];
            //create sql query to get the details
            $sql = "SELECT * FROM tbl_admin WHERE id=$id";

            //execute the query
            $res = mysqli_query($con,$sql);

            if ($res == true){
                //check if the data is available
                $count = mysqli_num_rows($res);
                //check whether we have admin data
                if ($count==1){
                    //Get the details
                    $row=mysqli_fetch_assoc($res);
                    $full_name= $row['full_name'];
                    $username = $row['username'];
                }else{

                    header('location:'.SITEURL.'admin/manage-admin.php');
                }

            }

            ?>

            <form action="" method="post">

                <table class="tbl-30">
                    <tr>
                        <td>Full name :</td>
                        <td><input type="text" name="full_name" value="<?php echo $full_name;?>"></td>
                    </tr>
                    <tr>
                        <td>Username :</td>
                        <td><input type="text" name="username" value="<?php echo $username;?>"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="submit" name="submit" value="UPDATE ADMIN" class="btn-secondary">
                            <a href="<?php echo SITEURL; ?>admin/change-password.php?id=<?php echo $id; ?>" class="btn-secondary">Change Password</a>
                        </td>
                    </tr>
                </table>
            </form>

        </div>
    </div>

<?php
//check wether the submin button is clicked or not

if (isset($_POST['submit'])){

    //get all the values from form to update
    $id = $_POST['id'];
    $full_name= $_POST['full_name'];
    $username= $_POST['username'];

    //create sql query to update admin
    $sql="UPDATE tbl_admin SET
    full_name = '$full_name',
    username= '$username'
    WHERE id='$id'";


    $res = mysqli_query($con,$sql);

    if ($res==true){
        $_SESSION['update']= "<div class='success'>Admin Updated Successfully</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }else{
        $_SESSION['update']= "<div class='error'>Failed Admin Updated</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
}

?>



<?php include "Partials/footer.php";
