<?php 
    class Delivery{
        private $conn;
        private $table = "deliveries";

        public $id;
        public $product_id;
        public $company_id;
        public $amount;
        public $delivery_date;

        public function __construct($db){
            $this->conn = $db;
        }

        public function create(){
            $query = "INSERT INTO ".$this->table." SET
                        product_id = ?, 
                        producer_id = ?,
                        amount = ?
                        ";
            $stmt = $this->conn->prepare($query);

            if($stmt->execute([$this->product_id, $this->company_id, $this->amount])){
                return true;
            }
            else{
                return false;
            }
        }

        public function read(){
            $query = "SELECT product.name AS product_name,
                            producer.name AS producer_name,
                            d.id,
                            d.product_id,
                            d.producer_id,
                            d.amount,
                            d.delivery_date 
                        FROM ".$this->table." d  
                        LEFT JOIN products as product ON d.product_id = product.id
                        LEFT JOIN producers as producer ON d.producer_id = producer.id
                        ORDER BY d.delivery_date DESC
                        ";


            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
        }

        public function delete(){
            $query = "DELETE FROM ".$this->table." WHERE id = ?";
            $stmt = $this->conn->prepare($query);

            if($stmt->execute($this->id)){
                return true;
            }
            else{
                return false;
            }

        }



    }
?>