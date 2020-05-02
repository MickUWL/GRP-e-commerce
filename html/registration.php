<?php
// Include config file
include "config.php";
 
// Define variables and initialize with empty values
$name1 = "";
$email = "";
$password = "";
$name_err = "";
$email_err = "";
$password_err = "";

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

        // Validate name1
    if(empty($_POST["name"])){
        echo $name_err = "please enter a name, redirecting back to registration. ";
        header( "refresh:10; url=registration.html" );
        
    } else{
        $name1 = $_POST["name"];
        }
    }
 
    // Validate email
    if(empty($_POST["email"])){
        echo $email_err = "please enter an email, redirecting by to registration. ";
        header( "refresh:10; url=registration.html" );
    } else{
//        // Prepare a select statement
        $sql = "SELECT idCustomers FROM Customers WHERE Email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    echo $email_err = "This email is already in use, please contact support, redirecting by to registration. ";
                    header( "refresh:10; url=registration.html" );
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo $error = "Oops! Something went wrong. Please try again later, redirecting back to registration. ";
                header( "refresh:10; url=registration.html" );
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty($_POST["password"])){
        echo $password_err = "please enter a password, redirecting back to registration. ";
        header( "refresh:10; url=registration.html" );
    } elseif(strlen($_POST["password"]) < 6){
        echo $password_err = "Password must have at least 6 characters, redirecting back to registration. ";
        header( "refresh:10; url=registration.html" );
    } else{
        $password = $_POST["password"];
    }
    
    
    // Check input errors before inserting in database
    if(empty($email_err) && empty($password_err) && empty($name_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO Customers (name, Email, Password) VALUES (?, ?, Password(?))";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_email, $param_password);
            
            // Set parameters
            $param_name = $name1;
            $param_email = $email;
            $param_password = $password; // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                echo "Account created successfully!. Redirecting to login page";
                header( "refresh:10; url=login.html" );
            } else{
                echo $error = "Something went wrong. Please try again later, redirecting back to registration.";
                header( "refresh:10; url=registration.html" );
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
//}
?>
