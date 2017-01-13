<?php 
      $SerializedUsers = $messages->getRoomsUserIn($db->dbh, $_SESSION['userid']);
      $users = unserialize($SerializedUsers['rooms'])
?>
<div id="roomContainer">

    <a onclick="joinRoom()" class="button">Join Room</a>
    <a onclick="createRoom()" class="button">Create Room</a><br/>
    <select id="roomListSelect">
        <?php 
            foreach($users as $x){
                $roomName = $messages->getRoomName($db->dbh, $x);
                echo '
                    <option data-roomid='.$x.'>'.$roomName.'</option>
                ';
            }
        ?>
    </select> <a onClick="leaveRoom()" class="button">Leave Room</a>

    <div id="RoomList">
        <?php 
            if($users){
                foreach($users as $x){
                    $roomDetails = $messages->getRoomDetails($db->dbh, $x);

                    $userArray = $messages->getRoomUsers($db->dbh, $x);

                    echo '
                        <a href="room.php?id='.$x.'">
                            <div class="room">
                                <span id="name">'.$roomDetails['name'].'</span>
                                <img src="'.$roomDetails['img'].'">
                                <span id="users">';
                                foreach ($userArray as $x){
                                    echo $messages->getUserName($db->dbh, $x);
                                    if ($x != $userArray[count($userArray)-1]){
                                        echo ", ";
                                    };
                                };
                                echo '</span>
                            </div>
                        </a>
                    ';
                };
            };
        ?>
    </div>
</div>