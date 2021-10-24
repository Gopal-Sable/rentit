<?php
    // session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>rentit.com</title>
    <link rel="stylesheet" href="./css/nav.css">
</head>
<body>
    <nav>
        <ul>
            <li style="float:left"><a href="home.php" id="logo">Rent It</a></li>
            <li style="float:right"><?php if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
            echo '<a href="login.php"> LOGIN</a>';
            }else {
              echo '<a href="logout.php"> LOGOUT </a>';
            }
            ?>
            </li>
            <li style="float:right"><a href="aboutus.php"> ABOUT ME</a></li>
            <li style="float:right"><a href="feedback.php"> CONTACT US</a></li>
            <li style="float:right"><a href="dashbord.php">DASHBORD</a></li>
            <li style="float:right" ><a href="listing.php">LIST PROPERTY</a></li>
        </ul>
    </nav> 
</body>
</html>