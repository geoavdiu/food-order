<?php include 'Partials/menu.php'; ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Update admin</h1>
        <br><br>

        <?php
         if (isset($_GET['id'])){
             $id=$_GET['id'];
         }

        if (isset($_SESSION['usernotfound'])){
            echo $_SESSION['usernotfound'];
            unset($_SESSION['usernotfound']);
        }
        if (isset($_SESSION['pwdnotmatch'])){
            echo $_SESSION['pwdnotmatch'];
            unset($_SESSION['pwdnotmatch']);
        }
        if (isset($_SESSION['change-pwd'])){
            echo $_SESSION['change-pwd'];
            unset($_SESSION['change-pwd']);
        }

        ?>

        <form action="" method="post">

            <table class="tbl-30">
                <tr>
                    <td>Current Password :</td>
                    <td><input type="password" name="current_password" value="" placeholder="Old Password"></td>
                </tr>
                <tr>
                    <td>New Password :</td>
                    <td><input type="password" name="new_password" value="" placeholder="New Password"></td>
                </tr>
                <tr>
                    <td>Confirm Password :</td>
                    <td><input type="password" name="confirm_password" value="" placeholder="ConfirmPassword"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="UPDATE PASSWORD" class="btn-secondary">
                                           </td>
                </tr>
            </table>
        </form>

    </div>
</div>

<?php

if (isset($_POST['submit'])){

    //1. Get the data from Form
    $id=$_POST['id'];
    $current_password = md5 ($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    //2. Check whether the user with current ID and
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
    $res = mysqli_query($con,$sql);

    if($res == true){
        $count = mysqli_num_rows($res);
        if ($count==1){
                    if ($new_password==$confirm_password){
                            $sql2 = "UPDATE tbl_admin SET
                            password='$new_password'
                            WHERE id=$id";

                            $res2 = mysqli_query($con,$sql2);

                            if ($res2==true){
                                $_SESSION['change-pwd'] = "<div class='success'>Password changed successfully</div>";
                                header('location:'.SITEURL.'admin/manage-admin.php');
                            }else {
                                $_SESSION['change-pwd'] = "<div class='error'>Password Not changed</div>";
                            }

                    }else {
                        $_SESSION['pwdnotmatch'] = "<div class='error'>Password dont match</div>";
                    }
        }else{
            $_SESSION['usernotfound'] = "<div class='error'>User not founds</div>";

        }
    }

    //3. Check whether the new password and confirm password match

    //4. Change Password if all above is true
}


include "Partials/footer.php"; ?>
