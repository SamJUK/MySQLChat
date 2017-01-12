<?php 
    require('php/init.php');
?>

<html>
    <head>
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <?php include('header.php') ?>
        <form id="loginForm" method="POST" action="index.php"> 
            <input id="user" name="user" placeholder="Username"></input>
            <input id="pass" name="pass" type="password" placeholder="Password"></input>
            <input id="submit" type="submit"></input>
        </form>
    </body>
</html>