<?php
    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php"); 
        exit;
      }
      include "nav.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/dahsboard.css">
    <title>Document</title>
</head>
<body>
  <div class="big_container">
    <?php
        $con = mysqli_connect('localhost','root','','rentit') or die('Unable To connect'); 
        $res=mysqli_query($con,"select * from list where r_email = '$_SESSION[email]'");
        echo `<div class="big_container">`;
        while($row=mysqli_fetch_array($res))
        { 
        ?>
      <div class="info_container">
          <div class="img">
            <img  src="upload/<?php echo $row['image'];?>" width="300" height="300">
          </div>
            <div class="items">
            <label for="">Name :</label>
              <?php
                echo "<br>";
               echo $row['name'];
               ?>
            </div>
            <div class="items">
            <label for="">Mobile :</label>
              <?php
                echo "<br>";
                 echo $row['mobile'];
               ?>
            </div>
            <div class="items">
            <label for="">Email Id :</label>
              <?php
                echo "<br>";
                 echo $row['email'];
              ?>
            </div>
            <div class="items">
            <label for="">Plot No. :</label>
              <?php
                echo "<br>";
                 echo $row['plot_no'];
              ?>
            </div>
            <div class="items">
            <label for="">Available Rooms :</label>
              <?php
                echo "<br>";
                 echo $row['available_room'];
              ?>
            </div>
            <div class="items">
            <label for="">Country </label>
              <?php
                echo "<br>";
                echo $row['country'];
              ?>
            </div>
            <div class="items">
            <label for="">State :</label>
              <?php
                echo "<br>";
                echo $row['state'];
              ?>
            </div>
            <div class="items">
            <label for="">City :</label>
              <?php
                echo "<br>";
                echo $row['city'];
              ?>
            </div>
            <div class="items">
            <label for="">Rent :</label>
              <?php
                echo "<br>";
                  echo $row['rent'];
              ?>
            </div>
            <div class="items">
            <label for="">Deposit :</label>
              <?php
                echo "<br>";
                echo $row['deposit'];
              ?>
            </div>
            <div class="items">
            <label for="">Facilities :</label>
              <?php
                echo "<br>";
                echo $row['facilities'];
              ?>
            </div>
            <div class="items">
            <label for="">Description :</label>
              <?php
                echo "<br>";
                echo $row['description'];
              ?>
            </div>
            <div class="items">
              <label for="">Landmark :</label>
              <?php
                echo "<br>";
                echo $row['landmark'];
              ?>
            </div>
            <div class="items">
            <label for="">Address :</label>
              <?php
                echo "<br>";
                echo $row['address'];
              ?>
            </div>
            <div></div>
            <div></div>
            <a href="edit.php?id=<?php echo $row['id']; ?>"> <button class="btn" type="submit"> update</button></a>  
              <a href="delete.php?id=<?php echo $row['id']; ?>"> <button class="btn">delete</button> </a>        
       </div>  
          <?php 
        }   
        
      ?>    
      </div> 
  
</body>
</html>