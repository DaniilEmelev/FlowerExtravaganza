<?php
class OrderItem
{
    // Подключение к базе данных и имя таблицы
    private $conn;
    private $table_name = "order_items";

    // Свойства объекта
    public $id;
    public $order_id;
    public $product_name;
    public $quantity;
    public $proudct_price;
    public $packaging_price;
    public $product_image;

    // Конструктор класса
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Метод для создания нового товара в заказе
    function create()
    {
        $query = "INSERT INTO " . $this->table_name . "
        SET
        order_id = :order_id,
        product_name = :product_name,
        quantity = :quantity,
        proudct_price = :proudct_price,
        product_image = :product_image,
        packaging_price = :packaging_price";

        $stmt = $this->conn->prepare($query);

        // Очистка данных
        $this->order_id = htmlspecialchars(strip_tags($this->order_id));
        $this->product_name = htmlspecialchars(strip_tags($this->product_name));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));
        $this->price = htmlspecialchars(strip_tags($this->proudct_price));
        $this->packaging_price = htmlspecialchars(strip_tags($this->packaging_price));

        // Привязываем значения
        $stmt->bindParam(":order_id", $this->order_id);
        $stmt->bindParam(":product_name", $this->product_name);
        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":proudct_price", $this->proudct_price);
        $stmt->bindParam(":product_image", $this->product_image);
        $stmt->bindParam(":packaging_price", $this->packaging_price);

        // Выполнение запроса
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    
    public function readAllByOrderId()
    {
        // Запрос для выборки всех товаров по идентификатору заказа
        $query = "SELECT * FROM " . $this->table_name . " WHERE order_id = ?";

        // Подготовка запроса
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            // Если запрос не удалось подготовить, выводим сообщение об ошибке
            printf("Ошибка при подготовке запроса: %s.\n", $this->conn->error);
            return false;
        }

        // Привязываем параметр
        $stmt->bindParam(1, $this->order_id);

        // Выполняем запрос
        if ($stmt->execute()) {
            return $stmt; // Возвращаем объект PDOStatement
        } else {
            // Если возникла ошибка при выполнении запроса, выводим сообщение об ошибке
            printf("Ошибка при выполнении запроса: %s.\n", $stmt->error);
            return false; // Возвращаем false, чтобы показать, что произошла ошибка
        }
    }
}
