<?php 

    ob_start();
    // start session
    session_start();


    // create constants to store non Repeating  values
    define('SITEURL', 'http://localhost/food-order/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','food-order-new');

        $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());//create connection to db
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //selecting db
?>