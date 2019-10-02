<?php 
    class Message{
        private $conn;
        private $table = "messages";

        public $id;
        public $body;
        public $product_id;
        public $created_at;

        public function __construct($db){
            $this->conn = $db;
        }

        public function create(){
            $query = "INSERT INTO ".$this->table." SET body = ?, product_id = ?";
            $stmt = $this->conn->prepare($query);

            if($stmt->execute([$this->body, $this->product_id])){
                return true;
            }
            else{
                return false;
            }
        }

        public function read(){
            $query = "SELECT * FROM ".$this->table." ORDER BY recieved_at DESC";
            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
        }

        public function delete(){
            $query = "DELETE FROM ".$this->table." WHERE product_id = ?";
            $stmt = $this->conn->prepare($query);

            $stmt->execute([$this->product_id]);


        }



    }
?>