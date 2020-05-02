<?php
//start session
session_start();
// Include config file
include "config.php";

$userid = $_SESSION['uid'];
$item_code = $_POST['item_code'];
$quantity = $_POST['qty'];
$product_name = $_POST['product'];
$price = $_POST['price'];



// Prepare an insert statement
$sql0 = "select count(*) from Cart where idcustomers = $userid and Item_code = $item_code";
$sql = "INSERT INTO Cart (idCustomers, Item_code, Price, Product_name, Quantity) VALUES ($userid, $item_code, $price, '$product_name', $quantity)";
$sql1 = "UPDATE Cart SET Quantity = $quantity WHERE idCustomers = $userid AND Item_code = $item_code";
$result = mysqli_query($link, $sql0);
$row = $result -> fetch_assoc();
$sql2 = "UPDATE Cart Set Total = Quantity * Price";

if($row['count(*)'] >= 1) {
    mysqli_query($link, $sql1);
    mysqli_query($link, $sql2);
    echo "Item already in cart, updating quantity to newly entered value, redirecting to product page";
    header( "refresh:4; url=catalog-page.php" );
}
  else {
    mysqli_query($link, $sql);
    mysqli_query($link, $sql2);
    echo "Item added to cart, redirecting to product page";
    header( "refresh:4; url=catalog-page.php" );
  }

//if(mysqli_query($link, $sql)) {
//   echo "Item added to cart, redirecting to product page";
//   header( "refresh:3; url=catalog-page.php" );
//}
    

    // Close connection
    mysqli_close($link);

?>
