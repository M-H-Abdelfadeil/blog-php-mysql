<?php
namespace App\Models;
use PDO;
class AuthModel {
    private $db;
    public function __construct()
    {
        $this->db= new Database;
    }

    public function register(string $name , string $email , string $password){
        $stm="INSERT INTO users  (name , email ,  password) VALUES (:name , :email , :password)";
        $sql=$this->db->conn->prepare($stm);
        $sql->bindParam(':name'     ,$name      ,PDO::PARAM_STR);
        $sql->bindParam(':email'    ,$email     ,PDO::PARAM_STR);
        $sql->bindParam(':password' ,$password  ,PDO::PARAM_STR);
        $sql->execute();
        return $this->db->conn->lastInsertId();
    }


    public function login(string $email , string $password){
        $stm="SELECT * FROM users where email=:email";
        $sql=$this->db->conn->prepare($stm);
        $sql->bindParam(':email'    ,$email     ,PDO::PARAM_STR);
        $sql->execute();
        return $this->check( $sql->fetch(),$password);
    }


    private function check($data,string $password){
        // check email
        if(!$data){
            return false;
        }
        
        // check password 
        if(!password_verify($password,$data['password'])){
            return false;
        }

        // return data
        return $this->data($data);

    }

    private function data(array $data){
        return [
            'id'=>$data['id'],
            'email'=>$data['email'],
            'name'=>$data['name']
        ];
    }
}
