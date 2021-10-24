 <?php

session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: home.php");
    exit;
}
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = $login_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if email is empty
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter email.";
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($email_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, email, password FROM register WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if email exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                             
                           
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;
                         

                            // Redirect user to welcome page
                            
                            header("location: home.php");
                            
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid email or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid email or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>LOGIN</h2>       
        </div>    
        <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>"  method="post" >
       <div>
       <?php 
            if(!empty($login_err)){
                echo '<div style="color:red" >' . $login_err . '</div>';
            }        
            ?>
        </div> 
            
            <div class="form-control">
                <label for="">Email</label>
                <input type="email" name="email" id="email" placeholder="please enter your user email">
                <span style="color: red"><?php echo "$email_err"; ?></span>
            </div>

            <div class="form-control">
                <label for="">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password">
                <span style="color: red"><?php echo "$password_err"; ?></span>
            </div>

            <div>
            <input type="submit" name ="done"value="submit" class="btn">
            </div>
            <span>Don't have account?</span>

            
            <a href="signup.php">create new account</a><br>
            
            <?php 
                if(!empty($_POST['email']) && !empty($_POST['password'])){
                        echo "<div >wrong email id or password</div>"; 
                }
            ?>
                
        </form>
    </div>
</body>
</html>