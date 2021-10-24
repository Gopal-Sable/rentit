<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}
  require_once 'config.php';
  $username = $email = $mobile = $plot_no=$available=$country=$state=$city=$rent=$deposit=$address="";
  $msg_err = $name_err = $email_err = $mobile_err =$plot_err=$available_err=$country_err=$state_err=$city_err=$rent_err=$deposit_err=$address_err="";  

if($_SERVER["REQUEST_METHOD"] == "POST")
{
      $facilities = $_POST['facilities'];
      $landmark = $_POST['landmark'];
      $description = $_POST['description'];
      // validate available rooms
      if(empty(trim($_POST["address"])))
      {
        $address_err="Please enter how many rooms available for rent ";
      }else {
        $address=trim($_POST["address"]);
      }

      // validate deposit
      if(empty(trim($_POST["deposit"])))
      {
        $deposit_err="Please enter needed deposit ";
      }else {
        $deposit=trim($_POST["deposit"]);
      }
      //Validate Rent
      if(empty(trim($_POST["rent"])))
      {
        $rent_err="Please enter expected rent";
      }else {
        $rent=trim($_POST["rent"]);
      }

    //validate city  
    if(empty(trim($_POST["city"]))){
      $city_err = "Please enter a city name.";     
    } elseif(strlen(trim($_POST["city"])) < 3){
      $city_err = "city name must have atleast 3 characters.";
    } else{
      $city = test_input($_POST["city"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z-' ]*$/",$city)) {
          $city_err = "Only letters and white space allowed";
      }
    }
    //validate state      
     if(empty(trim($_POST["state"]))){
      $state_err = "Please enter a state name.";     
    } elseif(strlen(trim($_POST["state"])) < 3){
      $state_err = "state name must have atleast 3 characters.";
    } else{
      $state = test_input($_POST["state"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z-' ]*$/",$state)) {
          $state_err = "Only letters and white space allowed";
      }
    }

    //validate country 
       if(empty(trim($_POST["country"]))){
        $country_err = "Please enter a country name.";     
    } elseif(strlen(trim($_POST["country"])) < 3){
        $country_err = "country name must have atleast 3 characters.";
    } else{
        $country = test_input($_POST["country"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$country)) {
            $country_err = "Only letters and white space allowed";
        }
    }

      // validate available rooms
      if(empty(trim($_POST["available"])))
      {
        $available_err="Please enter how many rooms available for rent ";
      }else {
        $available=trim($_POST["available"]);
      }
      
    //validate plot no
      if(empty(trim($_POST["plot_no"])))
      {
        $plot_err="Please enter plot no ";
      }else {
        $plot_no=trim($_POST["plot_no"]);
      }

      // validate name
    if(empty(trim($_POST["username"]))){
        $name_err = "Please enter a name.";     
    } elseif(strlen(trim($_POST["username"])) < 3){
        $name_err = "name must have atleast 3 characters.";
    } else{
        $username = test_input($_POST["username"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$username)) {
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
    $NewImageName = "";
   
        //image upload
        $output_dir = "upload/";/* Path for file upload */
        $RandomNum   = time();
        $ImageName      = str_replace(' ','-',strtolower($_FILES['image']['name'][0]));
        $ImageType      = $_FILES['image']['type'][0];
      
        $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
        $ImageExt       = str_replace('.','',$ImageExt);
        $ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
        $NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
        $ret[$NewImageName]= $output_dir.$NewImageName;
        
        /* Try to create the directory if it does not exist */
              if (!file_exists($output_dir))
              {
                @mkdir($output_dir, 0777);
              }               
              if(empty($NewImageName)){
                $msg_err="please upload image of room";
              }  
             

    if(empty($name_err) && empty($email_err) && empty($mobile_err)  && empty($msg_err) && empty($plot_err) && empty($available_err) && empty($country_err) && empty($state_err) && empty($city_err) && empty($rent_err) && empty($deposit_err) && empty($address_err)){
      if (isset($_POST['done'])){
      move_uploaded_file($_FILES["image"]["tmp_name"][0],$output_dir."/".$NewImageName );
      $q="INSERT INTO `list`( `name`, `mobile`, `email`, `plot_no`, `available_room`, `country`, `state`, `city`, `rent`, `deposit`, `facilities`, `description`, `landmark`, `address` , `image`,`r_email` ) VALUES ('$username','$mobile','$email','$plot_no','$available','$country','$state','$city','$rent','$deposit','$facilities','$description','$landmark','$address','$NewImageName','$_SESSION[email]')";
            
        if (mysqli_query($link, $q)) {
          // echo "successfully !";
        }
        else {
          echo "Error: " . mysqli_error($link);
        }
          // $query=mysqli_query($link,$q);
          header("location: home.php");
      }
    }
  
}
mysqli_close($link);

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
  <link rel="stylesheet" href="./css/listing.css">
  <title>Document</title>
</head>
<body>
  <div>
  <?php  include "nav.php"; ?>
  </div>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
  <div class="container">
    <div class="item">
      <label for="">Full Name:</label>
      <input type="text" name="username" id="name" placeholder="enter your full name"value="<?php echo $username;?>">
      <small><?php echo $name_err ;?></small>
    </div>
    <div class="item">
      <label for="">Mobile:</label>
      <input type="number" name="mobile" id="mobile" placeholder="Please enter your phone number"value="<?php echo $mobile;?>">
      <small><?php echo $mobile_err; ?></small>
    </div>
    <div class="item">
      <label for="">Email:</label>
      <input type="email" name="email" id="email" placeholder="Please enter your email"value="<?php echo $email;?>">
      <small><?php echo $email_err?></small>
    </div>
    <div class="item">
      <label for="">Plot No.:</label>
      <input type="number" name="plot_no" id="plot_no" placeholder="If doesn't no then enter 0"value="<?php echo $plot_no;?>">
      <small><?php echo $plot_err; ?></small>
    </div>
    <div class="item">
      <label for="">Available Rooms:</label>
      <input type="number" name="available" id="available" placeholder="how many rooms available for rent?"value="<?php echo $available;?>">
      <small><?php echo $available_err;?></small>
    </div>
    <div class="item">
      <label for="">Country:</label>
      <input type="text" name="country" id="country" placeholder="Enter your country"value="<?php echo $country;?>">
      <small><?php echo $country_err;?></small>
    </div>
    <div class="item">
      <label for="">State: </label>
      <input type="text" name="state" id="state" placeholder="please enter you state"value="<?php echo $state;?>">
      <small><?php echo $state_err;?></small>
    </div>
    <div class="item">
      <label for="">City:</label>
      <input type="text" name="city" id="city"placeholder="please enter your city/vilage name"value="<?php echo $city;?>">
      <small><?php echo $city_err; ?></small>
    </div>
    <div class="item">
      <label for="rent">Rent:</label>
      <input type="number" name="rent" id="rent" placeholder="expected rent?"value="<?php echo $rent;?>">
      <small><?php echo $rent_err; ?></small>
    </div>
    <div class="item">
      <label for="">Deposit:</label>
      <input type="number" name="deposit" id="deposit" placeholder="if deposit not required then enter 0"value="<?php echo $deposit;?>">
      <small><?php echo $deposit_err; ?></small>
    </div>
    <div class="item">
      <label for="">Facilities:</label>
      <input type="text" name="facilities" id="facilities" placeholder="eg. free wifi,hot water,cold water,fully furnished,parking"value="<?php  //echo $facilities;?>">
      <small><?php ?></small>
    </div>
    <div class="item">
      <label for="">Description:</label>
      <!-- <input type="text" name="description" id="description"> -->
      <textarea name="description" id="discription" cols="41" rows="3"placeholder="write any thing(this field  not compulsory)" value="<?php echo $description;?>"></textarea>
      <small><?php ?></small>
    </div>
    <div class="item">
      <label for="">Landmark:</label>
      <input type="text" name="landmark" id="landmark" placeholder="eg. mango tree, behind/front/beside of any thing" value="<?php //echo $landmark;?>">
      <small><?php ?></small>
    </div>
    <div class="item">
      <label for="">Address:</label>
      <input type="text" name="address" id="address" placeholder="please enter your address" value="<?php echo $address;?>">
      <small><?php $address_err?></small>
    </div>
    <div class="item">
      <label for="">Room Images:</label>
      <input type="file" name="image[]" id="image" value="<?php echo $NewImageName;?>" required>
      <small><?php echo $msg_err;?></small>
    </div>
    <div></div>
    <div class="item" >
      <input type="submit"id="submit" class="btn" name="done" value="submit"  >
    </div>
  </div>
</form>
</body>
<style>
label{
  font-weight: bold;
  color: #0d9a6b;
}
input{
  border-radius: 3px;
  border: solid #0000007a 2px;
}
#image{
  border:none;
}
}
</style>
</html>
