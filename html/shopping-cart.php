<?php
//start session
session_start();
// Include config file
include "config.php";
// include check user is logged in file
include_once("userloggedin.php")
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Shopping Cart - Love Fruit &amp; Veg</title>
    <meta name="description" content="Our team and LF&amp;V will always be on hand to provide you with fresh fruit and veg">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="assets/css/smoothproducts.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
        <div class="container"><a class="navbar-brand logo" href="#">Love Fruit &amp; Veg</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-2"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse"
                id="navcol-2">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="index-1.php">Home</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="shopping-cart.php">My Basket</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="catalog-page.php">products</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="about-us-1.php">About Us</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="contact-us-1.php">Contact Us</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="page shopping-cart-page">
        <section class="clean-block clean-cart dark" style="background-image: url(&quot;assets/img/project/background.jpg&quot;);">
            <div class="container">
                <div class="block-heading"></div>
                <div class="content">
                    <h2 class="text-center text-info">Shopping Cart</h2>
                    <p class="text-center">Check your basket and proceed to delivery instructions.&nbsp; To remove items from cart click remove <br> To update the quantity please adjust by going back to the product from the catalogue</p>
                    <div class="row no-gutters">
                        <div class="col-md-12 col-lg-8">
                            <div class="items">
                                <div class="table-responsive">
                                    <table class="table">
                                            <tr>
                                                <th>Product</th>
                                                <th>Item Code</th>
                                                <th>Quantity</th>
                                                <th>Unit Price</th>
                                                <th>Total</th>
                                                <th>Remove?</th>
                                            </tr>
<?php   

//start session
session_start();
// Include config file
include "config.php";
// include check user is logged in file
include_once("userloggedin.php");

                                    
$userid = $_SESSION['uid'];
$sql = "SELECT Product_name, Item_code, Quantity, Price, Total FROM Cart WHERE idCustomers = $userid";
$result = mysqli_query($link, $sql); //get results from database
$sql2 = "SELECT SUM(Total) AS subtotal, SUM(Total)+5 AS total FROM Cart WHERE idCustomers = $userid";
$result2 = mysqli_query($link, $sql2);
$sql1 = "DELETE FROM Cart WHERE Item_code = $item_code AND idCustomers = $userid";
$total_cost = mysqli_query($link, $sql2);

if ($result-> num_rows > 0) {
  while ($row = $result-> fetch_assoc()) {
    echo "<tr>";
    echo "<form name='remove item' action='remove_item.php' method='post'>";
    echo "<td>".$row["Product_name"]."</td>";
    echo "<td>".$row["Item_code"]."</td>";
    echo "<td>".$row["Quantity"]."</td>";
    echo "<td>","£",$row["Price"],"</td>";
    echo "<td>","£",$row["Total"],"</td>";
    echo "<td> " . "<button class='btn btn-primary btn-block' name='my_val' value='$row[Item_code]' type='submit'>Remove</button>";

    echo "</form>";

    echo "</td>";
    echo "</tr>";
    }
    echo "</table>";
  }

else {
   echo "0 results";
  }
//    // Close connection
//    mysqli_close($link);
?>
</table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <div class="summary">
                                <h3>Summary</h3>
                                    <table class="table">
                                            <tr>
                                                <th>Sub total</th>
                                                <th>Delivery</th>
                                                <th>Total</th>
                                            </tr>
<?php

if (mysqli_num_rows($result2)> 0) 
  while ($row2 = (mysqli_fetch_assoc($result2))) {
    echo "<tr>";
    echo "<td>","£", $row2["subtotal"], "</td>";
    echo "<td>", "£5.00", "</td>";
    echo "<td>","£", $row2["total"], "</td>";
    echo "</tr>";

}

//    // Close connection
    mysqli_close($link);

?>




                                    </table>

<button class="btn btn-primary btn-block btn-lg" onclick="window.location.href = '/create_order.php';">Checkout</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script src="assets/js/smoothproducts.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>
