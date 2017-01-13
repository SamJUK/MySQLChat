<?php 
    require('php/init.php');
?>

<html>
    <head>
        <link href="style.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    </head>
    <body>
        <?php 
            include('header.php');
            if(!isSet($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != 1){
                include('views/login.php');
            }else{
                include('views/alreadyLoggedIn.php');
            }
         ?>
    </body>
</html>