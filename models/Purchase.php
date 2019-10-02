<?php 
    class Purchase{
        private $conn;
        private $table = "purchases";

        public $id;
        public $product_id;
        public $product_name;
        public $amount;
        public $purchased_at;

        public function __construct($db){
            $this->conn = $db;
        }

        public function read(){
            $query = "SELECT product.name as product_name, p.id, p.product_id, p.amount, p.purchased_at 
                        FROM ".$this->table." p LEFT JOIN products as product ON p.product_id = product.id
                        ORDER BY p.purchased_at DESC";

            $stmt = $this->conn->prepare($query);

            $stmt->execute();
            return $stmt;
        }

        public function create(){
            $query = "INSERT INTO ".$this->table." SET
                        product_id = ?,
                        amount = ?";

            $stmt = $this->conn->prepare($query);

            if($stmt->execute([$this->product_id, $this->amount])){
                return true;
            }
            else{
                printf("Error: %s.\n", $stmt->error);
                return false;
            }
        }

        public function gePurchaseInfo($id){
            $query = "SELECT product_id, amount FROM ".$this->table." WHERE id = ?";

            $stmt = $this->conn->prepare($query);
            $stmt->execute([$id]);

            return $stmt->fetch();
        }

        public function delete($id){
            $query = "DELETE FROM ".$this->table." WHERE id = ?";

            $stmt = $this->conn->prepare($query);

            if($stmt->execute([$id])){
                return true;
            }
            else{
                return false;
            }
        }

    }
?>