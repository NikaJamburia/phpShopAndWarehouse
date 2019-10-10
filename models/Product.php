<?php 
    class Product{
        private $conn;
        private $table = "products";

        public $id;
        public $name;
        public $description;
        public $price;
        public $producer;
        public $producer_id;
        public $amount;
        public $added_at;
        public $image;

        public function __construct($db){
            $this->conn = $db;
        }

        public function read(){
            $query = "SELECT pr.name as producer_name, p.id, p.name, p.description, p.price, p.producer, p.amount, p.added_at, p.image
                        FROM ".$this->table." p
                        LEFT JOIN producers as pr ON p.producer = pr.id
                        ORDER BY added_at DESC";

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
        }

        public function read_by_producer($id){
            $query = "SELECT id, name FROM ".$this->table." WHERE producer = ?";

            $stmt = $this->conn->prepare($query);

            $stmt->execute([$id]);

            return $stmt;
        }

        public function show($id){
            $query = "SELECT pr.name as producer_name, pr.id as producer_id, p.id, p.name, p.description, p.price, p.producer, p.amount, p.added_at, p.image
                        FROM ".$this->table." p
                        LEFT JOIN producers as pr ON p.producer = pr.id
                        WHERE p.id = ?";
            
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$id]);

            $row = $stmt->fetch();

            $this->id = $row["id"];
            $this->name = $row["name"];
            $this->description = $row["description"];
            $this->price = $row["price"];
            $this->producer = $row["producer_name"];
            $this->producer_id = $row["producer_id"];
            $this->amount = $row["amount"];
            $this->added_at = $row["added_at"];
            $this->image = $row["image"];
        }

        public function create(){
            $query = "INSERT INTO ".$this->table." SET
            name = :name,
            description = :description,
            price = :price,
            producer = :producer,
            image = :image
            ";

            $stmt = $this->conn->prepare($query);
            
            if($stmt->execute([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'producer' => $this->producer_id,
                'image' => $this->image
            ])){
                return true;
            }
            else{
                printf("Error: %s.\n", $stmt->error);

                return false;
            }
        }

        public function delete($id){
            $query = "DELETE FROM ".$this->table." WHERE id = ?";
            $stmt = $this->conn->prepare($query);

            if($stmt->execute([$id])){
                return true;
            }
        }

        public function buy($id, $bought_amount){
            $query = "SELECT amount FROM products WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$id]);

            $row = $stmt->fetch();
            $previous_amount = $row['amount'];

            $new_amount = $previous_amount - $bought_amount;

            if($new_amount == 0){
                include_once "Message.php";

                $message = new Message($this->conn);

                $message->body = "Product id $id is out of stock!";
                $message->product_id = $id;

                $message->create();
            }

            $query = "UPDATE ".$this->table." SET amount = ? WHERE id = ?";
            $stmt = $this->conn->prepare($query);

            if($stmt->execute([$new_amount, $id])){
                return true;
            }
            else{
                return false;
            }

        }

        public function deliver($id, $delivered_amount){
            $query = "SELECT amount FROM products WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$id]);

            $row = $stmt->fetch();
            $previous_amount = $row['amount'];

            $new_amount = $previous_amount + $delivered_amount;

            $query = "UPDATE ".$this->table." SET amount = ? WHERE id = ?";
            $stmt = $this->conn->prepare($query);

            if($stmt->execute([$new_amount, $id])){
                include_once "Message.php";

                $message = new Message($this->conn);
                $message->product_id = $id;

                $message->delete();

                return true;
            }
            else{
                return false;
            }

        }

        public function return($id, $return_amount){
            $query = "SELECT amount FROM products WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$id]);

            $row = $stmt->fetch();
            $previous_amount = $row['amount'];

            $new_amount = $previous_amount + $return_amount;

            $query = "UPDATE ".$this->table." SET amount = ? WHERE id = ?";
            $stmt = $this->conn->prepare($query);

            if($stmt->execute([$new_amount, $id])){
                return true;
            }
            else{
                return false;
            }


        }

    }
?>