<?php include 'partials-front/menu.php';?>

<section class="contact">
    <div class="content">
        <h2>Contact Us</h2>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iusto, fugit doloremque distinctio rerum nemo nisi quo ducimus.
        Veniam cum ipsa quam, illum, modi cupiditate porro dignissimos voluptatem iure, similique soluta?</p>
    </div>

    <div class="container1">
        <div class="contactInfo">
            <div class="box">
                <div class="icon"><svg xmlns="http://www.w3.org/2000/svg"  width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 384 512">
                <path d="M172.268 501.67C26.97 291.031 0 269.413 0 192C0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67c-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80s-80 35.817-80 80s35.817 80 80 80z" fill="#626262"/></svg>
                </div>
                    <div class="text">
                        <h3>Address</h3>
                        <p>4671 Sugar Camp Road,<br>Owatonna,Minnesota,<br>55060</p>
                    </div>
            </div>

            <div class="box">
                <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"  viewBox="0 0 24 24"><g fill="#626262">
                <path d="M10.554 6.24L7.171 2.335c-.39-.45-1.105-.448-1.558.006L2.831 5.128c-.828.829-1.065 2.06-.586 3.047a29.207 29.207 0 0 0 13.561 13.58c.986.479 2.216.242 3.044-.587l2.808-2.813c.455-.455.456-1.174.002-1.564l-3.92-3.365c-.41-.352-1.047-.306-1.458.106l-1.364 1.366a.462.462 0 0 1-.553.088a14.557 14.557 0 0 1-5.36-5.367a.463.463 0 0 1 .088-.554l1.36-1.361c.412-.414.457-1.054.101-1.465z" stroke="#626262" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></g></svg>
                </div>
                    <div class="text">
                        <h3>Phone</h3>
                        <p>+91 9284808008</p>
                    </div>
            </div>

            <div class="box">
                <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg"  width="1em" height="1em" viewBox="0 0 32 32">
                <path d="M28 6H4a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h24a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2zm-2.2 2L16 14.78L6.2 8zM4 24V8.91l11.43 7.91a1 1 0 0 0 1.14 0L28 8.91V24z" fill="#626262"/></svg>
                </div>
                    <div class="text">
                        <h3>Email</h3>
                        <p>manujadhav@gmail.com</p>
                    </div>
            </div>
        </div>

        <div class="contactForm">
            <form action="" method="POST">
                <h2>Send Message</h2>
                <div class="inputBox">
                    <input type="text" name="fullname"  class="input-responsive" required="required">
                    <span>Full Name</span>
                </div>

                <div class="inputBox">
                    <input type="email" name="email"  class="input-responsive" required="required">
                    <span>Email</span>
                </div>

                <div class="inputBox">
                    <textarea name="message" class="input-responsive" required="required"></textarea>
                    <span>Type your Message...</span>
                </div>

                <div class="inputBox">
                    <input type="submit" name="send" value="Send">
                </div>

            </form>

                <?php

//CHeck whether submit button is clicked or not
if (isset($_POST['send'])) {
    // Get all the details from the form

    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    //Save the Order in Databaase
    //Create SQL to save the data
    $sql2 = "INSERT INTO tbl_contact SET
                                        full_name = '$fullname',
                                        email = '$email',
                                        message = '$message'
                                    ";

    //echo $sql2; die();

    //Execute the Query
    $res2 = mysqli_query($conn, $sql2);

    //Check whether query executed successfully or not
    if ($res2 == true) {
        //Query Executed and Order Saved
        echo "<script>alert('Query Submitted Successfully.Thank You.')</script>";
    } else {
        //Failed to Save Order
        echo "<script>alert('Something Went Wrong!!')</script>";

    }

}

?>
</div>
</div>

</section>


<?php include 'partials-front/footer.php';?>

