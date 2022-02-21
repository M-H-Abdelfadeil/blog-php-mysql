<?php
namespace App\Models;
use PDO;
class ProfileModel extends Model{
    public function edit(int $userId , string $name, string $email){
        $stm="UPDATE users SET name=:name , email=:email where id=:id";
        $sql=$this->db->conn->prepare($stm);
        $sql->bindParam(':name'     ,$name      ,PDO::PARAM_STR);
        $sql->bindParam(':email'    ,$email     ,PDO::PARAM_STR);
        $sql->bindParam(':id'       ,$userId    ,PDO::PARAM_INT);
        return $sql->execute();
    }

    public function editPassword(int $userId , string  $password){
        $stm="UPDATE users SET password=:password where id=:id";
        $sql=$this->db->conn->prepare($stm);
        $sql->bindParam(':password'  ,$password  ,PDO::PARAM_STR);
        $sql->bindParam(':id'        ,$userId    ,PDO::PARAM_INT);
        return $sql->execute();
    }

    public function getOldPassword($userId){
        $stm="SELECT password FROM users WHERE id=:user_id";
        $sql=$this->db->conn->prepare($stm);
        $sql->bindParam(':user_id'     ,$userId  ,PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetch()['password'];
    }
}