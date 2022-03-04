<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1>
            <br><br>

            <?php
            
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?>
            <br><br>

            <!-- Add category form starts -->
            <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" placeholder="Category Title">
                        </td>
                    </tr>

                    <tr>
                        <td>Seclect Image:</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input type="radio" name="featured" value="Yes" >Yes
                            <input type="radio" name="featured" value="No" >No
                        </td>
                    </tr>

                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name="active" value="Yes" >Yes
                            <input type="radio" name="active" value="No" >No
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                        </td>
                    </tr>


                </table>

            </form>
            <!-- Add category form Ends -->

            <?php
                // Check whether the submit Button is Clicked or not
                if(isset($_POST['submit']))
                {
                    // echo "Clicked";

                // 1.GET THE VALUE FROM CATEGORY FORM
                    $title = $_POST['title'];

                    // For radio input, we need to check whether the button is selected or not
                    if(isset($_POST['featured']))
                    {
                        // Get the value from form 
                        $featured = $_POST['featured'];
                    }
                    else
                    {
                        // set the default value
                         $featured = "No";
                    }

                    // for active
                    if(isset($_POST['active']))
                    {
                        // Get the value from form
                        $active = $_POST['active'];
                    }
                    else
                    {
                        // set the default value
                        $active = "No";
                    }

                    // Check whether image is selected or not and set value for image name accordingly
                    //print_r($_FILES['image']); //As our button type is file so that we use files array

                    //die();//Break the code here because we dont want to upload image to the db but want to see 
                            // whether image is selected

                    
                            // [name of img] [name of array] 
                    if(isset($_FILES['image']['name']))
                    {
                        // Upload the image 
                        // To upload image we need image name, sourse path and destination path
                        $image_name = $_FILES['image']['name'];

                        // Upload image only if image is selected
                        if($image_name!="")
                        {
                            // Auto Rename our image
                            // Get the Extension of our image(jpg, png, gif, etc) e.g. "specialfood.jpg"
                            $ext = end(explode('.', $image_name));

                            // Rename the image
                             $image_name = "Food_Category_".rand(000, 999).'.'.$ext; //new image name will be 
                                                                                //e.g.Food_Category_834.
                            $sourse_path = $_FILES['image']['tmp_name'];
                            $destination_path = "../images/category/".$image_name;

                            //Finally upload image
                            $upload = move_uploaded_file($sourse_path, $destination_path);

                            // Check whether the image is uploaded or not 
                            // if the image is not uploaded then we will stop the process and redirect with error message
                            if($upload==false)
                            {
                                 // Set message
                                 $_SESSION['upload'] = "<div class='error'>Failed to upload</div>";

                                // Redirect to add category page
                                header('location:'.SITEURL.'admin/add-category.php');

                                // Stop the process
                                die();
                            }
                        }
                    }
                    else
                    {
                        // Don't upload image and set the image_name value as blank
                        $image_name="";
                    }

                    // 2. CREATE SQL QUERY TO INSERT CATEGORY DATA INTO DB
                    $sql = "INSERT INTO tbl_category SET
                        title='$title',
                        image_name='$image_name',
                        featured='$featured',
                        active='$active'
                        ";
                    
                    // 3.EXECUTE THE QUERY AND SAVE IN DB
                    $res = mysqli_query($conn, $sql);

                    // 4.CHECK WHETHER THE QUERY EXECUTED OR NOT AND DATA ADDED OR NOT
                    if($res==true)
                    {
                        // Qery executed and category added
                        $_SESSION['add']="<div class='success'>Category Added Successfully</div>";

                        // Redirect to Manage category Page
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                    else
                    {
                        // Failed to add
                        $_SESSION['add']="<div class='error'>Failed to Add Category</div>";

                        // Redirect to Manage category Page
                        header('location:'.SITEURL.'admin/add-category.php');
                    }
                }
            
            ?>
        </div>
    </div>

<?php include('partials/footer.php'); ?>