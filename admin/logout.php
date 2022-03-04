<?php
        // Include Constants.php for SITEURL
        include('../config/Constants.php');

        // 1.Destroy the session
        session_destroy(); //Unset $_SESSION['user]

        // 2. Redirect to login page
        header('location:'.SITEURL.'admin/manage-admin.php');
?>