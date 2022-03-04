
<?php include('partials/menu.php'); ?>

    <!-- Main Content Section Starts-->
    <div class="main-content">
        <div class="wrapper">
            <h1>MANAGE ADMIN</h1>
            <br>

            <?php 
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];//Displaying session message
                    unset($_SESSION['add']);//Removing session message
                }

                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];//Displaying session message
                    unset($_SESSION['delete']);//Removing session message
                }

                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];//Displaying session message
                    unset($_SESSION['update']);//Removing session message
                }

                if(isset($_SESSION['user-not-found']))
                {
                    echo $_SESSION['user-not-found'];
                    unset($_SESSION['user-not-found']);
                }

                if(isset($_SESSION['pwd-not-found']))
                {
                    echo $_SESSION['pwd-not-found'];
                    unset($_SESSION['pwd-not-found']);
                }

                if(isset($_SESSION['change-pwd']))
                {
                    echo $_SESSION['change-pwd'];
                    unset($_SESSION['change-pwd']);
                }
            ?>
            <br> <br><br>

                 <!-- Button to Add Admin -->
                 <a href="add-admin.php" class="btn-primary">Add Admin</a>
                 <br><br><br>

            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Full Name</th>
                    <th>UserName</th>
                    <th>Actions</th>
                </tr>

                <?php 
                    //Query to get all Admin
                    $sql = "SELECT * FROM tbl_admin";

                    //Execute the query
                    $res = mysqli_query($conn, $sql);

                    //Check Whether the query get executed or not
                    if($res==TRUE)
                    {
                        //Count Rows to check wether we have data in db or not
                        $count = mysqli_num_rows($res); //Function to get all the rows in db

                        $sn=1; //Create a variable and assign the value

                        //Check the num of rows
                        if($count>0)
                        {
                            // We Have Data ib DB
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                //Using while loop to get all the data from database.
                                //And while loop will run as long as we have data in db

                                //get individual data
                                $id=$rows['id'];
                                $full_name=$rows['full_name'];
                                $username=$rows['username'];

                                //Display the values in our table
                                ?>

                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $full_name; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                        <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                        <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                    </td>
                                </tr>


                                <?php
                            }
                        }
                        else
                        {
                            //We do not have data in db
                        }
                    }

?>

                
            </table>

        </div>
    </div>
    <!-- Main Content Ends  -->

    <?php include('partials/footer.php')?>