<?php
 session_start();
require_once 'config.php';

    $con=mysqli_connect('localhost','root');
    mysqli_select_db($con,'rentit');

    if($con){
       
    }
    else{
        echo "not";
    }


if(!isset($_SESSION['email']))
// header('location:login.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2></h2>
<a href="loguot.php">LOGOUT</a>
<a href="home.php">home</a>
    <table>
        <tr>
            <th>id</th>
            <th>name</th>
            
            <th>mobile </th>
            <th>email </th>
            <th>password </th>
            <th>delete</th>
            <th>update</th>
        </tr>
        
        <?php
            // include 'conn.php';
            $q="select * from register";   
            // $q="select * from listing"; 
            $query=mysqli_query($con,$q);  

            while($res=mysqli_fetch_array($query)){
?>
        <tr>
            <td style="color:red;"> <?php echo $res['id'] ?> </td>
            <td><?php echo $res['username'] ?></td>
            <td><?php echo $res['mobile'] ?></td>
            <td><?php echo $res['email'] ?></td>
            <td><?php echo $res['password'] ?></td>
            <td><button><a href="deletelisting.php?id=<?php echo $res['id'];?>">delete</a></button></td>
            <td><button><a href="editlisting.php?id=<?php echo $res['id'];?>">update</a></button></td>
            
        </tr>
        <?php
            }
        ?>
    </table>
</body>
</html>