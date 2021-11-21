<?php include 'Partials/menu.php'; ?>

    <div class="main-content">
        <div class="wrapper">
            <h1 class="text-center">Add admin</h1>
            <br><br>

            <?php
            if (isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset ($_SESSION['add']);
            }


            ?>
            <form action="" method="post">

                <table class="tbl-30">
                    <tr>
                        <td>Full name :</td>
                        <td><input type="text" name="full_name"></td>
                    </tr>
                    <tr>
                        <td>Username :</td>
                        <td><input type="text" name="username"></td>
                    </tr>
                    <tr>
                        <td>Password :</td>
                        <td><input type="password" name="password"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="ADD ADMIN" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

        </div>
    </div>


<?php include "Partials/footer.php";

if (isset($_POST['submit'])){
    //Get the data from form =
    $full_name = $_POST['full_name'];
    $username  = $_POST['username'];
    $password  = md5($_POST['password']);  //password Encryption with MD5
    //sql query to save the data into database =

    $sql = "INSERT INTO tbl_admin SET 
            full_name='$full_name',
            username = '$username',
            password = '$password'";

    //execute query and save data iin database =
    $con = mysqli_connect('localhost','root',"",'food-order') or die(mysqli_error());
    $res = mysqli_query($con,$sql)or die (mysqli_error());
    if ($full_name==1){

    }

    if ($res==TRUE) {
        //create a sesion Variable to display messega
        $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";
        header("location:".SITEURL.'admin/manage-admin.php');


    }else {
        $_SESSION['add'] = 'Admin Added Failed';
        header("location:".SITEURL.'admin/add-admin.php');
    }
}


