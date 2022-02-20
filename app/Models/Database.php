<?php
namespace App\Models;
use PDO;
use PDOException;

class Database {

    private $db_host = DB_HOST;
    private $db_name = DB_NAME;
    private $db_user = DB_USER;
    private $db_pass = DB_PASS;
    private $dsn;
    public $conn;

    public function __construct()
    {
        $this->dsn="mysql:host=$this->db_host;dbname=$this->db_name";
        try{
            $this->conn=new PDO($this->dsn,$this->db_user,$this->db_pass,[
                 PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                 PDO::ATTR_EMULATE_PREPARES => false
             ]);
        }catch(PDOException $e){
            echo $e->getMessage();
            exit;
        }
    }
    


};