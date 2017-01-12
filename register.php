<?php 
    require('php/init.php');
?>

<html>
    <head>
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <?php include('header.php') ?>
        <form id="registerForm" method="post" action="confirmation.php"> 
            <input id="user" name="user" placeholder="Username"></input>
            <input id="email" name="email" placeholder="Email"></input>
            <input id="pass" name="pass" type="password" placeholder="Password"></input>
            <input id="submit" type="submit"></input>
        </form>
    </body>
</html>