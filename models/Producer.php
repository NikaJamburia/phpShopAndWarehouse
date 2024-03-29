<?php 
    class Producer{
        private $conn;
        private $table = "producers";

        public $id;
        public $name;
        public $email;
        public $address;
        public $phone;

        public function __construct($db){
            $this->conn = $db;
        }

        public function read(){
            $query = "SELECT * FROM ".$this->table;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll();
        }

        public function create(){
            $query = "INSERT INTO ".$this->table." SET
                name = :name,
                email = :email,
                address = :address,
                phone = :phone
            ";

            $stmt = $this->conn->prepare($query);

            if($stmt->execute([
                'name' => $this->name,
                'email' => $this->email,
                'address' => $this->address,
                'phone' => $this->phone
            ])){
                return true;
            }
            else{
                return false;
            }

        }

        public function show($id){
            $query = "SELECT * FROM ".$this->table." WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$id]);

            $row = $stmt->fetch();

            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->email = $row['email'];
            $this->address = $row['address'];
            $this->phone = $row['phone'];
        }



    }
?>