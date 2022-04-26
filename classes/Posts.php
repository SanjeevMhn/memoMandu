<?php

    require_once "./config/config.php";
    class Posts{

        public function getAllPosts(){
            try{
                $conn = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
                $sql = "SELECT * FROM posts";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $list = array();

                while($row = $stmt->fetch()){
                    $list[] = $row;    
                }

                $conn = null;
                return $list;
            }catch(Exception $ex){
                echo $ex->getMessage();
            }
        }

        public function insert($data = array()){
            try{
                $conn = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
                $sql = "INSERT INTO posts (post_title,post_desc,post_author) VALUES (:title,:descr,:author)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':title',$data['title'],PDO::PARAM_STR);
                $stmt->bindParam(':descr',$data['desc'],PDO::PARAM_LOB);
                $stmt->bindParam(':author',$data['author'],PDO::PARAM_STR);
                $result = $stmt->execute();
                $conn = null;
                return $result;
            }catch(Exception $ex){
                echo $ex->getMessage();
            }
        }

        public function addToFavorite($id){
            try{
                $conn = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
                $sql = 'INSERT INTO `favorites`(post_id) VALUES (?)';
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1,$id);
                $result = $stmt->execute();
                return $result;
                $conn = null;
            }catch(Exception $ex){
                echo $ex->getMessage();
                $conn = null;
            }
        }

        public function viewPost($id){
            try{
                $conn = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
                $sql = "SELECT * FROM `posts` WHERE post_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1,$id);
                $stmt->execute();
                $result = $stmt->fetch();
                return $result;
            }catch(Exception $ex){
                echo $ex->getMessage();
            }
        }

        public function deletePost($id){
            try{
                $conn = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
                $sql = "DELETE FROM `posts` WHERE post_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1,$id);
                $result = $stmt->execute();
                $conn = null;
                return $result;
            }catch(Exception $ex){
                $ex->getMessage();
                $conn = null;
            }
        }
    }