<?php
class User
{
    // подключение к базе данных и имя таблицы
    private $conn;
    private $table_name = "Users";

    // свойства объекта
    public $id;
    public $name;
    public $surname;
    public $lastname;
    public $email;
    public $password;

    // конструктор класса
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // метод создания нового пользователя
    function create()
    {
        // запрос для вставки записи о пользователе
        $query = "INSERT INTO " . $this->table_name . "
        SET
        Name = :name,
        Surname = :surname,
        Lastname = :lastname,
        email = :email,
        password = :password,
        role = 1";


        // подготовка запроса
        $stmt = $this->conn->prepare($query);

        // очистка данных
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->surname = htmlspecialchars(strip_tags($this->surname));
        $this->lastname = htmlspecialchars(strip_tags($this->lastname));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));

        // привязываем значения
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":surname", $this->surname);
        $stmt->bindParam(":lastname", $this->lastname);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);

        // выполнение запроса
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    public function check_user_credentials($email, $password)
    {
        // Подготавливаем запрос
        $query = "SELECT id FROM " . $this->table_name . " WHERE email = ? AND password = ?";

        // Подготавливаем запрос
        $stmt = $this->conn->prepare($query);

        // Биндим значения
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $password);

        // Выполняем запрос
        $stmt->execute();

        // Если запрос возвращает хотя бы одну строку
        if ($stmt->rowCount() > 0) {
            // Получаем идентификатор пользователя
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            return true;
        }

        // Если запрос не вернул ни одной строки
        return false;
    }

    public function readOne()
    {
        // Запрос для получения данных о пользователе по его идентификатору
        $query = "SELECT name, surname, lastname, email FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";

        // Подготовка запроса
        $stmt = $this->conn->prepare($query);

        // Привязка идентификатора пользователя
        $stmt->bindParam(1, $this->id);

        // Выполнение запроса
        $stmt->execute();

        // Получение строки с данными о пользователе
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Установка свойств объекта пользователя значениями из базы данных
        $this->name = $row['name'];
        $this->surname = $row['surname'];
        $this->lastname = $row['lastname'];
        $this->email = $row['email'];
    }

    function update()
    {
        // Запрос для обновления профиля
        $query = "UPDATE " . $this->table_name . "
            SET
                name = :name,
                surname = :surname,
                lastname = :lastname,
                email = :email
            WHERE
                id = :id";

        // Подготовка запроса
        $stmt = $this->conn->prepare($query);

        // Очистка данных
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->surname = htmlspecialchars(strip_tags($this->surname));
        $this->lastname = htmlspecialchars(strip_tags($this->lastname));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Привязываем значения
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":surname", $this->surname);
        $stmt->bindParam(":lastname", $this->lastname);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":id", $this->id);

        // Выполняем запрос
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    // В классе User добавьте следующий метод
    public function get_user_role($email)
    {
        // Запрос к базе данных для получения роли пользователя
        $query = "SELECT role FROM users WHERE email = :email";

        // Подготовка запроса
        $stmt = $this->conn->prepare($query);

        // Привязываем параметр
        $stmt->bindParam(':email', $email);

        // Выполняем запрос
        if ($stmt->execute()) {
            // Получаем результат
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Если результат не пустой, возвращаем роль пользователя
            if ($row) {
                return $row['role'];
            } else {
                // Если пользователь с таким email не найден, вернуть false или другое значение по умолчанию
                return false;
            }
        } else {
            // Обработка ошибки запроса, например, запись в логи и т.д.
            return false;
        }
    }
    // В классе User добавьте следующий метод
public function hasAdminRole($userId) {
    // Запрос к базе данных для получения роли пользователя
    $query = "SELECT role FROM users WHERE id = :id";

    // Подготовка запроса
    $stmt = $this->conn->prepare($query);

    // Привязываем параметр
    $stmt->bindParam(':id', $userId);

    // Выполняем запрос
    if ($stmt->execute()) {
        // Получаем результат
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Если результат не пустой, проверяем роль
        if ($row) {
            return $row['role'] == 2; // Возвращаем true, если роль администратора, иначе false
        } else {
            // Если пользователь с таким id не найден, вернуть false
            return false;
        }
    } else {
        // Обработка ошибки запроса, например, запись в логи и т.д.
        return false;
    }
}
}
?>