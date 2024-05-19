<?php

class Product
{
    // подключение к базе данных и имя таблицы
    private $conn;
    private $table_name = "Products";

    // свойства объекта
    public $id;
    public $name;
    public $price;
    public $description;
    public $category_id;
    public $image;
    public $timestamp;
    public $packaging;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // метод создания товара
    function create()
    {
        // запрос MySQL для вставки записей в таблицу БД «products»
        // запрос
        $query = "INSERT INTO " . $this->table_name . "
SET name=:name, price=:price, description=:description,
    category_id=:category_id, image=:image, created=:created";

        $stmt = $this->conn->prepare($query);

        // опубликованные значения
        $this->name = isset ($this->name) ? htmlspecialchars(strip_tags($this->name)) : null;
        $this->price = isset ($this->price) ? htmlspecialchars(strip_tags($this->price)) : null;
        $this->description = isset ($this->description) ? htmlspecialchars(strip_tags($this->description)) : null;
        $this->category_id = isset ($this->category_id) ? htmlspecialchars(strip_tags($this->category_id)) : null;
        $this->image = isset ($this->image) ? htmlspecialchars(strip_tags($this->image)) : null;

        // получаем время создания записи
        $this->timestamp = date("Y-m-d H:i:s");

        // привязываем значения
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":category_id", $this->category_id);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":created", $this->timestamp);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    // метод для получения товаров
    function readAll($from_record_num, $records_per_page, $category_id = null)
    {
        // Запрос MySQL
        $query = "SELECT
                    id, name, description, price, category_id, image
                FROM
                    " . $this->table_name;

        // Если задан $category_id, добавляем условие WHERE для выборки товаров по категории
        if ($category_id !== null) {
            $query .= " WHERE category_id = :category_id";
        }

        $query .= " ORDER BY name ASC
                    LIMIT
                    {$from_record_num}, {$records_per_page}";

        // Подготовка запроса
        $stmt = $this->conn->prepare($query);

        // Если задан $category_id, привязываем его к параметру запроса
        if ($category_id !== null) {
            $stmt->bindParam(":category_id", $category_id);
        }

        // Выполнение запроса
        $stmt->execute();

        return $stmt;
    }

    // используется для пагинации товаров
    public function countAll()
    {
        // запрос MySQL
        $query = "SELECT id FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $num = $stmt->rowCount();

        return $num;
    }
  
