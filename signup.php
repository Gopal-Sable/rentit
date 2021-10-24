<?php
    require_once "config.php";

    //define variables
    $username = $email = $mobile = $password = $cpassword = "";
    $username_err = $email_err = $mobile_err = $password_err =$cpassword_err = "";

    // Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    //validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";     
    } elseif(strlen(trim($_POST["username"])) < 3){
        $username_err = "username must have atleast 3 characters.";
    } else{
        $username = test_input($_POST["username"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$username)) {
            $username_err = "Only letters and white space allowed";
        }
    }
    
    //validate mobile
    if(empty(trim($_POST["mobile"]))){
        $mobile_err = "Please enter a mobile.";
    } elseif(strlen(trim($_POST["mobile"])) != 10){
        $mobile_err = "Phone number contain 10 numbers only";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM register WHERE mobile = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_mobile);
            
            // Set parameters
            $param_mobile = trim($_POST["mobile"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $mobile_err = "This mobile is already exist.";
                } else{
                    $mobile = trim($_POST["mobile"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

     //validate email
     if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";
    } 
     else{
        // Prepare a select statement
        $sql = "SELECT id FROM register WHERE email = ?";
        
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
                    $email_err = "This email is already exist.";
                } else{

                    $email = test_input($_POST["email"]);
                    // check if e-mail address is well-formed
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $email_err = "Invalid email format";
                    }
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }


    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["cpassword"]))){
        $cpassword_err = "Please confirm password.";     
    } else{
        $cpassword = trim($_POST["cpassword"]);
        if(empty($password_err) && ($password != $cpassword)){
            $cpassword_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($email_err) && empty($mobile_err) && empty($password_err) && empty($cpassword_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO register (username, mobile, email, password) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_username , $param_mobile , $param_email , $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_email = $email;
            $param_mobile = $mobile;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
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
//function input test
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/signup.css">
 
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>REGISTRATION FORM</h2>
        </div>  
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form" id ="form">

            <div class="form-control" >
                <label > Name</label>
                <input type="text" name="username" id="username" placeholder="Please Enter Your Name" autocomplete="off" require <?php if($username_err){ echo 'style="border:1px solid red"'; }else{ echo 'style="border:1px solid green"';} ?> value="<?php echo $username ?>">
                <small><?php echo $username_err; ?></small>

            </div>
            <div class="form-control">
                <label > Mobile No.</label>
                <input type="number" name="mobile" id="mobile" autocomplete="off" placeholder="Please Enter Your Moblie Number" require <?php if($mobile_err){ echo 'style="border:1px solid red"'; }else{ echo 'style="border:1px solid green"';} ?> value="<?php echo $mobile ?>">
                <small><?php echo $mobile_err; ?></small>
            </div>
            <div class="form-control">
                <label > E-mail</label>
                <input type="email" name="email" id="email" autocomplete="off" placeholder="Please Enter Your Email " require <?php if($email_err){ echo 'style="border:1px solid red"'; }else{ echo 'style="border:1px solid green"';} ?> value="<?php echo $email ?>">
                <small><?php echo $email_err; ?></small>
            </div>
            <div class="form-control">
                <label >Password</label>
                <input type="password" name="password" id="password" autocomplete="off" placeholder="Please Enter Your Password" require <?php if($password_err){ echo 'style="border:1px solid red"'; }else{ echo 'style="border:1px solid green"';} ?>value="<?php echo $password ?>">
                <small><?php echo $password_err; ?></small>
            </div>
            <div class="form-control">
                <label >Comfirm Password</label>
                <input type="password" name="cpassword" id="cpassword" autocomplete="off" placeholder="Please Enter Password Again" require <?php if($cpassword_err){ echo 'style="border:1px solid red"'; }else{ echo 'style="border:1px solid green"';} ?>value="<?php echo $cpassword ?>">
                <small><?php echo $cpassword_err; ?></small>
            </div>
            
            <input type="submit" value="submit"  name="done" class="btn">
        </form>        
    </div>

</body>


</html>