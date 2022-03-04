<?php include 'partials/menu.php'?>

<div class="main-content">
    <div class="wrapper">
        <h1>Show Contact</h1>
        <br><br><br>

        <?php

// Check whether id is set or not
if (isset($_GET['id'])) {
    // Get the order Details
    $id = $_GET['id'];

    // Get all order details based on this id
    // Query to get the order deatils
    $sql = "SELECT * FROM tbl_contact WHERE id=$id";

    // EXecute the query
    $res = mysqli_query($conn, $sql);

    // Count rows
    $count = mysqli_num_rows($res);

    // Check whether we have id or not
    if ($count == 1) {
        // DEtails available
        $row = mysqli_fetch_assoc($res);

        $fullname = $row['full_name'];
        $email = $row['email'];
        $message = $row['message'];

    } else {
        // Redirect to manage order page
        header('location:' . SITEURL . 'admin/manage-contact.php');

    }
} else {
    // Redirect to manage order page
    header('location:' . SITEURL . 'admin/manage-contact.php');
}
?>

        <form action="" method="POST">

        <table class="tbl-30">

             <tr>
                <td>Full Name:</td>
                <td>
                    <input type="text" name="fullname" value="<?php echo $fullname; ?>">
                </td>
            </tr>

             <tr>
                <td>Email:</td>
                <td>
                    <input type="text" name="email" value="<?php echo $email; ?>">
                </td>
            </tr>

             <tr>
                <td>Message:</td>
                <td>
                    <textarea name="message" cols="30" rows="5"><?php echo $message; ?></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <a href="<?php echo SITEURL; ?>admin/manage-contact.php?id=<?php echo $id; ?>" class="btn-secondary">Back to Contact</a>
                </td>
            </tr>

        </table>
        </form>

        <?php

// Check whether update button is clicked or not
if (isset($_POST['submit'])) {
    // echo "Clicked";
    // Get all the values from form
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $message = $_POST['message'];

}
?>

    </div>
</div>
<?php include 'partials/footer.php'?>
