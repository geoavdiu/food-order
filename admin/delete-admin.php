<?php
include "../config/constant.php";



//get the ID of Admin to be deleted
$id = $_GET['id'];
//Create SQL query to delete Admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";

//execute the query
$res = mysqli_query($con,$sql);

//check wether the query executed successfully or not
if ($res ==true){
    //create ssesion variable to display maadage
    $_SESSION['delete'] = "<div class='success'>Admin Deletet Successfully.</div>";

    header('location:'.SITEURL.'admin/manage-admin.php');
}else{{
    $_SESSION['delete'] = "<div class='error'>Failed to delete Admin.</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}}
//Redirect to manage admin page with meesaage