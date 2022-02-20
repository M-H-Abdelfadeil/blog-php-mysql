<?php
namespace App\Models;

use PDO;

class PostModel extends Model{
    

    public function create(string $title ,  string $description , string $image , int $user_id){
        $stm = "INSERT INTO posts (title ,  description , image , user_id ) VALUES (:title , :description , :image , :user_id)";
        $sql= $this->db->conn->prepare($stm);
        $sql->bindParam(':title'        ,$title         ,PDO::PARAM_STR);
        $sql->bindParam(':description'  ,$description   ,PDO::PARAM_STR);
        $sql->bindParam(':image'        ,$image         ,PDO::PARAM_STR);
        $sql->bindParam(':user_id'      ,$user_id       ,PDO::PARAM_STR);
        $sql->execute();
    }
}