// метод для получения одного товара
    function readOne()
    {
        // MySQL запрос
        $query = "SELECT name, price, description, category_id, image
        FROM " . $this->table_name . "
        WHERE id = ?
        LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row["name"];
        $this->price = $row["price"];
        $this->description = $row["description"];
        $this->category_id = $row["category_id"];
        $this->image = $row["image"];
    }
    public function Packaging()
    {
        // Запрос к базе данных для получения упаковок товара
        $query = "SELECT id, name, price FROM Packaging WHERE product_id = ?";

        // Подготавливаем запрос
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        // Создаем массив для хранения упаковок товара
        $packagingOptions = array();

        // Получаем данные о упаковках и добавляем их в массив
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $packagingOptions[] = array(
                "id" => $row["id"],
                "name" => $row["name"],
                "price" => $row["price"]
            );
        }

        return $packagingOptions;
    }

    // метод для обновления товара
    function update()
    {
        // MySQL запрос для обновления записи (товара)
        $query = "UPDATE
                " . $this->table_name . "
            SET
                name = :name,
                price = :price,
                description = :description,
                category_id  = :category_id
            WHERE
                id = :id";

        // подготовка запроса
        $stmt = $this->conn->prepare($query);

        // очистка
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // привязка значений
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":category_id", $this->category_id);
        $stmt->bindParam(":id", $this->id);

        // выполняем запрос
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    // метод для удаления товара
    function delete()
    {
        // запрос MySQL для удаления
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    // выбираем товары по поисковому запросу
    // метод для выборки товаров по поисковому запросу
    public function search($search_term, $from_record_num, $records_per_page)
    {
        // запрос к БД
        $query = "SELECT
        c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created, p.image
    FROM
        " . $this->table_name . " p
        LEFT JOIN
            categories c
                ON p.category_id = c.id
    WHERE
        p.name LIKE ? OR p.description LIKE ?
    ORDER BY
        p.name ASC
    LIMIT
        ?, ?";

        // подготавливаем запрос
        $stmt = $this->conn->prepare($query);

        // привязываем значения переменных
        $search_term = "%{$search_term}%";
        $stmt->bindParam(1, $search_term);
        $stmt->bindParam(2, $search_term);
        $stmt->bindParam(3, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(4, $records_per_page, PDO::PARAM_INT);

        // выполняем запрос
        $stmt->execute();

        // возвращаем значения из БД
        return $stmt;
    }


    // метод для подсчёта общего количества строк
    public function countAll_BySearch($search_term)
    {
        // запрос
        $query = "SELECT
            COUNT(*) as total_rows
        FROM
            " . $this->table_name . " p 
        WHERE
            p.name LIKE ? OR p.description LIKE ?";

        // подготовка запроса
        $stmt = $this->conn->prepare($query);

        // привязка значений
        $search_term = "%{$search_term}%";
        $stmt->bindParam(1, $search_term);
        $stmt->bindParam(2, $search_term);

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row["total_rows"];
    }
    // загрузка файла изображения на сервер
    function uploadPhoto()
    {
        $result_message = "";

        // если изображение не пустое, пробуем загрузить его
        if ($this->image) {

            // функция sha1_file() используется для создания уникального имени файла
            $target_directory = "uploads/";
            $target_file = $target_directory . $this->image;
            $file_type = pathinfo($target_file, PATHINFO_EXTENSION);

            // сообщение об ошибке пусто
            $file_upload_error_messages = "";
            // убеждаемся, что файл - изображение
            $check = getimagesize($_FILES["image"]["tmp_name"]);

            if ($check !== false) {
                // отправленный файл является изображением
            } else {
                $file_upload_error_messages .= "<div>Отправленный файл не является изображением.</div>";
            }

            // проверяем, разрешены ли определенные типы файлов
            $allowed_file_types = array("jpg", "jpeg", "png", "gif");

            if (!in_array($file_type, $allowed_file_types)) {
                $file_upload_error_messages .= "<div>Разрешены только файлы JPG, JPEG, PNG, GIF.</div>";
            }

            // убеждаемся, что файл не существует
            if (file_exists($target_file)) {
                $file_upload_error_messages .= "<div>Изображение уже существует. Попробуйте изменить имя файла.</div>";
            }

            // убедимся, что отправленный файл не слишком большой (не может быть больше 1 МБ)
            if ($_FILES["image"]["size"] > (1024000)) {
                $file_upload_error_messages .= "<div>Размер изображения не должен превышать 1 МБ.</div>";
            }

            // убедимся, что папка uploads существует, если нет, то создаём
            if (!is_dir($target_directory)) {
                mkdir($target_directory, 0777, true);
            }
            // если $file_upload_error_messages всё ещё пуст
            if (empty ($file_upload_error_messages)) {

                // ошибок нет, пробуем загрузить файл
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    // фото загружено
                } else {
                    $result_message .= "<div class='alert alert-danger'>";
                    $result_message .= "<div>Невозможно загрузить фото.</div>";
                    $result_message .= "<div>Обновите запись, чтобы загрузить фото снова.</div>";
                    $result_message .= "</div>";
                }
            }

            // если $file_upload_error_messages НЕ пусто
            else {

                // это означает, что есть ошибки, поэтому покажем их пользователю
                $result_message .= "<div class='alert alert-danger'>";
                $result_message .= "{$file_upload_error_messages}";
                $result_message .= "<div>Обновите запись, чтобы загрузить фото.</div>";
                $result_message .= "</div>";
            }
        }

        return $result_message;
    }
    public function readByCategoryId($from_record_num, $records_per_page, $category_id)
    {
        // SQL-запрос для выборки товаров по заданной категории
        $query = "SELECT p.id, p.name, p.price, p.image
        FROM Products p
        JOIN Categories c ON p.category_id = c.id
        WHERE c.id = :category_id;
        LIMIT {$from_record_num}, {$records_per_page}";

        // Подготовка запроса
        $stmt = $this->conn->prepare($query);

        // Привязываем параметры
        $stmt->bindParam(":category_id", $category_id);

        // Выполняем запрос
        $stmt->execute();

        return $stmt;
    }
}
