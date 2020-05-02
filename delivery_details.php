<?php
// Initialize the session
session_start();

// Include config file
require_once "config.php";

$userid = $_SESSION['uid'];
$orderid = $_SESSION['orderid'];
$err ="";
$name_no ="";
$line_1 ="";
$line_2 ="";
$town_city ="";
$region ="";
$postcode ="";
$del_time ="";
$del_date ="";

$sql2 = "SELECT max(idOrder) AS orderid FROM Orders WHERE Customers_idCustomers = $userid";
$result = (mysqli_query($link, $sql2));


if ($row = $result->fetch_assoc()) {
       $_SESSION['orderid'] = $row['orderid'];
}


if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if house name/no is empty
    if(empty(trim($_POST["name_no"]))){
        echo $err = "Please enter a house name/number. Redirecting back to delivery details page.'<br>' ";
           header( "refresh:6; url=delivery_details.html" );
    } else{
        $name_no = trim($_POST["name_no"]);
//        echo $name_no,"<br>";
    }

    // Check if address line 1 is empty
    if(empty(trim($_POST["line_1"]))){
        echo $err = "Please enter the first line of your address (street name). Redirecting back to delivery details page.'<br>' ";
           header( "refresh:6; url=delivery_details.html" );
    } else{
        $line_1 = trim($_POST["line_1"]);
//        echo $line_1,"<br>";
    }


    // Address line 2 is not always required, however this sets the $line_2 variable appropriately if it is entered, this will also be a nullable value in the db
    if(empty(trim($_POST["line_2"]))){
        $line_2 = trim($_POST["line_2"]);
    } else{
        $line_2 = trim($_POST["line_2"]);
//        echo $line_2,"<br>";
    }

    // Check if Town/city is empty
    if(empty(trim($_POST["town_city"]))){
        echo $err = "Please enter a Town/City. Redirecting back to delivery details page.'<br>' ";
           header( "refresh:6; url=delivery_details.html" );
    } else{
        $town_city = trim($_POST["town_city"]);
//        echo $town_city,"<br>";
    }

    // Check if Region is empty
    if(empty(trim($_POST["region"]))){
        echo $err = "Please enter a Region. Redirecting back to delivery details page.'<br>' ";
           header( "refresh:6; url=delivery_details.html" );
    } else{
        $region = trim($_POST["region"]);
//        echo $region,"<br>";
    }

    // Check if Postcode is empty
    if(empty(trim($_POST["postcode"]))){
        echo $err = "Please enter a Postcode. Redirecting back to delivery details page.'<br>' ";
           header( "refresh:6; url=delivery_details.html" );
    } else{
        $postcode = trim($_POST["postcode"]);
//        echo $postcode,"<br>";
    }

    // set del_time, the if statement is not required but it works, will come back to fix this at a later stage
    if(empty(trim($_POST["del_time"]))){
        echo $err = "Contact us for support.'<br>' ";
           header( "refresh:6; url=delivery_details.html" );
    } else{
        $del_time = trim($_POST["del_time"]);
//        echo $del_time,"<br>";
    }

    // set del_date, the if statement is not required but it works, will come back to fix this at a later stage
    if (empty($_POST["del_date"])){
        echo $err = "Please enter a delivery date. Redirecting back to delivery details page.'<br>' ";
           header( "refresh:6; url=delivery_details.html" );
    } else{
        $del_date = ($_POST["del_date"]);
//        echo $del_date,"<br>";
    }

    // del_instructions is not always required, however this sets the $del_instructions variable appropriately if it is entered, this will also be a nullable value in the db
    if(empty(trim($_POST["del_instructions"]))){
        $del_instructions = trim($_POST["del_instructions"]);
    } else{
        $del_instructions = trim($_POST["del_instructions"]);
//        echo $del_instructions,"<br>";
//        echo $err,"<br>";
    }

    if(empty($err)){

        // Prepare an insert statement
        $sql = "INSERT INTO delivery_details (name_no, line_1, line_2, Town_City, Region, Postcode, del_time, del_date, del_instructions, Customers_idCustomers, idOrder) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssssss", $param_name_no, $param_line1, $param_line2, $param_town_city, $param_region, $param_postcode, $param_del_time, $parm_del_date, $param_del_instructions, $param_userid, $param_orderid);

            // Set parameters
            $param_name_no = $name_no;
            $param_line1 = $line_1;
            $param_line2 = $line_2;
            $param_town_city = $town_city;
            $param_region = $region;
            $param_postcode =$postcode;
            $param_del_time = $del_time;
            $parm_del_date = $del_date;
            $param_del_instructions = $del_instructions;
            $param_userid = $userid;
            $param_orderid = $_SESSION['orderid'];

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
               
                echo "Address entered successfully! Redirecting to payment details page";
                header( "refresh:5; url=payment_details.html" );
            } 
        

                else {
                echo $err; // = "Something went wrong. Please try again later or contact us, redirecting back to basket.";
                header( "refresh:10; url=shopping-cart.php" );
            }
}
            // Close statement
            mysqli_stmt_close($stmt);
}
}

?>
