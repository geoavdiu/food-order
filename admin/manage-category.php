<?php include 'Partials/menu.php'; ?>

    <div class="main-content">
        <div class="wrapper">
            <h1 class="text-center">Manage Catagery</h1>
            <br><br>
            <?php
            if (isset($_SESSION['add-category'])) {
                echo $_SESSION['add-category'];
                unset ($_SESSION['add-category']);
            }
            ?>
            <br><br>
            <a href="add-category.php" class="btn-primary">Add Category</a>
            <br><br>
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
                <?php

                $sn = 1;
                //query to get all from data base
                $sql = "SELECT * FROM tbl_category";

                //execute query
                $res = mysqli_query($con, $sql);

                $count = mysqli_num_rows($res);
                //check wether we have data in data base
                if ($count > 0) {

                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $title ?></td>
                            <td>
                                <?php
                                //check whether image name is available or not
                                if ($image_name!=""){
                                    ?>
                                    <img src="../images/category/<?php  echo $image_name;?>" width="100px" >
                                        <?php
                                }else{
                                    echo "<div class='error'>Image not Added</div>";
                                }
                                ?>
                            </td>
                            <td><?php echo $featured ?></td>
                            <td><?php echo $active ?></td>

                            <td>
                                <a href="#" class="btn-secondary">Update</a>
                                <a href="#" class="btn-danger">Delete</a>
                            </td>
                        </tr>


                        <?php

                    }
                } else {
                    ?>

                    <tr>
                        <td colspan="6">
                            <div class="error">Ni category added.</div>
                        </td>
                    </tr>

                    <?php
                }


                ?>


            </table>

            <div class="clearfix"></div>

        </div>
    </div>

<?php include "Partials/footer.php"; ?>