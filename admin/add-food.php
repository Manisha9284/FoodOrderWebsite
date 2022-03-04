<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Food</h1>
            <br><br>

            <?php
            
                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" placeholder="Title of the Food">
                        </td>
                    </tr>

                    <tr>
                        <td>Description:</td>
                        <td>
                            <textarea name="description" cols="30" rows="5" placeholder="Description of the Food"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Price:</td>
                        <td>
                            <input type="number" name="price">
                        </td>
                    </tr>

                    <tr>
                        <td>Select Image:</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>Category:</td>
                        <td>
                            <select name="category" >
                                <?php
                                    // Create PHP Code to display categories from db
                                    // 1.Create SQL to get all active categories from db
                                    $sql="SELECT * FROM tbl_category WHERE active='Yes' ";

                                    // Execute query
                                    $res=mysqli_query($conn, $sql);

                                    // Count the rows to check whether we have categories or not
                                    $count =mysqli_num_rows($res);

                                    // If count is greater than zero , we have categories else we don't have category
                                    if($count>0)
                                    {
                                        // We have categories
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            // Get the details of category 
                                            $id=$row['id'];
                                            $title=$row['title'];
                                            ?>

                                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        // We don't have categories
                                        ?>
                                        <option value="0">No Category Found</option>
                                        <?php
                                    }

                                    // 2.Display on dropdown
                                ?>
                            
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input type="radio" name="featured" value="Yes">Yes
                            <input type="radio" name="featured" value="No">No
                        </td>
                    </tr>

                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="No">No
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            
            </form>

            <!-- INSERT DATA IN DB -->
            <?php
                // Check whether the button is clicked or not
                if(isset($_POST['submit']))
                {
                    // Add the food in db
                    // echo "Clicked";
                    
                    // 1.Get the data from form
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $category = $_POST['category'];

                    // Check whether radio button for featured and active are checked or not
                    if(isset($_POST['featured']))
                    {
                        $featured = $_POST['featured'];
                    }
                    else
                    {
                        $featured = "No";//Selecting default value
                    }

                     if(isset($_POST['active']))
                    {
                        $active = $_POST['active'];
                    }
                    else
                    {
                        $active = "No";//Selecting default value
                    }

                    // 2.Upload the image if selected
                    // Check whether select image is clicked or not and upload image only if the image is selected
                    if(isset($_FILES['image']['name']))
                    {
                        // Get the deatils of image selected
                        $image_name=$_FILES['image']['name'];

                        // Check whether the image is selected or not if selected only if upload
                        if($image_name!="")
                        {
                            // image selected
                            // A.Rename Image
                            // Get the extension of selected image(jpg, png, gif, etc) "manisha-jadhav.jpg"
                            $ext = end(explode('.', $image_name));
                            
                            // Create new name for image
                            $image_name = "Food-Name".rand(000, 999).".".$ext; //new image name may be like "Food-Name-657.jpg"

                            // B. Uplaod image
                            // Get source and destination path

                            // Source path is the current location of the image 
                            $src = $_FILES['image']['tmp_name'];

                            // Destination path for the image to be uploaded
                            $dst = "../images/food/".$image_name;

                            // Finally upload the food image
                            $upload = move_uploaded_file($src, $dst);

                            // Check whether the image is uploaded or not
                            if($upload==false)
                            {
                                // Failed to upload the image
                                // Redirect to Add Food Page with error msg
                                $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";

                                header('location:'.SITEURL.'admin/add-food.php');
                                // stop the process
                                die();
                            }
                        } 
                        
                    } 
                    else
                    {
                        $image_name="";//selecting default name as blank
                    }

                    // 3.Insert data in db

                    // Create SQL Query to save data in db
                    // For numerical value we don't need value inside quotes '' but for string value it's compulsory
                    $sql2 = "INSERT INTO tbl_food SET
                    title= '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active' 
                    ";

                    // Execute the query
                    $res2 = mysqli_query($conn, $sql2);
                    
                    // Check whether data is inserted
                    // 4. Redirect to manage food with session msg 
                    if($res2 == true)
                    {
                        // data inserted successfully
                        $_SESSION['add']="<div class='success'>Food Added Successfully.</div>";

                        // Redirect
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }
                    else
                    {
                        // data not inserted successfully
                        $_SESSION['add']="<div class='error'>Failed to Add Food.</div>";

                        // Redirect
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }

                    
                }
            ?>
        </div>
    </div>
<?php include('partials/footer.php'); ?>















