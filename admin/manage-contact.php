<?php include 'partials/menu.php';?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Contact</h1>
        <br><br><br>

         <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Action</th>
            </tr>
             <?php
$sql = "SELECT * FROM tbl_contact ORDER BY id DESC"; //Display the Latest Order by First i.e. latest placed order will displayed on top of table row

// Execute the query
$res = mysqli_query($conn, $sql);

// Count rows
$count = mysqli_num_rows($res);

$sn = 1; //Create a serial no and set its initial value as 1

// Check whether the order is placed or not
if ($count > 0) {
    // Order available
    while ($row = mysqli_fetch_assoc($res)) {
        $id = $row['id'];
        $fullname = $row['full_name'];
        $email = $row['email'];
        $message = $row['message'];

        ?>

                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $fullname; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><?php echo $message; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/show-contact.php?id=<?php echo $id; ?>" class="btn-secondary">Show Contact</a>
                                </td>
                            <?php

    }
} else {
    // Order not available
    echo "<div class='error'>Contact Not Available.</div>";
}
?>




        </table>



    </div>
</div>
<?php include 'partials/footer.php';?>
