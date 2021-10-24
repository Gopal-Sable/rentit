<?php
// Initialize the session
session_start();

$con=mysqli_connect('localhost','root');
mysqli_select_db($con,'rentit');

if($con){
   
}
else{
    echo "not";
}


// $q="SELECT `username` FROM `register` WHERE `email` = `$_SESSION['email']` ";
// $query=mysqli_query($con,$q); 
// $res=mysqli_fetch_array($query);
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["email"]); ?></b>. Welcome to our site.</h1>
    <h1><?php// echo "$res['username']"; ?></h1>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
        <!-- <a href="index.php"> see users </a> -->
    </p>
    <?php include "dashbord.php";?>
</body>
</html>