<?php include '../config/Constants.php';?>

<html>
        <head>
                <title>Login - Food Order System</title>
                <link rel="stylesheet" href="../css/admin.css">
        </head>

        <body>
                <div class="login">
                    <h1 class="text-center">Login</h1>
                    <br><br>

                    <?php
if (isset($_SESSION['login'])) {
    echo $_SESSION['login'];
    unset($_SESSION['login']);
}

if (isset($_SESSION['no-login-message'])) {
    echo $_SESSION['no-login-message'];
    unset($_SESSION['no-login-message']);
}
?>

                    <br><br>


                        <!-- Login Starts here -->
                        <form action="" method="POST" class="text-center">
                            Username:<br>
                            <input type="text " name="username" placeholder="Username"><br>
                            <br>

                            Password:<br>
                            <input type="password" name="password" placeholder="Password"><br>

                            <br>
                            <input type="submit" name="submit" value="Login" class="btn-primary"><br><br>
                        </form>
                        <!-- Login Starts here -->

                    <p class="text-center">Created By - <a href="www.manujadhav.com">Manisha Jadhav</a></p>
                </div>

        </body>
</html>

<?php
// Check whether the submit button is clicked or not
if (isset($_POST['submit'])) {
    // Process login form
    // 1.Get the data from form
    // $username = $_POST['username'];
    $username = mysqli_real_escape_string($conn, $_POST['username']);

    $password = md5($_POST['password']);

    //2.SQL to check whether the user with username and password exist or not
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    // 3.Execute SQL Query
    $res = mysqli_query($conn, $sql);

    // 4.Count rows to check whether the user exist or not
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        // user available and Login Success
        $_SESSION['login'] = "<div class='success'>Login Successfull</div>";
        $_SESSION['user'] = $username; //To check whether the user is logged in or not and logout will unset it

        // redirect to home page/Dashboard
        header('location:' . SITEURL . 'admin/');
    } else {
        // user not available and Login Failed
        $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match</div>";

        //   Redirect to login page
        header('location:' . SITEURL . 'admin/login.php');
    }
}
?>