<?php


//start session
session_start();
// Include config file
include "config.php";
// include check user is logged in file
include_once("userloggedin.php");


$userid = $_SESSION['uid'];
$sql = "INSERT INTO Orders (OrderDate, Customers_idCustomers) VALUES(now(), $userid)";
$sql2 = "SELECT max(idOrder) AS orderid FROM Orders WHERE Customers_idCustomers = $userid";
$result = (mysqli_query($link, $sql2));
//$sql3 = "SELECT Item_code, Quantity FROM Cart WHERE idCustomers = $userid";
//$result1 = mysqli_query($link, $sql3);
//$row1 = $result1 -> fetch_assoc();
$sql4 = "INSERT INTO Order_has_Products (Order_idOrder, Products_idProducts, Quantity) VALUES($orderid, $row0[Item_code], $row0[Quantity])";


if (mysqli_query($link, $sql)) {
   echo "order created....";
}



sleep(1);

$sql2 = "SELECT max(idOrder) AS orderid FROM Orders WHERE Customers_idCustomers = $userid";
$result = (mysqli_query($link, $sql2));

if ($result-> num_rows > 0) {
  while ($row = $result-> fetch_assoc()) {
       $_SESSION['orderid'] = $row['orderid'];
       $orderid = $row['orderid'];
       echo "<br> orderid = $orderid";

}
}


sleep(1);

$sql3 = "SELECT Item_code, Quantity FROM Cart WHERE idCustomers = $userid";
$result1 = mysqli_query($link, $sql3);

if ($result1-> num_rows > 0) {
  while ($row0 = $result1-> fetch_assoc()) {
               (mysqli_query($link, "INSERT INTO Order_has_Products (Order_idOrder, Products_idProducts, Quantity) VALUES($orderid, $row0[Item_code], $row0[Quantity])"));
}
}

$sql4 = "INSERT INTO Order_has_Products (Order_idOrder, Products_idProducts, Quantity) VALUES($orderid, $row[Item_code], $row[Quantity])";



//if ($row = $result1->fetch_assoc()) {
//   (mysqli_query($link, "INSERT INTO Order_has_Products (Order_idOrder, Products_idProducts, Quantity) VALUES($orderid, $row[Item_code], $row[Quantity])"));

// Simple echo statements used to confirm correct details were input in the above command
//  echo "orderID - ",$_SESSION['orderid'],"<br>";
//  echo "itemcode - ",$row0['Item_code'],"<br>";
//  echo "qty - ",$row0['Quantity'],"<br>";
//}


//else{
//   echo "something went wrong, contact support";
//}

    header( "refresh:5; url=delivery_details.html" );

    // Close connection
    mysqli_close($link);


?>
