<?php
    require_once 'config.php';

    class Auth extends Database{

        //Insert Mesage us form to db
        public function messageNow($type, $message, $status){
            $sql = "INSERT INTO notifications (type, message, status) VALUES (:type, :message, :status)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    'type'=>$type, 
                    'message'=>$message,
                    'status'=>$status
                    ]
                );
                return $stmt;
        }

        //Insert like us form to db
        public function likeNow($name, $type, $status){
            $sql = "INSERT INTO notifications (name, type, status) VALUES (:name, :type, :status)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    'name'=>$name,
                    'type'=>$type, 
                    'status'=>$status
                    ]
                );
                return $stmt;
        }
            
        public function displayNotificationCount(){
            $sql = "SELECT * FROM notifications WHERE status = 'unread' ORDER BY date DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }

        public function fetchNotifications(){
            $sql = "SELECT * FROM notifications ORDER BY date DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $result;
        }
    }