<?php
class UniqueOrder
{
    private $conn;
    private $table_name = "unique_orders";

    public $id;
    public $order_number;
    public $phone;
    public $wishes;
    public $created_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function readAll()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>