<?php 

    // Include constants.php file here
    include('../config/constants.php');

    if(isset($_GET['id']) && isset($_GET['image_name']))//either we use 'AND' or '&&'
    {
        // Process to delete
        // echo "Process to Delete";

        // 1.Get id and image_name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // 2.Remove the image if available
        // Check whether th image is available or not and delete if available
        if($image_name!="")
        {
            // It has the image and need to remove from folder
            // Get the image path
            $path ="../images/food/".$image_name;

            // Remove image file from folder
            $remove =unlink($path);

            // Check whether image is removed or not
            if($remove==false)
            {
                // Failed to remove
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Image  File.</div>";

                // Redirect to manage food
                header('location:'.SITEURL.'admin/manage-food.php');

                // stop process
                die();
            }
        }

        // 3.Delete Food from db
        $sql="DELETE FROM tbl_food WHERE id='$id'";

        // Execute the query
        $res = mysqli_query($conn, $sql);

        // Check whether the query is executed or not set session msg accordingly
        // 4.Redirect to manage food with session msg
        if($res==true)
        {
            // Food Deleted
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";

            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            // Food Not Deleted
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";

            header('location:'.SITEURL.'admin/manage-food.php');
        }

       
    }
    else
    {
        // Redirect to manage food page
        // echo "Redirect";
        $_SESSION['unauthorize']= "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>