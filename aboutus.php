<?php
session_start();
include_once "nav.php";

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
<div class="big-container">
    <div class="container">
        <h2>About Me</h2>
        <p> My name is Gopal Sable. Studying at Deogiri College, Aurangabad BCA(Sci.) Second Year
          I developed this site for a college project . </p>
        <p>
        The “Rent It” has been developed to override the problem of finding home(rooms) on rent. This software is supported to eliminate and in some cases reduce the hardship of the user finding room door to door. Also giving ads in the newspaper is costly or peast the pamphlet on walls in streat to streat or you choose a broker that was too costly .
        </p>
        <p>
        So I find a solution to it by giving ads. and get responses in one place. Moreover this website is designed for the particular need to Carry out as middle man work effectively. So tenants  get a room faster on rent and the landlord rents it without any spending any cost and easily .
        </p>
    </div>
</div>
</body>
<style>
*{
    padding: 0;
    margin:0;
    box-sizing: border-box;
}
body{
    background:url('./img/about.jpg');
    background-repeat: no-repeat;
    background-size: cover;  
     
}
p{
    margin: 5px;
    text-align:justify;
}
h2{
    margin:5px
}
.container{
    background: rgba(0, 0, 0, 0.7);
    color:white;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 400px;
    padding: 20px;
}
.big-container{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 90vh;
}
</style>
</html>