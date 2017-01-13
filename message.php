<?php
    require('php/init.php');

    
    if (!isSet($_GET['id'])){echo 'Error: No Room Selected';die();}; //No room declared - end sccript with message
    if (!$messages->IsApartOfRoom($db->dbh, $_GET['id'])){echo 'Not apart of the room!';die();}; //No in room clients- end script with message
?>
<html>
    <head>
        <link href="style.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
        <meta http-equiv="refresh" content="10">
    </head>
    <body id="messages"><!--
        <div class="message">
            <span class="inbound">So, Bill wanna go get some banna chips at some point?</span>
        </div>
        <div class="message">
            <span class="outbound">Ahh that sounds great Bob!</span>
        </div>
        <div class="message">
            <span class="inbound">Cool see you in a decade!</span>
        </div>-->
        <?php $messages->loadRoomMessages($db->dbh, $_GET['id']) ?>
    </body>
</html>