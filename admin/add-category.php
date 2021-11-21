<?php include 'Partials/menu.php'; ?>

    <div class="main-content">
        <div class="wrapper">
            <h1 class="text-center">Add admin</h1>
            <br><br>

            <?php
            if (isset($_SESSION['add-category'])){
                echo $_SESSION['add-category'];
                unset ($_SESSION['add-category']);
            }
            if (isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset ($_SESSION['upload']);
            }
            ?>
            <form action="" method="post" enctype="multipart/form-data">

                <table class="tbl-30">
                    <tr>
                        <td>Title :</td>
                        <td><input type="text" name="title"></td>
                    </tr>
                    <tr>
                        <td>Select Image : </td>
                        <td><input type="file" name="image"></td>
                    </tr>
                    <tr>
                        <td>Featured :</td>
                        <td><input type="radio" name="featured" value="yes">Yes
                        <input type="radio" name="featured" value="no">No
                        </td>
                    </tr>
                    <tr>
                        <td>Active :</td>
                        <td><input type="radio" name="active" value="yes">Yes
                        <input type="radio" name="active" value="no">No

                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="ADD CATEGORTY" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

        </div>
    </div>


<?php include "Partials/footer.php";

if (isset($_POST['submit'])) {

    $title = $_POST['title'];

    if (isset($_POST['featured'])) {

        $featured = $_POST['featured'];
    } else {
        $featured = "No";
    }
    if (isset($_POST['active'])) {

        $active = $_POST['active'];
    } else {
        $active = "No";
    }

    if (isset($_FILES['image']['name'])){
        //to upload image we need image name ,source path and destination
        $image_name = $_FILES['image']['name'];
        //auto rename the image
        $ext = end(explode('.',$image_name));

        $image_name = "Food_category_".rand(000,999).'.'.$ext;

        $source = $_FILES['image']['tmp_name'];
        $destination = "../images/category/".$image_name;

        $upload = move_uploaded_file($source,$destination);

        if ($upload ==false){
            echo $_SESSION['upload']= "<div class='error'>Failed to upload image</div>";
            header('location:'.SITEURL.'admin/add-category.php');
            //stop the procces
            die();
        }
    }else{
        $image_name="";
    }

    $sql = "INSERT INTO tbl_category SET 
    title='$title',
    image_name='$image_name',
    featured='$featured',
    active='$active'";

    $res = mysqli_query($con, $sql);

    if ($res == true) {

        echo $_SESSION['add-category'] = "<div class='success'>Category added successfully</div>";
        header('location:' . SITEURL . 'admin/manage-category.php');
    } else {
        echo $_SESSION['add-category'] = "<div class='error'>Category added Failed</div>";
    }
}
