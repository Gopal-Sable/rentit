<?php
  include 'config.php';
  $name_err=$mobile_err=$email_err="";
  if (isset($_GET['done'])) {
    $id = $_GET['id'];
    $name = $_GET['username'];
    $mobile = $_GET['mobile'];
    $email = $_GET['email'];
    $plot_no = $_GET['plot_no'];
    $available = $_GET['available'];
    $country = $_GET['country'];
    $state = $_GET['state'];
    $city = $_GET['city'];
    $rent = $_GET['rent'];
    $deposit = $_GET['deposit'];
    $facilities = $_GET['facilities'];
    $description = $_GET['description'];
    $landmark = $_GET['landmark'];
    $address = $_GET['address'];
  
    $q = mysqli_query($link,"UPDATE `list` SET `name`='$name',`mobile`='$mobile',`email`='$email',`plot_no`='$plot_no',`available_room`='$available',`country`='$country',`state`='$state',`city`='$city',`rent`='$rent',`deposit`='$deposit',`facilities`='$facilities',`description`='$description',`landmark`='$landmark',`address`='$address'  WHERE id= $id "); 
    header('location:dashbord.php');
   }
  $q=mysqli_query($link,"SELECT * FROM `list` WHERE id = '" . $_GET['id'] . "'");
  $row=mysqli_fetch_array($q);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/listing.css">
  <title>Document</title>
</head>
<body>
  <div>
  <?php  include "nav.php"; ?>
  </div>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET" enctype="multipart/form-data">
  <div class="container">
  <input style="display:none" type="text" name="id" id="id" value="<?php echo $row['id'];?>">
               
    <div class="item">
      <label for="">Full Name</label>
      <input type="text" name="username" id="username" value="<?php echo $row['name']?>"placeholder="enter your full name">
      <small><?php echo $name_err ;?></small>
    </div>
    <div class="item">
      <label for="">Mobile</label>
      <input type="number" name="mobile" id="mobile" placeholder="Please enter your phone number"value="<?php echo $row['mobile']?>">
      <small><?php echo $mobile_err; ?></small>
    </div>
    <div class="item">
      <label for="">email</label>
      <input type="email" name="email" id="email" placeholder="Please enter your email"value="<?php echo $row['email']?>">
      <small><?php echo $email_err?></small>
    </div>
    <div class="item">
      <label for="">Plot No.</label>
      <input type="number" name="plot_no" id="plot_no"value="<?php echo $row['plot_no']?>">
      <small><?php ?></small>
    </div>
    <div class="item">
      <label for="">Available Rooms</label>
      <input type="number" name="available" id="available"value="<?php echo $row['available_room']?>">
      <small><?php ?></small>
    </div>
    <div class="item">
      <label for="">Country</label>
      <input type="text" name="country" id="country"value="<?php echo $row['country']?>">
      <small><?php ?></small>
    </div>
    <div class="item">
      <label for="">State </label>
      <input type="text" name="state" id="state"value="<?php echo $row['state']?>">
      <small><?php ?></small>
    </div>
    <div class="item">
      <label for="">City</label>
      <input type="text" name="city" id="city"value="<?php echo $row['city']?>">
      <small><?php ?></small>
    </div>
    <div class="item">
      <label for="rent">Rent</label>
      <input type="number" name="rent" id="rent"value="<?php echo $row['rent']?>">
      <small><?php ?></small>
    </div>
    <div class="item">
      <label for="">Deposit</label>
      <input type="number" name="deposit" id="deposit"value="<?php echo $row['deposit']?>">
      <small><?php ?></small>
    </div>
    <div class="item">
      <label for="">Facilities</label>
      <input type="text" name="facilities" id="facilities"value="<?php echo $row['facilities']?>">
      <small><?php ?></small>
    </div>
    <div class="item">
      <label for="">Description</label>
      <!-- < input type="text" name="description" id="description" > -->
      <textarea name="description" id="discription" cols="41" rows="3" ><?php echo $row['description']?></textarea>
      <small><?php ?></small>
    </div>
    <div class="item">
      <label for="">landmark</label>
      <input type="text" name="landmark" id="landmark"value="<?php echo $row['landmark']?>">
      <small><?php ?></small>
    </div>
    <div class="item">
      <label for="">Address</label>
      <input type="text" name="address" id="address"value="<?php echo $row['address']?>">
      <small><?php ?></small>
    </div>
    <div></div>
    <div></div>
    <div>
      <input type="submit" class="btn" name="done" value="submit" >
    </div>
  </div>
</form>
<style>
  label{
  font-weight: bold;
  color: #0d9a6b;
}
input{
  border-radius: 3px;
  border: solid #0000007a 2px;
}
</style>
</style>
</body>

</html>
