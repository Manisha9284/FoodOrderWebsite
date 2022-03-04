<?php include 'partials/menu.php';?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>

        <?php
//checking whether the session is set or not
if (isset($_SESSION['add'])) {
    echo $_SESSION['add']; //Displaying session message
    unset($_SESSION['add']); //Removing session message
}
?>


        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary">

                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include 'partials/footer.php';?>

<?php
// process the value from form and save it in Database
// Check whether the submit button is clicked or not

if (isset($_POST['submit'])) {
    //  button clicked
    // echo "Button Clicked";

    // !.Get data from form       ```````````````````````````````````````````````````````````````````````````
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']); //Password Encryption with MD5

    //  2. SQL Query to save data into database
    $sql = "INSERT INTO tbl_admin SET
                full_name='$full_name',
                username='$username',
                password='$password'
                ";

    // 3. Execute query and save data in database
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    // 4. Check whether the (Query is Executed) data is inserted or not and display appropriate message
    if ($res == true) {
        // Data Inserted
        // echo "Data Inserted";
        // create a Session variable to display message
        $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";

        // Redirect Page Manage Admin
        header("Location:" . SITEURL . 'admin/manage-admin.php');
    } else {
        // Data not inserted
        // echo "Fail to insert Data ";
        // create a Session variable to display message
        $_SESSION['add'] = "<div class='error'> Fail To Add Admin.</div>";

        // Redirect Page Add Admin
        header("Location:" . SITEURL . 'admin/add-admin.php');
    }
}

?>