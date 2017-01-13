<div id="header">
            <div id="left">
                <span>El Giggle</span>
            </div>

            <div id="middle">
                <?php 
                    if(explode("?",explode("/",$_SERVER['REQUEST_URI'])[2])[0] == "room.php"){
                        $roomName = $messages->getRoomName($db->dbh, $_GET['id']);
                        $roomImg = $messages->getRoomImg($db->dbh, $_GET['id']);
                        echo '
                            <img id="roomImage" src="'.$roomImg.'"=><span id="roomName" data-roomid='.$_GET['id'].'>'.$roomName.'</span>
                        ';
                    };
                ?>
            </div>

            <div id="right">
                <a href="index.php"><span>Home</span></a>
                <?php 
                    if ( $Users->IsloggedIn() ){
                        echo '<a href="rooms.php"><span>Rooms</span></a>';
                        echo '<a href="?logout"><span>Logout</span></a>';
                    }else{
                        echo '<a href="login.php"><span>Login</span></a>';
                        echo '<a href="register.php"><span>Register</span></a>';
                    };
                ?>
            </div>
        </div>