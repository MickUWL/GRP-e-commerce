<?php
// Initialize the session
session_start();

// Include config file
require_once "config.php";

$userid = $_SESSION['uid'];
$orderid = $_SESSION['orderid'];
$err ="";
$card_type ="";
$card_no ="";
$exp_month ="";
$exp_year ="";
$issue_no ="";
$sec_no ="";
$fname ="";
$lname ="";
$postcode ="";
$house_name_no ="";



if($_SERVER["REQUEST_METHOD"] == "POST"){

    // set card_type, the if statement is not required but it works, will come back to fix this at a later stage
    if(empty(trim($_POST["card_type"]))){
        echo $err = "Contact us for support ";
           header( "refresh:6; url=delivery_details.html" );
    } else{
        $card_type = trim($_POST["card_type"]);
//        echo $card_type,"<br>";
    }


    // Check if card number is empty
    if(empty(trim($_POST["card_no"]))){
        echo $err = "Please enter the card number. Redirecting back to delivery details page'<br>' ";
           header( "refresh:6; url=delivery_details.html" );
    } else{
        $card_no = trim($_POST["card_no"]);
//        echo $card_no,"<br>";
    }

    // Check if expiry month is empty
    if(empty(trim($_POST["exp_month"]))){
        echo $err = "Please enter the cards expiry month (MM). Redirecting back to delivery details page'<br>' ";
           header( "refresh:6; url=delivery_details.html" );
    } else{
        $exp_month = trim($_POST["exp_month"]);
//        echo $exp_month,"<br>";
    }

    // Check if expiry year is empty
    if(empty(trim($_POST["exp_year"]))){
        echo $err = "Please enter the cards expiry year (YYYY). Redirecting back to delivery details page'<br>' ";
           header( "refresh:6; url=delivery_details.html" );
    } else{
        $exp_year = trim($_POST["exp_year"]);
//        echo $exp_year,"<br>";
    }



    // Issue number is not always required, however this sets the $issue_no variable appropriately if it is entered, this will also be a nullable value in the db
    if(empty(trim($_POST["issue_no"]))){
        $issue_no = " ";
        echo $line_2,"<br>";
    } else{
        $issue_no = trim($_POST["issue_no"]);
//        echo $line_2,"<br>";
    }

    // Check if security number is empty
    if(empty(trim($_POST["sec_no"]))){
        echo $err = "Please enter the cards security number. Redirecting back to payment details page'<br>' ";
           header( "refresh:6; url=payment_details.html" );
    } else{
        $sec_no = trim($_POST["sec_no"]);
//        echo $sec_no,"<br>";
    }

    // Check if first name is empty
    if(empty(trim($_POST["fname"]))){
        echo $err = "Please enter the cardholders first name. Redirecting back to payment details page'<br>' ";
           header( "refresh:6; url=payment_details.html" );
    } else{
        $fname = trim($_POST["fname"]);
//        echo $fname,"<br>";
    }

    // Check if last name is empty
    if(empty(trim($_POST["lname"]))){
        echo $err = "Please enter the cardholders last name. Redirecting back to payment details page'<br>' ";
           header( "refresh:6; url=payment_details.html" );
    } else{
        $lname = trim($_POST["lname"]);
//        echo $lname,"<br>";
    }


    // Check if Postcode is empty
    if(empty(trim($_POST["postcode"]))){
        echo $err = "Please enter a Postcode. Redirecting back to payment details page'<br>' ";
           header( "refresh:6; url=payment_details.html" );
    } else{
        $postcode = trim($_POST["postcode"]);
//        echo $postcode,"<br>";
    }

    // Check if house name/number is empty
    if(empty(trim($_POST["name_no"]))){
        echo $err = "Please enter a the cardholders house name/number. Redirecting back to payment details page'<br>' ";
           header( "refresh:6; url=payment_details.html" );
    } else{
        $house_name_no = trim($_POST["name_no"]);
//        echo $house_name_no,"<br>";
    }


    if(empty($err)){

        // Prepare an insert statement
        $sql = "INSERT INTO Payment_details (Card_type, Card_no, Expiry_month, Expiry_year, Issue_no, Security_no, First_name, Last_name, Postcode, house_name_no) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssss", $param_card_type, $param_card_no, $param_expiry_month, $param_expiry_year, $param_issue_no, $param_sec_no, $param_fname, $parm_lname, $param_postcode, $param_house_name_no);

            // Set parameters
            $param_card_type = $card_type;
            $param_card_no = $card_no;
            $param_expiry_month = $exp_month;
            $param_expiry_year = $exp_year;
            $param_issue_no = $issue_no;
            $param_sec_no = $sec_no;
            $param_fname = $fname;
            $parm_lname = $lname;
            $param_postcode = $postcode;
            $param_house_name_no = $house_name_no;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
               
                echo "SUCCESS!!<br>";
                header( "refresh:10; url=index-1.php" );
            } 
        

                else {
                echo $err = "Something went wrong. Please try again later or contact us, redirecting back to payment details <br>";
                header( "refresh:10; url=payment_details.html" );
            }
}
            // Close statement
            mysqli_stmt_close($stmt);
}
sleep(1);
$sql3 = "SELECT max(idPayment_details) AS paymentid FROM Payment_details WHERE Card_no = $card_no";
$result1 = (mysqli_query($link, $sql3));


if ($row = $result1->fetch_assoc()) {
       $paymentid = $row['paymentid'];

}
sleep(1);

$sql4 = "UPDATE Orders SET Payment_details_idPayment_details = (SELECT max(idPayment_details) AS paymentid FROM Payment_details WHERE Card_no = $card_no) WHERE idOrder = $orderid";
if (mysqli_query($link, $sql4)) {
    echo "Payment entered successfully! Redirecting to homepage.  <br> Your order number is $_SESSION[orderid]<br> Your payment ref is $paymentid <br>";

}

$sql10 = "SELECT Item_code, Quantity FROM Cart WHERE idCustomers = $userid";
$result10 = mysqli_query($link, $sql10); //get results from database

while($row10 = $result10-> fetch_assoc())  {
  $sql11 = "UPDATE Products SET QtyInStock = (SELECT QtyInStock - $row10[Quantity]) WHERE idProducts = $row10[Item_code]";
  mysqli_query($link, $sql11);
} 



sleep(1);

$sql5 = "DELETE from Cart where idCustomers = $userid";
if (mysqli_query($link, $sql5)) {
    echo "<br>your cart has been emptied";
}


$file = "stock_levels/stock.txt";
$f = fopen($file, 'w'); // Open in write mode

$sql20 = "Select NOW() AS TIME, idProducts, Name, QtyInStock from Products where QtyInStock <= 6";
$result20 = mysqli_query($link, $sql20);
while($row20 = mysqli_fetch_array($result20))
{
    $time = $row20['TIME'];
    $prodid = $row20['idProducts'];
    $prodname = $row20['Name'];
    $quantity = $row20['QtyInStock'];

    $low_stock = "Last checked on :$time\nProductID:$prodid\nProduct Name:$prodname\nQuantity in stock:$quantity\n\n";
    // Or "$user:$pass\n" as @Benjamin Cox points out

    fwrite($f, $low_stock);
}

fclose($f);

}
?>
