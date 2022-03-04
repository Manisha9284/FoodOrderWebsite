<?php
        // Include Constants file
        include('../config/constants.php');

        // echo "Delete Page";
        // Check whether the id and image_name value is set or not
        if(isset($_GET['id']) AND isset($_GET['image_name']))
        {
            // Get the value and Delete
            $id = $_GET['id'];
            $image_name = $_GET['image_name'];

            // Remove the physical image file is available
            if($image_name !="")
            {
                // Image is available , so remove it
                $path = "../images/category/".$image_name;

                // Remove the image
                $remove = unlink($path);

                // If failed to remove the image then add an error mrssage and stop the process
                if($remove==false)
                {
                    // Set the Session Message
                    $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image</div>";

                    // Redirect to manage Category Page
                    header('location:'.SITEURL.'admin/manage-category.php');

                    // Stop the process
                    die();
                }
            }

            // Delete data from db
            // sql query delete data from db
            $sql = "DELETE FROM tbl_category WHERE id=$id";

            // Execute the query
            $res = mysqli_query($conn, $sql);

            // Check whether the data is available or not
            if($res==true)
            {
                // Set  Success msg and redirect
                $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
                
                header('location:'.SITEURL.'admin/manage-category.php');
            }
            else
            {
                // Set fail msg and redirect
                $_SESSION['delete'] = "<div class='error'>Failed to Delete Category</div>";

                header('location:'.SITEURL.'admin/manage-category.php');
            }

            // Redirect to manage category page with message
            
        }
        else
        {
            // Redirect to Manage Category Page
            header('location:'.SITEURL.'admin/manage-category.php');
        }
?>