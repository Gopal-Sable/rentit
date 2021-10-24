<?php
    session_start();
    require_once "config.php";
    // include 'conn.php';
    include 'nav.php';
    //define variables
    $name = $email = $mobile = $disc  = "";
    $name_err = $email_err = $mobile_err = $disc_err ="";

    // Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    //validate name
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter a name.";     
    } elseif(strlen(trim($_POST["name"])) < 3){
        $name_err = "name must have atleast 3 characters.";
    } else{
        $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
            $name_err = "Only letters and white space allowed";
        }
    }
    
    //validate mobile
    if(empty(trim($_POST["mobile"]))){
        $mobile_err = "Please enter a mobile.";
    } elseif(strlen(trim($_POST["mobile"])) != 10){
        $mobile_err = "Phone number contain 10 numbers only";
    } else{
       $mobile= trim($_POST["mobile"]);
    }

     //validate email
    if (empty($_POST["email"])) {
        $email_err = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = "Invalid email format";
        }
    }

    //validation of discripition
    if(empty(trim($_POST["disc"]))){
        $disc_err = "Please write something.";
    } 
     else{
            $disc = trim($_POST["disc"]);
           
        }
            
    // Check input errors before inserting in database
    if(empty($name_err) && empty($email_err) && empty($mobile_err) && empty($disc_err)){
        if (isset($_POST['done'])){
            $q="INSERT INTO `feedback`( `name`, `email`, `mobile`, `disc`) VALUES ('$name','$email','$mobile','$disc')";
            $query=mysqli_query($link,$q);
            header("location: home.php");
        }
    }
    
    // Close connection
    mysqli_close($link);
}
   
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

?>
<script type="javascript"></script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/feedback.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>WE GLAD TO HERE YOUR FEEDBACK</h2>
        </div>  
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form" id ="form">

            <div class="form-control" >
                <label > Name</label>
                <input type="text" name="name" id="name" placeholder="Please Enter Your Name" autocomplete="off" require <?php if($name_err){ echo 'style="border:1px solid red"'; }else{ echo 'style="border:1px solid green"';} ?> value="<?php echo $name ?>">
                <small><?php echo $name_err; ?></small>

            </div>
            
            <div class="form-control">
                <label > E-mail</label>
                <input type="email" name="email" id="email" autocomplete="off" placeholder="Please Enter Your Email " require <?php if($email_err){ echo 'style="border:1px solid red"'; }else{ echo 'style="border:1px solid green"';} ?> value="<?php echo $email ?>">
                <small><?php echo $email_err; ?></small>
            </div>
            <div class="form-control">
                <label > Mobile no.</label>
                <input type="number" name="mobile" id="mobile" autocomplete="off" placeholder="Please Enter Your Moblie Number" require <?php if($mobile_err){ echo 'style="border:1px solid red"'; }else{ echo 'style="border:1px solid green"';} ?> value="<?php echo $mobile ?>">
                <small><?php echo $mobile_err; ?></small>
            </div>
            <div class="form-control">
                <label >Description</label>
                <!-- <input type="text" name="disc" id="disc" autocomplete="off" placeholder="Please Enter Your Password" require > -->
                <textarea name="disc" id="disc"  <?php if($disc_err){ echo 'style="border:1px solid red"'; }else{ echo 'style="border:1px solid green"';} ?>value="<?php echo $disc ?>"></textarea>
                <small><?php echo $disc_err; ?></small>
            </div>
    
            <input type="submit" value="submit feedback"  name="done" class="btn">
        </form>        
    </div>
    

</body>


</html>