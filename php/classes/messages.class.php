<?php

class messages {

    function getRoomMessages($db, $room){
        //Get all messages from table for set 
        $sql = 'SELECT * FROM messages WHERE room = :room LIMIT 50';
        $qry = $db->prepare($sql);
        $qry -> bindParam(':room', $room, PDO::PARAM_INT);
        $qry -> execute();
        $results = $qry->fetchAll();

        return $results;
    }

    function loadRoomMessages($db, $room){
        $msgArray = $this->getRoomMessages($db, $room);
        $msgs = "";

        foreach($msgArray as $x){
            $dir = "inbound";
            $msg = $x[3];
            $time = $x[4];

            if($x[2]==$_SESSION['userid']){
                $dir = "Outbound";
            };

            echo "<div class='message'><span class='".$dir."'>".$msg."</span></div>";
        }
    }
    
    function sendMessage($db, $message, $room){
        //Add new message to table
        $user = $_SESSION['userid'];
        
        try{
            $sql = 'INSERT INTO messages(room, user, content, time) VALUES (:room, :user, :message, now())';
            $qry = $db->prepare($sql);
            $qry -> bindParam(':room', $room, PDO::PARAM_INT);
            $qry -> bindParam(':user', $user, PDO::PARAM_INT);
            $qry -> bindParam(':message', $message, PDO::PARAM_STR);
            $qry -> execute();
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

    }   

    function getAllRooms($db){
        $sql = 'SELECT id FROM rooms';
        $qry = $db->prepare($sql);
        $qry -> execute();
        $results = $qry->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    function getRoomDetails($db, $room){
        $sql = 'SELECT * FROM rooms WHERE id = :room LIMIT 1';
        $qry = $db->prepare($sql);
        $qry -> bindParam ( ':room' ,$room, PDO::PARAM_INT );
        $qry -> execute();

        return $qry -> fetch(PDO::FETCH_ASSOC);
    }

    function getRoomsUserIn($db, $user){
        $sql = 'SELECT rooms FROM users WHERE id = :user';
        $qry = $db->prepare($sql);
        $qry -> bindParam ( ':user', $user, PDO::PARAM_INT );
        $qry -> execute();

        return $qry -> fetch(PDO::FETCH_ASSOC);
    }

    function getRoomName($db, $room){
        $sql = 'SELECT name FROM rooms WHERE id = :room LIMIT 1';
        $qry = $db->prepare($sql);
        $qry -> bindParam ( ':room' ,$room, PDO::PARAM_INT );
        $qry -> execute();
        $result = $qry -> fetch(PDO::FETCH_ASSOC);

        return $result['name'];
    }

    function getUserName($db, $user){
        $sql = 'SELECT username FROM users WHERE id = :user LIMIT 1';
        $qry = $db->prepare($sql);
        $qry -> bindParam ( ':user' ,$user, PDO::PARAM_INT );
        $qry -> execute();
        $result = $qry -> fetch(PDO::FETCH_ASSOC);

        return $result['username'];
    }

    function getRoomUsers($db, $room){
        $sql = 'SELECT users FROM rooms WHERE id = :room LIMIT 1';
        $qry = $db->prepare($sql);
        $qry -> bindParam ( ':room' ,$room, PDO::PARAM_INT );
        $qry -> execute();
        $result = $qry -> fetch(PDO::FETCH_ASSOC);

        return unserialize($result['users']);
    }

    function RoomExists($db, $id){
        $sql = 'SELECT users FROM rooms WHERE id = :id';
        $qry = $db->prepare($sql);
        $qry -> bindParam( ':id', $id, PDO::PARAM_INT );
        $qry -> execute();
        $results = $qry -> fetch( PDO::FETCH_ASSOC );

        if ($results){
            return true;
        };
        return false;
    }

    function IsApartOfRoom($db, $id){
        $sql = 'SELECT users FROM rooms WHERE id = :id';
        $qry = $db->prepare($sql);
        $qry -> bindParam(':id', $id, PDO::PARAM_INT);
        $qry -> execute();
        $results = $qry->fetch(PDO::FETCH_ASSOC);
        
        $UsersArray = unserialize($results['users']);

        $hndl = false;
        foreach ($UsersArray as $x)
        {
            if ($x == $_SESSION['userid']){$hndl = true;};
        };
        
        return $hndl;
    }

    function CreateRoom($db, $name, $picture){
        $users = serialize(array((int)$_SESSION['userid']));

        $sql = 'INSERT INTO rooms (name, img, users) VALUES (:name, :img, :users)';
        $qry = $db->prepare($sql);
        $qry -> bindParam( ':name', $name, PDO::PARAM_STR );
        $qry -> bindParam( ':img', $picture, PDO::PARAM_STR );
        $qry -> bindParam( ':users', $users, PDO::PARAM_STR );
        $qry -> execute();
        $room = $db->lastInsertId();

         //select rooms in user table
        $user = $_SESSION['userid'];
        $sql2 = 'SELECT rooms FROM users WHERE id = :userid';
        $qry2 = $db->prepare($sql2);
        $qry2 -> bindParam( ':userid', $user, PDO::PARAM_INT );
        $qry2 -> execute();
        $results1 = $qry2 -> fetch( PDO::FETCH_ASSOC );
        
        //Add user to it
        $roomsArray = unserialize($results1['rooms']);
        array_push($roomsArray, (int)$room);
        $roomsArray = serialize($roomsArray);
        
        //Update in table
        $sql3 = 'UPDATE users SET rooms=:rooms WHERE id = :userid';
        $qry3 = $db->prepare($sql3);
        $qry3 -> bindParam( ':userid', $user, PDO::PARAM_INT );
        $qry3 -> bindParam( ':rooms', $roomsArray, PDO::PARAM_STR );
        $qry3 -> execute();

    }

    function JoinRoom($db, $room){
        
        //select users in room table
        $sql = 'SELECT users FROM rooms WHERE id = :room';
        $qry = $db->prepare($sql);
        $qry -> bindParam( ':room', $room, PDO::PARAM_INT );
        $qry -> execute();
        $results = $qry -> fetch( PDO::FETCH_ASSOC );
        
        //Add user to it
        $userArray = unserialize($results['users']);
        array_push($userArray, $_SESSION['userid']);
        $userArray = serialize($userArray);
        
        //Update in table
        $sql1 = 'UPDATE rooms SET users=:users WHERE id = :room';
        $qry1 = $db->prepare($sql1);
        $qry1 -> bindParam( ':room', $room, PDO::PARAM_INT );
        $qry1 -> bindParam( ':users', $userArray, PDO::PARAM_STR );
        $qry1 -> execute();
        
        //select rooms in user table
        $user = $_SESSION['userid'];
        $sql2 = 'SELECT rooms FROM users WHERE id = :user';
        $qry2 = $db->prepare($sql2);
        $qry2 -> bindParam( ':user', $user, PDO::PARAM_INT );
        $qry2 -> execute();
        $results1 = $qry2 -> fetch( PDO::FETCH_ASSOC );
        
        //Add user to it
        $roomsArray = unserialize($results1['rooms']);
        array_push($roomsArray, (int)$room);
        $roomsArray = serialize($roomsArray);
        
        //Update in table
        $sql3 = 'UPDATE users SET rooms=:rooms WHERE id = :user';
        $qry3 = $db->prepare($sql3);
        $qry3 -> bindParam( ':user', $user, PDO::PARAM_INT );
        $qry3 -> bindParam( ':rooms', $roomsArray, PDO::PARAM_STR );
        $qry3 -> execute();
    }

    function leaveRoom($db, $room){
         //select users in room table
        $sql = 'SELECT users FROM rooms WHERE id = :room';
        $qry = $db->prepare($sql);
        $qry -> bindParam( ':room', $room, PDO::PARAM_INT );
        $qry -> execute();
        $results = $qry -> fetch( PDO::FETCH_ASSOC );
        
        //Add user to it
        $userArray = unserialize($results['users']);
        if (($key = array_search($_SESSION['userid'], $userArray)) !== false) {
            unset($userArray[$key]);
        };
        $userArray = serialize($userArray);
        
        //Update in table
        $sql1 = 'UPDATE rooms SET users=:users WHERE id = :room';
        $qry1 = $db->prepare($sql1);
        $qry1 -> bindParam( ':room', $room, PDO::PARAM_INT );
        $qry1 -> bindParam( ':users', $userArray, PDO::PARAM_STR );
        $qry1 -> execute();

        //select rooms in user table
        $user = $_SESSION['userid'];
        $sql2 = 'SELECT rooms FROM users WHERE id = :user';
        $qry2 = $db->prepare($sql2);
        $qry2 -> bindParam( ':user', $user, PDO::PARAM_INT );
        $qry2 -> execute();
        $results1 = $qry2 -> fetch( PDO::FETCH_ASSOC );
        
        //Add user to it
        $roomsArray = unserialize($results1['rooms']);
        if (($key1 = array_search((int)$room, $roomsArray)) !== false) {
            unset($roomsArray[$key1]);
        };
        $roomsArray = serialize($roomsArray);
        
        //Update in table
        $sql3 = 'UPDATE users SET rooms=:rooms WHERE id = :user';
        $qry3 = $db->prepare($sql3);
        $qry3 -> bindParam( ':user', $user, PDO::PARAM_INT );
        $qry3 -> bindParam( ':rooms', $roomsArray, PDO::PARAM_STR );
        $qry3 -> execute();
    }
}

$messages = new messages;

?>