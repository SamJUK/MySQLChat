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
    <body id="index">
        
        <?php include('header.php') ?>

        <div id="container">
            
            <div id="home">
                <div id="left">
                    <img src="http://www.stealsnphonies.com/wp-content/uploads/2015/04/Screen-Shot-2015-04-26-at-12.11.34-AM.png">
                </div>
                
                <div id="right">
                    <h1>El Giggle</h1>
                    <span>
                        El Giggle, is an app that provides an 'instant' messaging service. <br/>
                        It utilizes PHP for generating pages and MySQL database interaction, </br>
                        It also uses Javascript AJAX for calling PHP functions to handle DB interactions.
                    </span>
                    <div id="buttons">
                        <?php 
                          if(!isSet($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != 1){
                              echo '
                                <a href="login.php" class="IndexButton">Login</a>
                                <a href="register.php" class="IndexButton">Register</a>
                                ';
                          }else{
                              echo '
                                <a href="rooms.php" class="IndexButton">Rooms</a>
                                <a href="?logout" class="IndexButton">Logout</a>
                                ';
                          };
                        ?>
                    </div>
                </div>
            </div>
            
        </div>
        <script src="main.js"></script>
    </body>
</html>