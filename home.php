<?php
session_start();
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/home.css">
  <link rel="stylesheet" href="css/home.css">
  <title>Document</title>
</head>
<body>
  <nav>
    <?php require_once 'nav.php'; ?>
  </nav>

  <div class="container">

    <h1>Welcome To Rent It!</h1>
    <h3>It's Nice To See You<br></h3>
    <a href="#form">
      <div class="mouse_scroll">
        <div class="mouse">
          <div class="wheel"> </div>
        </div>
        <div>
          <span class="m_scroll_arrows unu"></span>
          <span class="m_scroll_arrows doi"></span>
          <span class="m_scroll_arrows trei"></span>
        </div>
      </div>
      <span id="msg">Scroll Down</span>
    </a>
  </div>
<form id="form" name="form1" action="" method="post" enctype="multipart/form-data">
<div class="center">
  <center>
   <h2>Find Your Choice</h2>
  </center>
</div>
  
  <div class="big-container"> 
  <?php
    $con = mysqli_connect('localhost','root','','rentit') or die('Unable To connect');

    $res=mysqli_query($con,"select * from list");
    while($row=mysqli_fetch_array($res))
    { 
    ?>

    <div class="info_container">
    <div class="img">
      <img src="upload/<?php echo $row['image'];?>" width="350" height="300">
    </div>

      <div class="items">
      <label for="">Name:</label><br>
        <?php
         echo $row['name'];
        ?>
      </div>
      <div class="items">
      <label for="">Mobile No.:</label><br>
        <?php
           echo $row['mobile'];
         ?>
      </div>
      <div class="items">
      <label for="">Email Id: </label><br>
        <?php
           echo $row['email'];
        ?>
      </div>
      <div class="items">
        <label for="">Plot No.:</label><br>
        <?php
           echo $row['plot_no'];
        ?>
      </div>
      <div class="items">
      <label for="">Availabe Rooms:</label><br>
        <?php
           echo $row['available_room'];
        ?>
      </div>
      <div class="items">
      <label for="">Country:</label><br>
        <?php
          echo $row['country'];
        ?>
      </div>
      <div class="items">
      <label for="">State:</label><br>
        <?php
          echo $row['state'];
        ?>
      </div>
      <div class="items">
      <label for="">City:</label><br>
        <?php
          echo $row['city'];
        ?>
      </div>
      <div class="items">
      <label for="">Rent:</label><br>
        <?php
            echo $row['rent'];
        ?>
      </div>
      <div class="items">
      <label for="">Deposit:</label><br>
        <?php
          echo $row['deposit'];
        ?>
      </div>
      <div class="items">
      <label for="">Facilities:</label><br>
        <?php
          echo $row['facilities'];
        ?>
      </div>
      <div class="items">
      <label for="">Description:</label><br>
        <?php
          echo $row['description'];
        ?>
      </div>
      <div class="items">
      <label for="">Landmark:</label><br>
        <?php
          echo $row['landmark'];
        ?>
      </div>
      <div class="items">
      <label for="">Address:</label><br>
        <?php
          echo $row['address'];
        ?>
      </div>
    </div>

    <?php 
  }   
  
  ?>
  </div> 
</form>
</body>
</html>