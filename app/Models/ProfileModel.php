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
}