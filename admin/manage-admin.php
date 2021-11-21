<?php include 'Partials/menu.php'; ?>

    <div class="main-content">
        <div class="wrapper">
            <h1 class="text-center">Manage Admin</h1>
            <br>

            <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
           if (isset($_SESSION['delete'])){
               echo $_SESSION['delete'];
               unset($_SESSION['delete']);
           }

           if (isset($_SESSION['update'])){
               echo $_SESSION['update'];
               unset($_SESSION['update']);
           }
            if (isset($_SESSION['usernotfound'])){
                echo $_SESSION['usernotfound'];
                unset($_SESSION['usernotfound']);
            }
            if (isset($_SESSION['change-pwd'])){
                echo $_SESSION['change-pwd'];
                unset($_SESSION['change-pwd']);
            }



            ?>
            <br><br><br>
            <a href="add-admin.php" class="btn-primary">Add Admin</a>
            <br><br>
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Full name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>

                <?php
                $slq = "SELECT * FROM tbl_admin";

                $res = mysqli_query($con, $slq);

                if ($res == TRUE) {
                    $count = mysqli_num_rows($res);//function to get all the rows in database

                    $sn = 1; //create a variable and


                    if ($count > 0) {
                        while ($rows = mysqli_fetch_assoc($res)) {
                            //using while loop to get all the data from database
                            $id = $rows['id'];
                            $full_name = $rows['full_name'];
                            $username = $rows['username'];

                            //display the values in our table
                            ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $username; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>"
                                       class="btn-danger">Delete</a>
                                </td>
                            </tr>

                            <?php

                        }
                    }
                }

                ?>


            </table>


        </div>
    </div>

<?php include "Partials/footer.php"; ?>