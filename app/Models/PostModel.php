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


    public function showToUser(int $postId , int $userId){
        $stm="SELECT title , description , image FROM posts WHERE id=:post_id and user_id=:user_id";
        $sql=$this->db->conn->prepare($stm);
        $sql->bindParam(':post_id',$postId,PDO::PARAM_INT);
        $sql->bindParam(':user_id',$userId,PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetch();
    }


    public function show(int $postId){
        $stm="
        SELECT 
            posts.id as post_id , title , SUBSTRING(description,1,100) as description , image , user_id , users.name
        FROM posts 
        JOIN users 
            ON posts.user_id = users.id 
        WHERE   posts.id = :post_id
        ";
        $sql=$this->db->conn->prepare($stm);
        $sql->bindParam(':post_id',$postId,PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetch();
    }

    public function update(int $postId , string $title , string $description ,$image){
        $stm="UPDATE posts SET title=:title , description=:description where id=:id";
        $sql=$this->db->conn->prepare($stm);
        $sql->bindParam(':title'        ,$title         ,PDO::PARAM_STR);
        $sql->bindParam(':description'  ,$description   ,PDO::PARAM_STR);
        $sql->bindParam(':id'           ,$postId        ,PDO::PARAM_INT);
        $sql->execute();
        if($image){
            $this->updateImage($postId,$image);
        }
    }


    public function recent(){
        $stm="
            SELECT 
                posts.id as post_id , title , SUBSTRING(description,1,100) as description , image , user_id , users.name
            FROM posts 
            JOIN users 
                ON posts.user_id = users.id 
            ORDER BY posts.id DESC LIMIT 4
        ";
        $sql=$this->db->conn->prepare($stm);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function postsUser($userId){
        $stm="SELECT 
            id , title ,  SUBSTRING(description,1,100) as description , image 
        FROM posts WHERE  user_id=:user_id";
        $sql=$this->db->conn->prepare($stm);
        $sql->bindParam(':user_id',$userId,PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetchAll();
    }


    public function getUser($userId){
        $stm="SELECT name FROM users WHERE  id=:user_id";
        $sql=$this->db->conn->prepare($stm);
        $sql->bindParam(':user_id',$userId,PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetch();
    }

    public function delete($postId,$userId){
        deleteOldImagePost($this->getOldImage($postId));// delete old image
        
        $stm="DELETE FROM posts where id = :id and user_id=:user_id";
        $sql=$this->db->conn->prepare($stm);
        $sql->bindParam(':user_id',$userId,PDO::PARAM_INT);
        $sql->bindParam(':id',$postId,PDO::PARAM_INT);
        $sql->execute();
    }



    private function updateImage($postId,$image){

        deleteOldImagePost($this->getOldImage($postId));// delete old image

        $stm="UPDATE posts SET image=:image  where id=:id";
        $sql=$this->db->conn->prepare($stm);
        $sql->bindParam(':image'  ,$image   ,PDO::PARAM_STR);
        $sql->bindParam(':id'     ,$postId  ,PDO::PARAM_INT);
        $sql->execute();
    }

    public function index(){
        $stm="
            SELECT 
                posts.id as post_id , title , SUBSTRING(description,1,100) as description , image , user_id , users.name
            FROM posts 
            JOIN users 
                ON posts.user_id = users.id 
            ORDER BY posts.id DESC
        ";
        $sql=$this->db->conn->prepare($stm);
        $sql->execute();
        return $sql->fetchAll();
    }
    private function getOldImage($postId){
        $stm="SELECT image FROM posts WHERE id=:post_id";
        $sql=$this->db->conn->prepare($stm);
        $sql->bindParam(':post_id'     ,$postId  ,PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetch()['image'];

    }


}