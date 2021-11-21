<?php include '../config/constant.php';?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/admin.css">
    <title>LOG IN</title>
</head>
<body>
<div class="login">
    <h1 class="text-center">Login</h1><br>
    <?php
    if (isset($_SESSION['login'])){
        echo $_SESSION['login'];
        unset($_SESSION['login']);

    }
    if (isset($_SESSION['no-login'])){
        echo $_SESSION['no-login'];
        unset($_SESSION['no-login']);

    }


    ?>
    <form action="" method="post" class="text-center">
        Username:<br>
        <input type="text" name="username" placeholder="Enter Username"><br><br>
        Password:<br>
        <input type="password" name="password" placeholder="Enter Password"><br><br>

        <input type="submit" name="submit" value="login" class="btn-primary"><br><br>

    </form>
    <p class="text-center">Created By - GEO</p>
</div>

</body>
</html>

<?php


if (isset($_POST['submit'])){

    $username = $_POST['username'];
     $password = md5($_POST['password']);

    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
    $res = mysqli_query($con,$sql);

    $count = mysqli_num_rows($res);

    if ($count==1){
        $_SESSION['login']="<div class='success'>Login Successful</div>";
        $_SESSION['user'] = $username; //to check whether the user is logged in or not
        header('location:'.SITEURL.'admin/index.php');
    }else{
        $_SESSION['login']="<div class='error'>Login Failed</div>";
        header('location:'.SITEURL.'admin/login.php');

    }
}
