<?php
class Database{


       private $host = "localhost";
    private $db_name = "rccgdomi_nionparish";
    private $username = "rccgdomi_codemon";
    private $password = "iftrueconnect";

    public $conn;
    
    

    // get the database connection
    public function getConnection(){
        $ip = $_SERVER['REMOTE_ADDR'];
        if($ip === '::1'){
            $this->db_name = 'rccgdominionparish';
            $this->username = 'root';
            $this->password = '';
        }
        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password, array(
        PDO::ATTR_PERSISTENT => true
      ));
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
            die();
        }

        return $this->conn;
    }
}
