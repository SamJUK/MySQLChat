<?php 

class db{

    public $dbh;

    function __construct(){
        try{
            $db_host = "localhost";
            $db_name = "msg";
            $db_username = "root";
            $db_password = "";

            $this->dbh = new PDO('mysql:host='.$db_host.'; dbname='.$db_name,$db_username,$db_password);
            $this->dbh->setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->dbh->exec("SET CHARACTER SET utf8");
            $con = $this->dbh;
        }
        catch(PDOException $err){
            echo "There appears to have been an issue initiating the database connection!";
            $err->getMessage() . "<br/>";
            file_put_contents('PDOErrors.txt',$err, FILE_APPEND);
            die();  //Terminate Connection
        }
    }   

}

$db = new db;

?>