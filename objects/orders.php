<?php
class Order
{
    private $conn;
    private $table_name = "orders";

    public $id;
    public $order_number;
    public $user_id;
    public $order_status;
    public $name;
    public $phone;
    public $address;
    public $delivery_date;
    public $delivery_time;
    public $note;
    public $total_amount;

    public function __construct($db)
    {
        $this->conn = $db;
        $this->order_number = $this->generateOrderNumber();
        $this->order_status = 1;
    }

    public function generateOrderNumber()
    {
        return uniqid();
    }

    public function setUser($user_id)
    {
        // Запрос для выборки заказов пользователя
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = ?";

        // Подготовка запроса
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            // Если запрос не удалось подготовить, выводим сообщение об ошибке
            printf("Ошибка при подготовке запроса: %s.\n", $this->conn->error);
            return false; // Возвращаем false, чтобы показать, что произошла ошибка
        }

        // Привязываем параметр
        $stmt->bindParam(1, $user_id);

        // Выполняем запрос
        if ($stmt->execute()) {
            return $stmt; // Возвращаем объект PDOStatement
        } else {
            // Если возникла ошибка при выполнении запроса, выводим сообщение об ошибке
            printf("Ошибка при выполнении запроса: %s.\n", $stmt->error);
            return false; // Возвращаем false, чтобы показать, что произошла ошибка
        }
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . "
        SET
        order_number = :order_number,
        user_id = :user_id,
        order_status = :order_status,
        name = :name,
        phone = :phone,
        address = :address,
        delivery_date = :delivery_date,
        delivery_time = :delivery_time,
        note = :note,
        total_amount = :total_amount";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":order_number", $this->order_number);
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":order_status", $this->order_status);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":delivery_date", $this->delivery_date);
        $stmt->bindParam(":delivery_time", $this->delivery_time);
        $stmt->bindParam(":note", $this->note);
        $stmt->bindParam(":total_amount", $this->total_amount);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    public function readAll()
    {
        // Запрос для получения всех заказов
        $query = "SELECT * FROM " . $this->table_name;

        // Подготовка запроса
        $stmt = $this->conn->prepare($query);

        // Выполнение запроса
        $stmt->execute();

        return $stmt;
    }
    public function updateStatus()
    {
        // Запрос для обновления статуса заказа в базе данных
        $query = "UPDATE " . $this->table_name . " SET order_status = :order_status WHERE id = :id";

        // Подготовка запроса
        $stmt = $this->conn->prepare($query);

        // Привязка параметров
        $stmt->bindParam(':order_status', $this->order_status);
        $stmt->bindParam(':id', $this->id);

        // Выполнение запроса
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    
    function createUniqueOrder($phone, $wishes)
    {
        // SQL запрос для вставки данных в таблицу уникальных заказов
        $query = "INSERT INTO unique_orders SET phone=:phone, wishes=:wishes";

        // Подготовка запроса
        $stmt = $this->conn->prepare($query);

        $phone = htmlspecialchars(strip_tags($phone));
        $wishes = htmlspecialchars(strip_tags($wishes));

        // Привязка значений
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":wishes", $wishes);

        // Выполнение запроса
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    public function readUniqueOrders()
    {
        // Запрос для получения всех уникальных заказов
        $query = "SELECT * FROM unique_orders";

        // Подготовка запроса
        $stmt = $this->conn->prepare($query);

        // Выполнение запроса
        $stmt->execute();

        return $stmt;
    }
}
?>