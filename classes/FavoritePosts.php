<?php
    require_once "./config/config.php";

    class FavoritePosts{

        public function __construct(){
           $this->removeDeletedPosts(); 
        }

        public function getFavoriteCount(){
            $this->removeDeletedPosts();
            try{
                $conn = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
                $sql = "SELECT count(*) FROM `favorites`";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $row_num = $stmt->fetchColumn();
                $conn = null;
                return $row_num;
                
            }catch(Exception $ex){
                echo $ex->getMessage();
                $conn = null;
            }
        }

        public function getFavoritePosts(){
            $this->removeDeletedPosts();
            try{
                $conn = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
                $sql = "SELECT * FROM `posts` natural join favorites where posts.post_id = favorites.post_id";
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
                $conn = null;
            }
        }

        public function removeFromFavorites($id){
            $this->removeDeletedPosts();
            try{
                $conn = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
                $sql = "DELETE FROM `favorites` WHERE fav_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1,$id);
                $result = $stmt->execute();
                $conn = null;
                return $result;
            }catch(Exception $ex){
                echo $ex->getMessage();
                $conn = null;
            }
        }

        public function removeDeletedPosts(){
            try{
                $conn = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
                $sql_select_row = 'SELECT fav_id FROM `favorites` WHERE NOT EXISTS (SELECT * FROM `posts` NATURAL JOIN `favorites` WHERE posts.post_id = favorites.post_id)';
                $stmt = $conn->prepare($sql_select_row);
                $stmt->execute();
                $result_id = $stmt->fetch();

                $sql_delete_row = 'DELETE FROM `favorites` WHERE fav_id = ?';
                $stmt=$conn->prepare($sql_delete_row);
                $stmt->bindParam(1,$result_id['fav_id']);
                $stmt->execute();
                $conn = null;
            }catch(Exception $ex){
                echo $ex->getMessage();
            }
        }

    }