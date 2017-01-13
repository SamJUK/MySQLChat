<?php 
    require('php/init.php');

    if (isSet($_POST['user']) && isSet($_POST['pass'])){
        $Users->Login($db->dbh, $_POST['user'], $_POST['pass']);
    }
?>
<html>
    <head>
        <link href="style.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    </head>
    <body id="rooms">
        
        <?php include('header.php') ?>

        <div id="container">
            
            <?php
                if ( $Users->IsloggedIn() ){
                    include('views/rooms/loggedIn.php');
                }else{
                    include('views/rooms/notloggedIn.php');
                }; 
            ?>

        </div>
        <script src="main.js"></script>
    </body>
</html>