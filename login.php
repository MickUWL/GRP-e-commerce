<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index-1.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$email = "";
$password = "";
$email_err = "";
$password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["email"]))){
        echo $email_err = "Please enter an email. Redirecting back to login page ";
           header( "refresh:10; url=login.html" );
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        echo $password_err = "Please enter your password. Redirecting back to login page ";
           header( "refresh:10; url=login.html" );
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($email_err) && empty($password_err)){
        // Prepare a select statement

        $sql = "SELECT idCustomers FROM Customers WHERE Email = '$email' and password = Password('$password')";
        $result = mysqli_query($link,$sql);
        $row = mysqli_fetch_array($result);
        $active = $row[''];

        $count = mysqli_num_rows($result);

        // Password is correct, so start a new session
        session_start();

        $count = mysqli_num_rows($result);

        // If result matched $myusername and $mypassword, table row must be 1 row

        if($count == 1) {

           $_SESSION['loggedin'] = $active;
           echo "Logged in successfully, redirecting to homepage. ";
           $_SESSION["uid"] = $row["idCustomers"];
//           print_r($_SESSION['uid']);
           header( "refresh:10; url=index-1.php" );
        }else {
           echo $error = "Your Login Name or Password is invalid, redirecting back to login page ";
           header( "refresh:10; url=login.html" );
        }
}
    else {
      $error = "Something went wrong, try again, if error persists please contact support";
   }
}
   
//   } 
    // Close connection
    mysqli_close($link);
//}
?>
