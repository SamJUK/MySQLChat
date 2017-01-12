<?php
    require('php/init.php');

    if (!$Users->IsLoggedIn()){echo 'Please log in';exit;}; //Not logged in - end script with message 
    if (!isSet($_GET['id'])){echo 'Error: No Room Selected';exit;}; //No room declared - end sccript with message
    if (!$messages->RoomExists($db->dbh, $_GET['id'])){echo 'No such room'; exit;}; //Room Dont Exist -- End script with message
    if (!$messages->IsApartOfRoom($db->dbh, $_GET['id'])){echo 'Not apart of the room!';exit;}; //No in room clients- end script with message

?>
<html>
    <head>
        <title>El Giggle</title>
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
         <?php include('header.php') ?>
        <iframe id="messagesIframe" src="message.php?id=<?php echo $_GET['id']; ?>"></iframe>
        <input id="userinput" type="text" onKeyDown="MsgKeyDown(event)"></input>
        <input type="submit" onClick="sendMessage()"></input>
    <script src="main.js"></script>
    </body>
</html>