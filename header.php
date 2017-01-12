<div id="header">
            <div id="left">
                <span>El Giggle</span>
            </div>

            <div id="middle">
                <?php 
                    if(explode("?",explode("/",$_SERVER['REQUEST_URI'])[2])[0] == "room.php"){
                        $roomName = $messages->getRoomName($db->dbh, $_GET['id']);
                        echo '
                            <span id="roomName" data-roomid='.$_GET['id'].'>'.$roomName.'</span>
                        ';
                    };
                ?>
            </div>

            <div id="right">
                <ul>
                    <a href="index.php"><li>Home</li></a>
                    <?php 
                        if ( $Users->IsloggedIn() ){
                            echo '<a href="?logout"><li>Logout</li></a>';
                        }else{
                            echo '<a href="login.php"><li>Login</li></a>';
                            echo '<a href="register.php"><li>Register</li></a>';
                        };
                    ?>
                </ul>
            </div>
        </div>