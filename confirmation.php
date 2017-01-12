<?php 
    require('php/init.php');

    if (
        isSet($_POST['user']) &&
        isSet($_POST['email']) &&
        isSet($_POST['pass'])
    ){
        $Users->Register($db->dbh, $_POST['user'], $_POST['email'], $_POST['pass']);
    };

?>