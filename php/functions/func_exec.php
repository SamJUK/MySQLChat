<?php

    //include classes
     foreach (glob('../classes/*.class.php') as $class_filename){   //Include needed classes
        include($class_filename);
    };


    if (!isSet($_GET['function'])){exit;};  //Exit script if no function declared

    switch ($_GET['function']){
        case 'sendMessage':
            $messages->sendMessage($db->dbh, $_GET['msg'], $_GET['room']);
            break;
        case 'joinRoom':
            $messages->JoinRoom($db->dbh, $_GET['room']);
            break;
        case 'leaveRoom':
            $messages->leaveRoom($db->dbh, $_GET['room']);
            break;
        case 'createRoom':
            $messages->CreateRoom($db->dbh, $_GET['name'], $_GET['pic']);
            break;
    };




?>