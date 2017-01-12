<?php 
    require('php/init.php');

    if (isSet($_POST['user']) && isSet($_POST['pass'])){
        $Users->Login($db->dbh, $_POST['user'], $_POST['pass']);
    }
?>
<html>
    <head>
        <link href="style.css" rel="stylesheet">
    </head>
    <body id="index">
        
        <?php include('header.php') ?>

        <div id="container">
            
            <?php
                if ( $Users->IsloggedIn() ){
                    include('views/index/loggedIn.php');
                }else{
                    include('views/index/notloggedIn.php');
                }; 
            ?>

        </div>
        <script src="main.js"></script>
    </body>
</html>