<?php

//start session
session_start();
// Include config file
include "config.php";
// include check user is logged in file
include_once("userloggedin.php");

$id = $_POST['my_val'];
$userid = $_SESSION['uid'];
$sql = "DELETE FROM Cart WHERE idCustomers = $userid AND Item_code = $id";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    mysqli_query($link, $sql);
//        echo $userid;
//        echo $id;

        echo "Item removed from cart, redirecting back to basket";
        header( "refresh:5; url=shopping-cart.php" );
}

    // Close connection
    mysqli_close($link);


?>
