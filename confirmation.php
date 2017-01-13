<?php 
    require('php/init.php');
    $error = false;

    if (
        isSet($_POST['user']) &&
        isSet($_POST['email']) &&
        isSet($_POST['pass'])
    ){
        $Users->Register($db->dbh, $_POST['user'], $_POST['email'], $_POST['pass']);
    }else{
        $error = true;
    };

?>

<html>
    <head>
        <link href="style.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    </head>
    <body>
        <?php include('header.php') ?>
        <div id="error">
            <?php 
                if (!$error){
                    include('views/confirmation/sucess.php');
                }else{
                    include('views/confirmation/failed.php');
                };
            ?>
        </div>
        <script src="main.js"></script>
    </body>
</html>