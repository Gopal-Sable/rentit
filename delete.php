<?php
    include 'config.php';
    $id=$_GET['id'];
    $q="delete from `list` where id = $id ";
    // $q="delete from `listing` where id = $id ";
   
    mysqli_query($link,$q);
   
    // header(location:listing.php);
    header('location:dashbord.php');

?>