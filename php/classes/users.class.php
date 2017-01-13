<?php 

class Users{

    function LogIn($db, $user, $pass){
        try{
            $sql = "SELECT * FROM msg.users WHERE username = :user LIMIT 1";
            $qry = $db -> prepare($sql);
            $qry -> bindParam(':user', $user, PDO::PARAM_STR);
            $qry -> execute();
            $results = $qry -> fetch(PDO::FETCH_ASSOC);
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        };

        if (password_verify($pass, $results['pass'])){
            $_SESSION['loggedIn'] = true;
            $_SESSION['userid'] = $results['id'];
            $_SESSION['username'] = $results['username'];
        };

    }

    function Register($db, $user, $email, $pass){
        $hashedPW = password_hash($pass, PASSWORD_DEFAULT);
        try{
            $sql = "INSERT INTO users(username, email, pass) VALUES (:user, :email, :hashedPW)";
            $qry = $db -> prepare($sql);
            $qry -> bindParam(':user', $user, PDO::PARAM_STR);
            $qry -> bindParam(':email', $email, PDO::PARAM_STR);
            $qry -> bindParam(':hashedPW', $hashedPW, PDO::PARAM_STR);
            $qry -> execute();
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

    }

    function IsloggedIn(){
        $rtn;
        if ( isSet($_SESSION['loggedIn']) && $_SESSION['loggedIn'] ){
            $rtn = true;
        }else{
            $rtn = false;
        };
        return $rtn;
    }

    function LoggingOut(){
        if (isSet($_GET['logout'])){
            session_destroy();
            header("Location: rooms.php");
        }
    }

}

$Users = new Users;
session_start();
$Users->LoggingOut();

?>