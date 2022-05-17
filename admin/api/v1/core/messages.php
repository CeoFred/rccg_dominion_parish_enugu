<?php

require 'Base.php';

class Messages extends Base {

  // database connection and table name
  public $conn,$table_name = "messages", $null  = null,$deleted_status = 2,$active_status = 1,$not_active = 0,$_result = null;
  private $_fetchStyle = PDO::FETCH_CLASS;

  // constructor with $db as database connection
  public function __construct($db){

    $this->conn = $db;
  
    }

  function allMessages(){

    // select all query
    $query = "SELECT *  FROM
                " . $this->table_name . "
                ORDER BY created_at
                 DESC";

    // prepare query statement
    $stmt = $this->conn->prepare($query);



    // execute query
    $stmt->execute();

    return $stmt;
  }


  function singleMessage($id){

    // select all query
    $query = "SELECT *  FROM
                " . $this->table_name . "
                WHERE message_id=:message_id
                LIMIT
                0,1
                 ";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":message_id", $id);

    // execute query
    $stmt->execute();

    return $stmt;
  }

  function randomNumber($length) {
    $result = '';

    for($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }

    return $result;
  }
  // create courier
  function create(){

    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
            message_id=:message_id,name=:name,
            content=:content,subject=:subject,
            email=:email,created_at=:created_at";
    // prepare query
    $stmt = $this->conn->prepare($query);
    // sanitize
    $this->email = htmlspecialchars(strip_tags(trim($this->email)));
    $this->created_at = date('Y-m-d H:i:s');
    $this->message_id = $this->randomNumber(30);
    // bind values
   $stmt->bindParam(":created_at", $this->created_at);
    $stmt->bindParam(":email",$this->email);
   $stmt->bindParam(":message_id",$this->message_id);
   $stmt->bindParam(":name",$this->name);
   $stmt->bindParam(":content",$this->content);
   $stmt->bindParam(":subject",$this->subject);


    // execute query
    if ($stmt->execute()) {

      return true;
    }

    return false;
  }



    
}
